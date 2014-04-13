<?php

class CASE {

	public function doWork() {
		return true;
	}

}

$x = new CASE;
echo get_class($x) . ":\n");
	assert($x->doWork() == true);
print_r(uniqid() . "\n");