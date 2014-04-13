<?php

class SplitTempVar {

	private $primaryForce = 1;
	private $secondaryForce = 3;
	private $mass = 100;
	private $delay = 10;

	public function setSecondaryForce($val) {
		$this->secondaryForce = $val;
	}

	public function getDistanceTravelled($time) {
		$acc = $this->primaryForce/$this->mass;
		$primaryTime = min($time, $this->delay);
		$result = 0.5 * $acc * $primaryTime * $primaryTime;
		$secondaryTime = $time - $this->delay;
		if ($secondaryTime > 0) {
			$primaryVel = $acc * $this->delay;
			$acc = ($this->primaryForce + $this->secondaryForce) / $this->mass;
			$result += $primaryVel * $secondaryTime + 0.5 * $acc * $secondaryTime * $secondaryTime;
		}
		return $result;
	}
}

echo "Start test...\n";
	$x = new SplitTempVar;
	print_r(get_class($x) . ":\n");
	assert($x->getDistanceTravelled(100) == 171.5);
	$x->setSecondaryForce(0);
	assert($x->getDistanceTravelled(100) == 50);
echo "... done\n";