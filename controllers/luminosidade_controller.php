<?php
  class LuminosidadeController {
    /**
     * url == ?controller=luminosidade&action=create&luminosidade=luminosidade
     */
    public function create() {
      if (!isset($_GET['luminosidade'])) {
        return false;
      }

      $luminosidade = new Luminosidade($_GET['luminosidade'], time());
      $luminosidade->create();
    }
  }
?>