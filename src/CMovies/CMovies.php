<?php

/**
 * CMovies is a class that handles movies and database
 *
 * @author Åsa
 */
class CMovies extends CBListSort{
   /**
   * Properties
   *
   */
    private $db;
    private $sqlOrig;
    private $where;
    private $groupby;
    private $params; 
   
   /**
   * Constructor
   *
   */
   public function __construct($db) {
       parent::__construct();
     $this->db=$db;
    }
    
    


/**
 * Function to get movie table
 *
 */
function getTable(){
// Get parameters 
$title = htmlentities(isset($_GET['title']) ? $_GET['title'] : null);
$title=  str_replace('*', '%', $title);
$hits = isset($_GET['hits']) ? $_GET['hits'] : 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$orderby = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'title';
$order = isset($_GET['order']) ? strtolower($_GET['order']) : 'asc';


// Check that incoming parameters are valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');




// Prepare the query based on incoming arguments
$this->sqlOrig = '
  SELECT 
    M.* FROM pmovie AS M
    
';
$this->where = null;
$this->groupby = ' GROUP BY M.id';
$limit = null;
$sort = " ORDER BY $orderby $order";
$this->params= array();


// Select by title
if ($title) {
    $this->where .= ' AND title LIKE ?';
    $this->params[] = $title;
}



// Pagination
if ($hits && $page) {
    $limit = " LIMIT $hits OFFSET " . (($page - 1) * $hits);
}


// Complete the sql statement
$this->where = $this->where ? " WHERE 1 {$this->where}" : null;
$sql = $this->sqlOrig . $this->where . $this->groupby . $sort . $limit;
$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $this->params);

$htmledit="";
$htmlrubrik="";
if(isset($_SESSION['user']))
{
    $htmlrubrik="</th><th></th><th></th>";
   
}
//// Put results into a HTML-table
$tr = "<tr><th>Bild</th><th>Titel " . $this->orderby('title') . "</th><th>År " . $this->orderby('year') . "</th><th>Kategori</th><th>Pris (kr)</th>{$htmlrubrik}</tr>";
foreach ($res AS $key => $val) {
    if(isset($_SESSION['user']))
{
    $htmledit="<td><a href='movie_edit.php?id={$val->id}'>editera </a></td><td><a href='movie_delete.php?id={$val->id}'> ta bort</a></td>";
}
    $tr .= "<tr><td><a href='movie_single.php?id={$val->id}'><img src='img.php?src={$val->image}&amp;width=140&amp;height=100&amp;crop-to-fit' alt='Bild'/></a></td><td><a href='movie_single.php?id={$val->id}'> {$val->title}</a></td><td>{$val->year}</td><td>{$val->category}</td><td>{$val->prise}</td>{$htmledit}</tr>";
}
return $tr;
}
/**
 * Function to get a result which can be used to calculate maximal number
 * of pages. 
 */
function selectMovieWithId($id)
{
    $sql='SELECT * FROM pmovie WHERE id=?';
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
function getResMaxPages(){
//// Get max pages for current query, for navigation
$sql = "
  SELECT
    COUNT(id) AS rows
  FROM 
  (
    $this->sqlOrig $this->where $this->groupby
  ) AS Movie
";
$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $this->params);
return $res;
}
function edit($current)
{
// Get parameters 
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$title  = isset($_POST['title']) ? $_POST['title'] : null;
$director   = isset($_POST['director'])  ? $_POST['director']  : null;
$year    = isset($_POST['year'])   ? strip_tags($_POST['year']) : null;
$plot   = isset($_POST['plot'])  ? $_POST['plot'] : null;
$image   = isset($_POST['image'])  ? strip_tags($_POST['image']) : null;
$prise = isset($_POST['prise']) ? $_POST['prise'] : null;
$trailer = isset($_POST['trailer']) ? $_POST['trailer'] : null;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

$sql = '
    UPDATE pmovie SET
      title   = ?,
      director  = ?,
      year     = ?,
      plot    = ?,
      image    = ?,
      prise  = ?,
      trailer = ?,
      category= ?,
      updated = NOW()
    WHERE 
      id = ?
  ';
  $params = array($title, $director, $year, $plot, $image, $prise, $trailer,$current,$id);
  $this->db->ExecuteQuery($sql, $params);
  $output = 'Informationen sparades.';
  return $output;
}
function create($title)
{
  $sql = 'INSERT INTO pmovie (title) VALUES (?)';
  $params = array($title);
  $this->db->ExecuteQuery($sql,$params);
  header('Location: movie_edit.php?id=' . $this->db->LastInsertId());
}
function delete($id)
{
   $sql = 'DELETE FROM pmovie WHERE id = ? LIMIT 1';
   $params = array($id);
   $this->db->ExecuteQuery($sql, $params);
   $output="Det raderades " . $this->db->RowCount() . " rader från databasen.";
   return $output;
}
function selectCategories(){
    $sql ="SELECT * FROM pmcategory";
    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);
    return $res;
}
function selectLatestMovies()
{
    $sql='SELECT * FROM pmovie
    ORDER BY updated DESC
    LIMIT 3';
    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array());
    return $res;
        
    
}

}

