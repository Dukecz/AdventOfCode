<?php

// real is too long for stdin
$input = '2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2';

$input = explode(' ', $input);
$input = array_map(function($value) {return (int) $value;}, $input);

function getMetadata(&$input)
{
	$nodes = array_shift($input);
	$numberOfMetadata = array_shift($input);
	$sum = 0;

	for ($i = 1; $i <= $nodes; ++$i) {
		$sum += getMetadata($input);
	}

	for ($i = 1; $i <= $numberOfMetadata; ++$i) {
		$metadata = array_shift($input);
		$sum += $metadata;
	}

	return $sum;
}

echo sprintf('Day 8 Part One result: %d' . PHP_EOL, getMetadata($input));
