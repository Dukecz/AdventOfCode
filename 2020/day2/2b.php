<?php

$input = fopen('php://stdin', 'rb');

$correctPasswords = 0;

while(!empty(trim($line = fgets($input)))) {
	$matches = [];
	preg_match('/([\d]+)-([\d]+) ([a-z]): (.+)/', trim($line), $matches);

	[, $first, $second, $letter, $password] = $matches;

	$passwordLength = mb_strlen($password);
	if ($password[$first - 1] === $letter xor $password[$second - 1] === $letter) {
		++$correctPasswords;
	}
}

echo sprintf('Result: %d' . PHP_EOL, $correctPasswords);
