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
    
    $paragraphs = explode("\n",$text);
    $count = 0;

    foreach($paragraphs as $paragraph){
      $paragraphs[$count] = "<p>";
      $paragraphs[$count] .= $paragraph;
      $paragraphs[$count] .= "</p>";
      $count++;      
    }
    return implode("",$paragraphs);
  }

  public static function getTexts(){    
    
    $plaintexts = TextWriter::readFolderContents(self::TXT_DIR);
    $HTML = [];

    foreach($plaintexts as $section => $text){
      //Caracteres removidos: 6 (numero, underscore e .txt)
      $section_name = substr($section,2,strlen($section)-6);
      $HTML[$section_name] = TextWriter::HTMLifyText($text);
    }

    return JSON_encode($HTML);
  }
  

  
}
?>