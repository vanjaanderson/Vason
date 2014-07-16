<?php
/**
 *  This is a vason pagecontroller.
 *
 */
 
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__ . '/config.php');

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($vason['database']);
$movie = new CFilm();

// Get parameters 
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$genre  = isset($_POST['genre[]']) ? $_POST['genre[]'] : array();
$save   = isset($_POST['save'])  ? true : false;
$acronym =  isset($_SESSION['user'])  ? $_SESSION['user']->acronym  : null;


// Check that incoming parameters are valid
isset($acronym) or die('Check: You must login to edit.');
is_numeric($id) or die('Check: Id must be numeric.');
is_array($genre) or die('Check: Genre must be array.');



// Get all genres and select those that should be selected
$sql = 'SELECT * FROM Genre';
$genres = $db->ExecuteSelectQueryAndFetchAll($sql);

$sql = 'SELECT idGenre AS id FROM Movie2Genre WHERE idMovie = ?';
$myGenres = $db->ExecuteSelectQueryAndFetchAll($sql, array($id), 0, PDO::FETCH_COLUMN);

$selectOptionGenres = "<select name='genre[]'>";
foreach($genres as $key => $val) {
  $selected = in_array($val->id, $myGenres) ? 'selected' : null;
  $selectOptionGenres .= "<option value='{$val->id}'{$selected}>{$val->name}</option>";
}
$selectOptionGenres .= '</select>';



// Check if form was submitted
$output = null;


if($save) {
 
$sql = "INSERT INTO najb13.Movie2Genre (idMovie, idGenre) VALUES (?, ?);";
  $params = array($id,$genre); 
  $db->ExecuteQuery($sql, $params);
  
  $output = 'Informationen sparades.';

  header('Location: editmovie.php?id=' . $id);
  exit;

}


$vason['title'] = "skapa";

// Select information on the movie
$sql = 'SELECT * FROM VMovie WHERE id = ?';
$params = array($id);
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

if(isset($res[0])) {
  $movie = $res[0];
}
else {
  die('Failed: There is no movie with that id');
}

$vason['main'] = <<<EOD
<form method=post>
  <fieldset>
  <input type='hidden' name='id' value='{$id}'/>
  <p><label>Genre:</label><br/>{$selectOptionGenres}</p>
  <output>{$output}</output>
  <p><input type='submit' name='save' value='Spara Typ'/> <input type='reset' value='Återställ'/></p>
  </fieldset>
</form>

EOD;

// Finally, leave it all to the rendering phase of vason.
include(VASON_THEME_PATH); 
