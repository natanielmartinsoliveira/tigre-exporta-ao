<?php

namespace Drupal\tigre_custom\Controller;
use Drupal\Core\Controller\ControllerBase;
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 3/3/18
 * Time: 8:30 PM
 */
class TigreCustomController extends ControllerBase {

  public function product() {
    //tigre_list_products();
    $batch = array(
      'title' => t('Exporting'),
      'operations' => array(
        array('tigre_list_products'),
      ),
      'finished' => 'tigre_list_products_finished',
      'file' => drupal_get_path('module', 'tigre_custom') . '/tigre_custom.module',
    );

    batch_set($batch);

  }
}