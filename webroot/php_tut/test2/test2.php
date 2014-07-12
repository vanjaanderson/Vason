<?php
/*========================
	Autoloader for classes
=========================*/
// $class is the name of the class
function myAutoloader($class) {
	$path = "{$class}/{$class}.php";
	if(is_file($path)) {
		include($path);
	}
}
spl_autoload_register('myAutoloader');
/**
 * Test file in OOP programming
 **/
echo '<h1>Getting started with object oriented programming in PHP in 20 steps</h1>';
echo '<h3>1) A small introduction&mdash;no exercises to show</h3>';
echo '<p>Here I will show the 20 programming steps in one place.</p>';
/*========================
	2) A SimpleClass
=========================*/
// Start by including the class definition
//include('SimpleClass/simpleClass.php');
// Create an instant (object) of the class
$obj = new SimpleClass();
// Use the class
echo '<h3>2) A simple class</h3>';
echo '<p>';
$obj->DisplayVar();
echo '</p>';
// Change the state of the object and use it again
$obj->var = 'Hello World (should now be 2) = ';
echo '<p>';
$obj->DisplayVar();
echo '</p>';
/*========================
	3) A class for a Dice
=========================*/
echo '<h3>3) Roll the dice</h3>';
echo '<p>The dice is thrown 6 times and here is the result:</p>';
// Save the outcome of each dice roll
$rolls = array();
// Roll the dice
$times = 6;
// Loop 6 times
for ($i=0; $i<$times; $i++) {
	$rolls[] = rand(1,6);
}
// Print out the result
$html = '<ul>';
// Loop through array
foreach($rolls as $val) {
	$html .= '<li style="display:inline-block">&nbsp;&bullet;'.$val.'&nbsp;</li>';
}
$html .= '</ul>';
// Show the result
echo $html;
/*========================
	Roll the Dice 
	through the class
=========================*/
// Start by including the class definition
//include('CDice/CDice.php');
// Define $times;
$times = $_GET['roll'];
// Print html and choose number of times to roll
echo '<h4>Use CDice to roll the dice</h4>';
echo '<p>The dice can be thrown (<a href="?roll=6">6</a>, <a href="?roll=12">12</a> or <a href="?roll=24">24</a>) times and here comes the result:</p>';
// Create an instance of the dice class
$dice = new CDice();
// Echo method when constructor is used
echo ' (feedback when constructor is used, see 6 &mdash; Constructor and destructor)';
// Print out the result
$html = '<ul>';
// Let the dice roll
$dice->Roll($times);
$rolls2 = $dice->rolls;
// Loop through array to print the list
foreach($rolls2 as $val) {
	$html .= '<li style="display:inline-block">&nbsp;&bullet;'.$val.'&nbsp;</li>';
}
$html .= '</ul>';
// Show the result
echo $html;
// Show the result
$score = $dice->GetTotal();
// Show average score
$avg = $dice->GetAverageScore($score, $times);
// Print some info
echo '<p>You rolled the dice '.$times.' times.</p>';
echo '<p>Total score is: '.$score.'.</p>';
echo '<p>Average score per dice is: '.$avg.'.</p>';
/*========================
	4) Put classes in 
	seperate files
	CHistogram
=========================*/
// Show rolled dices in a histogram
//include('CHistogram/CHistogram.php');
// Create a histogram object
$histogram = new CHistogram();
// Show result
echo '<h3>4) Write a histogram of the rolls</h3>';
echo '<p>When you roll the dices above, a histogram will show here.</p>';
echo '<p>';
// Put array into class method
echo $histogram->GetHistogram($rolls2);
echo '</p>';
/*========================
	5) Autoloader for 
	classes, see the top
=========================*/
echo '<h3>5) Autoloader for classes</h3>';
echo '<p>In this excercise, I made an autoloader function, that automatically includes all my class-files.</p>';
/*========================
	6) Constructor and 
	destructor
========================*/
echo '<h3>6) Construct and destruct</h3>';
echo '<p>The constructor is used when an object is created: <span style="color:red">';
$obj = new CDice();
echo '</span></p>';
echo '<p>The destructor is used when an object is destroyed: <span style="color:red">';
unset($obj);
echo '</span></p>';
echo '<p>And/or automatically at the end (see bottom of page):</p>';
/*========================
	7) Unified Modelling 
	Language diagrams
========================*/
echo '<h3>7) Draw diagrams to display classes</h3>
	<p>Classes can be illustrated with Modelling Language (UML) diagrams</p>';
