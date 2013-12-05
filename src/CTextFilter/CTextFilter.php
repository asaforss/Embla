<?php
//instantiate the markdown class and use it     
use \Michelf\MarkdownExtra; 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CTextFilter
 *
 * @author Åsa
 */
class CTextFilter {
    /**
 * Functions for filtering content.
 */

/**
 * Call each filter.
 *
 * @param string $filters as comma separated list of filter.
 * @return string the formatted text.
 */
public function doFilter($text, $filters) {
  $all = array(
    'bbcode'   => 'bbcode2html',
    'link'     => 'make_clickable',
    'markdown' => 'markdown',
    'nl2br'    => 'breakrow',  
  );

  $filter = preg_replace('/\s/', '', explode(',', $filters));
  foreach($filter as $val) {
            $text = $this->$all[$val]($text);
      } 

  return $text;
}
// taken from emil.e.johansson
public function breakrow($text) {
return nl2br($text);
}

/**
 * Helper, BBCode formatting converting to HTML.
 *
 * @link http://dbwebb.se/coachen/reguljara-uttryck-i-php-ger-bbcode-formattering
 * @param string text The text to be converted.
 * @return string the formatted text.
 */
public function bbcode2html($text) {
  $search = array( 
    '/\[b\](.*?)\[\/b\]/is', 
    '/\[i\](.*?)\[\/i\]/is', 
    '/\[u\](.*?)\[\/u\]/is', 
    '/\[img\](https?.*?)\[\/img\]/is', 
    '/\[url\](https?.*?)\[\/url\]/is', 
    '/\[url=(https?.*?)\](.*?)\[\/url\]/is' 
    );   
  $replace = array( 
    '<strong>$1</strong>', 
    '<em>$1</em>', 
    '<u>$1</u>', 
    '<img src="$1" />', 
    '<a href="$1">$1</a>', 
    '<a href="$1">$2</a>' 
    );     
  return preg_replace($search, $replace, $text);
}



/**
 * Make clickable links from URLs in text.
 *
 * @link http://dbwebb.se/coachen/lat-php-funktion-make-clickable-automatiskt-skapa-klickbara-lankar
 * @param string $text the text that should be formatted.
 * @return string with formatted anchors.
 */
public function make_clickable($text) {
  return preg_replace_callback(
    '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
    create_function(
      '$matches',
      'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
    ),
    $text
  );
}

/**
 * Format text according to Markdown syntax.
 *
 * @link http://dbwebb.se/coachen/skriv-for-webben-med-markdown-och-formattera-till-html-med-php
 * @param string $text the text that should be formatted.
 * @return string as the formatted html-text.
 */
public function markdown($text) {
  require_once(__DIR__ . '/php-markdown/Michelf/Markdown.php');
  require_once(__DIR__ . '/php-markdown/Michelf/MarkdownExtra.php');
  return MarkdownExtra::defaultTransform($text);
}

}

?>
