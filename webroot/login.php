<?php 
/** 
 * This is a vason pagecontroller. 
 * 
 */ 
// Include the essential config-file which also creates the $vason variable with its defaults. 
include(__DIR__.'/config.php'); 

$vason['title'] = "Logga in"; 

//creating an object of the class ADatabase to use with the class AUser 
$db = new CDatabase($vason['database']); 
$user = new CUser($db);
$loggedin = true; 

if(!$user->Authenticated()) { 
  if(isset($_POST['acronym'], $_POST['password'])){ 
    $loggedin = $user->login($_POST['acronym'], $_POST['password']); 
  } 
}

if(!$loggedin) { 
  $output = "<p class='error'>Du är INTE inloggad.</p>"; 
} 
else {
  $output=$user->output();
  $_SESSION['user'] = true;
} 

// HTML code to handle the data visually 
$vason['main'] = <<<EOD
<h1>{$vason['title']}</h1>
<form method=post> 
  <fieldset> 
  <legend>{$vason['title']}</legend> 
  <p class='smaller'>Du kan logga in med doe:doe eller admin:admin.</p> 
  <p><label>Användare:<br/><input type='text' name='acronym' value=''/></label></p> 
  <p><label>Lösenord:<br/><input type='text' name='password' value=''/></label></p> 
  <p><input type='submit' name='login' value='Logga in'/></p> 
  <strong>{$output}</strong>
  </fieldset> 
</form> 
EOD;

// Finally, leave it all to the rendering phase of vason. 
include(VASON_THEME_PATH);