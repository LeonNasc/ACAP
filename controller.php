<?php
/**
 * Controlador simples para atualização de textos do site
 * Projeto site ACAP
 * 
 * @author Leon de França Nascimento
 */
ini_set('display_errors', 'on');

require_once("Manager.php");
$manager = new Manager();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
  $task = $_GET['task'];
  if ($task == 'GETCTT'){
    print($manager->getContents($_GET['type']));
  }
  else if ($task == 'GETNWS'){
    print($manager->getNews());
  }
}
else{
  $task = $_POST['task'];
  if ($task == 'AUTH'){
    print($manager->getContents($_GET['type']));
  }
  else if ($task == 'SETCTT'){
    print($manager->updateContent($_GET['type'],$_GET));
  }
  else if ($task == 'GETNWS'){
    print($manager->getNews());
  }
}

?>