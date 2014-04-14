<?php

class ReplaceControlFlagWithBreak {
	public static $foundPerson;

	public static function checkSecurity(array $people) {
		foreach ($people as $person) {
			if ($person == "Don") {
				self::sendAlert($person);
				break;
			}
			if ($person	== "Juan") {
				self::sendAlert($person);
				break;
			}
		}
	}

	private static function sendAlert($person) {
		self::$foundPerson = $person;
		echo "Found $person. \n";
	}

}

echo "Start test...\n";
	$people = array("Jon", "Stephen", "Samantha", "Jason");
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert(null == ReplaceControlFlagWithBreak::$foundPerson);
	$people[] = "Don";
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert("Don" == ReplaceControlFlagWithBreak::$foundPerson);
	$people[] = "Juan";
	ReplaceControlFlagWithBreak::checkSecurity($people);
	assert("Don" == ReplaceControlFlagWithBreak::$foundPerson);
echo "... done\n";