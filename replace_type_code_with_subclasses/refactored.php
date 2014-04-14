<?php

abstract class Employee {

	protected $_type;
	const ENGINEER = 0;
	const SALESMAN = 1;
	const MANAGER  = 2;

	private function __construct() {
	}

	abstract public function getType();

	// adding a factory method, so we can do some factory switching later
	public static function create($type) {
		switch ($type) {
			case self::ENGINEER: 
				return new Engineer();
			case self::SALESMAN:
				return new Salesman();
			case self::MANAGER:
				return new Manager();
			default:
				throw new Exception("$type is an invalid EmployeeType");
		}
	}

	abstract public function getPayCode();

}

// we want the employee to have subclasses
class Engineer extends Employee {
	public function getType() {
		return self::ENGINEER;
	}

	public function getPayCode() {
		return self::ENGINEER + 100;
	}
}

class Salesman extends Employee {
	public function getType() {
		return self::SALESMAN;
	}

	public function getPayCode() {
		return self::SALESMAN + 200;
	}
}

class Manager extends Employee {

	public function getType() {
		return self::MANAGER;
	}

	public function getPayCode() {
		return self::MANAGER + 300;
	}
}

echo "Start test...\n";
	$x = Employee::create(Employee::ENGINEER);
	assert(100+Employee::ENGINEER == $x->getPayCode());
	assert(Employee::ENGINEER == $x->getType());

	$x = Employee::create(Employee::SALESMAN);
	assert(200+Employee::SALESMAN == $x->getPayCode());
	assert(Employee::SALESMAN == $x->getType());

	$x = Employee::create(Employee::MANAGER);
	assert(300+Employee::MANAGER == $x->getPayCode());
	assert(Employee::MANAGER == $x->getType());
echo "... done\n";