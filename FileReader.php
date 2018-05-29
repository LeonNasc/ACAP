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

  protected static function readFolderContents($dir){
    $files = scandir($dir);
    $contentArray = [];

    //Contamos a partir de 2 pois 0 e 1 são . e .. , respectivamente
    for ($i = 2;$i<sizeof($files);$i++){
      $file = fopen($dir.$files[$i],'r');

      $contentArray[$files[$i]] = fread($file, filesize($dir.$files[$i]));
      FileReader::closeFile($file);
    }
    
    return $contentArray;
  }

}
?>