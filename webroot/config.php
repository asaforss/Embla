<?php
/**
 * Config-file for Embla. Change settings here to affect installation.
 *
 */
 
/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly
 
 
/**
 * Define Embla paths.
 *
 */
define('EMBLA_INSTALL_PATH', __DIR__ . '/..');
define('EMBLA_THEME_PATH', EMBLA_INSTALL_PATH . '/theme/render.php');
 
 
/**
 * Include bootstrapping functions.
 *
 */
include(EMBLA_INSTALL_PATH . '/src/bootstrap.php');
 
 
/**
 * Start the session.
 *
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();
 
 
/**
 * Create the Embla variable.
 *
 */
$embla = array();
 
 
/**
 * Site wide settings.
 *
 */
$embla['lang']= 'sv';
$embla['title_append'] = '';

/**
 * Theme related settings.
 *
 */
//$embla['stylesheet'] = 'css/style.css';
$embla['stylesheets'] = array('css/style.css');

$embla['favicon']    = 'favicon.ico';
if(isset($_SESSION['user'])){
$menu = array(
  'home'  => array('text'=>'Hem','url'=>'home.php?p=home'),
  'movies' => array('text'=>'Filmer', 'url'=>'movies.php?p=movies'),
  'blog' => array('text'=>'Nyheter', 'url'=>'blog.php?p=blog'),
  'game100' => array('text'=>'Tävling', 'url'=>'game100.php?p=game100'),
  'about' => array('text'=>'Om', 'url'=>'about.php?p=about'),
  'logout' => array('text'=>'Logout', 'url'=>'logout.php?p=logout') 
    );
    if($_SESSION['user']->acronym=='admin'){
      $menu= array_merge($menu,array('admin'=>array('text'=>'Admin', 'url'=>'admin.php?p=admin')));
  
   }
}

else{
    $menu = array(
  'home'  => array('text'=>'Hem','url'=>'home.php?p=home'),
  'movies' => array('text'=>'Filmer', 'url'=>'movies.php?p=movies'),
  'blog' => array('text'=>'Nyheter', 'url'=>'blog.php?p=blog'),
  'game100' => array('text'=>'Tävling', 'url'=>'game100.php?p=game100'),
  'about' => array('text'=>'Om', 'url'=>'about.php?p=about'),
  'login' => array('text'=>'Login', 'url'=>'login.php?p=login')
  
  
);
}
    

$html=null;
$html= CNavigation::GenerateMenu($menu,'navmenu');
    $embla['header'] =<<<EOD
    <img class="sitelogo" src="img/teddy.jpg" alt="RM Rental Movies Logo"/>
    <span class="sitetitle">RM Rental Movies</span>
    <span class="siteslogan">Vi älskar barnfilmer!</span><p></p>{$html}
EOD;



$embla['footer'] ='<footer><span class="sitefooter">
    <span class="copyright">&copy; RM Rental Movies</span><br/>
    <a href="http://validator.w3.org/check/referer">HTML5</a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">CSS3</a>
    <a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">Unicorn</a>
    <a href="source.php">Källkod</a>
   </span></footer>';

/**
 * Settings for the database.
 *
 */
//$embla['database']['dsn']            = 'mysql:host=blu-ray.student.bth.se;dbname=asfo13;';
//$embla['database']['username']       = 'asfo13';
//$embla['database']['password']       = 'bxpV]vW6';
//$embla['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

$embla['database']['dsn']            = 'mysql:host=localhost;dbname=Movie;';
$embla['database']['username']       = 'root';
$embla['database']['password']       = '';
$embla['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");





