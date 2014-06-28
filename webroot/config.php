<?php
/**
 * Config-file for Vason. Change settings here to affect installation.
 *
 */
 
/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly
 
 
/**
 * Define Vason paths.
 *
 */
define('VASON_INSTALL_PATH', __DIR__ . '/..');
define('VASON_THEME_PATH', VASON_INSTALL_PATH . '/theme/render.php');
 
 
/**
 * Include bootstrapping functions.
 *
 */
include(VASON_INSTALL_PATH . '/src/bootstrap.php');
 
 
/**
 * Start the session.
 *
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();
 
 
/**
 * Create the Vason variable.
 *
 */
$vason = array();
 
/**
 * Header content
 *
 */
$vason['header'] = <<<EOD
<img class='sitelogo' src='img/vason.png' alt='Vason Logo'/>
<span class='sitetitle'>Vason webbtemplate</span>
<span class='siteslogan'>Återanvändbara moduler för webbutveckling med PHP</span>
EOD;

/**
 * Menu content
 *
 */
$vason['menu'] = array(
  'callback' => 'modifyNavbar',
  'items' => array(
    'home'  => array('text'=>'Hello',  			'url'=>'hello.php', 	'class'=>null),
    'away'  => array('text'=>'Kasta tärning',  	'url'=>'dice.php', 		'class'=>null),
    'about' => array('text'=>'Bildspel', 		'url'=>'slideshow.php', 'class'=>null),
  ),
);
$active = '';

/**
 * Footer content
 *
 */
$vason['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright &copy; Vanja Anderson | <a href='https://github.com/vanjaanderson/Vason-base'>Vason på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

/**
 * Site wide settings.
 *
 */
$vason['lang']         = 'sv';
$vason['title_append'] = ' | Vason en webbtemplate';

/**
 * Theme related settings.
 *
 */
//$vason['stylesheet'] = 'css/style.css';
$vason['stylesheets'] 		= array('css/style.css');
$vason['favicon']    		= 'img/favicon.png';
$vason['apple_touch_icon']  = 'img/apple-touch-icon.png';

/**
 * Settings for JavaScript.
 *
 */
$vason['modernizr'] = 'js/modernizr.js';
$vason['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
//$vason['jquery'] = null; // To disable jQuery
$vason['javascript_include'] = array();
//$vason['javascript_include'] = array('js/main.js'); // To add extra javascript files

/**
 * Google analytics.
 *
 */
$vason['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics
