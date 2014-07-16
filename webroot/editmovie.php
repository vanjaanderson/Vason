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
$id       = isset($_POST['id'])       ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$title    = isset($_POST['title'])    ? strip_tags($_POST['title'])   : null;
$year     = isset($_POST['year'])     ? strip_tags($_POST['year'])    : null;
$length   = isset($_POST['length'])   ? strip_tags($_POST['length'])  : null;
$price    = isset($_POST['price'])    ? strip_tags($_POST['price'])   : null;
$image    = isset($_POST['image'])    ? strip_tags($_POST['image'])   : null;
$genre    = isset($_POST['genre'])    ? strip_tags($_POST['genre'])   : null;
$save     = isset($_POST['save'])     ? true : false;
$acronym  = isset($_SESSION['user'])  ? $_SESSION['user']->acronym : null; 
$trailer  = isset($_POST['trailer'])  ? strip_tags($_POST['trailer']) : null;
$imdb     = isset($_POST['imdb'])     ? strip_tags($_POST['imdb'])    : null;
$plot     = isset($_POST['plot'])     ? strip_tags($_POST['plot'])    : null;
$director = isset($_POST['director']) ? strip_tags($_POST['director']): null;




// Check that incoming parameters are valid
isset($acronym) or die('Check: You must login to edit.'); 
is_numeric($id) or die('Check: Id must be numeric.');

 



// Get all genres and select those that should be selected
$sql = 'SELECT * FROM Genre';
$movie = $db->ExecuteSelectQueryAndFetchAll($sql);


$selectOptionGenres = "<select id='input' name='genre';'>"; 
$selectOptionGenres .= "<option value='-1'>{$genre}</option>";
foreach($movie as $key => $val) {
  $selected = "";
  if(isset($_POST['genre']) && $_POST['genre'] == $val->id) { 
  $selected = "selected";
  $genre = $val->name;
  }
  $selectOptionGenres .= "<option value='{$val->id}'{$selected}>{$val->name}</option>";
}
$selectOptionGenres .= '</select>';







// Check if form was submitted
$output = null;
if($save) {


  
  $sql = '
    UPDATE Movie SET
      title = ?,
      year = ?,
      length = ?,
      director = ?,
      price = ?,
      plot = ?,
      image = ?,
      imdb = ?,
      trailer = ?
    WHERE 
      id = ?
  ';
 $params = array($title, $year, $length, $director, $price, $plot, $image, $imdb, $trailer, $id);
  $db->ExecuteQuery($sql, $params);
  
  $genre = 1;
  $sql = 'INSERT INTO najb13.Movie2Genre (idMovie, idGenre) VALUES (?, ?);';
  $params = array($id,$genre); 
  $db->ExecuteQuery($sql, $params);
  
  $output = 'Informationen sparades.';


}

// Select information on the movie
$sql = 'SELECT * FROM Movie WHERE id = ?';
$params = array($id);
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

if(isset($res[0])) {
  $movie = $res[0];
}
else {
  die('Failed: There is no movie with that id');
} 

$vason['title'] = "Redigera film";
$vason['main'] = <<<EOD

<form method=post>
  <fieldset>
  <legend>Uppdatera info om film</legend>
  <input type='hidden' name='id' value='{$id}'/>
  <p><label>Titel:<br/><input type='text' name='title' value='{$movie->title}'/></label></p>
  <p><label>År:<br/><input type='text' name='year' value='{$movie->year}'/></label></p>
  <p><label>Längd:<br/><input type='text' name='length' value='{$movie->length}'/></label></p>
  <p><label>Regissör:<br/><input type='text' name='director' value='{$movie->director}'/></label></p>
  <p><label>Pris:<br/><input type='text' name='price' value='{$price}'/></label></p>
  <p><label>Genre:</label><br/>{$selectOptionGenres}</p> 
  <p><label>Handling:<br/><textarea style='min-width:600px; min-height:300px;' name='plot'>{$movie->plot}</textarea></label></p> 
  <p><label>Bild:<br/><input type='text' name='image' value='{$movie->image}'/></label></p>
  <p><label>IMDB:<br/><input type='text' name='imdb' value='{$movie->imdb}'/></label></p> 
  <p><label>Trailer:<br/><input type='text' name='trailer' value='{$movie->trailer}'/></label></p> 
 
  <p><input type='submit' name='save' value='Spara film'/></p>
  <p><a href='singlemovie.php?id={$id}'>Visa film</a><br/>
  <a href='movie.php'>Visa alla filmer</a></p>
  <output>{$output}</output>
  </fieldset>
</form>


EOD;



// Finally, leave it all to the rendering phase of vason.
include(VASON_THEME_PATH);
