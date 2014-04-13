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
	print_r(get_class($x) . ":\n");
	$x->setQuantity(100);
	$x->setItemPrice(100);
	assert($x->getPrice() == 9500);

	$x->setQuantity(10);
	$x->setItemPrice(10);
	assert($x->getPrice() == 98);
echo "... done\n";