<?php

$input = fopen('php://stdin', 'rb');

$treesEncountered = 0;
$coordY = 0;
$gridWidth = null;
$movementRight = 3;

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);

	if ($gridWidth === null) {
		$gridWidth = mb_strlen($line);
	}

	if ($line[$coordY % $gridWidth] === '#') {
		++$treesEncountered;
	}

	$coordY += $movementRight;
}

echo sprintf('Result: %d' . PHP_EOL, $treesEncountered);
