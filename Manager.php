<?php
/**
 * Controlador simples para atualização de textos do site
 * Projeto site ACAP
 *
 * @author Leon de França Nascimento
 */

require_once "Authenticator.php";
require_once "TextWriter.php";
require_once "NewsWriter.php";
require_once "ImageChanger.php";

class Manager
{

    public function __construct()
    {

    }

    public function updateContent($type, $content = "")
    {

        if ($content) {

            switch ($type) {
                case 'TXT':
                    //Content is an array of texts
                    unset($content['task']);
                    unset($content['type']);
                    $content['historiasignature'] = $content['A2S'] . "\n" . $content['A2SS'];
                    unset($content['A2S'],$content['A2SS']);
                    TextWriter::UpdateTexts($content);
                    break;
                case 'IMG':
                    //Content is area and uploaded image
                    ImageChanger::UpdateImages($content);
                    break;
            }
        }
    }

    public function getContents($type)
    {
        switch ($type) {
            case 'TXT':
                return TextWriter::getTexts();
                break;
            case 'IMG':
                ImageChanger::getImages();
                break;
        }
    }
    public function authenticate($token){
       return new Authenticator($token);
    }

    public function updateNews($news)
    {
        NewsWriter::writeNews($news);
    }

    public function getNews()
    {
        NewsWriter::getNews();
    }

}
