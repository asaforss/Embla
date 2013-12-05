<?php

/**
 * CMovies is a class that handles movies and database
 *
 * @author Åsa
 */
class CBListSort{
  
   /**
   * Constructor
   *
   */
   public function __construct() {
    
    }
    
    

 /**
 * Use the current querystring as base, modify it according to $options and return the modified query string.
 *
 * @param array $options to set/change.
 * @param string $prepend this to the resulting query string
 * @return string with an updated query string.
 */
function getQueryString($options = array(), $prepend = '?') {
    // parse query string into array
    $query = array();
    parse_str($_SERVER['QUERY_STRING'], $query);

    // Modify the existing query string with new options
    $query = array_merge($query, $options);

    // Return the modified querystring
    return $prepend . htmlentities(http_build_query($query));
}

/**
 * Create links for hits per page.
 *
 * @param array $hits a list of hits-options to display.
 * @param array $current value.
 * @return string as a link to this page.
 */
function getHitsPerPage($hits, $current = null) {
    $nav = "Träffar per sida: ";
    foreach ($hits AS $val) {
        if ($current == $val) {
            $nav .= "$val ";
        } else {
            $nav .= "<a href='" . $this->getQueryString(array('hits' => $val)) . "'>$val</a> ";
        }
    }
    return $nav;
}

/**
 * Create navigation among pages.
 *
 * @param integer $hits per page.
 * @param integer $page current page.
 * @param integer $max number of pages. 
 * @param integer $min is the first page number, usually 0 or 1. 
 * @return string as a link to this page.
 */
function getPageNavigation($hits, $page, $max, $min = 1) {
    $nav = ($page != $min) ? "<a href='".$this->getQueryString(array('page' => $min))."'>&lt;&lt;</a>" : '&lt;&lt;';
    $nav .= ($page > $min) ? "<a href='".$this->getQueryString(array('page' => ($page > $min ? $page - 1 : $min)))."'>&lt;</a>" : '&lt;';

    for ($i = $min; $i <= $max; $i++) {
        if ($page == $i) {
            $nav .= "$i ";
        } else {
            $nav .= "<a href='".$this->getQueryString(array('page' => $i)) ."'>$i</a> ";
        }
    }

    $nav .= ($page < $max) ? "<a href='".$this->getQueryString(array('page' => ($page < $max ? $page + 1 : $max)))."'>&gt;</a>" : '&gt;';
    $nav .= ($page != $max) ? "<a href='".$this->getQueryString(array('page' => $max))."'>&gt;&gt;</a> " : '&gt;&gt; ';
    return $nav;
}

/**
 * Function to create links for sorting
 *
 * @param string $column the name of the database column to sort by
 * @return string with links to order by column.
 */
function orderby($column) {
    $nav = "<a href='" . $this->getQueryString(array('orderby' => $column, 'order' => 'asc')) . "'>&darr;</a>";
    $nav .= "<a href='" . $this->getQueryString(array('orderby' => $column, 'order' => 'desc')) . "'>&uarr;</a>";
    return "<span class='orderby'>" .$nav . "</span>";
}

}

