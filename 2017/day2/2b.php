<?php

$input = fopen('php://stdin', 'rb');
$array = array();

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);
	$array[] = explode("\t", $line);
}

$sum = 0;
foreach ($array as $line) {
	for ($i = 0; $i < count($line) - 1; ++$i) {
		for ($j = $i + 1; $j < count($line); ++$j) {
			if (is_int($line[$i] / $line[$j])) {
				$sum += ($line[$i] / $line[$j]);
				break;
			}
			if (is_int($line[$j] / $line[$i])) {
				$sum += ($line[$j] / $line[$i]);
				break;
			}

		}
	}
}

echo $sum;
