<?php

class Item {

	public function doWork() {
		return true;
	}

}

$x = new Item;
echo get_class($x) . ":\n";
	assert($x->doWork() == true);
print_r(uniqid() . "\n");