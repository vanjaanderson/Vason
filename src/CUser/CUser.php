<?php
/**
* CUser for user handeling
*/
class CUser extends CDatabase
{
  
  public $db;
  public $output;
  public $buttonName;
  public $buttonValue;
  public $form;
  protected $acronym;
  protected $name;
  protected $sql;
  protected $params;

  public function __construct($db)
  {
    $this->db = $db;
    $this->acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
  }

//Log in function, and get username.
  public function login($username,$password,$location="logout.php")
  {
    $this->sql = "SELECT acronym, name FROM User WHERE acronym = ? AND password = md5(concat(?, salt))";
    $this->params = array($username, $password);
    $res = $this->db->ExecuteSelectQueryAndFetchAll($this->sql, $this->params);
      if(isset($res[0])) {
        $_SESSION['user'] = $res[0];
      }
    $this->SaveDebug();
    header("Location:$location");
    exit;
  }

//Log out function
public function logout($locationOut="login.php")
{
    unset($_SESSION['user']);
    header("Location:$locationOut");
    exit;
}

// Check if user is authenticated. And what to do if/else. 
//I put this in construct__ Keeping it here just in case..
public function userAuth()
{
$this->acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
}

public function userOutput()
{
if($this->acronym) {
  $this->SetName();
  $this->output = "Du är inloggad som: {$this->GetAcronym()} ({$this->GetName()})";
  $this->buttonName = "logout";
  $this->buttonValue = "Logga ut";
  $this->form = "<p>Redan inloggad</p>";
  }
  else {
  $this->output = "Du är inte inloggad.";
  $this->buttonName = "login";
  $this->buttonValue = "Logga in";
  $this->form = "<p><label>Användare:<br/><input type='text' name='acronym' value=''/></label></p>";
  $this->form .= "<p><label>Lösenord:<br/><input type='text' name='password' value=''/></label></p>";
  }
}

public function GetAcronym()
{
 return $this->acronym;
}

public function SetName()
{
  $this->name = $_SESSION['user']->name;
}
public function GetName()
{
 return $this->name;
}  
  

} 
