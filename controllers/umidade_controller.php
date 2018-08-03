<?php
  class UmidadeController {
    /**
     * retrieveAll
     * ?controller=umidade&action=retrieveAll
     */
    public function retrieveAll() {
      Umidade::retrieveAll();
    }

    /**
     * retrieve
     * ?controller=umidade&action=retrieve&id=1
     */
    public function retrieve() {
      Umidade::retrieve($_GET['id']);
    }

    /**
     * create
     * ?controller=umidade&action=create&umidade=3
     */
    public function create() {
      if (!isset($_GET['umidade'])) {
        return false;
      }

      $umidade = new Umidade();
      $umidade->setUmidade($_GET['umidade']);
      $umidade->setTempo(date('Y-m-d H:i:s', time()));
      $umidade->create();
    }

    /**
     * update
     * ?controller=umidade&action=update&id=1&umidade=4
     */
    public function update() {
      $id = $_GET['id'];
      if (!isset($id)) {
        return false;
      }
      $id = intval($id);
      if (!$id) {
        return false;
      }

      $umidade = new Umidade();
      $umidade->setId($id);
      $umidade->setUmidade($_GET['umidade']);
      $umidade->setTempo(date('Y-m-d H:i:s', time()));
      $umidade->update();
    }

    /**
     * delete
     * ?controller=umidade&action=delete&id=7
     */
    public function delete() {
      Umidade::delete($_GET['id']);
    }
  }
?>