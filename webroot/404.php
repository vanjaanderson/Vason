<?php 
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 
 
 
// Do it and store it all in variables in the Vason container.
$vason['title'] = "404";
$vason['header'] = "";
$vason['main'] = "This is a Vason 404. Document is not here.";
$vason['footer'] = "";
 
// Send the 404 header 
header("HTTP/1.0 404 Not Found");
 
 
// Finally, leave it all to the rendering phase of Vason.
include(VASON_THEME_PATH);