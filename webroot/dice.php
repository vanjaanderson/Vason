<?php
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php');

// Define what to include to make the plugin to work
//$vason['stylesheets'][]        = 'css/dice.css';
//$vason['javascript_include'][] = 'js/slideshow.js';

// Start a named session
//session_name('dice');
//session_start();

if(isset($_GET['destroy'])) {
  // Unset all of the session variables.
  $_SESSION = array();

  // If it's desired to kill the session, also delete the session cookie.
  // Note: This will destroy the session, and not just the session data!
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }

  // Finally, destroy the session.
  session_destroy();
  $destroyed = "<em>Sessionen har raderats</em>";
}

// Get the arguments from the query string
$roll = isset($_GET['roll']) ? true : false;
$init = isset($_GET['init']) ? true : false;

$output = ""; //Initiate output.

// Create the object or get it from the session
if(isset($_SESSION['dicehand'])) {
  $session = "<em>Objektet finns redan i sessionen</em>";
  $hand = $_SESSION['dicehand'];
}
else {
  $session = "<em>Objektet finns inte i sessionen, skapar nytt objekt och lagrar det i sessionen</em>";
  $hand = new CDiceHand();
  $_SESSION['dicehand'] = $hand;
}

// Roll the dices 
if($roll) {
  $hand->Roll();
}
else if($init) {
  $hand->InitRound();
}

//Render HTML, include rolls and round info.
$output .= (isset($destroyed) ? $destroyed : $session);
$output .= $hand->GetRollsAsImageList();
$output .= "<p>Summan av detta kast: " . $hand->GetTotal() . "</p>";
$output .= "<p>Summan av rundan totalt: " . $hand->GetRoundTotal() . "</p>";
/**
 * Store all HTML and output-related variables in the vason-array
 */
$vason['title'] = "Tärningsspel";

$vason['main'] = <<<EOD
<h1>En tärningshand med fem tärningar</h1>
<p>
{$output}
</p>
<p><a href='?init'>Starta en ny runda</a>.</p>
<p><a href='?roll'>Gör ett nytt kast</a>.</p>
<p><a href='?destroy'>Förstör sessionen</a>.</p>
EOD;

$vason['aside'] = <<<EOD

EOD;

/**
 * Render page
 */
include(VASON_THEME_PATH);

?>
