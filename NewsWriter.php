<?php
require_once('FileReader.php');
define('NEWS_DIR', __DIR__ . '/pub_news/');

class NewsWriter extends FileReader
{
 
 const NEWS_DIR = NEWS_DIR;
  
 private static $NEWSFILE = 'newsfile.txt';

 public static function writeNews($meta_info, $content){
  //$meta_info é array, $content é string
  $newsArray = Array($meta_info, $content);
  $newsJSON = JSON_encode($newsArray);
   
  NewsWriter::appendToNewsFile($newsJSON);   
 }
 
 private static function appendToNewsFile($news){
  $newsfile = self::openFile(self::NEWS_DIR . self::$NEWSFILE, true);
  self::writeContents($newsfile,$news);
  self::closeFile($section);   
 }
 
 public static function retrieveNews($uptodate = null){
   //$uptodate é a data máxima da notícia
   $news =  self::readNewsFile();
   
   $news = sortNewsByDate($uptodate);

   $news = JSON_encode($news);

   return $news;
 }  

 private static function sortNewsByDate($maxDate = null){
   //TODO: Tudo
 }
 
 private static function readNewsFile(){
  $news = self::readFolderContents(self::NEWS_DIR);
  $news = $news[0]; //Somente há um arquivo de notícias
  $news = JSON_decode($news);

  return $news;
 }
  
}
?>