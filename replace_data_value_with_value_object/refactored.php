<?php

// Convert $_customer to a Customer object with attribute name.

class Order {
	
	private $_customer;

	public function __construct($customerName) {
		$this->_customer = new Customer($customerName);
	}

	public function getCustomerName() {
		return $this->_customer->getName();
	}

	public function setCustomer($val) {
		$this->_customer = new Customer($val);
	}

	/**
	 * This is "client" code, but stuck inside Order for convenience.
	 *
	 * @param array $orders - an array of Order objects
	 * @param string $customer
	 */
	public static function numberOfOrdersFor(array $orders, $customer) {
		$result = 0;
		foreach ($orders as $order) {
			if ($order->getCustomerName() == $customer) {
				$result++;
			}
		}
		return $result;
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

$orders = array(
	new Order("charles"),
	new Order("diana")
	);


echo "Start test...\n";
	assert(Order::numberOfOrdersFor($orders, "diana") == 1);
	assert(Order::numberOfOrdersFor($orders, "charles") == 1);
	assert(Order::numberOfOrdersFor($orders, "camilla") == 0);
echo "... done\n";