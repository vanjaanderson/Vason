<?php 
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 


// Define what to include to make the plugin to work
$vason['stylesheets'][]        = 'css/calender.css';

// Do it and store it all in variables in the Vason container.
$vason['title'] = "Calender";

/**
 * Set month to view in calendar. If not sent in $_GET, sets todays values.
 * Also checks numeric format: 'MM-YYYY'.
 */
if(isset($_GET['month']) && preg_match('/^[0-9]{2}+-[0-9]{4}$/', $_GET['month'])) {
  $month = $_GET['month'];
}
else {
  $month = date("m") . "-" . date("Y"); //Ex. 'Sep-2013'.
}

$myCalendar = new CCalendarRenderBig();
$myCalendar->setMonth($month);
$output = $myCalendar->Render();

$vason['main'] = <<<EOD
<h1>Månadens bild</h1>
<p>{$output}</p>
EOD;

//CCalender::showDate();

// Finally, leave it all to the rendering phase of Vason.
include(VASON_THEME_PATH);