<?php
/**
 * Bootstrapping functions, essential and needed for Vason to work together with some common helpers. 
 *
 */
ob_start();
/**
 * Default exception handler.
 *
 */
/**
* Custom exception handler
*/
function myExceptionHandler($exception) {
  echo "Vason: Uncaught exception: <p>" . $exception->getMessage() . "</p><pre>" . $exception->getTraceAsString() . "</pre>";
}
set_exception_handler('myExceptionHandler');

/**
* Class autoloader
*/
function myAutoloader($class) {
  $path = VASON_INSTALL_PATH . "/src/{$class}/{$class}.php";
  if(is_file($path)) {
    include($path);
  }
  else {
    throw new Exception("Classfile '{$class}' does not exists.");
  }
}
spl_autoload_register('myAutoloader');

/**
 * dump() prints out an arrays content in a readable format.
 */
function dump($array) {
  return "<code class='code'>" . htmlentities(print_r($array, 1)) . "</code>";
}

/**
 * Function to get the URL to the current page.
 */
function getCurrentUrl() {
  $url = "http";
  $url .= (@$_SERVER["HTTPS"] == "on") ? 's' : '';
  $url .= "://";
  $serverPort = ($_SERVER["SERVER_PORT"] == "80") ? '' :
    (($_SERVER["SERVER_PORT"] == 443 && @$_SERVER["HTTPS"] == "on") ? '' : ":{$_SERVER['SERVER_PORT']}");
  $url .= $_SERVER["SERVER_NAME"] . $serverPort . htmlspecialchars($_SERVER["REQUEST_URI"]);
  return $url;
}

/**
 * Use the current querystring as base, modify it according to $options and return the modified query string.
 * 
 * @author Mikael Roos
 * @param array $options to set/change.
 * @param string $prepend this to the resulting query string
 * @return string with an updated query string.
 */
function getQueryString($options=array(), $prepend='?') {
  // parse query string into array
  $query = array();
  parse_str($_SERVER['QUERY_STRING'], $query);

  // Modify the existing query string with new options
  $query = array_merge($query, $options);

  // Return the modified querystring
  return $prepend . htmlentities(http_build_query($query));
}

/**
 * Create a link to the content, based on its type.
 * Used for dynamic content pages.
 *
 * @param object $content to link to.
 * @return string with url to display content.
 */
function getUrlToContent($content) {
  switch($content->type) {
    case 'page': return "page.php?url={$content->slug}"; break;
    case 'post': return "blog.php?slug={$content->slug}"; break;
    default: return null; break;
  }
}

/**
 * 
 *
 * @param type $data
 * @return type 
 */
function HTMLentitiesUTF8($data) {
  return htmlentities($data, ENT_QUOTES, 'UTF-8');
}

?> 