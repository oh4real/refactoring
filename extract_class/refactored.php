<?php

class Person_After {
	private $_name;

	public function __construct() {
		$this->_telephoneNumber = new Telephone_After;
	}

	public function getName() {
		return $this->_name;
	}

	public function getTelephoneNumber() {
		return $this->_telephoneNumber->getTelephoneNumber();
	}

	public function getOfficeAreaCode() {
		return $this->_telephoneNumber->getAreaCode();
	}
	public function setOfficeAreaCode($val) {
		$this->_telephoneNumber->setAreaCode($val);
	}
	public function getOfficeNumber() {
		return $this->_telephoneNumber->getNumber();
	}
	public function setOfficeNumber($val) {
		$this->_telephoneNumber->setNumber($val);
	}
}

class Telephone_After {
	private $_areaCode;
	private $_number;

	public function getTelephoneNumber() {
		return "(" . $this->_areaCode . ") " . $this->_number;
	}

	public function getAreaCode() {
		return $this->_areaCode;
	}
	public function setAreaCode($val) {
		$this->_areaCode = $val;
	}
	public function getNumber() {
		return $this->_number;
	}
	public function setNumber($val) {
		$this->_number = $val;
	}
}

$classes = array('Person_After');
foreach($classes as $class) {
	$x = new $class;
	print_r(get_class($x) . ":\n");
	$x->setOfficeNumber("555-1212");
	$x->setOfficeAreaCode("512");
	print_r($x->getTelephoneNumber() == "(512) 555-1212" ? "PASS\n" : "FAIL\n");
}