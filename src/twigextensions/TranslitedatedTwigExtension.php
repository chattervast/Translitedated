<?php
/**
 * Translitedated plugin for Craft CMS 3.x
 *
 * Twig filter to output dates in any locale (language).
 *
 * @link      https://github.com/chattervast
 * @copyright Copyright (c) 2018 Chattervast
 */

namespace chattervast\translitedated\twigextensions;

use chattervast\translitedated\Translitedated;

use Craft;

/**
 * @author    Chattervast
 * @package   Translitedated
 * @since     1.0
 */
class TranslitedatedTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Translitedated';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('dated', [$this, 'dated']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('dated', [$this, 'dated']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     */
    public function dated($date, $format, $locale)
    {
	    setlocale(LC_TIME, $locale);
	    
		$result = $date->format('U');
		
        //return date($format, $result);
/*
        $old_date = date('l, F d y h:i:s');              // returns Saturday, January 30 10 02:06:34
		$result = strtotime($result);
		return $new_date = date($format, $date);
*/ 
/*
		$old_date = date('l, F d y h:i:s');              // returns Saturday, January 30 10 02:06:34
		$old_date_timestamp = strtotime($old_date);
		return date('Y-m-d H:i:s', $old_date_timestamp); 
*/
		$search  = array('Y',  'y',  'M',  'm',  'D',     'd',     'l',  'j',  'N',  'S',  'W',  'F',  'o',  'H',  'h',  'g',  'a',  'A',  'i',  's',  'u',  'O',  'T');
		$replace = array('%Y', '%y', '%B', '%b', '%A %d', '%A %d', '%A', '%e', '%u', '%O', '%W', '%B', '%g', '%H', '%I', '%l', '%P', '%p', '%M', '%S', '%s', '%z', '%Z');
		
		$format = str_replace($search, $replace, $format);
        
        return strftime($format, $result);
    }
}
