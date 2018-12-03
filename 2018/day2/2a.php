<?php

$input = fopen('php://stdin', 'rb');

$repeatCounter = [
	2 => 0,
	3 => 0,
];

while(!empty(trim($line = fgets($input)))) {
	$boxId = str_split(trim($line));

	$lettersCounter = [];
	foreach ($boxId as $letter) {
		if (isset($lettersCounter[$letter])) {
			++$lettersCounter[$letter];
		} else {
			$lettersCounter[$letter] = 1;
		}
	}

	$repeatedTwice = false;
	$repeatedThrice = false;
	foreach ($lettersCounter as $letter => $letterCount) {
		if ($repeatedTwice && $repeatedThrice) break;

		switch ($letterCount) {
			case 2:
				$repeatedTwice = true;
				continue;
			case 3:
				$repeatedThrice = true;
				continue;
			default:
				continue;
		}
	}

	if ($repeatedTwice) ++$repeatCounter[2];
	if ($repeatedThrice) ++$repeatCounter[3];
}

echo sprintf('Day 2 Part One result: %d' . PHP_EOL, $repeatCounter[2] * $repeatCounter[3]);
