<?php

// Convert $_customer to a reference object so multiple Order can have same Customer object.

class Order {
	
	private $_customer;

	public function __construct($customer) {
		$this->_customer = $customer;
	}

	public function getCustomerName() {
		return $this->_customer->getName();
	}

	public function setCustomerName($val) {
		$this->_customer->setName($val);
	}
}

class Customer {
	private $_name;

	private function __construct($name) {
		$this->_name = $name;
	}

	public function getName() {
		return $this->_name;
	}

	public function setName($val) {
		$this->_name = $val;
	}

	public static function create($name) {
		return new self($name);
	}
}

class Customers {
	private $customers = array();
	private static $instance;

	private function __construct() {
		if (!empty($customers)) {
			throw new Exception("Customers has already been instantiated");
		}	
	}

	public static function get() {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function addCustomer($customerName) {
		if (!array_key_exists($customerName, $this->customers)) {
			$this->customers[$customerName] = Customer::create($customerName);
		}
	}

	public function getCustomer($customerName) {
		if (array_key_exists($customerName, $this->customers)) {
			return $this->customers[$customerName];
		} else {
			throw new Exception("$customerName not found");
		}
	}

}

/**
 * This is "client" code, but stuck inside Order for convenience.
 *
 * @param array $orders - an array of Order objects
 * @param string $customer
 */
function numberOfOrdersFor(array $orders, $customer) {
	$result = 0;
	foreach ($orders as $order) {
		if ($order->getCustomerName() == $customer) {
			$result++;
		}
	}
	return $result;
}

echo "Start test...\n";

	Customers::get()->addCustomer("charles");
	Customers::get()->addCustomer("diana");

	$orders = array(
		$charles = new Order(Customers::get()->getCustomer("charles")),
		$diana   = new Order(Customers::get()->getCustomer("diana"))
	);

	assert(numberOfOrdersFor($orders, "diana") == 1);
	Customers::get()->getCustomer("diana")->setName("camilla");

	assert(numberOfOrdersFor($orders, "diana") == 0);
	assert(numberOfOrdersFor($orders, "camilla") == 1);

	foreach ($orders as $order) {
		assert("diana" !== $order->getCustomerName());
	}

echo "... done\n";
print_r(uniqid() . "\n");