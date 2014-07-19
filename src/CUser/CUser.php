<?php 

class CUser { 

    public function __construct($db) { 
        $this->db=$db;
        //$this->acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
    } 

    function Authenticated() { 
        if(isset($_SESSION['user'])){ 
            return true; 
        } 
        else { 
            return false; 
        } 
    } 

    function output() {  
        //$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
        
        if($acronym) { 
            $output = "<p class='okay'>Du är inloggad som: $acronym ({$_SESSION['user']->name})</p>"; 
        } 
        else { 
            $output = "<p class='error'>Du är INTE inloggad.</p>"; 
        } 
        return $output; 
    } 

    function login($user,$password) { 
        $sql = "SELECT acronym, name FROM User WHERE acronym = ? AND password = md5(concat(?, salt))"; 
        $params = array(htmlentities($user), htmlentities($password)); 
        $res=$this->db->ExecuteSelectQueryAndFetchAll($sql, $params); 
        
        if(isset($res[0])) { 
            $_SESSION['user'] = $res[0];
            return true; 
        } 
        else{ 
            return false; 
        }
    } 
}  