<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 3/4/18
 * Time: 11:22 PM
 */

namespace Drupal\tigre_custom\Plugin\QueueWorker;

/**
 * Processes Tasks for Learning.
 *
 * @QueueWorker(
 *   id = "tigre_custom_queue_worker",
 *   title = @Translation("Import Tigre produtos"),
 *   cron = {"time" = 600}
 * )
 */
class CronEventProcessor extends ImportProdutoQueue {

}