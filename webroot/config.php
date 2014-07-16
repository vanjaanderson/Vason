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
//define('VASON_SRC_PATH', VASON_INSTALL_PATH . '/src/');
 
/**
 * Include bootstrapping functions.
 *
 */
include(VASON_INSTALL_PATH . '/src/bootstrap.php');
 
/**
 * Start the session.
 *
 */
//session_name('vason');
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();
 
/**
 * Set timezone
 */
date_default_timezone_set('Europe/Paris');

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
	    'start'  	=> array('text'=>'Hem',  	 	  'url'=>'index.php',		'class'=>null),
	    'dice'  	=> array('text'=>'Tärningsspel',  'url'=>'dice.php', 	   	'class'=>null),
	    'slideshow' => array('text'=>'Bildspel', 	  'url'=>'slideshow.php', 	'class'=>null),
	    'calendar' 	=> array('text'=>'Kalender', 	  'url'=>'calender.php',   	'class'=>null),
	    'movie' 	=> array('text'=>'Filmdatabas',   'url'=>'movie.php',   	'class'=>null
    ),
  )
);
$active = '';

/**
 * Footer content
 *
 */
$vason['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright &copy; <span id='date'><!--js/main.js show year here--></span> | Vanja Anderson | <a href='https://github.com/vanjaanderson/Vason-base'>Vason på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

/**
 * Site wide settings.
 *
 */
$vason['lang']         = 'sv';
$vason['title_append'] = ' | Vason webbtemplate';

/**
 * Settings for the database.
 *
 */
$vason['database']['dsn']            = 'mysql:host=localhost;dbname=Vason;';
$vason['database']['username']       = 'root';
$vason['database']['password']       = 'dT5#n42b';
$vason['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

/**
 * Theme related settings.
 *
 */
//$vason['stylesheet'] = 'css/style.css';
$vason['stylesheets'] 			= array('css/table.css', 'css/style.css', 'css/dice.css', 'css/calender.css', 'css/links.css', 'css/movie.css', 'css/slideshow.css');
$vason['favicon']    			= 'img/favicon.png';
$vason['apple_touch_icon']  	= 'img/apple-touch-icon.png';

/**
 * Settings for JavaScript.
 *
 */
$vason['modernizr'] = 'js/modernizr.js';
$vason['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
//$vason['jquery'] = null; // To disable jQuery
$vason['javascript_include'] = array('js/main.js', 'js/slideshow.js');

/**
 * Google analytics.
 *
 */
$vason['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics

?>