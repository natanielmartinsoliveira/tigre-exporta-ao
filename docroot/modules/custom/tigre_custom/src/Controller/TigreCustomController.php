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
    tigre_list_products();
    die();
  }
}