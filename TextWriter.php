<?php

/**
 * Escritor de texto para atualização de textos do site
 * Projeto site ACAP
 *
 * @author Leon de França Nascimento
 */
require_once 'FileReader.php';
define('TXT_DIR', __DIR__ . '/txt/');

class TextWriter extends FileReader
{

    private static $FILENAMES = ["introtitle" => '0_introtitle.txt',
        "intro" => '1_intro.txt',
        "historiatitle" => '2_historiatitle.txt',
        "historia" => '3_historia.txt',
        "historiasignature" => '4_historiasignature.txt',
        "parceirostitle" => '5_parceirostitle.txt',
        "parceiros" => '6_parceiros.txt',
    ];

    const TXT_DIR = TXT_DIR;

    public static function UpdateTexts($content_array)
    { 
        
        foreach ($content_array as $area => $text) {
          if(trim($text) == ""){
            continue;
          }
          self::updateSection($area, $text);
        }
    }

    private function updateSection($area, $text)
    {
        

        $section = TextWriter::openFile(TextWriter::TXT_DIR . TextWriter::$FILENAMES[$area], true);
        TextWriter::writeContents($section, $text);
        TextWriter::closeFile($section);
    }

    public static function getTexts()
    {

        $plaintexts = TextWriter::readFolderContents(self::TXT_DIR);
        $HTML = [];

        foreach ($plaintexts as $section => $text) {
            //Caracteres removidos: 6 (numero, underscore e .txt)
            $section_name = substr($section, 2, strlen($section) - 6);
            $HTML[$section_name] = TextWriter::HTMLifyText($text, $section_name);

            if ($section_name == 'historia') {
                $HTML[$section_name] = TextWriter::balanceParagraphs($HTML[$section_name]);
            }
        }

        return JSON_encode($HTML);
    }

    private static function HTMLifyText($text, $section_name)
    {

        if (strpos($section_name, 'title')) {
            $HTML = TextWriter::HTMLifyTitles($text);
        } else if (strpos($section_name, 'signature')) {
            $HTML = TextWriter::HTMLifySignature($text);
        } else {
            $HTML = TextWriter::HTMLifyParagraphs($text);
        }

        return $HTML;
    }

    private static function HTMLifyParagraphs($paragraphs)
    {
        $paragraphs = explode("\n", $paragraphs);
        $count = 0;

        //Cada paragrafo deve ocupar uma linha continua no arquivo de texto
        //pois cada caractere \n inicia um novo parágrafo
        foreach ($paragraphs as $paragraph) {
            $paragraphs[$count] = "<p>";
            $paragraphs[$count] .= $paragraph;
            $paragraphs[$count] .= "</p>";
            $count++;
        }
       
        return implode("", $paragraphs);
    }

    private static function balanceParagraphs($paragraph_texts)
    {
        //$paragraphs é array
        $paragraphs = preg_split("/<p>[\s]<\/p>/", $paragraph_texts);
        
        $halfway_point = floor(sizeof($paragraphs) / 2);
        $first_half = array_slice($paragraphs, 0, $halfway_point);
        $second_half = array_slice($paragraphs, $halfway_point + 1);

        $firsthalf_HTML = implode("", $first_half);
        $secondhalf_HTML = implode("", $second_half);

        $iterable = [$firsthalf_HTML, $secondhalf_HTML];

        $returnHTML = "";

        //Foreach do php funciona com passagem via copia
        foreach ($iterable as $column) {
            $returnHTML .= '<div class="col-xs-12 col-md-6">'
                . $column .
                '</div>';
        }

        return $returnHTML;
    }

    private static function HTMLifyTitles($title)
    {
        return "<h3 class='title'>" . $title . "</h3><hr style='width:100%'>";
    }

    private static function HTMLifySignature($signature)
    {
        $lines = explode("\n", $signature);

        $HTML = "<hr><div id='signature'>";
        $HTML .= "<strong>" . $lines[0] . "</strong>";
        $HTML .= "<br><small>" . $lines[1] . "</small>";
        $HTML .= "</div>";

        return $HTML;
    }
}
