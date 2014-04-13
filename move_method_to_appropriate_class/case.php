<?php

class Type {
	private $isPremium;
	public function __construct($isPremium) {
		$this->isPremium = (boolean)$isPremium;
	}
	public function isPremium() {
		return (bool)$this->isPremium;
	}
}

class MoveMethodToAppropriateClass {
	private $type;
	private $daysOverdrawn;

	public function __construct(Type $type = null, $daysOverdrawn = 0) {
		$this->type = $type;
		$this->daysOverdrawn = $daysOverdrawn;
	}

	private function overdraftCharge() {
		if ($this->type->isPremium()) {
			$result = 10;
			if ($this->daysOverdrawn > 7) {
				$result += ($this->daysOverdrawn - 7) * 0.85;
			}
			return $result;
		} else {
			return $this->daysOverdrawn * 1.75;
		}
	}

	public function bankCharge(){
		$result = 4.5;
		if ($this->daysOverdrawn > 0) {
			$result += $this->overdraftCharge();
		}
		return $result;
	}
}

echo "Start test...\n";
	$y = new Type(true);
	$x = new MoveMethodToAppropriateClass($y);
	print_r(get_class($x) . ":\n");
	assert($x->bankCharge() == 4.5);

	$y = new Type(false);
	$x = new MoveMethodToAppropriateClass($y, 10);
	print_r(get_class($x) . ":\n");
	assert($x->bankCharge() == 22);

	$y = new Type(true);
	$x = new MoveMethodToAppropriateClass($y, 10);
	print_r(get_class($x) . ":\n");
	assert($x->bankCharge() == 17.05);
echo "... done\n";