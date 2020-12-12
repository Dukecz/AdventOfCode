<?php

$input = fopen('php://stdin', 'rb');

$correctPasswords = 0;

while(!empty(trim($line = fgets($input)))) {
	$matches = [];
	preg_match('/([\d]+)-([\d]+) ([a-z]): (.+)/', trim($line), $matches);

	[, $min, $max, $letter, $password] = $matches;

	$count = substr_count($password, $letter);
	if ($count >= $min && $count <= $max) {
		++$correctPasswords;
	}
}

echo sprintf('Result: %d' . PHP_EOL, $correctPasswords);
