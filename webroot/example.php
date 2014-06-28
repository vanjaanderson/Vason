<?php 
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 
 
// Add js/main.js for inklusion
$vason['javascript_include'][] = 'js/main.js';
$vason['javascript_include'][] = 'js/other.js';

// Add style for csource
$vason['stylesheets'][] = 'css/source.css';
 
// Create the object to display sourcecode
//$source = new CSource();
$source = new CSource(array('secure_dir' => '..', 'base_dir' => '..'));
 
// Do it and store it all in variables in the Anax container.
$vason['title'] = "Visa källkod";
$vason['main'] = "<h1>Visa källkod</h1>\n" . $source->View();

// Finally, leave it all to the rendering phase of Vason.
include(VASON_THEME_PATH);