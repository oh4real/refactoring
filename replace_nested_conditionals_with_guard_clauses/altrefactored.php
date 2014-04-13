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
		if ($this->_capital <= 0.0) {
			return 0.00;
		} 
		if ($this->_intRate <= 0.0 || $this->_duration <= 0.0) {
			return 0.00;
		}
		return number_format(($this->_income / $this->_duration) * self::ADJ_FACTOR, 2);
	}
}

echo "Start test...\n";
	$james = new Investment(100, 0.08, 36, 10000);
	assert($james->getAdjustedCapital() == 208.33);
	$anne = new Investment(100, 0.08, 0, 10000);
	assert($anne->getAdjustedCapital() == 0.00);
	$anne = new Investment(100, 0, 36, 10000);
	assert($anne->getAdjustedCapital() == 0.00);
	$anne = new Investment(0, 0.08, 36, 10000);
	assert($anne->getAdjustedCapital() == 0.00);
echo "... done\n";