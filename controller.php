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
  echo "Not yet implemented";
  // print($manager->getContents($_GET['type']));
}

?>