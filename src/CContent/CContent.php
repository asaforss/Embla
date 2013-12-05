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
class CContent {
    
private $db;
//private $id;
 /**
   * Constructor
   *
   */
public function __construct($db) {
       
     $this->db=$db;
    }

function edit($current)
{
   // Get parameters 
$id    = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$title  = isset($_POST['title']) ? $_POST['title'] : null;
$slug   = isset($_POST['slug'])  ? $_POST['slug']  : null;

$data   = isset($_POST['data'])  ? $_POST['data'] : array();
$filter = isset($_POST['filter']) ? $_POST['filter'] : array();
$published = isset($_POST['published'])  ? strip_tags($_POST['published']) : array();


$sql = '
    UPDATE pblog SET
      title   = ?,
      slug    = ?,
      data    = ?,
      type    = ?,
      filter  = ?,
      published = ?,
      category=?,
      updated = ?
    WHERE 
      id = ?
  ';
  $params = array($title, $slug, $data,"post", $filter, $published,$current,"NOW()", $id);
  $this->db->ExecuteQuery($sql, $params);
  $output = 'Informationen sparades.';
  return $output;
}
function create($title)
{
  $sql = 'INSERT INTO pblog (title, user) VALUES (?,?)';
  $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
  $params = array($title,$acronym);
  $this->db->ExecuteQuery($sql,$params);
  header('Location: blog_edit.php?id=' . $this->db->LastInsertId());
}
function delete($id)
{
   $sql = 'DELETE FROM pblog WHERE id = ? LIMIT 1';
   $params = array($id);
   $this->db->ExecuteQuery($sql, $params);
   $output="Det raderades " . $this->db->RowCount() . " rader från databasen.";
   return $output;
}
function selectWithId($id)
{
    // Select from database
    $sql = 'SELECT * FROM pblog WHERE id = ?';
    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));
        if(isset($res[0])) {
            $c = $res[0];
            return $c;
        }
        else {
        die('Misslyckades: det finns inget innehåll med id '.$id);
            return null;
        }
}

function selectPageWithUrl($url)
{
   // Get content
$sql = "
SELECT *
FROM Content
WHERE
  type = 'page' AND
  url = ? AND
  published <= NOW();
";
$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($url));

if(isset($res[0])) {
  $c = $res[0];
  return $c;
}
else {
  die('Misslyckades: det finns inget innehåll.');
  return null;
}
}
function selectPostWithSlug($slug)
{
    // Get content
    $slugSql = $slug ? 'slug = ?' : '1';
    $sql = "
    SELECT *
    FROM pblog
    WHERE
        type = 'post' AND
        $slugSql AND
        published <= NOW()
    ORDER BY published DESC
    ;
    ";
    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($slug));
    return $res;
    
    }
}





