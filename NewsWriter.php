<?php
require_once('FileReader.php');
define('TXT_DIR', __DIR__ . '/pub_news/');

class NewsWriter extends FileReader
{
 
 public static function writeNews($meta_info, $content){
  //$meta_info é array, $content é string
   
   
 }
 
 private static function appendToNewsFile(){
   
   
 }
 
 public static function retrieveNews($uptodate){
   //$uptodate é a data máxima da notícia
   
   
 }  
 
 private static function readNewsFile(){
   
 }
  
}
?>