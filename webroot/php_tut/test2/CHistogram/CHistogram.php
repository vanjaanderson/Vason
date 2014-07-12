<?php
/**
 * A Histogram class
 *
 */
class CHistogram {

  /**
   * Properties
   *
   */
  

  /**
   * Methods
   *
   */
  public function GetHistogram($rolls) {
    
    // Calculate occurences for each key
    $res = array();
    foreach($rolls as $key => $value) {
      @$res[$value] .= '*'; // Use @ to ignore warning for not initiating variabel, not really nice but powerful.
    }
    ksort($res);

    // Prepare out a textual representation of the histogram
    $html = "<ul>";
    foreach($res as $key => $val) {
      $html .= "<li style='display:inline-block'>[$key]&nbsp;{$val}&nbsp;</li>";
    }
    $html .= "</ul>";

    return $html;
  }
}

?>
