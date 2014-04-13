<?php

// Convert $_customer to a reference object so multiple Order can have same Customer object.

class Order {
	
	private $_customer;

	public function __construct($customerName) {
		$this->_customer = new Customer($customerName);
	}

	public function getCustomerName() {
		return $this->_customer->getName();
	}

	public function setCustomerName($val) {
		$this->_customer = new Customer($val);
	}
}

class Customer {
	private $_name;

	public function __construct($name) {
		$this->_name = $name;
	}

	public function getName() {
		return $this->_name;
	}

	public function setName($val) {
		$this->_name = $val;
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

$orders = array(
	$charles = new Order("charles"),
	$diana   = new Order("diana")
);

echo "Start test...\n";
	assert(numberOfOrdersFor($orders, "diana") == 1);
	$diana->setCustomerName("camilla");
	assert(numberOfOrdersFor($orders, "diana") == 0);
	assert(numberOfOrdersFor($orders, "camilla") == 1);
echo "... done\n";