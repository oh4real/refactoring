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
		if ($this->_isDead) {
			return $this->deadAmount();
		} 
		if ($this->_isSeparated) {
			return $this->separatedAmount();
		}
		if ($this->_isRetired) {
			return $this->retiredAmount();
		}
		return $this->normalAmount();
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
	assert(175 == $james->getPensionAmount());
	$james->setIsDead(false);
	$james->setIsRetired(true);
	assert(150 == $james->getPensionAmount());
	$james->setIsRetired(false);
	$james->setIsSeparated(true);
	assert(50 == $james->getPensionAmount());
	$james->setIsSeparated(false);
	assert(100 == $james->getPensionAmount());
echo "... done\n";