<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CContent
 *
 * @author Åsa
 */
class CPage extends CContent{
    

//private $id;
 /**
   * Constructor
   *
   */
public function __construct($db) {
     parent::__construct($db);  
    
    }

function doPage(){

$url     = isset($_GET['url']) ? $_GET['url'] : null;
$c=$this->selectPageWithUrl($url);
return $c;

}

}





