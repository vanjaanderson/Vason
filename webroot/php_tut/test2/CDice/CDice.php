<?php
/**
 * A Dice class to play around with a dice
 *
 */
class CDice {

  /**
   * Properties
   *
   */
  public $rolls = array();

  /**
   * Constructor
   */
  public function __construct() {
    echo __METHOD__;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    echo __METHOD__;
  }

  /**
   * Methods
   *
   */
  // Roll the dice $times times
  public function Roll($times) {
    // This points to $rolls property
    $this->rolls = array();
    // Roll the dice $times times
    for($i=0; $i<$times; $i++) {
      $this->rolls[] = rand(1,6);
    }
  }
  
  // Get the total from the last roll(s).
  public function GetTotal() {
    return array_sum($this->rolls);
  }
  // Get average score
  public function GetAverageScore($score, $times) {
    return round(($score/$times),2);
  }
}

?>
