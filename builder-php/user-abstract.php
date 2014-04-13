<?php

abstract class Buildable {
	protected function __construct() {}

	/**
	 *  Could define this non abstract builder() method. 
	 *	Builder doesn't exist so you'd get a runtime error on test and force dev to Override
	 *  
	 *	public static function builder() {
	 *		return new Builder(new static());
	 *	}	
	 *
	 */
	abstract public static function builder();
}

abstract class Builder {
	abstract public function __construct(Buildable $item);
	abstract public function build();
}

class User extends Buildable {
	
	private $id;
	private $name;

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

class UserBuilder extends Builder {
	private $user;
	public function __construct(Buildable $item) {
		$this->user = $item;
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

define("NAME", "alfred");
define("ID", 101);
$user = User::builder()
			->name(NAME)
			->id(ID)
			->build();
assert(NAME == $user->getName());
assert(ID == $user->getId());