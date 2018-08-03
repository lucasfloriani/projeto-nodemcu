<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'pages':
        require_once('models/luminosidade.php');
        require_once('models/umidade.php');
        require_once('models/temperatura.php');
        $controller = new PagesController();
      break;
      case 'luminosidade':
        require_once('models/luminosidade.php');
        $controller = new LuminosidadeController();
      break;
      case 'umidade':
        require_once('models/umidade.php');
        $controller = new UmidadeController();
      break;
      case 'temperatura':
        require_once('models/temperatura.php');
        $controller = new TemperaturaController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(
    'pages' => ['home', 'error'],
    'luminosidade' => ['create', 'retrieve', 'retrieveAll', 'update', 'delete'],
    'umidade' => ['create', 'retrieve', 'retrieveAll', 'update', 'delete'],
    'temperatura' => ['create', 'retrieve', 'retrieveAll', 'update', 'delete']
  );

  // Se o controller que está no index.php estiver como chave dentro do array $controllers
  echo '-----------';
  echo $controller;
  echo '-----------';
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>