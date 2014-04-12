<?php

class ReplaceMethodWithMethodObject_Before {
	private $delta = 10;

	public function delta() {
		// maybe do some calculation in here, but just going with simple test now
		return $this->delta;
	}

	public function gamma($inputVal, $quantity, $yearToDate) {
		$importantValue1 = ($inputVal * $quantity) + $this->delta();
		$importantValue2 = ($inputVal * $yearToDate) + 100;
		if (($yearToDate - $importantValue1) > 100) {
			$importantValue2 -= 20;
		}
		$importantValue3 = $importantValue2 * $this->delta();
		// and so on ...
		return $importantValue3 - 2 * $importantValue1;
	}
}

class ReplaceMethodWithMethodObject_After {
	private $delta = 10;

	public function delta() {
		// maybe do some calculation in here, but just going with simple test now
		return $this->delta;
	}

	public function gamma($inputVal, $quantity, $yearToDate) {
		$gamma = new GammaMethod2($this, $inputVal, $quantity, $yearToDate);
		return $gamma->compute();
	}
}

class GammaMethod2 {
	private $source;
	private $inputVal;
	private $quantity;
	private $yearToDate;

	public function __construct(ReplaceMethodWithMethodObject_After $source, $inputVal, $quantity, $yearToDate) {
		$this->inputVal = $inputVal;
		$this->quantity = $quantity;
		$this->yearToDate = $yearToDate;
		$this->source = $source;
	}

	public function compute() {
		$this->calculateValue1();
		$this->calculateValue2();
		$this->adjustValue2();
		$this->calculateValue3();
		// and so on ...
		return $this->importantValue3 - 2 * $this->importantValue1;
	}

	private function calculateValue1() {
		$this->importantValue1 = ($this->inputVal * $this->quantity) + $this->source->delta();
	}

	private function calculateValue2() {
		$this->importantValue2 = ($this->inputVal * $this->yearToDate) + 100;
	}

	private function adjustValue2() {
		if (($this->yearToDate - $this->importantValue1) > 100) {
			$this->importantValue2 -= 20;
		}
	}

	private function calculateValue3() {
		$this->importantValue3 = $this->importantValue2 * $this->source->delta();
	}
}

$classes = array('ReplaceMethodWithMethodObject_Before', 'ReplaceMethodWithMethodObject_After');
foreach($classes as $class) {
	$x = new $class;
	print_r(get_class($x) . ":\n");
	print_r($x->gamma(10, 100, 1000) == 98980 ? "PASS\n" : "FAIL\n");
}