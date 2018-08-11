<?php
  require_once('connection.php');
  require_once('mutations.php');

  createTablesDatabase(Db::getInstance());

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'home';
  }

  require_once('routes.php');
?>