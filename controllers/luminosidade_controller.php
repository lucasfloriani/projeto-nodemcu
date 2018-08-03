<?php
  class LuminosidadeController {
    /**
     * retrieveAll
     * ?controller=luminosidade&action=retrieveAll
     */
    public function retrieveAll() {
      Luminosidade::retrieveAll();
    }

    /**
     * retrieve
     * ?controller=luminosidade&action=retrieve&id=1
     */
    public function retrieve() {
      Luminosidade::retrieve($_GET['id']);
    }

    /**
     * create
     * ?controller=luminosidade&action=create&luminosidade=3
     */
    public function create() {
      if (!isset($_GET['luminosidade'])) {
        return false;
      }

      $luminosidade = new Luminosidade();
      $luminosidade->setLuminosidade($_GET['luminosidade']);
      $luminosidade->setTempo(date('Y-m-d H:i:s', time()));
      $luminosidade->create();
    }

    /**
     * update
     * ?controller=luminosidade&action=update&id=1&luminosidade=4
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

      $luminosidade = new Luminosidade();
      $luminosidade->setId($id);
      $luminosidade->setLuminosidade($_GET['luminosidade']);
      $luminosidade->setTempo(date('Y-m-d H:i:s', time()));
      $luminosidade->update();
    }

    /**
     * delete
     * ?controller=luminosidade&action=delete&id=7
     */
    public function delete() {
      Luminosidade::delete($_GET['id']);
    }
  }
?>