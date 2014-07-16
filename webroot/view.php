<?php 
/**
 * This is a vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 



// Connect to a MySQL database using PHP PDO
$db = new CDatabase($vason['database']);
$content = new CContent($db);
$content->GetOutput();

$acronym     = isset($_SESSION['user'])         ? $_SESSION['user']->acronym : null;

if(!isset($acronym)){
    header("Location:login.php");
    exit;
} 

// Do it and store it all in variables in the vason container.
$vason['title'] = "Administrera";
//$vason['debug'] = $db->Dump();

 

$vason['main'] = <<<EOD
<article class="blogg">
<h2>{$vason['title']}</h2>

<h4>Filmer</h4>
<p><a href="createmovie.php">Lägg till ny film</a><br/>
<a href="movie.php">Redigera eller ta bort film</a></p>

<h4>Nyheter</h4>
<ul>
{$content->items}
</ul>

<br>
<a href='blog.php'>Visa alla blogginlägg</a> 
<br>
<a href='create.php'>Skapa ett nytt blogginlägg</a>  
<br>
<a href='reset.php'>Återställ</a> 
</article>
EOD;



// Finally, leave it all to the rendering phase of vason.
include(VASON_THEME_PATH);
