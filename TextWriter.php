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
    TextWriter::writeContents($section);
    TextWriter::closeFile($section);
  }

  private static function HTMLifyText($text,$section_name){
    
    if(strpos($section_name,'title')){
      $HTML = TextWriter::HTMLifyTitles($text);
    }
    else if (strpos($section_name,'signature')){
      $HTML = TextWriter::HTMLifySignature($text);
    }
    else{
      $HTML = TextWriter::HTMLifyParagraphs($text);
    }
    
    return $HTML;
  }

  private static function HTMLifyParagraphs($paragraphs){
    $paragraphs = explode("\n",$paragraphs);
    $count = 0;

    //Cada paragrafo deve ocupar uma linha continua no arquivo de texto
    //pois cada caractere \n inicia um novo parágrafo
    foreach($paragraphs as $paragraph){
      $paragraphs[$count] = "<p>";
      $paragraphs[$count] .= $paragraph;
      $paragraphs[$count] .= "</p>";
      $count++;      
    }
    return TextWriter::balanceParagraphs($paragraphs);
  }

  private static function balanceParagraphs($paragraphs){
    //$paragraphs é array
    $halfway_point =  floor(sizeof($paragraphs)/2);
    $first_half = array_slice($paragraphs,0,$halfway_point);
    $second_half = array_slice($paragraphs,$halfway_point+1);

    $firsthalf_HTML = implode("",$first_half);
    $secondhalf_HTML = implode("",$second_half);

    $iterable = Array($firsthalf_HTML,$secondhalf_HTML);

    for($i = 0; i<sizeof($iterable);$i++){
      $iterable[$i] = '<div class="col-xs-12 col-md-6>'
                        .$iterable.[$i].
                      '</div>';
    }
    
    return implode("",$iterable);
  }

  private static function HTMLifyTitles($title){
    return "<h3 class='title'>".$title ."</h3><hr style='width:100%'>";
  }

  private static function HTMLifySignature($signature){
    $lines = explode("\n",$signature);

    $HTML = "<div id='signature'>";
    $HTML .= "<strong>".$lines[0]."</strong>";
    $HTML .= "<br><small>".$lines[0]."</small>";
    $HTML .= "</div>";

    return $HTML;
  }

  public static function getTexts(){    
    
    $plaintexts = TextWriter::readFolderContents(self::TXT_DIR);
    $HTML = [];

    foreach($plaintexts as $section => $text){
      //Caracteres removidos: 6 (numero, underscore e .txt)
      $section_name = substr($section,2,strlen($section)-6);
      $HTML[$section_name] = TextWriter::HTMLifyText($text,$section_name);
    }
    
    return JSON_encode($HTML);
  }
  

  
}
?>