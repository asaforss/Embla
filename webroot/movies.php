<?php

/**
 * This is a Embla pagecontroller.
 * It handles movie information from a database
 */
// Include the essential config-file which also creates the $embla variable with its defaults.
include(__DIR__ . '/config.php');

$embla['stylesheets'][] = 'css/table.css';
$embla['stylesheets'][] = 'css/form.css';


// Connect to a MySQL database using PHP PDO
$db = new CDatabase($embla['database']);
$movies=new CMovies($db);


$tr=$movies->getTable();
$hits = isset($_GET['hits']) ? $_GET['hits'] : 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$title = htmlentities(isset($_GET['title']) ? $_GET['title'] : null);
$res=$movies->getResMaxPages();
$rows = $res[0]->rows;
$max = ceil($rows / $hits);


$embla['header'] =<<<EOD
<img class="sitelogo" src="img/teddy.jpg" alt="Logo"/>
<span class="sitetitle">Rm Rental Movies</span>
<span class="siteslogan">Vi älskar barnfilmer!</span>
<span class="right">
      <form>
    <input type="text" id="search" name="title" value="{$title}"/><input type="submit" name="search" value="Sök" />
     </form>
   </span>
<p></p>{$html}
EOD;

// Do it and store it all in variables in the Embla container.
$embla['title'] = "Filmer ni kan hyra!";

$hitsPerPage =  $movies->getHitsPerPage(array(2, 4, 8), $hits);
$navigatePage = $movies->getPageNavigation($hits, $page, $max);
//$sqlDebug = $db->Dump();
$htmlcreate="";
if(isset($_SESSION['user']))
{
    $htmlcreate="<a href='movie_create.php'>Ny film </a>";
}

$embla['main'] = <<<EOD
<h1>{$embla['title']}</h1>


<div>
  <div>{$rows} träffar. {$hitsPerPage}</div>
  <table>
  {$tr}
  </table>
  <div class='center'>{$navigatePage}</div>
</div>
 <p><a href='?'>Visa alla</a></p>
  <p>$htmlcreate</p>

EOD;

// Finally, leave it all to the rendering phase of Embla.
include(EMBLA_THEME_PATH);
