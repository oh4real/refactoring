<?php

class ReplaceTempWithQuery {
	private $quantity;
	private $itemPrice;

	public function setQuantity($val) {
		$this->quantity = $val;
	}

	public function setItemPrice($val) {
		$this->itemPrice = $val;
	}

	public function getPrice() {
		return $this->basePrice() * $this->discountFactor();
	}

	private function basePrice() {
		return $this->quantity * $this->itemPrice;
	}

	private function discountFactor() {
		if ($this->basePrice() > 1000) {
			return 0.95;
		}
		return 0.98;
	}
}

echo "Start test...\n";
	$x = new ReplaceTempWithQuery;
	$x->setQuantity(100);
	$x->setItemPrice(100);
	assert(9500 == $x->getPrice());

	$x->setQuantity(10);
	$x->setItemPrice(10);
	assert(98 == $x->getPrice());
echo "... done\n";