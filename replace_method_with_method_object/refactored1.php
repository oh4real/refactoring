<?php

class ReplaceMethodWithMethodObject {
	private $delta = 10;

	public function delta() {
		// maybe do some calculation in here, but just going with simple test now
		return $this->delta;
	}

	public function gamma($inputVal, $quantity, $yearToDate) {
		$gamma = new GammaMethod($this, $inputVal, $quantity, $yearToDate);
		return $gamma->compute();
	}
}

class GammaMethod {
	private $source;
	private $inputVal;
	private $quantity;
	private $yearToDate;

	public function __construct(ReplaceMethodWithMethodObject $source, $inputVal, $quantity, $yearToDate) {
		$this->inputVal = $inputVal;
		$this->quantity = $quantity;
		$this->yearToDate = $yearToDate;
		$this->source = $source;
	}

	public function compute() {
		$this->importantValue1 = ($this->inputVal * $this->quantity) + $this->source->delta();
		$this->importantValue2 = ($this->inputVal * $this->yearToDate) + 100;
		if (($this->yearToDate - $this->importantValue1) > 100) {
			$this->importantValue2 -= 20;
		}
		$this->importantValue3 = $this->importantValue2 * $this->source->delta();
		// and so on ...
		return $this->importantValue3 - 2 * $this->importantValue1;

	}
}


echo "Start test...\n";
	$x = new ReplaceMethodWithMethodObject;
	print_r(get_class($x) . ":\n");
	assert($x->gamma(10, 100, 1000) == 98980);
echo "... done\n";