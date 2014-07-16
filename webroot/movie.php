<?php
/**
 * This is a vason pagecontroller.
 *
 */
 
// Get config-file and $vason variable. And then store it in vason variables.
include(__DIR__ . '/config.php');

$acronym = '';

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($vason['database']);
$movie = new CFilm();
$filter = new CTextFilter();
$content = new CContent($db);


// Get parameters 
$title    = isset($_GET['title']) ? $_GET['title'] : null;
$genre    = isset($_GET['genre']) ? $_GET['genre'] : null;
$hits     = isset($_GET['hits'])  ? $_GET['hits']  : 5;
$page     = isset($_GET['page'])  ? $_GET['page']  : 1;
$year1    = isset($_GET['year1']) && !empty($_GET['year1']) ? $_GET['year1'] : null;
$year2    = isset($_GET['year2']) && !empty($_GET['year2']) ? $_GET['year2'] : null;
$orderby  = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
$order    = isset($_GET['order'])   ? strtolower($_GET['order'])   : 'asc';
$id       = isset($_GET['id']) ? $_GET['id'] : null;
//$hyr     = isset($_GET['hyr']) ? $_GET['hyr'] : null;

// Check that incoming parameters are valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');
is_numeric($year1) || !isset($year1)  or die('Check: Year must be numeric or not set.');
is_numeric($year2) || !isset($year2)  or die('Check: Year must be numeric or not set.');


// Get all genres that are active
$sql = '
  SELECT DISTINCT G.name
  FROM Genre AS G
    INNER JOIN Movie2Genre AS M2G
      ON G.id = M2G.idGenre
';
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

$genres = null;
foreach($res as $val) {
  if($val->name == $genre) {
    $genres .= "$val->name ";
  }
  else {
    $genres .= "<a href='" . $movie->getQueryString(array('genre' => $val->name)) . "'>{$val->name}</a> ";
  }
}


// Prepare the query based on incoming arguments
$sqlOrig = '
  SELECT 
    M.*,
    GROUP_CONCAT(G.name) AS genre
  FROM Movie AS M
    RIGHT OUTER JOIN Movie2Genre AS M2G
      ON M.id = M2G.idMovie
    INNER JOIN Genre AS G
      ON M2G.idGenre = G.id
';
$where    = null;
$groupby  = ' GROUP BY M.id';
$limit    = null;
$sort     = " ORDER BY $orderby $order";
$params   = array();

// Select by title
if($title) {
  $where .= ' AND title LIKE ?';
  $params[] = $title;
} 

// Select by year
if($year1) {
  $where .= ' AND year >= ?';
  $params[] = $year1;
} 
if($year2) {
  $where .= ' AND year <= ?';
  $params[] = $year2;
} 

// Select by genre
if($genre) {
  $where .= ' AND G.name = ?';
  $params[] = $genre;
} 

// Pagination
if($hits && $page) {
  $limit = " LIMIT $hits OFFSET " . (($page - 1) * $hits);
}

// Get max pages for current query, for navigation
$sql = "
  SELECT
    COUNT(id) AS rows
  FROM 
  (
    $sqlOrig $where $groupby
  ) AS Movie
";
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
$rows = $res[0]->rows;
$max = ceil($rows / $hits); 

// Complete the sql statement
$where = $where ? " WHERE 1 {$where}" : null;
$sql = $sqlOrig . $where . $groupby . $sort . $limit;
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

$hitsPerPage = $movie->getHitsPerPage(array(5, 10, 100), $hits);
$navigatePage = $movie->getPageNavigation($hits, $page, $max);



// Put results into a HTML-movie
if($acronym) {
$vason['title'] = "Filmer";
$tr = "<tr><th>Film</th><th>Titel " . $movie->orderby('title') . "</th><th>År " . $movie->orderby('year') . "</th><th>Genre</th><th>Uppdatera</th><th>Ta bort</th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr>
              <!--<td><a href='singlemovie.php?id={$val->id}'><img src='img.php?src={$val->image}' width='150' height='250' alt='{$val->title}' /></a></td>-->
              <td><a href='singlemovie.php?id={$val->id}'><img src='{$val->image}' width='150' height='250' alt='{$val->title}' /></a></td>
              <td><a href='singlemovie.php?id={$val->id}'>{$val->title}</a></td>
              <td>{$val->year}</td>
              <td>{$val->genre}</td>
              <td><a href='editmovie.php?id={$val->id}'><img src='img/movie/edit.png' width='35px'/></a></td>
              <td><a href='deletemovie.php?id={$val->id}'><img src='img/movie/delete.png'width='35px'/></a></td>
            
          </tr>"; 
  }
}
else {
$vason['title'] = "Filmdatabas";
$tr = "<tr><th>Film</th><th>Titel " . $movie->orderby('title') . "</th><th>År " . $movie->orderby('year') . "</th><th>Genre</th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr>
              <!--<td><a href='singlemovie.php?id={$val->id}'><img src='img.php?src={$val->image}' width='150' height='250' alt='{$val->title}' /></a></td>-->
              <td class='moviecell'><a href='singlemovie.php?id={$val->id}'><img src='{$val->image}' width='150' height='250' alt='{$val->title}' /></a></td>
              <td class='titlecell'><a href='singlemovie.php?id={$val->id}'>{$val->title}</a></td>
              <td class='yearcell'>{$val->year}</td>
              <td>{$val->genre}</td>
            
          </tr>"; 
  }
}

$createLink = $acronym ? "<a href='createmovie.php'>Skapa en ny film</a>" : null;

//$sqlDebug = $db->Dump();

$vason['main'] = <<<EOD
<article class="readable">
<h1>{$vason['title']}</h1>
<form>
  <fieldset>
 <legend>Sök</legend>
  <input type=hidden name=genre value='{$genre}'/>
  <input type=hidden name=hits value='{$hits}'/>
  <input type=hidden name=page value='1'/>
  <p><label>Titel: <input type='search' name='title' value='{$title}'/></label></p>
  <p><label>Genre: </label><span class='genre'>{$genres}</span></p>
  <p><label>Skapad mellan åren: 
      <input type='text' name='year1' value='{$year1}'/></label>
      &mdash;
      <label><input type='text' name='year2' value='{$year2}'/></label>
    
  </p>
  <p><input type='submit' name='submit' value='Sök'/></p>
  <p><a href='?'>Visa alla</a></p>
  </fieldset>
</form> 

<div class='dbtable'>
<div class='rows'>{$navigatePage}</div>
<div class='hits'>{$hitsPerPage}</div>

<table id='moviestable'>
{$tr}
</table>

{$createLink}
<div class='pages'>{$navigatePage}</div>
</div>

</article>
EOD;

// Render vason
include(VASON_THEME_PATH); 
