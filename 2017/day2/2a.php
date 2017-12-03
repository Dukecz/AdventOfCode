<?php

$input = fopen('php://stdin', 'rb');
$array = array();

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);
	$array[] = explode("\t", $line);
}

$sum = 0;
foreach ($array as $line) {
	$min = PHP_INT_MAX;
	$max = 0;
	foreach ($line as $number) {
		if ($number < $min) $min = $number;
		if ($number > $max) $max = $number;
	}
	$sum += ($max - $min);
}

echo $sum;
