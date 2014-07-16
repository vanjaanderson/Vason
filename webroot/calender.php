<?php 
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 


// Include calender content
include('calender/content.php');
/**
 * Store all HTML and output-related variables in the vason-array
 */
$vason['title'] = "Kalender";

$vason['main'] = <<<EOD
<h1>Månadens bild</h1>
<p>{$output}</p>
EOD;

//CCalender::showDate();

// Finally, leave it all to the rendering phase of Vason.
include(VASON_THEME_PATH);