<?php

class Person {
	private $_name;
	private $_amount;
	private $_isDead = false;
	private $_isSeparated = false;
	private $_isRetired = false;

	public function __construct($name, $amount) {
		$this->_name = $name;
		$this->_amount = $amount;
	}

	public function setIsDead($val) {
		$this->_isDead = (bool)$val;
	}

	public function setIsRetired($val) {
		$this->_isRetired = (bool)$val;
	}

	public function setIsSeparated($val) {
		$this->_isSeparated = (bool)$val;
	}

	public function getPensionAmount() {
		$result = 0;
		if ($this->_isDead) {
			$result = $this->deadAmount();
		} else {
			if ($this->_isSeparated) {
				$result = $this->separatedAmount();
			} else {
				if ($this->_isRetired) {
					$result = $this->retiredAmount();
				} else {
					$result = $this->normalAmount();
				}
			}
		}
		return $result;
	}

	private function deadAmount() {
		return 1.75 * $this->_amount;
	}

	private function separatedAmount() {
		return 0.5 * $this->_amount;
	}

	private function retiredAmount() {
		return 1.5 * $this->_amount;
	}

	private function normalAmount() {
		return 1.00 * $this->_amount;
	}
}


echo "Start test...\n";
	$james = new Person("James", 100);
	$james->setIsDead(true);
	assert($james->getPensionAmount() == 175);
	$james->setIsDead(false);
	$james->setIsRetired(true);
	assert($james->getPensionAmount() == 150);
	$james->setIsRetired(false);
	$james->setIsSeparated(true);
	assert($james->getPensionAmount() == 50);
	$james->setIsSeparated(false);
	assert($james->getPensionAmount() == 100);
echo "... done\n";