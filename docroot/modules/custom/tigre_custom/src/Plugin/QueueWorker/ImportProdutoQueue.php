<?php

namespace Drupal\tigre_custom\Plugin\QueueWorker;
use Drupal\node\Entity\Node;
use \Drupal\Core\Queue\QueueWorkerBase;

class ImportProdutoQueue extends QueueWorkerBase {

  /**
   * Processes Tasks for Learning.
   *
   * @QueueWorker(
   *   id = "import_produto_queue",
   *   title = @Translation("Import Tigre produtos"),
   *   cron = {"time" = 60}
   * )
   */
  public function processItem($data) {
    $detail = $data['detail'];
    // TODO: Implement processItem() method.
    /** @var \Drupal\node\Entity\Node $current_product */
    $current_product = \Drupal::service('entity.repository')->loadEntityByUuid('node', $detail['uuid']['0']['value']);

    if (empty($current_product)) {
      $node = Node::create([
        'type' => 'produto',
      ]);
    }
    else {
      $node = Node::load($current_product->id());
    }
    $node->set('uuid', $detail['uuid'][0]['value']);
    $node->set('title', $detail['title'][0]['value']);
    $node->set('body', $detail['body'][0]['value']);
    /*if (!empty($detail['field_produto_banners'])) {
      $node->set('field_produto_banners', $detail['field_produto_banners'][0]['value']);
    }*/
    if (!empty($detail['field_produto_chamada'])) {
      $node->set('field_produto_chamada', $detail['field_produto_chamada'][0]['value']);
    }
    if (!empty($detail['field_produto_descricao'])) {
      $node->set('field_produto_descricao', $detail['field_produto_descricao'][0]['value']);
    }
    if (!empty($detail['field_desenho_tecnico'])) {
      $node->set('field_desenho_tecnico', $detail['field_desenho_tecnico'][0]['value']);
    }
    if (!empty($detail['field_ficha_seguranca'])) {
      $node->set('field_ficha_seguranca', $detail['field_ficha_seguranca'][0]['value']);
    }
    if (!empty($detail['field_ficha_tecnica'])) {
      $node->set('field_ficha_tecnica', $detail['field_ficha_tecnica'][0]['value']);
    }
    if (!empty($detail['field_produtos_instrucoes'])) {
      $node->set('field_produto_instrucoes', $detail['field_produtos_instrucoes'][0]['value']);
    }
    if (!empty($detail['field_keywords'])) {
      $node->set('field_keywords', $detail['field_keywords'][0]['value']);
    }
    if (!empty($detail['field_label_aba_1'])) {
      $node->set('field_label_aba_1', $detail['field_label_aba_1'][0]['value']);
    }
    if (!empty($detail['field_label_aba_2'])) {
      $node->set('field_label_aba_2', $detail['field_label_aba_2'][0]['value']);
    }
    if (!empty($detail['field_label_aba_3'])) {
      $node->set('field_label_aba_3', $detail['field_label_aba_3'][0]['value']);
    }
    if (!empty($detail['field_label_coluna_1_aba_1'])) {
      $node->set('field_label_coluna_1_aba_1', $detail['field_label_coluna_1_aba_1'][0]['value']);
    }
    if (!empty($detail['field_label_coluna_2_aba_1'])) {
      $node->set('field_label_coluna_2_aba_1', $detail['field_label_coluna_2_aba_1'][0]['value']);
    }
    if (!empty($detail['field_label_da_coluna_modelo'])){
      $node->set('field_label_da_coluna_modelo', $detail['field_label_da_coluna_modelo'][0]['value']);
    }
    if (!empty($detail['field_meta_tags'])) {
      $node->set('field_meta_tags', $detail['field_meta_tags'][0]['value']);
    }
    if (!empty($detail['field_prioridade'])) {
      $node->set('field_prioridade', $detail['field_prioridade'][0]['value']);
    }
    if (!empty($detail['field_produto_genero'])) {
      $node->set('field_produto_genero', $detail['field_produto_genero'][0]['value']);
    }
    if (!empty($detail['field_produto_revisado'])) {
      $node->set('field_produto_revisado', $detail['field_produto_revisado'][0]['value']);
    }
    //      $node->set('field_taxonomy_catalog', $detail['taxonomy_catalog']['value']);
    if (!empty($detail['field_texto_tecnico'])){
      $node->set('field_texto_tecnico', $detail['field_texto_tecnico'][0]['value']);
    }
    if (!empty($detail['field_titulo_especificacao'])) {
      $node->set('field_titulo_especificacao', $detail['field_titulo_especificacao'][0]['value']);
    }
    if (!empty($detail['field_video'])) {
      $node->set('field_video', $detail['field_video'][0]['value']);
    }
    if (!empty($detail['field_video_titulo'])) {
      $node->set('field_video_titulo', $detail['field_video_titulo'][0]['value']);
    }

    $node->save();
  }

}