<?php

interface Buildable {
	/** 
	 *	Can't define __construct() in interfaces as protected, 
	 *	so can't force all Buildables to have it protected
	 *	
	 *	protected function __construct();
	 */
	public static function builder();
}

interface Builder {
	public function build();
}

class User implements Buildable {
	private $id;
	private $name;

	/** 
	 *	Can't define __construct() in interfaces as protected, 
	 *	so can't force all Buildables to have it protected - must be by convention!
	 */
	protected function __construct() {}

	public function setName($val) {
		$this->name = $val;
	}
	public function setId($val) {
		$this->id = $val;
	}
	
	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}

	public static function builder() {
		return new UserBuilder(new self());
	}
}

class UserBuilder implements Builder {
	private $user;
	public function __construct(Buildable $user) {
		$this->user = $user;
	}

	public function name($val) {
		$this->user->setName($val);
		return $this;
	}
	public function id($val) {
		$this->user->setId($val);
		return $this;
	}

	public function build() {
		$user = clone $this->user;
		$this->user = null;
		return $user;
	}
}

// test

define("NAME", "alfred");
define("ID", 101);
$user = User::builder()
			->name(NAME)
			->id(ID)
			->build();
assert(NAME == $user->getName());
assert(ID == $user->getId());