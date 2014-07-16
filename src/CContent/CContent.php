<?php
/** 
 * Admin for content 
 * 
 */ 
class CContent extends CUser {

    public $items = null;
    public $GetOutputEdit;
    public $title;


public function __construct($db) {
    parent::__construct($db);
    $this->url = isset($_GET['url']) ? $_GET['url'] : null;    //For page
    $this->slug = isset($_GET['slug']) ? $_GET['slug'] : null; //For post
    
}



/**
 * Create a link to the Content, based on its type.
 *
 * @param object $Content to link to.
 * @return string with url to display Content.
 */
  public function getUrlToContent($Content) {
   switch($Content->type) {
    case 'page': return "page.php?url={$Content->url}"; break;
    case 'post': return "blog.php?slug={$Content->slug}"; break;
    default: return null; break;
}
}



/**
 * Put results into a list
 *
 */ 
  public function GetOutput() {

   //Execute sql statment and get Content
   $sql = 'SELECT *, (published <= NOW()) As available FROM Content';
   $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

   foreach ($res as $key => $val){
   $this->items .=   "<li>{$val->type} ("
                     . ($val->available ? 'publicerad' : 'inte publicerad')
                     . ")   <a href='" 
                     . $this->getUrlToContent($val) ."'>{$val->title}</a> "
                     . ($this->GetAcronym() ? "(<a href='edit.php?id={$val->id}'>redigera</a>) (<a href='delete.php?id={$val->id}'>ta bort</a>) " : null) 
                     . "</li>"; 
}
}



/**
 * Link that is shown if user is logged in.
 *
 */
  public function userLink($cLink, $cText) {
   return ($this->GetAcronym() ? "[<a href='$cLink'>{$cText}</a>] " : null);

}




/**
 * Edit
 *
 */
  public function edit() {
   $id          = isset($_POST['id'])            ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
   $title       = isset($_POST['title'])         ? $_POST['title'] : null;
   $slug        = isset($_POST['slug'])          ? $_POST['slug']  : null;
   $url         = isset($_POST['url'])           ? strip_tags($_POST['url']) : null;
   $data        = isset($_POST['data'])          ? $_POST['data'] : array();
   $category   = isset($_POST['category'])       ? strip_tags($_POST['category']) : array();
   $type        = isset($_POST['type'])          ? strip_tags($_POST['type']) : array();
   $filter      = isset($_POST['filter'])        ? $_POST['filter'] : array();
   $published   = isset($_POST['published'])     ? strip_tags($_POST['published']) : array();
   $save        = isset($_POST['save'])          ? true : false;
   $acronym     = isset($_SESSION['user'])       ? $_SESSION['user']->acronym : null;


   // Check that incoming parameters are valid
   isset($acronym) or die(header('location:http://www.student.bth.se/~najb13/oophp/projekt/Idun/webroot/login.php'));
   is_numeric($id) or die('Check: Id must be numeric.');


   // Check if form was submitted
   $output = null;
   if($save) {
   $sql = '
    UPDATE Content SET
      title     = ?,
      slug      = ?,
      url       = ?,
      data      = ?,
      category  = ?,
      type      = ?,
      filter    = ?,
      published = ?,
      updated = NOW()
    WHERE 
      id = ?
   ';
   $params = array($title, $slug, $url, $data, $category, $type, $filter, $published, $id);
   $this->db->ExecuteQuery($sql, $params);
   $output = 'Informationen sparades.';
}

   $sql = 'SELECT * FROM Content WHERE id = ?';
   $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));

   if (isset($res[0])) {
   $c = $res[0];
}
   else {
   die('Misslyckades: det finns inget innehåll med id');
}

   // Sanitize Content before using it.
   $title      = htmlentities($c->title, null, 'UTF-8');
   $slug       = htmlentities($c->slug, null, 'UTF-8');
   $url        = $c->url;
   $data       = htmlentities($c->data, null, 'UTF-8');
   $category   = $c->category;
   $type       = $c->type;
   $filter     = htmlentities($c->filter, null, 'UTF-8');
   $published  = $c->published;

   $this->GetOutputEdit .=  "<form method=post><fieldset><legend>Uppdatera inlägg</legend>";
   $this->GetOutputEdit .=  "<input type='hidden' name='id' value='{$id}'/>";
   $this->GetOutputEdit .=  "<p><label>Titel:<br/><input type='text' name='title' value='{$title}'/></label></p>";
   $this->GetOutputEdit .=  "<p><label>Slug:<br/><input type='text' name='slug' value='{$slug}'/></label></p>";
   $this->GetOutputEdit .=  "<p><label>Url:<br/><input type='text' name='url' value='{$url}'/></label></p>";
   $this->GetOutputEdit .=  "<p><label>Kategori:<br/><input type='text' name='category' value='{$category}'/></label></p>";
   $this->GetOutputEdit .=  "<p><label>Text:<br/><textarea style='min-width:600px; min-height:300px;' name='data'>{$data}</textarea></label></p>";
   $this->GetOutputEdit .=  "<p><label>Type:<br/><input type='text' name='type' value='{$type}'/></label></p>";
   $this->GetOutputEdit .=  "<p><label>Filter:<br/><input type='text' name='filter' value='{$filter}'/></label></p>";
   $this->GetOutputEdit .=  "<p><label>Publiseringsdatum:<br/><input type='text' name='published' value='{$published}'/></label></p>";
   $this->GetOutputEdit .=  "<p class=buttons><input type='submit' name='save' value='Spara'/> <input type='reset' value='Ta bort'/></p>";
   $this->GetOutputEdit .=  "<p><a href='view.php'>Visa alla inlägg</a></p>";
   $this->GetOutputEdit .=  "<output>{$output}</output>";
   $this->GetOutputEdit .=  "</fieldset></form>";

}



