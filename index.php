<?php
/**
 * Controlador simples para atualização de textos do site
 * Projeto site ACAP
 * 
 * @author Leon de França Nascimento
 */
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'on');

require_once("Manager.php");

 echo 'Hello World';
 $manager = new Manager();

 $manager->setContents('TXT');
?>