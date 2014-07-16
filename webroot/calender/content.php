<?php 
/**
 * This is a Vason pagecontroller.
 *
 */

/**
 * Set month to view in calendar. If not sent in $_GET, sets todays values.
 * Also checks numeric format: 'MM-YYYY'.
 */
if(isset($_GET['month']) && preg_match('/^[0-9]{2}+-[0-9]{4}$/', $_GET['month'])) {
  $month = $_GET['month'];
}
else {
  $month = date("m") . "-" . date("Y"); //Ex. 'Sep-2013'.
}

$myCalendar = new CCalendarRenderBig();
$myCalendar->setMonth($month);
$output = $myCalendar->Render();

$vason['main'] = <<<EOD
<h1>Månadens bild</h1>
<p>{$output}</p>
EOD;

//CCalender::showDate();