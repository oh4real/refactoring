<?php

class SplitTempVar_Before {

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

class SplitTempVar_After {

	private $primaryForce = 1;
	private $secondaryForce = 3;
	private $mass = 100;
	private $delay = 10;

	public function setSecondaryForce($val) {
		$this->secondaryForce = $val;
	}
	public function getDistanceTravelled($time) {

	}
}

$classes = array('SplitTempVar_Before', 'SplitTempVar_After');
foreach($classes as $class) {
	$x = new $class;
	print_r(get_class($x) . ":\n");
	print_r($x->getDistanceTravelled(100) == 171.5 ? "PASS\n" : "FAIL\n");
	$x->setSecondaryForce(0);
	print_r($x->getDistanceTravelled(100) == 50 ? "No Secondary PASS\n" : "No Secondary FAIL\n");
}