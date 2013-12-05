<?php 
/**
 * This is a Embla pagecontroller.
 *
 */
// Include the essential config-file which also creates the $embla variable with its defaults.
include(__DIR__.'/config.php'); 



// Connect to a MySQL database using PHP PDO
$db = new CDatabase($embla['database']);
$content= new CContent($db);
$output="";
if (isset($_GET['submit']))
{
$output=$content->restore();
if ($output==null)
$output="Det fungerade inte!";      
}

$title="Återställ databasen";
// Prepare content and store it all in variables in the Embla container.
$embla['title'] = $title;
$embla['main'] = <<<EOD
<article>
<header>
<h1>{$title}</h1>
</header>
<form>
<p><input type='submit' name='submit' value='Återställ'/></p>
</form>
<p1>{$output}</p1>

<footer>
<p><a href='view.php'>Visa alla</a></p>
</footer
</article>
EOD;


// Finally, leave it all to the rendering phase of Embla.
include(EMBLA_THEME_PATH);
