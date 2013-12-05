<?php
/**
 * This is a Embla pagecontroller.
 * It handels login
 */
// Include the essential config-file which also creates the $embla variable with its defaults.
include(__DIR__.'/config.php');
$db = new CDatabase($embla['database']);
$user= new CUser($db);
$embla['stylesheets'][] = 'css/form.css';
$success=true;
if(!$user->IsAuthenticated()){
    if(isset($_POST['acronym'], $_POST['password'])){
       $success=$user->loginUser($_POST['acronym'], $_POST['password']);
       header('Location: home.php');
    }
}
if(!$success)
{
    $output = "Du lyckades ej logga in.";

}
else{
    $output=$user->outputIsAuthenticated();
}
$embla['title'] = "Login";

$embla['main'] = <<<EOD
<h1>{$embla['title']}</h1>
  <form method=post>
  <fieldset>
  <legend>Login</legend>
  <p><em>Du kan logga in med doe:doe eller admin:admin.</em></p>
  <p><label>Användare:<br/><input type='text' name='acronym' value=''/></label></p>
  <p><label>Lösenord:<br/><input type='text' name='password' value=''/></label></p>
  <p><input type='submit' name='btnLogin' value='Login'/></p>
  <p><a href='logout.php'>Logout</a></p>
  <output><b>{$output}</b></output>
  </fieldset>
</form>
EOD;
  // Finally, leave it all to the rendering phase of Embla.
include(EMBLA_THEME_PATH);
