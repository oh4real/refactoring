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
	assert(1 == Order::numberOfOrdersFor($orders, "diana"));
	assert(1 == Order::numberOfOrdersFor($orders, "charles"));
	assert(0 == Order::numberOfOrdersFor($orders, "camilla"));
echo "... done\n";