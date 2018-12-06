<?php

const MAX_DISTANCE = 10000;

/**
 * @param int $fromX
 * @param int $fromY
 * @param int $toX
 * @param int $toY
 *
 * @return int
 */
function getManhattanDistance($fromX, $fromY, $toX, $toY)
{
	return abs($fromX - $toX) + abs($fromY - $toY);
}

$input = fopen('php://stdin', 'rb');
$coordinates = [];

$gridWidth = 0;
$gridHeight = 0;
$gridFirstX = null;
$gridFirstY = null;

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);
	list($x, $y) = explode(', ', $line);
	$x = (int) $x;
	$y = (int) $y;

	$coordinates[] = ['x' => $x, 'y' => $y];

	if ($x > $gridWidth) {
		$gridWidth = $x;
	}

	if ($gridFirstX === null || $gridFirstX > $x) {
		$gridFirstX = $x;
	}

	if ($y > $gridHeight) {
		$gridHeight = $y;
	}

	if ($gridFirstY === null || $gridFirstY > $y) {
		$gridFirstY = $y;
	}
}

$gridSize = 0;

foreach (range($gridFirstX, $gridWidth) as $x) {
	foreach (range($gridFirstY, $gridHeight) as $y) {
		$distance = 0;
		foreach ($coordinates as $id => $coordinate) {
			$distance += getManhattanDistance($x, $y, $coordinate['x'], $coordinate['y']);
			if ($distance >= MAX_DISTANCE) {
				break;
			}
		}

		if ($distance < MAX_DISTANCE) {
			++$gridSize;
		}
	}
}

echo sprintf('Day 6 Part Two result: %d' . PHP_EOL, $gridSize);
