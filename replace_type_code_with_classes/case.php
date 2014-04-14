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

echo "Start test...\n";
	for ($i = 0; $i < 4; $i++) {
		$person = new Person($i);
		assert($i == $person->getBloodGroup());
	}

echo "... done\n";

// $x = new Item;
// echo get_class($x) . ":\n";
// 	assert($x->doWork() == true);
// print_r(uniqid() . "\n");