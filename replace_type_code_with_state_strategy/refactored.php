<?php

// TODO:
// 1. self-encapsulate type code
// 2. create new state object, type class (abstract)
// 3. add subclasses to state object, one for each type.
// 4. create abstract getType() method on super class
// 5. create new field in outer object for state object.
// 6. update type code assignment in outer object for new state object.

class Employee {

	private $_type;
	private $_commission = 100;
	private $_monthlySalary = 1000;
	private $_bonus = 10;

	public function __construct($type) {
		$this->setType($type);
	}

	public function setType($val) {
		// _type is no longer immutable
		$this->_type = EmployeeType::newType($val);
	}

	public function getWages() {
		// Fowler still had a swtich case here, I took it one step further
		return $this->_type->getWages($this);
	}

	public function getMonthlySalary() {
		return $this->_monthlySalary;
	}

	public function getCommission() {
		return $this->_commission;
	}

	public function getBonus() {
		return $this->_bonus;
	}

}

abstract class EmployeeType {
	private $_type;
	const ENGINEER = 0;
	const SALESMAN = 1;
	const MANAGER  = 2;

	abstract public function getTypeCode();
	abstract public function getWages(Employee $employee);

	public static function newType($type) {
		switch ($type) {
			case EmployeeType::ENGINEER:
				return new Engineer();
			case EmployeeType::SALESMAN:
				return new Salesman();
			case EmployeeType::MANAGER:
				return new Manager();
			default:
				throw new Exception("No matching type for: $type");
		}
	}
}

class Engineer extends EmployeeType {
	public function getTypeCode() {
		return EmployeeType::ENGINEER;
	}

	public function getWages(Employee $emp) {
		return $emp->getMonthlySalary();
	}
}

class Salesman extends EmployeeType {
	public function getTypeCode() {
		return EmployeeType::SALESMAN;
	}

	public function getWages(Employee $emp) {
		return $emp->getMonthlySalary() + $emp->getCommission();
	}
}

class Manager extends EmployeeType{
	public function getTypeCode() {
		return EmployeeType::MANAGER;
	}

	public function getWages(Employee $emp) {
		return $emp->getMonthlySalary() + $emp->getBonus();
	}
}



echo "Start test...\n";
	$x = new Employee(EmployeeType::ENGINEER);
	assert(1000 == $x->getWages());

	$x->setType(EmployeeType::SALESMAN);
	assert(1100 == $x->getWages());

	$x->setType(EmployeeType::MANAGER);
	assert(1010 == $x->getWages());
echo "... done\n";