<?php

namespace Drupal\tigre_custom\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\tigre_custom\Rest\TigreRestService;

/**
 * Created by PhpStorm.
 * User: julio
 * Date: 3/3/18
 * Time: 8:30 PM
 */
class TigreCustomController extends ControllerBase {

  public function product() {
    tigre_custom_queue_import_produto_cronjob();

    //tigre_list_products();

    /*$tigre_service = new TigreRestService();
    $tigre_service->setHost("http://34.193.90.181");
    //$tigre_service->setHost("https://www.tigre.com.br");
    $tigre_service->setUsername("lucas");
    $tigre_service->setPassword('102030');
    $produtos = $tigre_service->getProducts();
    $total = count($produtos);
    var_dump($total);*/

    die();

  }
}