<?php
// Connect to a MySQL database using PHP PDO
$dsn      = 'mysql:host=localhost;dbname=Movie;';
$login    = 'root';
$password = '';
$options  = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
$pdo = new PDO($dsn, $login, $password, $options);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 // Get parameters for sorting
$year1 = htmlentities(isset($_GET['year1']) && !empty($_GET['year1']) ? $_GET['year1'] : null);
$year2 = htmlentities(isset($_GET['year2']) && !empty($_GET['year2']) ? $_GET['year2'] : null);
$title = htmlentities(isset($_GET['title']) ? $_GET['title'] : null);
$title=  str_replace("*","%", $title);
$where    = null;
$groupby  = ' GROUP BY M.id';
$limit    = null;
$sort     = " ORDER BY $orderby $order";
$params   = array();

// Do SELECT from a table
// Select by title
if($title) {
  $where .= ' AND title LIKE ?';
  $params[] = $title;
} 

// Select by year
if($year1) {
  $where .= ' AND year >= ?';
  $params[] = $year1;
} 
if($year2) {
  $where .= ' AND year <= ?';
  $params[] = $year2;
}  
// Complete the sql statement
$where = $where ? " WHERE 1 {$where}" : null;
$sql = $sqlOrig . $where . $groupby . $sort . $limit;
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
    
 <h1>Filmer</h1>
 

<table>
  <caption><strong>Filmer.</strong></caption>
  <tr>
    <th>Id:</th>
    <th>Titel:</th>
    <th>Bild:</th>
    <th>År:</th>
  </tr>
  <?php foreach($res as $mov): ?>
  
  <tr>
      <td><?php echo $mov->id; ?></td>
    <td><?php echo $mov->title; ?></td>
    <td><img class="smallimg" src="<?php echo $mov->image; ?>"></td>
    <td><?php echo $mov->year ?></td>
  </tr>
  
  <?php endforeach; ?>
</table> 
<form>
<fieldset>
<legend>Sök</legend>
<p><label>Titel (delsträng, använd % eller *): <input type='search' name='title' value=''/></label></p>
<p><label>Skapad mellan åren: 
    <input type='text' name='year1' value=''/>
    - 
    <input type='text' name='year2' value=''/>
  </label>
</p>
<p><input type='submit' name='submit' value='Sök'/></p>
<p><a href='?'>Visa alla</a></p>
</fieldset>
</form>     
    </body>
</html>


