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
class CBlog extends CContent{
    
private $db;
//private $id;
 /**
   * Constructor
   *
   */
public function __construct($db) {
     parent::__construct($db);  
     $this->db=$db;
    }

function doBlogs(){
    // Get parameters 
$slug    = isset($_GET['slug']) ? $_GET['slug'] : null;
$res=$this->selectPostWithSlug($slug);

return $res;
}

function selectCategories(){
    $sql ="SELECT * FROM pbcategory";
    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);
    return $res;
}

function selectLatestBlogs()
{
    $sql='SELECT * FROM pblog
    ORDER BY published DESC
    LIMIT 3';
    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array());
    return $res;
        
    
}

}






