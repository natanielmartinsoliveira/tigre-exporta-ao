<?php

namespace Drupal\tigre_custom\Plugin\QueueWorker;

use Drupal\node\Entity\Node;
use \Drupal\Core\Queue\QueueWorkerBase;

class ImportProdutoQueue extends QueueWorkerBase
{

    public function processItem($data)
    {
        $detail = $data['detail'];
        $this->crateProduct($detail);
    }

    public function crateProduct($detail)
    {
        $info = $detail['produto'];
        foreach ($info as $nid => $produto) {

            if (!isset($produto['uuid'][0]['value'])) {
                return null;
            }

            if ($nid == 'pt-br') {
                // TODO: Implement processItem() method.
                /** @var \Drupal\node\Entity\Node $current_product */
                $current_product = \Drupal::service('entity.repository')->loadEntityByUuid('node', $produto['uuid']['0']['value']);

                if (empty($current_product)) {
                    $node = Node::create([
                        'type' => 'produto',
                    ]);
                } else {
                    $node = Node::load($current_product->id());
                }
            } else {
                if ($node->hasTranslation($nid)) {
                    $node = $node->getTranslation($nid);
                } else {
                    $node = $node->addTranslation($nid);
                }
            }

            $node->set('uuid', $produto['uuid'][0]['value']);

            $node->set('title', $produto['title'][0]['value']);
            $node->set('body', array('format' => 'full_html', 'value' => $produto['body'][0]['value']));

            if (!empty($produto['model'])) {
                $node->set('field_sku', $produto['model'][0]['value']);
            }
            if (!empty($produto['uc_product_image'])) {
                $node->set('field_uc_product_image_url', $produto['uc_product_image'][0]['url']);
            }
            if (!empty($produto['field_produto_chamada'])) {
                $node->set('field_produto_chamada', $produto['field_produto_chamada'][0]['value']);
            }
            if (!empty($produto['field_produto_descricao'])) {
                $node->set('field_produto_descricao', array('format' => 'full_html', 'value' => $produto['field_produto_descricao'][0]['value']));
            }
            if (!empty($produto['field_desenho_tecnico'])) {
                $node->set('field_desenho_tecnico', $produto['field_desenho_tecnico'][0]['value']);
            }
            if (!empty($produto['field_ficha_seguranca'])) {
                $node->set('field_ficha_seguranca', $produto['field_ficha_seguranca'][0]['value']);
            }
            if (!empty($produto['field_ficha_tecnica'])) {
                $node->set('field_ficha_tecnica_url', $produto['field_ficha_tecnica'][0]['url']);
            }
            if (!empty($produto['field_produtos_instrucoes'])) {
                $node->set('field_produto_instrucoes', array('format' => 'full_html', 'value' => $produto['field_produtos_instrucoes'][0]['value']));
            }
            if (!empty($produto['field_keywords'])) {
                $node->set('field_keywords', $produto['field_keywords'][0]['value']);
            }
            if (!empty($produto['field_label_aba_1'])) {
                $node->set('field_label_aba_1', $produto['field_label_aba_1'][0]['value']);
            }
            if (!empty($produto['field_label_aba_2'])) {
                $node->set('field_label_aba_2', $produto['field_label_aba_2'][0]['value']);
            }
            if (!empty($produto['field_label_aba_3'])) {
                $node->set('field_label_aba_3', $produto['field_label_aba_3'][0]['value']);
            }
            if (!empty($produto['field_label_coluna_1_aba_1'])) {
                $node->set('field_label_coluna_1_aba_1', $produto['field_label_coluna_1_aba_1'][0]['value']);
            }
            if (!empty($produto['field_label_coluna_2_aba_1'])) {
                $node->set('field_label_coluna_2_aba_1', $produto['field_label_coluna_2_aba_1'][0]['value']);
            }
            if (!empty($produto['field_label_da_coluna_modelo'])) {
                $node->set('field_label_da_coluna_modelo', $produto['field_label_da_coluna_modelo'][0]['value']);
            }
            if (!empty($produto['field_meta_tags'])) {
                $node->set('field_meta_tags', $produto['field_meta_tags'][0]['value']);
            }
            if (!empty($produto['field_prioridade'])) {
                $node->set('field_prioridade', $produto['field_prioridade'][0]['value']);
            }
            if (!empty($produto['field_produto_genero'])) {
                $node->set('field_produto_genero', $produto['field_produto_genero'][0]['value']);
            }
            if (!empty($produto['field_produto_revisado'])) {
                $node->set('field_produto_revisado', $produto['field_produto_revisado'][0]['value']);
            }

            // if (!empty($produto['taxonomy_catalog'])) {
            //     foreach ($produto['taxonomy_catalog'] as $term) {
            //         $taxId = (string) $term['target_id'];
            //         $node->field_taxonomy_catalog->appendItem(['target_id' => (int) $produto['taxonomias'][$nid][$taxId]]);
            //     }
            // }

            if (!empty($produto['field_texto_tecnico'])) {
                $node->set('field_texto_tecnico', array('format' => 'full_html', 'value' => $produto['field_texto_tecnico'][0]['value']));
            }
            if (!empty($produto['field_titulo_especificacao'])) {
                $node->set('field_titulo_especificacao', $produto['field_titulo_especificacao'][0]['value']);
            }
            if (!empty($produto['field_video'])) {
                $node->set('field_video', $produto['field_video'][0]['value']);
            }
            if (!empty($produto['field_video_titulo'])) {
                $node->set('field_video_titulo', $produto['field_video_titulo'][0]['value']);
            }

            $node->save();
        }
    }
}
