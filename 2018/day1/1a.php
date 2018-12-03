<?php

$input = fopen('php://stdin', 'rb');
$sum = 0;

while(!empty(trim($line = fgets($input)))) {
	$value = (int) trim($line);
	$sum += $value;
}

echo sprintf('Day 1 Part One result: %d' . PHP_EOL, $sum);
