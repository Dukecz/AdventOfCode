<?php

$line = 'dabAcCaCBAcCcaDA'; // input was too long for stdin

$resultingLines = [];
$line = str_split($line);

do {
	$changed = false;
	for ($i = 1; $i < count($line); ++$i) {
		if (!isset($line[$i - 1])) continue;
		if (abs(ord($line[$i]) - ord($line[$i - 1])) === 32) {
			unset($line[$i]);
			unset($line[$i - 1]);
			$changed = true;
		}
	}
	$line = array_values($line);
} while ($changed);

$originalLine = implode('', $line);

foreach (range('a', 'z') as $removedLetter) {
	$line = str_split(str_replace([$removedLetter, strtoupper($removedLetter)], '', $originalLine));
	do {
		$changed = false;
		for ($i = 1; $i < count($line); ++$i) {
			if (!isset($line[$i - 1])) continue;
			if (abs(ord($line[$i]) - ord($line[$i - 1])) === 32) {
				unset($line[$i]);
				unset($line[$i - 1]);
				$changed = true;
			}
		}
		$line = array_values($line);
		$resultingLines[$removedLetter] = count($line);
	} while ($changed);
}

echo sprintf('Day 5 Part Two result: %d' . PHP_EOL, min($resultingLines));
