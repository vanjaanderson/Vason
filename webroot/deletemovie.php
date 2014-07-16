<?php 
/**
 * This is a vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($vason['database']);
$movie = new CFilm();

// Get parameters 
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$delete = isset($_POST['delete'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

// Check that incoming parameters are valid
isset($acronym) or die('Check: You must login to delete.');

// Check if form was submitted
$output = null;
if($delete) {
  $genre = 1;
$sql = 'DELETE FROM Movie2Genre WHERE IdMovie = ? and idGenre = ?';
  $db->ExecuteQuery($sql, array($id,$genre));

  $sql = 'DELETE FROM Movie WHERE id = ?';
  $db->ExecuteQuery($sql, array($id));
  $db->SaveDebug("Det raderades " . $db->RowCount() . " rader från databasen.");
  header('Location: movie.php');
}

// Select information on the movie 
$sql = 'SELECT * FROM Movie WHERE id = ?';
$params = array($id);
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

if(isset($res[0])) {
  $movie = $res[0];
}
else {
  die('Failed: There is no plant with that id');
}
$vason['title'] = "Ta bort film";
$vason['main'] = <<<EOD
<form method=post>
  <fieldset>
  <legend>Radera: {$movie->title}</legend>
  <input type='hidden' name='id' value='{$id}'/>
  <p><input type='submit' name='delete' value='Radera'/></p>
  </fieldset>
</form>


EOD;

// Render vason
include(VASON_THEME_PATH); 
