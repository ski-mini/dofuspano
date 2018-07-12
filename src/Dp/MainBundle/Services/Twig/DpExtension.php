<?php
namespace Dp\MainBundle\Services\Twig;

class DpExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('slugify', array($this, 'slugify')),
        );
    }


    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    /**
     * Enleve les accents
     *
     * @param string nom du fichier avant nettoyage
     * @return string nom apres nettoyage
     */
    public function nettoyage_accent($nom)
    {

        $aReplace = array("À"=>"A","Á"=>"A","Â"=>"A","Ã"=>"A","Ä"=>"A","Å"=>"A","Ç"=>"C","Ð"=>"D","È"=>"E","É"=>"E","Ê"=>"E","Ë"=>"E","Ì"=>"I","Í"=>"I","Î"=>"I","Ï"=>"I","Ñ"=>"N","Ò"=>"O","Ó"=>"O","Ô"=>"O","Õ"=>"O","Ö"=>"O","Ø"=>"O","Š"=>"S","Ù"=>"U","Ú"=>"U","Û"=>"U","Ü"=>"U","Ý"=>"Y","Ž"=>"Z","à"=>"a","á"=>"a","â"=>"a","ã"=>"a","ä"=>"a","å"=>"a","ç"=>"c","è"=>"e","é"=>"e","ê"=>"e","ë"=>"e","ì"=>"i","í"=>"i","î"=>"i","ï"=>"i","ñ"=>"n","ð"=>"o","ò"=>"o","ó"=>"o","ô"=>"o","õ"=>"o","ö"=>"o","ø"=>"o","š"=>"s","ù"=>"u","ú"=>"u","û"=>"u","ü"=>"u","ý"=>"y","ÿ"=>"y","ž"=>"z","Æ"=>"Ae","æ"=>"ae","Œ"=>"Oe","œ"=>"oe","ß"=>"ss","Ä"=>"Ae","ä"=>"ae","Ö"=>"O","ö"=>"o","Ü"=>"U","ü"=>"u");
        $nom =  strtr($nom, $aReplace);

        return $nom;
    }


    public function getName()
    {
        return 'dp_extension';
    }
}