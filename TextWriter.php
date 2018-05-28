<?php

/**
 * Escritor de texto para atualização de textos do site
 * Projeto site ACAP
 * 
 * @author Leon de França Nascimento
 */
require_once('FileReader.php');

class TextWriter extends FileReader{

  const TXT_DIR = __DIR__.'/txt/';

  public static function UpdateTexts($content_array){
    foreach ($content_array as $area => $text) {
      self::updateSection($area,$text);
    }
  }

  private function updateSection($area,$text){
    $section = TextWriter::openFile(TXT_DIR.$area.".txt",true);
    TextWriter::HTMLifyText($section);
    TextWriter::writeContents($section);
    TextWriter::closeFile($section);
  }

  private static function HTMLifyText($text){

  }

  public static function getTexts(){    
    
    $a = TextWriter::readContents(self::TXT_DIR);
    
    print($a);
  }
}
?>