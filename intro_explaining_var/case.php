<?php

class IntroduceExplainingVar_Before {
	private $quantity;
	private $itemPrice;

	public function setQuantity($val) {
		$this->quantity = $val;
	}

	public function setItemPrice($val) {
		$this->itemPrice = $val;
	}

	public function price() {
		// price is base price - quantity discount + shipping
		return $this->quantity * $this->itemPrice -
			max(0, $this->quantity - 500) * $this->itemPrice * 0.05 +
			min($this->quantity * $this->itemPrice * 0.1, 100);
	}
}

class IntroduceExplainingVar_After {
	private $quantity;
	private $itemPrice;

	public function setQuantity($val) {
		$this->quantity = $val;
	}

	public function setItemPrice($val) {
		$this->itemPrice = $val;
	}

	public function price() {
		return;
	}
}

$classes = array('IntroduceExplainingVar_Before', 'IntroduceExplainingVar_After');
foreach ($classes as $class) {
	$x = new $class;
	print_r(get_class($x) . ":\n");
	$x->setQuantity(250);
	$x->setItemPrice(10);
	print_r($x->price() == 2600 ? "PASS\n" : "FAIL\n");

	$x->setQuantity(750);
	$x->setItemPrice(10);
	print_r($x->price() == 7475 ? "PASS\n" : "FAIL\n");
}