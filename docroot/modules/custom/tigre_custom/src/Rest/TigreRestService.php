<?php

namespace Drupal\tigre_custom\Rest;

/**
 * Created by PhpStorm.
 * User: julio
 * Date: 3/3/18
 * Time: 8:01 PM
 */
class TigreRestService {

  protected $curl;
  protected $username;
  protected $password;
  protected $host;

  /**
   * @return string
   */
  public function getUsername(): string {
    return $this->username;
  }

  /**
   * @param string $username
   */
  public function setUsername(string $username) {
    $this->username = $username;
  }

  /**
   * @return string
   */
  public function getPassword(): string {
    return $this->password;
  }

  /**
   * @param string $password
   */
  public function setPassword(string $password) {
    $this->password = $password;
  }

  /**
   * @return mixed
   */
  public function getHost() {
    return $this->host;
  }

  /**
   * @param mixed $host
   */
  public function setHost($host) {
    $this->host = $host;
  }


  public function getProducts() {
    $this->curl = curl_init($this->host . "/nodes/products/list?_format=json");
    return $this->getResult();
  }

  public function getDetailProduct($url) {
    $this->curl = curl_init($url . '?_format=json');
    return $this->getResult();
  }

  public function getResult() {
    curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '. base64_encode($this->username . ':' . $this->password)));
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,1);
    $data = curl_exec($this->curl);
    curl_close($this->curl);
    return json_decode($data, TRUE);
  }
}