// Table CDice
echo '<table style="border:1px solid black; float:left; margin-right:1em">
	<tr><th style="border-bottom: 1px solid black">CDice</th></tr>
	<tr><td> + faces: int</td></tr>
	<tr><td style="border-bottom: 1px solid black"> + rolls: array</td></tr>
	<tr><td> + __construct($faces=6): void</td></tr>
	<tr><td> + __destruct(): void</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td> + Roll($times): void</td></tr>
	<tr><td> + GetTotal(): int</td></tr>
	<tr><td> + GetAverage(): float</td></tr>
	</table>';
// Table CHistogram
echo '<table style="border:1px solid black;">
	<tr><th style="border-bottom: 1px solid black">CHistogram</th></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td style="border-bottom: 1px solid black">&nbsp;</td></tr>
	<tr><td> + __construct(): void</td></tr>
	<tr><td> + __destruct(): void</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td> + GetHistogram($values): string</td></tr>
	<tr><td> + GetHistogramIncludeEmpty($values, $max): string</td></tr>
	<tr><td>&nbsp;</td></tr>
	</table>';
echo '<p>Plus sign (+) indicates that members and methods are public.<br />
	Protected members or methods are written with hash tag (#).<br />
	Finally, private members and methods are written with a minus sign (-).</p>';
/*========================
	8) Unified Modelling 
	Language diagrams
========================*/
echo '<h3>8) Classes visibility: public, protected and private</h3>
	<ul><li><strong>Public</strong> visibility: the users of the class can read, update the member variables and call functions/methods.</li>
	<li><strong>Private</strong> visibility: the users of the class cannot read, update the member variables or call functions/methods.</li>
	<li><strong>Protected</strong> visibility: affects the visibility of inheritance hierarchy.</li></ul>';
// Updated class CDice with private member variables
echo '<h4>Throw a dice</h4>';
echo '<p>The dice can be thrown (<a href="?roll=6">6 times, 6 faces</a>; <a href="?roll=12&amp;faces=12">12 times, 12 faces</a> or <a href="?roll=24&amp;faces=24">24 times, 24 faces</a>) and here is the result:</p>';
// Roll the dice
$times = isset($_GET['roll']) && is_numeric($_GET['roll']) ? $_GET['roll'] : 1;
if($times > 100) {
  die("You cannot roll the dice more than 100 times!<br />");
}
$faces = isset($_GET['faces']) && is_numeric($_GET['faces']) ? $_GET['faces'] : 6;
if($faces > 100) {
  die("A dice cannot have more than 100 faces!<br />");
}
// Create the objects
$dice = new CDice2($faces);
// Echo method when constructor is used
echo ' (feedback when constructor is used, see 6 &mdash; Constructor and destructor)<br />';
$histogram = new CHistogram2();
// Echo method when constructor is used
echo ' (feedback when constructor is used, see 6 &mdash; Constructor and destructor)<br />';
$dice->Roll($times);
$rolls = $dice->rolls;
$rollscount = count($rolls);
$average = $dice->GetAverage();
$total = $dice->GetTotal();
// Print out the results as a histogram
$html = null;
foreach($rolls as $val) {
  $html .= "{$val}, ";
}
echo $histogram->GetHistogramIncludeEmpty($rolls, $faces);
echo '<p>You throwed: '.$html.'</p>
<p>The dice has '.$faces.' faces.</p>
<p>You rolled the dice '.$rollscount.' times.</p>
<p>Total score is: '.$total.'.</p>
<p>Average score is: '.$average.'.</p>';
/*========================
	9) Inheritance
========================*/
// Last row before destruct command
echo '<p></p>';
?>