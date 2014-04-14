<?php

class ReplaceControlFlagWithBreak {
	public static $foundPerson;

	public static function checkSecurity(array $people) {
		$found = "";
		foreach ($people as $person) {
			if (strlen($found) == 0) {
				if ($person == "Don") {
					self::storeViolator($person);
					$found = $person;
				}
				if ($person	== "Juan") {
					self::storeViolator($person);
					$found = $person;
				}
			} 
		}
		self::displayViolator($found);
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
	assert(null == ReplaceControlFlagWithBreak::$foundPerson);
	$people[] = "Don";
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert("Don" == ReplaceControlFlagWithBreak::$foundPerson);

	// test reveals very fragile code, why?
	$people[] = "Juan";
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert("Don" == ReplaceControlFlagWithBreak::$foundPerson);
echo "... done\n";