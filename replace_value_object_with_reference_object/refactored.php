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
	$charles = new Order(new Customer("charles")),
	$diana   = new Order(new Customer("diana"))
);

echo "Start test...\n";
	assert(1 == numberOfOrdersFor($orders, "diana"));
	$diana->setCustomerName("camilla");
	assert(0 == numberOfOrdersFor($orders, "diana"));
	assert(1 == numberOfOrdersFor($orders, "camilla"));
	foreach ($orders as $order) {
		assert("diana" !== $order->getCustomerName());
	}
echo "... done\n";
print_r(uniqid() . "\n");