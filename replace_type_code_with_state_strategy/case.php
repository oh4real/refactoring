<?php

class Employee {

	const ENGINEER = 0;
	const SALESMAN = 1;
	const MANAGER  = 2;

	private $_type;
	private $_commission = 100;
	private $_monthlySalary = 1000;
	private $_bonus = 10;

	public function __construct($type) {
		// _type is immutable
		$this->_type = $type;
	}

	public function getWages() {
		switch ($this->_type) {
			case self::ENGINEER:
				return $this->_monthlySalary;
			case self::SALESMAN: 
				return $this->_monthlySalary + $this->_commission;
			case self::MANAGER:
				return $this->_monthlySalary + $this->_bonus;
			default:
				throw new Exception("No type for {$this->_type}");
		}
	}
}


echo "Start test...\n";
	$x = new Employee(Employee::ENGINEER);
	assert(1000 == $x->getWages());

	$x = new Employee(Employee::SALESMAN);
	assert(1100 == $x->getWages());

	$x = new Employee(Employee::MANAGER);
	assert(1010 == $x->getWages());
echo "... done\n";