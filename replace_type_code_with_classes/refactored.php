<?php

class Person {

	const O = 0;
	const A = 1;
	const B = 2;
	const AN = 3;

	private $_bloodGroup; // int

	public function __construct(BloodGroup $bloodGroup) {
		$this->_bloodGroup = $bloodGroup;
	}

	public function setBloodGroup(BloodGroup $bloodGroup) {
		$this->_bloodGroup = $bloodGroup;
	}

	public function getBloodGroup() {
		return $this->_bloodGroup;
	}

	public function getBloodGroupCode() {
		return $this->_bloodGroup->getCode();
	}
	
	public function doWork() {
		return true;
	}

}

// simulated enum in php
class BloodGroup {

	const O = 0;
	const A = 1;
	const B = 2;
	const AB = 3;
	
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
		assert($i == BloodGroup::code($i)->getCode());
		$person = new Person(BloodGroup::code($i));
		assert($i == $person->getBloodGroup()->getCode());
	}

	$person = new Person(BloodGroup::code(BloodGroup::A));
	assert(BloodGroup::code(BloodGroup::A) == $person->getBloodGroupCode());

	// test that bloodgroup really did change
	$person->setBloodGroup(BloodGroup::code(BloodGroup::AB));
	assert(BloodGroup::code(BloodGroup::A) != $person->getBloodGroupCode());
echo "... done\n";

// $x = new Item;
// echo get_class($x) . ":\n";
// 	assert($x->doWork() == true);
// print_r(uniqid() . "\n");