<?php

class ReplaceControlFlagWithBreak {
	public static $foundPerson;

	public static function checkSecurity(array $people) {
		$found = self::findViolator($people);
		self::displayViolator($found);
	}

	private static function findViolator(array $people) {
		foreach ($people as $person) {
			if ($person == "Don") {
				self::storeViolator($person);
				return $person;
			}
			if ($person	== "Juan") {
				self::storeViolator($person);
				return $person;
			}
		}
	}

	private static function displayViolator($person) {
		if (strlen($person) > 0) {
			echo "Found violator: $person. \n";
		}
	}

	private static function storeViolator($person) {
		self::$foundPerson = $person;
	}

}


echo "Start test...\n";
	$people = array("Jon", "Stephen", "Samantha", "Jason");
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert(ReplaceControlFlagWithBreak::$foundPerson == null);
	$people[] = "Don";
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert(ReplaceControlFlagWithBreak::$foundPerson == "Don");

	// test reveals very fragile code, why?
	// test would fail if: array_unshift($people, "Juan");
	$people[] = "Juan";
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert(ReplaceControlFlagWithBreak::$foundPerson == "Don");
echo "... done\n";