/**
 * Delete
 *
 */
  public function delete() {
   $id      = isset($_POST['id'])      ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
   $delete  = isset($_POST['delete'])  ? true : false;
   $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

   // Check that incoming parameters are valid
   isset($acronym) or die('fel, logga in..');

   // Check if form was submitted
   $output = null;
   if($delete) {
   $sql = 'DELETE FROM Content WHERE id = ?';
   $this->db->ExecuteQuery($sql, array($id));
   $this->db->SaveDebug("Det raderades " . $this->db->RowCount() . " rader från databasen.");
   header('Location: view.php');
}

   // Select information
   $sql = 'SELECT * FROM Content WHERE id = ?';
   $params = array($id);
   $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);

   if(isset($res[0])) {
   $post = $res[0];
}
   else {
   die('Misslyckades: det finns inget innehåll med id');
}

   $this->GetOutputEdit .= "<form method=post>";
   $this->GetOutputEdit .= "<fieldset>";
   $this->GetOutputEdit .= "<legend>Radera inlägg: {$post->title}</legend>";
   $this->GetOutputEdit .= "<input type='hidden' name='id' value='{$id}'/>";
   $this->GetOutputEdit .= "<p><input type='submit' name='delete' value='Radera'/></p>";
   $this->GetOutputEdit .= "</fieldset></form>";


}



/**
 * Create
 *
 */
  public function create() {
   $title  =   isset($_POST['title'])    ? strip_tags($_POST['title']) : null;
   $create =   isset($_POST['create'])   ? true                        : false;
   $acronym =  isset($_SESSION['user'])  ? $_SESSION['user']->acronym  : null;

   // Check that incoming parameters are valid
   isset($acronym) or die(header('location:http://www.student.bth.se/~najb13/oophp/projekt/lily/webroot/login.php'));

   // Check if form was submitted
   if($create) {
   $sql = 'INSERT INTO najb13.Content (title) VALUES (?)';
   $this->db->ExecuteQuery($sql, array($title));
   $this->db->SaveDebug();
   header('Location: edit.php?id=' . $this->db->LastInsertId());
   exit;
}

   $this->GetOutputEdit .= "<form method=post><fieldset><legend>Skapa ett nytt inlägg</legend>";
   $this->GetOutputEdit .= "<p><label>Titel:<br/><input type='text' name='title'/></label></p>";
   $this->GetOutputEdit .= "<p><input type='submit' name='create' value='Skapa'/></p></fieldset></form>";

}


/**
 * Category
 *
 */
  public function getCategory() {
  
    // Get all genres that are active
    $sql = "
      SELECT DISTINCT category 
      FROM Content WHERE type = 'post'
    ";
    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);
    
    $categories = null;
    foreach($res as $val) {
      $categories .= "<a href=blog.php?category={$val->category}>{$val->category}</a> ";
    }
    return $categories;
  }


/**
 * Reset
 *
 */
  public function reset() {
   $reset  = isset($_POST['reset'])  ? true : false;
   $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

   // Check that incoming parameters are valid
   isset($acronym) or die('fel, logga in..');

   // Check if form was submitted
   $output = null;
   if($reset) {
   $sql = 'DROP TABLE IF EXISTS Content;
   CREATE TABLE Content
(
   id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
   slug CHAR(80) UNIQUE,
   url CHAR(80) UNIQUE,
 
  TYPE CHAR(80),
  title VARCHAR(80),
  DATA TEXT,
  FILTER CHAR(80),
 
  published DATETIME,
  created DATETIME,
  updated DATETIME,
  deleted DATETIME
 
) ENGINE INNODB CHARACTER SET utf8;
';
   $this->db->ExecuteQuery($sql);
   $this->db->SaveDebug();
   header('Location: create.php');
}

   $this->GetOutputEdit .= "<form method=post><fieldset><legend>återställ</legend>";
   $this->GetOutputEdit .= "<p><input type='submit' name='reset' value='återställ'/></p></fieldset></form>";

}



} 
