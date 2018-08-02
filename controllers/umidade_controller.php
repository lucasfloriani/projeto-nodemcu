<?php
  class UmidadeController {
    /**
     * url == ?controller=umidade&action=create&umidade=umidade
     */
    public function create() {
      echo '<pre>';
      var_dump($_GET['umidade'])
      echo '</pre>';
      if (!isset($_GET['umidade'])) {
        return false;
      }

      $umidade = new Umidade($_GET['umidade'], time());
      echo '-=-=-=-=-==-=-=-=-<br>';
      echo $umidade->create();
      echo '-=-=-=-=-==-=-=-=-';
    }
  }
?>