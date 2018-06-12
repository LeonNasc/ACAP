<?php
/**
 * Controlador simples para atualização de textos do site
 * Projeto site ACAP
 * 
 * @author Leon de França Nascimento
 */
ini_set('display_errors', 'on');
session_start();
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
  else if($task == 'LOGF'){
    $_SESSION['authentication_status'] = false;
    header('Location: /ACAP/textforms.php');
  }
}
else{
  $task = $_POST['task'];
  if ($task == 'AUTH'){
    try{
      $manager->authenticate($_POST['token']);
      header('Location: /ACAP/textforms.php');
    }
    catch(Exception $e){
      print("<div class='alert alert-warning'>Senha inválida</div>");
      header('Location: /ACAP/textforms.php');
    }
  }
  else if ($task == 'SETCTT'){
    print($manager->updateContent($_POST['type'],$_POST));
    header('Location: /ACAP/content.html');
  }
  else if ($task == 'PUBNEWS'){
    print($manager->publishNews());
  }
}

?>