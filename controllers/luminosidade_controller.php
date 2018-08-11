<?php
  class LuminosidadeController {
    /**
     * retrieveAll
     * ?controller=luminosidade&action=retrieveAll
     */
    public function retrieveAll() {
      echo json_encode(Luminosidade::retrieveAll());
    }

    /**
     * retrieve
     * ?controller=luminosidade&action=retrieve&id=1
     */
    public function retrieve() {
      echo json_encode(Luminosidade::retrieve($_GET['id']));
    }

    /**
     * create
     * ?controller=luminosidade&action=create&luminosidade=3
     */
    public function create() {
      if (!isset($_GET['luminosidade'])) {
        echo json_encode("false");
      }

      $luminosidade = new Luminosidade();
      $luminosidade->setLuminosidade($_GET['luminosidade']);
      $luminosidade->setTempo(date('Y-m-d H:i:s', time()));
      echo json_encode($luminosidade->create());
    }

    /**
     * update
     * ?controller=luminosidade&action=update&id=1&luminosidade=4
     */
    public function update() {
      $id = $_GET['id'];
      if (!isset($id)) {
        echo json_encode("false");
      }
      $id = intval($id);
      if (!$id) {
        echo json_encode("false");
      }

      $luminosidade = new Luminosidade();
      $luminosidade->setId($id);
      $luminosidade->setLuminosidade($_GET['luminosidade']);
      $luminosidade->setTempo(date('Y-m-d H:i:s', time()));
      echo json_encode($luminosidade->update());
    }

    /**
     * delete
     * ?controller=luminosidade&action=delete&id=7
     */
    public function delete() {
      echo json_encode(Luminosidade::delete($_GET['id']));
    }
  }
?>