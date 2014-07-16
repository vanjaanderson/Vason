<?php
/**
 *    A vason page controller.
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
$orderby  = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
$order    = isset($_GET['order'])   ? strtolower($_GET['order'])   : 'asc';
$id       = isset($_GET['id']) ? $_GET['id'] : null;
//$hyr      = isset($_GET['hyr']) ? $_GET['hyr'] : null;

// Check that incoming parameters are valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');



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


// Select by genre
if($genre) {
  $where .= ' AND G.name = ?';
  $params[] = $genre;
} 

// Pagination
if($hits && $page) {
  $limit = " LIMIT $hits OFFSET " . (($page - 1) * $hits);
}

// Complete the sql statement
$where = $where ? " WHERE 1 {$where}" : null;
$sql = $sqlOrig . $where . $groupby . $sort . $limit;
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);


$editLink = $acronym ? "<a href='editmovie.php?id={$id}'>Uppdatera Film</a>" : null;
$deleteLink = $acronym ? "<a href='deletemovie.php?id={$id}'>Ta bort film</a>" : null;

$hyrruta = null;

if(isset($_GET["id"]))
{ 
  $id =strip_tags($_GET["id"]);
}
is_numeric($id) or die('Check: Id must be numeric.');

  $filters = "bbcode,link,nl2br";
    foreach($res AS $key => $val) {
        $plot = $filter->doFilter($val->plot,$filters);
        //$link = $filter->doFilter($valt->link,'link');
       $vason['title'] = "Filmdatabas: {$val->title}";
       $tr="";
        $tr = "
        <!--<img src='img.php?src={$val->image}' width='360' heigth='500' alt='{$val->title}'/> <br> <a href='img.php?src={$val->image}&width=200'>Se en mindre bild</a><a href='img.php?src={$val->image}&width=500'>Se en större bild</a>-->
        <img id='singlemovieimg' src='{$val->image}' width='360' heigth='500' alt='{$val->title} '/>
        
        <div id='info'>
          <p class='title'>{$val->title}</p>
          <p class='infolist'>{$val->year}  |  {$val->length} min</p>
          <p><strong>Genre:</strong> {$val->genre}</p>  
          <p><strong>Regissör:</strong> {$val->director}</p>
          <!--<p><strong>Pris:</strong> {$val->price} kr</p>-->

          
          <p class='infotext'>{$val->plot}</p>

          <p><a href='movie.php'>&lt;&lt; Tillbaka till listan</a></p>
        </div>
        <div class='clear'></div>
        <p><span class='movielinks'><a href='{$val->imdb}' target='blank'>IMDB</a></span> | <span class='movielinks'><a href='{$val->trailer}' target='blank'>Trailer</a></span><!-- | <span class='movielinks'><a href='singlemovie.php?id={$id}&hyr=ja'>Hyr filmen</a></span> --></p>
  
         ";  
        $tr .= "&nbsp; {$editLink} {$deleteLink}";
               
        
        if ($val->id == $id){break;}

    }

    // if ($hyr == 'ja') {
    //       echo "
    //       <div id='hyrruta'>
    //       <p>Du har hyrt <a href='moviesingle.php?id={$id}'>{$val->title}</a> för {$val->price} kr. 
    //       Hyrestid: 14 dagar från hyresdatumet. Fakturan skickas med din film till din leverans&shy;adress.</p>
      
    //       <p><a href='singlemovie.php?id={$id}'>stäng</a></p>
    //       <p style='font-size:12px; font-style: italic;'>(Genom att stänga den här rutan accepterar du <a id='hyresvillkor' href='page.php?url=hyresvillkor'>hyresvillkoren</a>.)</p>
    //       </div>";
    //     }
        
        
        
$vason['main'] = <<<EOD
<article class="readable">
<h1>{$vason['title']}</h1>

{$tr}

</article>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'></script>
<script src="js/singlemovie.js"></script>
EOD;

// Render vason
include(VASON_THEME_PATH); 

