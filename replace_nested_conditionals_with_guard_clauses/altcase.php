<?php

class Investment {
	private $_capital;
	private $_intRate;
	private $_duration;
	private $_income;
	const ADJ_FACTOR = 0.75;

	public function __construct($capital, $intRate, $duration, $income) {
		$this->_capital = $capital;
		$this->_intRate = $intRate;
		$this->_duration = $duration;
		$this->_income = $income;
	}

	public function getAdjustedCapital() {
		$result = 0;
		if ($this->_capital > 0.0) {
			if ($this->_intRate > 0.0 && $this->_duration > 0.0) {
				$result = ($this->_income / $this->_duration) * self::ADJ_FACTOR;
			}
		}
		return number_format($result, 2);
	}

}

echo "Start test...\n";
	$james = new Investment(100, 0.08, 36, 10000);
	assert(208.33 == $james->getAdjustedCapital());
	$anne = new Investment(100, 0.08, 0, 10000);
	assert(0.00 == $anne->getAdjustedCapital());
	$anne = new Investment(100, 0, 36, 10000);
	assert(0.00 == $anne->getAdjustedCapital());
	$anne = new Investment(0, 0.08, 36, 10000);
	assert(0.00 == $anne->getAdjustedCapital());
echo "... done\n";