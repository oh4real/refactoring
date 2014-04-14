<?php

class Person {
	private $_department;

	public function getDepartment() {
		return $this->_department;
	}

	public function setDepartment(Department $val) {
		$this->_department = $val;
	}

}

class Department {
	private $_chargeCode;
	private $_manager;

	public function __construct(Person $person) {
		$this->_manager = $person;
	}

	public function getManager() {
		return $this->_manager;
	}
}


echo "Start test...\n";
	$manager = new Person();
	$department = new Department($manager);
	$employee = new Person();
	$employee->setDepartment($department);
	print_r(get_class($manager) . ":\n");
	assert($manager == $employee->getDepartment()->getManager());
echo "... done\n";