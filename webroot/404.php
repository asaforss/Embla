<?php 
/**
 * This is a Embla pagecontroller.
 *
 */
// Include the essential config-file which also creates the $embla variable with its defaults.
include(__DIR__.'/config.php'); 



// Do it and store it all in variables in the Embla container.
$embla['title'] = "404";
$embla['header'] = "";
$embla['main'] = "This is a Embla 404. Document is not here.";
$embla['footer'] = "";

// Send the 404 header 
header("HTTP/1.0 404 Not Found");


// Finally, leave it all to the rendering phase of Embla.
include(EMBLA_THEME_PATH);
