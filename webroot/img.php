<?php 
/** 
 * This is the image pagecontroller document. 
 */ 
// Include the essential config-file which also creates the $idun variable with its defaults. 
include(__DIR__.'/config.php');  

//New object of CImage 
$img = new CImage(); 

//CImage will send header image back when called, no need for main output ! 


$html = null; 

// Prepare content and store it all in variables in the Idun container. 
$vason['title'] = "Filmer"; 
  
// Page content goes here.  
$vason['main'] = $html;

     
// Finally, leave it all to the rendering phase of Idun 
include(VASON_THEME_PATH); 
