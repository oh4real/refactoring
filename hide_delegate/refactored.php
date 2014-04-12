<?php

class Person_Before {
	private $_department;

	public function setDepartment(Department_Before $val) {
		$this->_department = $val;
	}

	public function getManager() {
		return $this->_department->getManager();
	}

}

class Department_Before {
	private $_chargeCode;
	private $_manager;

	public function __construct(Person_Before $person) {
		$this->_manager = $person;
	}

	public function getManager() {
		return $this->_manager;
	}
}

$classes = array('Person_Before');
foreach($classes as $class) {
	$manager = new Person_Before();
	$department = new Department_Before($manager);
	$employee = new Person_Before();
	$employee->setDepartment($department);
	print_r(get_class($manager) . ":\n");
	print_r($employee->getManager() == $manager ? "PASS\n" : "FAIL\n");
}
