<?php 
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 
 
 
// Do it and store it all in variables in the Vason container.
$vason['title'] = "Hello World";
 
$vason['main'] = <<<EOD
<h1>Hej Världen</h1>
<p>Detta är en exempelsida som visar hur Vason ser ut och fungerar.</p>
EOD;
 
// Add js/main.js for inklusion
$vason['javascript_include'][] = 'js/main.js';
$vason['javascript_include'][] = 'js/other.js';

// Finally, leave it all to the rendering phase of Vason.
include(VASON_THEME_PATH);