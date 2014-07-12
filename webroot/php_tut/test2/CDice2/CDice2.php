<?php
/**
 * A Dice class to play around with a dice
 *
 */
class CDice2 {

  /**
   * Properties
   *
   */
  public $faces;
  public $rolls = array();


  /**
   * Constructor
   *
   * @param int $faces the number of faces to use.
   */
  public function __construct($faces=6) {
    echo __METHOD__;
    $this->faces = $faces;
  }


  /**
   * Destructor
   *
   */
  public function __destruct() {
    echo __METHOD__;
  }


  /**
   * Roll the dice
   *
   */
  public function Roll($times) {
    $this->rolls = array();

    for($i = 0; $i < $times; $i++) {
      $this->rolls[] = rand(1, $this->faces);
    }
  }


  /**
   * Get the total from the last roll(s).
   *
   */
  public function GetTotal() {
    return array_sum($this->rolls);
  }


  /**
   * Get the average from the last roll(s).
   *
   */
  public function GetAverage() {
    return round(array_sum($this->rolls) / count($this->rolls), 1);
  }

}

?>
