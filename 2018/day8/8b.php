<?php

// real is too long for stdin
$input = '2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2';

$input = explode(' ', $input);
$input = array_map(function($value) {return (int) $value;}, $input);

function getMetadata(&$input)
{
	$children = array_shift($input);
	$numberOfMetadata = array_shift($input);
	$sum = 0;
	$childrenValues = [];

	for ($i = 1; $i <= $children; ++$i) {
		$childrenValues[$i] = getMetadata($input);
	}

	for ($i = 1; $i <= $numberOfMetadata; ++$i) {
		$metadata = array_shift($input);
		if ($children === 0) {
			$sum += $metadata;
		} else {
			$sum += isset($childrenValues[$metadata]) ? $childrenValues[$metadata] : 0;
		}
	}

	return $sum;
}

echo sprintf('Day 8 Part Two result: %d' . PHP_EOL, getMetadata($input));
