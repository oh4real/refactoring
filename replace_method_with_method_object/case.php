<?php

class ReplaceMethodWithMethodObject {
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

echo "Start test...\n";
	$x = new ReplaceMethodWithMethodObject;
	print_r(get_class($x) . ":\n");
	assert(98980 == $x->gamma(10, 100, 1000));
echo "... done\n";