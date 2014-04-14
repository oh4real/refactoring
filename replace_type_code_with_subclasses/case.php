<?php

class Employee {

	private $_type;
	const ENGINEER = 0;
	const SALESMAN = 1;
	const MANAGER  = 2;

	public function __construct($type) {
		$this->_type = $type;
	}

	public function getPayCode() {
		switch ($this->_type) {
			case self::ENGINEER:
				return self::ENGINEER + 100;
			case self::SALESMAN: 
				return self::SALESMAN + 200;
			case self::MANAGER:
				return self::MANAGER + 300;
			default:
				throw new Exception("No type for {$this->_type}");
		}
	}

}


echo "Start test...\n";
	$x = new Employee(Employee::ENGINEER);
	assert(100+Employee::ENGINEER == $x->getPayCode());

	$x = new Employee(Employee::SALESMAN);
	assert(200+Employee::SALESMAN == $x->getPayCode());

	$x = new Employee(Employee::MANAGER);
	assert(300+Employee::MANAGER == $x->getPayCode());
echo "... done\n";