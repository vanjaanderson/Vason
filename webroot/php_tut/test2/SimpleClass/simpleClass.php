<?php

/**
 * Getting started with object oriented programming in PHP.
 * 20 tutorial steps. Author: Mikal Roos, BTH, 2013.
 *
 * @author      Vanja Anderson <http://vanjaanderson.com>
 * @copyright   Vanja Anderson 2014
 * @license     http://opensource.org/licenses/MIT - MIT
 * @package     Testing OOP 
 * 
 * @todo 		Finish tutorial
 */

class SimpleClass {

	// Property declaration
	public $var = 'A default value: ';
	public $val = 0;

	// Method declaration
	public function DisplayVar() {
		$this->val++;
		echo $this->var . $this->val;
	}
}