<?php
/**
 * This is a Embla pagecontroller.
 * It handels logout
 */
// Include the essential config-file which also creates the $embla variable with its defaults.
include(__DIR__.'/config.php');
$db = new CDatabase($embla['database']);
$user= new CUser($db);
$embla['stylesheets'][] = 'css/form.css';
if(isset($_POST['btnLogout'])){
    $user->logoutUser();
    header('Location: home.php');
}
$output=$user->outputIsAuthenticated();
$embla['title'] = "Logout";

$embla['main'] = <<<EOD
<h1>{$embla['title']}</h1>
    <form method=post>
  <fieldset>
  <legend>Logout</legend>
  <p><input type='submit' name='btnLogout' value='Logout'/></p>
  <output><b>{$output}</b></output>
  </fieldset>
</form>
EOD;
  // Finally, leave it all to the rendering phase of Embla.
include(EMBLA_THEME_PATH);
