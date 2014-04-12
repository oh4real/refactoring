<?php

class Type_Before {

	private $isPremium;

	public function __construct($isPremium) {
		$this->isPremium = (boolean)$isPremium;
	}

	public function isPremium() {
		return (bool)$this->isPremium;
	}
}

class MoveMethodToAppropriateClass_Before {
	private $type;
	private $daysOverdrawn;

	public function __construct(Type_Before $type = null, $daysOverdrawn = 0) {
		$this->type = $type;
		$this->daysOverdrawn = $daysOverdrawn;
	}

	public function overdraftCharge() {
		if ($this->type->isPremium()) {
			$result = 10;
			if ($this->daysOverdrawn > 7) {
				$result += ($this->daysOverdrawn - 7) * 0.85;
			}
			return $result;
		} else {
			return $this->daysOverdrawn * 1.75;
		}
	}

	public function bankCharge(){
		$result = 4.5;
		if ($this->daysOverdrawn > 0) {
			$result += $this->overdraftCharge();
		}
		return $result;
	}
}

class Type_After extends Type_Before {

	public function overdraftCharge($daysOverdrawn) {
		if ($this->isPremium()) {
			$result = 10;
			if ($daysOverdrawn > 7) {
				$result += ($daysOverdrawn - 7) * 0.85;
			}
			return $result;
		} else {
			return $daysOverdrawn * 1.75;
		}
	}
}

class MoveMethodToAppropriateClass_After {
	private $type;
	private $daysOverdrawn;

	public function __construct(Type_After $type = null, $daysOverdrawn = 0) {
		$this->type = $type;
		$this->daysOverdrawn = $daysOverdrawn;
	}

	public function bankCharge(){
		$result = 4.5;
		if ($this->daysOverdrawn > 0) {
			$result += $this->type->overdraftCharge($this->daysOverdrawn);
		}
		return $result;
	}
}


$classes = array('MoveMethodToAppropriateClass_Before');
foreach ($classes as $class) {
	$y = new Type_Before(true);
	$x = new $class($y);
	print_r(get_class($x) . ":\n");
	print_r($x->bankCharge() == 4.5 ? "PASS\n" : "FAIL\n");

	$y = new Type_Before(false);
	$x = new $class($y, 10);
	print_r(get_class($x) . ":\n");
	print_r($x->bankCharge() == 22 ? "PASS\n" : "FAIL\n");

	$y = new Type_Before(true);
	$x = new $class($y, 10);
	print_r(get_class($x) . ":\n");
	print_r($x->bankCharge() == 17.05 ? "PASS\n" : "FAIL\n");
}


$classes = array('MoveMethodToAppropriateClass_After');
foreach ($classes as $class) {
	$y = new Type_After(true);
	$x = new $class($y);
	print_r(get_class($x) . ":\n");
	print_r($x->bankCharge() == 4.5 ? "PASS\n" : "FAIL\n");

	$y = new Type_After(false);
	$x = new $class($y, 10);
	print_r(get_class($x) . ":\n");
	print_r($x->bankCharge() == 22 ? "PASS\n" : "FAIL\n");

	$y = new Type_After(true);
	$x = new $class($y, 10);
	print_r(get_class($x) . ":\n");
	print_r($x->bankCharge() == 17.05 ? "PASS\n" : "FAIL\n");
}