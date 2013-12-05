<?php
/**
 * This is a Embla pagecontroller.
 *
 */
// Include the essential config-file which also creates the $embla variable with its defaults.
include(__DIR__.'/config.php'); 
// Add style for csource
$embla['stylesheets'][] = 'css/source.css';
 // Create the object to display sourcecode
//$source = new CSource();
$source = new CSource(array('secure_dir' => '..', 'base_dir' => '..'));
 
// Do it and store it all in variables in the Embla container.
$embla['title'] = "Visa källkod";
 

 
$embla['main'] = "<h1>Visa källkod</h1>\n" . $source->View();
 

 
// Finally, leave it all to the rendering phase of Embla.
include(EMBLA_THEME_PATH);

$embla['stylesheets'][] = 'css/source.css';
 

