<?php

$input = fopen('php://stdin', 'rb');
$sum = 0;

while(!empty(trim($line = fgets($input)))) {
    $line = trim($line);
    $line = explode(" ", $line);
	if (count(array_unique($line)) === count ($line)) {
		$sum++;
	}
}

echo $sum . "\n";
