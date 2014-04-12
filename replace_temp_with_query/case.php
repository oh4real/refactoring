<?php

class ReplaceTempWithQuery_Before {
	private $quantity;
	private $itemPrice;

	public function setQuantity($val) {
		$this->quantity = $val;
	}

	public function setItemPrice($val) {
		$this->itemPrice = $val;
	}

	public function getPrice() {
		$basePrice = $this->quantity * $this->itemPrice;
		$discountFactor = 1.00;
		if ($basePrice > 1000) {
			$discountFactor = 0.95;
		} else {
			$discountFactor = 0.98;
		}
		return $basePrice * $discountFactor;
	}
}

class ReplaceTempWithQuery_After {
	private $quantity;
	private $itemPrice;

	public function setQuantity($val) {
		$this->quantity = $val;
	}

	public function setItemPrice($val) {
		$this->itemPrice = $val;
	}

	public function getPrice() {
		$basePrice = $this->quantity * $this->itemPrice;
		$discountFactor = 1.00;
		if ($basePrice > 1000) {
			$discountFactor = 0.95;
		} else {
			$discountFactor = 0.98;
		}
		return $basePrice * $discountFactor;
	}
}

$classes = array('ReplaceTempWithQuery_Before', 'ReplaceTempWithQuery_After');
foreach ($classes as $class) {
	$x = new $class;
	print_r(get_class($x) . ":\n");
	$x->setQuantity(100);
	$x->setItemPrice(100);
	print_r($x->getPrice() == 9500 ? "PASS\n" : $x->getPrice() . " FAIL\n");

	$x->setQuantity(10);
	$x->setItemPrice(10);
	print_r($x->getPrice() == 98 ? "PASS\n" : $x->getPrice() . " FAIL\n");
}