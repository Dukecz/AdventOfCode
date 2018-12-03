<?php

$input = fopen('php://stdin', 'rb');
$sum = 0;
$frequenciesHit = [];
$firstFrequencyHitTwice = null;
$inputs = [];

while(!empty(trim($line = fgets($input)))) {
	$value = (int) trim($line);
	$inputs[] = $value;
	$sum += $value;

	if (isset($frequenciesHit[$sum])) {
		if ($firstFrequencyHitTwice === null && ++$frequenciesHit[$sum] === 2) {
			$firstFrequencyHitTwice = $sum;
			break;
		}
	} else {
		$frequenciesHit[$sum] = 1;
	}
}

fclose($input);

while($firstFrequencyHitTwice === null) {
	foreach ($inputs as $value) {
		$sum += $value;

		if (isset($frequenciesHit[$sum])) {
			if ($firstFrequencyHitTwice === null && ++$frequenciesHit[$sum] === 2) {
				$firstFrequencyHitTwice = $sum;
				break;
			}
		} else {
			$frequenciesHit[$sum] = 1;
		}
	}
}

echo sprintf('Day 1 Part Two result: %d' . PHP_EOL, $firstFrequencyHitTwice);
