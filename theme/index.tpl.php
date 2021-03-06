<!-- 
**********************************************************************************
  index.tpl.php
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
  Author: Vanja Maria Anderson
  Description: Vason webbtemplate in PHP, javascript, CSS and PDO::sqlite
  Date: 2014-07-12
  Version: 1.0
  Website: http://vanjaanderson.com
  Development: https://github.com/vanjaanderson/Vason
********************************************************************************** 
-->
<!DOCTYPE html>
<html class='no-js' lang='<?=$lang?>'> <!-- Modernizr will replace the class 'no-js' with a list of features supported by the browser -->
<head>
<meta charset='utf-8'/>
<title><?=get_title($title)?></title>
<?php if(isset($favicon)): ?>
  <link rel='shortcut icon' href='<?=$favicon?>'/>
<?php endif; ?>
<?php if(isset($apple_touch_icon)): ?>
  <link rel='apple-touch-icon' href='<?=$apple_touch_icon?>'/>
<?php endif; ?>
<?php foreach($stylesheets as $val): ?>
  <link rel='stylesheet' type='text/css' href='<?=$val?>'/>
<?php endforeach; ?>
<script src='<?=$modernizr?>'></script>
</head>
<body>
  <div id='wrapper'>
    <div id='header'><?=$header?></div>
      <?php if(isset($menu)): ?><div id='navbar'><?=CNavigation::GenerateMenu($menu,'navbar',$active); ?></div><?php endif; ?>
    <div id='main'><?=$main?></div>
    <div id='footer'><?=$footer?></div>
  </div>
  <?php if(isset($jquery)):?><script src='<?=$jquery?>'></script><?php endif; ?>
  <?php if(isset($javascript_include)): foreach($javascript_include as $val): ?>
<script src='<?=$val?>'></script>
<?php endforeach; endif; ?>
<?php if(isset($google_analytics)): ?>
<script>
  var _gaq=[['_setAccount','<?=$google_analytics?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif; ?>
</body>
</html>