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
		$acc = $this->calculateAcceleration($this->primaryForce);
		$result = $this->subCalc($acc, min($time, $this->delay));
		$secondaryTime = $time - $this->delay;
		if ($secondaryTime > 0) {
			$primaryVel = $this->calcVelocity($acc, $this->delay);
			$secondaryAcc = $this->calculateAcceleration($this->primaryForce + $this->secondaryForce);
			$result += $primaryVel * $secondaryTime + $this->subCalc($secondaryAcc, $secondaryTime);
		}
		return $result;
	}

	private function subCalc($a, $t) {
		return 0.5 * $a * pow($t, 2);
	}

	private function calculateAcceleration($force) {
		return $force / $this->mass;
	}

	private function calcVelocity($a, $t) {
		return $a * $t;
	}

}

echo "Start test...\n";
	$x = new SplitTempVar;
	print_r(get_class($x) . ":\n");
	assert($x->getDistanceTravelled(100) == 171.5);
	$x->setSecondaryForce(0);
	assert($x->getDistanceTravelled(100) == 50);
echo "... done\n";