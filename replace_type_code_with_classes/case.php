<?php

class Person {

	const O = 0;
	const A = 1;
	const B = 2;
	const AN = 3;

	private $_bloodGroup; // int that corresponds to constants (i think)

	public function __construct($bloodGroup) {
		$this->_bloodGroup = $bloodGroup;
	}

	public function setBloodGroup($bloodGroup) {
		$this->_bloodGroup = $bloodGroup;
	}

	public function getBloodGroup() {
		return $this->_bloodGroup;
	}

	public function doWork() {
		return true;
	}

}

// simulated enum in php
class BloodGroup {
	
	private $_code;
	private $_label;

	private static $_values = array();

	private function __construct($code, $label) {
		$this->_code = $code;
		$this->_label = $label;
	}

	public function getCode() {
		return $this->_code;
	}

	public static function code($code) {
		if (empty(self::$_values)) {
			self::init();
		}
		return self::$_values[$code];
	}

	private static function init() {
		$values = array('O', 'A', 'B', 'AB');
		foreach ($values as $key => $value) {
			self::$_values[$key] = new self($key, $value);
		}
	}
}

echo "Start test...\n";
	for ($i = 0; $i < 4; $i++) {
		assert(BloodGroup::code($i)->getCode() == $i);
	}

	$person = new Person(Person::A);
echo "... done\n";

// $x = new Item;
// echo get_class($x) . ":\n";
// 	assert($x->doWork() == true);
// print_r(uniqid() . "\n");