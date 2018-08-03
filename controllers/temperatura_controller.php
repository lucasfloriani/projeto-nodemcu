<?php
  class TemperaturaController {
    /**
     * retrieveAll
     * ?controller=temperatura&action=retrieveAll
     */
    public function retrieveAll() {
      Temperatura::retrieveAll();
    }

    /**
     * retrieve
     * ?controller=temperatura&action=retrieve&id=1
     */
    public function retrieve() {
      Temperatura::retrieve($_GET['id']);
    }

    /**
     * create
     * ?controller=temperatura&action=create&temperatura=3
     */
    public function create() {
      if (!isset($_GET['temperatura'])) {
        return false;
      }

      $temperatura = new Temperatura();
      $temperatura->setTemperatura($_GET['temperatura']);
      $temperatura->setTempo(date('Y-m-d H:i:s', time()));
      $temperatura->create();
    }

    /**
     * update
     * ?controller=temperatura&action=update&id=1&temperatura=4
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

      $temperatura = new Temperatura();
      $temperatura->setId($id);
      $temperatura->setTemperatura($_GET['temperatura']);
      $temperatura->setTempo(date('Y-m-d H:i:s', time()));
      $temperatura->update();
    }

    /**
     * delete
     * ?controller=temperatura&action=delete&id=7
     */
    public function delete() {
      Temperatura::delete($_GET['id']);
    }
  }
?>