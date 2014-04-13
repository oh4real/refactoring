<?php

// Convert $_customer to a Customer object with attribute name.

class Order {
	
	private $_customer;

	public function __construct($customer) {
		$this->_customer = $customer;
	}

	public function getCustomer() {
		return $this->_customer;
	}

	public function setCustomer($val) {
		$this->_customer = $val;
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
			if ($order->getCustomer() == $customer) {
				$result++;
			}
		}
		return $result;
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