<?php
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php');

// Include dice content
include('dice/content.php');
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

/**
 * Render page
 */
include(VASON_THEME_PATH);

?>
