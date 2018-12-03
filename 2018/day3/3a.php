<?php

$input = fopen('php://stdin', 'rb');

$map = [];
$matches = [];

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);

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

$overlapCount = 0;

foreach ($map as $x => $row) {
	foreach ($row as $y => $value) {
		if (isset($map[$x][$y]) && $map[$x][$y] > 1) {
			$overlapCount++;
		}
	}
}

echo sprintf('Day 3 Part One result: %d' . PHP_EOL, $overlapCount);
