<?php 
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 


// Define what to include to make the plugin to work
//$vason['stylesheets'][]        = 'css/slideshow.css';
//$vason['javascript_include'][] = 'js/slideshow.js';


// Do it and store it all in variables in the Vason container.
$vason['title'] = "Slideshow för att testa JavaScript i Vason";

$vason['main'] = <<<EOD
<div id="slideshow" class='slideshow' data-host="" data-path="img/cats/" data-images='["cat01.jpg", "cat02.jpg", "cat03.jpg", "cat04.jpg"]'>
	<h2 id="slideshow-header">My Cats</h2>
	<img src='img/cats/cat01.jpg' alt='My Cats'/>
</div>

<h1>En slideshow med JavaScript</h1>
<p>Detta är en exempelsida som visar hur Vason fungerar tillsammans med JavaScript.</p>
EOD;

// Finally, leave it all to the rendering phase of Vason.
include(VASON_THEME_PATH);