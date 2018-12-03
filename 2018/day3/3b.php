<?php

$input = fopen('php://stdin', 'rb');

$map = [];
$matches = [];
$inputLines = [];

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);
	$inputLines[] = $line;

	preg_match('/#([0-9]+) @ ([0-9]+),([0-9]+): ([0-9]+)x([0-9]+)/', $line, $matches);
	list(, $id, $leftOffset, $topOffset, $xSize, $ySize) = $matches;

	for($x = $leftOffset; $x < $leftOffset + $xSize; ++$x) {
		for($y = $topOffset; $y < $topOffset + $ySize; ++$y) {
			if (!isset($map[$x][$y])) {
				$map[$x][$y] = 1;
			} else {
				++$map[$x][$y];
			}
		}
	}
}

foreach ($inputLines as $line) {
	preg_match('/#([0-9]+) @ ([0-9]+),([0-9]+): ([0-9]+)x([0-9]+)/', $line, $matches);
	list(, $id, $leftOffset, $topOffset, $xSize, $ySize) = $matches;

	$conflicted = false;
	for($x = $leftOffset; $x < $leftOffset + $xSize; ++$x) {
		for($y = $topOffset; $y < $topOffset + $ySize; ++$y) {
			if ($map[$x][$y] !== 1) {
				$conflicted = true;
				break 2;
			}
		}
	}

	if (!$conflicted) {
		echo sprintf('Day 3 Part Two result: %d' . PHP_EOL, $id);
		break;
	}
}
