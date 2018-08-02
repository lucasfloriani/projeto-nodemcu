<?php
  class TemperaturaController {
    /**
     * url == ?controller=temperatura&action=create&temperatura=temperatura
     */
    public function create() {
      if (!isset($_GET['temperatura'])) {
        return false;
      }

      $temperatura = new Temperatura($_GET['temperatura'], time());
      $temperatura->create();
    }
  }
?>