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


echo "Start test...\n";
	$x = new ReplaceTempWithQuery;
	$x->setQuantity(100);
	$x->setItemPrice(100);
	assert(9500 == $x->getPrice());

	$x->setQuantity(10);
	$x->setItemPrice(10);
	assert(98 == $x->getPrice());
echo "... done\n";