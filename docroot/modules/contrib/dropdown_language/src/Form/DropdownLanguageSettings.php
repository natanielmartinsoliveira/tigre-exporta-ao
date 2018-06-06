<?php

namespace Drupal\dropdown_language\Form;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Database\Connection;
use Drupal\Core\Database\Database;
use Drupal\Core\Database\DatabaseException;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\MapArray;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a configuration form for global settings.
 */
class DropdownLanguageSettings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dropdown_language_config';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'dropdown_language.setting',
    ];
  }

  /**
   * The database connection object.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a new DblogClearLogConfirmForm.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection.
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('dropdown_language.setting');

    $form['display_language_id'] = [
      '#type' => 'radios',
      '#options' => [
        '0' => $this->t('Language Name'),
        '1' => $this->t('Language ID'),
        '2' => $this->t('Native Name'),
        '3' => $this->t('Custom Labels'),
      ],
      '#title' => $this->t('Display Language Labelling'),
      '#default_value' => $config->get('display_language_id'),
    ];
    $form['display_language_id'][2]['#description'] = $this->t('Langauge Name used as title attribute');
    $form['display_language_id'][3]['#description'] = $this->t('Each block instance will provide fields for label names.');

    $form['decor'] = [
      '#type' => 'details',
      '#title' => $this->t('<q>Switch Language</q> Decor'),
      '#open' => TRUE,
    ];

    $form['decor']['wrapper'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show block with fieldset wrapping'),
      '#default_value' => $config->get('wrapper'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('dropdown_language.setting')
      ->set('wrapper', $form_state->getValue('wrapper'))
      ->set('display_language_id', $form_state->getValue('display_language_id'))
      ->save();

    $dropdown_blocks = $this->connection->select('cache_config', 'cc')
      ->fields('cc', ['cid'])
      ->condition('cid', $this->connection->escapeLike('block.block.dropdownlanguage') . "%", 'LIKE')
      ->execute()
      ->fetchAllAssoc('cid');
    if (!empty($dropdown_blocks)){
       foreach($dropdown_blocks as $key => $id){
         $dropdown_blocks[$key] = 'config:' . $id->cid;

       }
       Cache::invalidateTags(array_values($dropdown_blocks));
    }

    parent::submitForm($form, $form_state);
  }

}
