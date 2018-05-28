<?php

/**
 * Wrapper simples para leitura de arquivos do site
 * Projeto site ACAP
 * 
 * @author Leon de França Nascimento
 */

class FileReader{

  
  const IMG_DIR = __DIR__.'/img';
  const NEWS_DIR = __DIR__.'/news';

  protected static function openFile($path,$write_enabled = false){

    //$write_enabled is boolean

    $write_enabled = $write_enabled ? 'w+' : 'r+' ;

    if(file_exists($path)){
      $file = fopen($path,$write_enabled);
    }
    else {
      return 'FAILURE';
    }

    return $file;
  }

  protected static function closeFile($file){
    if($file){
      fclose($file);
      return;
    }
    return new Exception("Nenhum arquivo a ser fechado");
  }

  protected static function writeContents($file,$content){
    fwrite($file, $content);
  }

  protected static function readContents($dir){
    $files = scandir($dir);
    $content = "";
    for ($i = 2;$i<sizeof($files);$i++){
      $file = fopen($dir.$files[$i],'r');

      $content .= fread($file, filesize($dir.$files[$i]));
    }

    return $content;
  }
}
?>