<?php

class IntroduceExplainingVar {
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


echo "Start test...\n";
	$x = new IntroduceExplainingVar;
	print_r(get_class($x) . ":\n");
	$x->setQuantity(250);
	$x->setItemPrice(10);
	assert(2600 == $x->price());

	$x->setQuantity(750);
	$x->setItemPrice(10);
	assert(7475 == $x->price());
echo "... done\n";