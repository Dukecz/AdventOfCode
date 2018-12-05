<?php

$line = 'dabAcCaCBAcCcaDA'; // input was too long for stdin

$line = str_split($line);

do {
	$changed = false;
	for ($i = 1; $i < count($line); ++$i) {
		if (!isset($line[$i - 1])) continue;
		if (abs(ord($line[$i]) - ord($line[$i - 1])) === 32) {
//			echo count($line) . PHP_EOL;
			unset($line[$i]);
			unset($line[$i - 1]);
			$changed = true;
		}
	}
	$line = array_values($line);
} while ($changed);

echo sprintf('Day 5 Part One result: %d' . PHP_EOL, count($line));
