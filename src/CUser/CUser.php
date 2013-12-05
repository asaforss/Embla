<?php

/**
 * Description of CUser
 *
 * @author Åsa
 */
class CUser extends CBListSort{
   /**
   * Properties
   *
   */
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
     $this->db=$db;
    }
    /**
    * Check if user is authenticated.
    */
    function IsAuthenticated()
    { 
       if(isset($_SESSION['user'])){
            return true;
        }
        else{
            return false;
        }
    }
    /**
    * Gets output.
    */
    function outputIsAuthenticated()
    {
        $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
        if($acronym) {
            $output = "Du är inloggad som: $acronym ({$_SESSION['user']->name})";
        }
        else {
            $output = "Du är INTE inloggad.";
        }
    return $output;
    }
    /**
    * Method to login the user
    */
     function loginUser($user,$password)
    {
         
            $sql = "SELECT acronym, name FROM User WHERE acronym = ? AND password = md5(concat(?, salt))";
            $params = array();
            $params=[htmlentities($user),  htmlentities($password)];
            $res=$this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
            if(isset($res[0])) {
                $_SESSION['user'] = $res[0];
                return true;
            }
            else{ 
                return false;
            }

        
    }
    /**
    * Method to logout the user
    */
    function logoutUser()
    {
    // Logout the user
       unset($_SESSION['user']);
     
      
    }
    function getName($acronym)
    {
       $sql = "SELECT name FROM User WHERE acronym = ?"; 
       $params = array(htmlentities($acronym));
       $res=$this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
            if(isset($res[0])) {
                $name = $res[0]->name;
                return  $name;
            }
            else{ 
                return null;
            }
    }
    /**
 * Function to get movie table
 *
 */
    function getTable(){
        // Get parameters 
        
        $hits = isset($_GET['hits']) ? $_GET['hits'] : 8;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $orderby = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
        $order = isset($_GET['order']) ? strtolower($_GET['order']) : 'asc';


        // Check that incoming parameters are valid
        is_numeric($hits) or die('Check: Hits must be numeric.');
        is_numeric($page) or die('Check: Page must be numeric.');
        // Prepare the query based on incoming arguments
        $this->sqlOrig = '
        SELECT 
        U.* FROM user AS U
    
        ';
        $this->where = null;
        $this->groupby = ' GROUP BY U.id';
        $limit = null;
        $sort = " ORDER BY $orderby $order";
        $this->params= array();

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
        if(isset($_SESSION['user'])&&$_SESSION['user']->acronym=="admin")
        {
            $htmlrubrik="</th><th></th><th></th>";
   
        }
        //// Put results into a HTML-table
        $tr = "<tr><th>Id</th><th>Acronym " . $this->orderby('acronym') . "</th><th>Användare" . $this->orderby('name') ."</th>{$htmlrubrik}</tr>";
        foreach ($res AS $key => $val) {
            if(isset($_SESSION['user']))
            {
                $htmledit="<td><a href='user_edit.php?id={$val->id}'>editera </a></td><td><a href='user_delete.php?id={$val->id}'> ta bort</a></td>";
            }
    $tr .= "<tr><td>{$val->id}</td><td>{$val->acronym}</td><td>{$val->name}</td>{$htmledit}</tr>";
}
return $tr;
}
  function getResMaxPages(){
//// Get max pages for current query, for navigation
$sql = "
  SELECT
    COUNT(id) AS rows
  FROM 
  (
    $this->sqlOrig $this->where $this->groupby
  ) AS User
";
$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $this->params);
return $res;
}
function create($acronym)
{
  $sql = 'INSERT INTO user (acronym) VALUES (?)';
  $params = array($acronym);
  $this->db->ExecuteQuery($sql,$params);
  header('Location: user_edit.php?id=' . $this->db->LastInsertId());
}
function selectUserWithId($id)
{
    $sql='SELECT * FROM user WHERE id=?';
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
function edit()
{
// Get parameters 
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$acronym  = isset($_POST['acronym']) ? strip_tags($_POST['acronym']) : null;
$name   = isset($_POST['name'])  ? strip_tags($_POST['name'])  : null;
$password    = isset($_POST['password'])   ? strip_tags($_POST['password']) : null;


$sql = '
    UPDATE user SET
    acronym=?,
    name=?,
    password = md5(concat(?, salt))
    WHERE id=?
  ';
  $params = array($acronym, $name, $password,$id );
  $this->db->ExecuteQuery($sql, $params);
  $output = 'Informationen sparades.';
  return $output;
}
function delete($id)
{
   $sql = 'DELETE FROM user WHERE id = ? LIMIT 1';
   $params = array($id);
   $this->db->ExecuteQuery($sql, $params);
   $output="Det raderades " . $this->db->RowCount() . " rader från databasen.";
   return $output;
}
}

