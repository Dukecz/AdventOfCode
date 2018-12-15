<?php

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

$infiniteGrids = [];
$gridSizes = [];

foreach (range(0, count($coordinates) - 1) as $id) {
	$gridSizes[$id] = 0;
	$infiniteGrids[$id] = false;
}

foreach (range($gridFirstX, $gridWidth) as $x) {
	foreach (range($gridFirstY, $gridHeight) as $y) {
		$distance = null;
		$closestCoordinate = null;
		foreach ($coordinates as $id => $coordinate) {
			if ($distance === null || $distance > getManhattanDistance($x, $y, $coordinate['x'], $coordinate['y'])) {
				$distance = getManhattanDistance($x, $y, $coordinate['x'], $coordinate['y']);
				$closestCoordinate = $id;
			}
		}

		if ($x === 0 || $y === 0 || $x === $gridWidth || $y === $gridHeight) {
			$infiniteGrids[$closestCoordinate] = true;
		}
		++$gridSizes[$closestCoordinate];
	}
}

foreach ($infiniteGrids as $id => $value) {
	if ($value) {
		unset($gridSizes[$id]);
	}
}

echo sprintf('Day 6 Part One result: %d' . PHP_EOL, max($gridSizes));
