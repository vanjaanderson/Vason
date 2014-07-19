<?php 
/** 
 * This is a vason pagecontroller. 
 * 
 */ 
// Include the essential config-file which also creates the $vason variable with its defaults. 
include(__DIR__.'/config.php');

$vason['title'] = "Logga ut"; 

// Logout the user 
if(isset($_POST['logout'])) { 
  unset($_SESSION['user']); 
  header('Location: logout.php'); 
} 

// Get incoming parameters 
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null; 

if($acronym) { 
  $output = "<p class='okay'>Du är inloggad som: $acronym ({$_SESSION['user']->name})</p>"; 
} 
else { 
  $output = "<p class='error'>Du är INTE inloggad.</p>"; 
} 

// HTML code to handle the data visually 
$vason['main'] = <<<EOD
<h1>{$vason['title']}</h1> 
<form method=post> 
  <fieldset> 
  <legend>{$vason['title']}</legend> 
  <p><input type='submit' name='logout' value='Logga ut'/></p> 
  <strong>{$output}</strong>
  </fieldset> 
</form> 
EOD;

// Finally, leave it all to the rendering phase of vason. 
include(VASON_THEME_PATH);