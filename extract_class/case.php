<?php

class Person_Before {
	private $_name;
	private $_officeAreaCode;
	private $_officeNumber;

	public function getName() {
		return $this->_name;
	}
	public function getTelephoneNumber() {
		return "(" . $this->_officeAreaCode . ") " . $this->_officeNumber;
	}
	public function getOfficeAreaCode() {
		return $this->_officeAreaCode;
	}
	public function setOfficeAreaCode($val) {
		$this->_officeAreaCode = $val;
	}
	public function getOfficeNumber() {
		return $this->_officeNumber;
	}
	public function setOfficeNumber($val) {
		$this->_officeNumber = $val;
	}
}

$classes = array('Person_Before');
foreach($classes as $class) {
	$x = new $class;
	print_r(get_class($x) . ":\n");
	$x->setOfficeNumber("555-1212");
	$x->setOfficeAreaCode("512");
	print_r($x->getTelephoneNumber() == "(512) 555-1212" ? "PASS\n" : "FAIL\n");
}