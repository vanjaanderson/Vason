<?php
/**
 * A Histogram class
 *
 */
class CHistogram2 {

  /**
   * Constructor
   *
   */
  public function __construct() {
    echo __METHOD__;
  }


  /**
   * Destructor
   *
   */
  public function __destruct() {
    echo __METHOD__;
  }


  /**
   * Print the histogram
   *
   * @param array $values the values to print out the histogram from.
   * @return string as the histogram in a ul li list.
   */
  public function GetHistogram($values) {

    // Calculate occurences for each key
    $res = array();
    foreach($values as $key => $value) {
      @$res[$value] .= '*'; // Use @ to ignore warning for not initiating variabel, not really nice but powerful.
    }
    ksort($res);

    // Prepare out a textual representation of the histogram
    $html = "<ul>";
    foreach($res as $key => $val) {
      $html .= "<li>{$val} ($key)</li>";
    }
    $html .= "</ul>";

    return $html;
  }


  /**
   * Print the histogram and include the empty ones
   *
   * @param array $values the values to print out the histogram from.
   * @param int $max number of staples in the histogram.
   * @return string as the histogram in a ul li list.
   */
  public function GetHistogramIncludeEmpty($values, $max) {

    // Calculate occurences for each key
    $res = array();
    foreach($values as $key => $value) {
      @$res[$value] .= '*'; // Use @ to ignore warning for not initiating variabel, not really nice but powerful.
    }
    ksort($res);

    // Prepare out a textual representation of the histogram
    $html = "<ol>";
    for($i = 1; $i <= $max; $i++) {
      $val = isset($res[$i]) ? $res[$i] : null;
      $html .= "<li>{$val}</li>";
    }
    $html .= "</ol>";

    return $html;
  }
}

?>