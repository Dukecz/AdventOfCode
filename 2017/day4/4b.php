<?php

$input = fopen('php://stdin', 'rb');
$sum = 0;

$string = "abcde xyz ecdabr";

while(!empty(trim($line = fgets($input)))) {
    $line = trim($line);
    $line = explode(" ", $line);
	$lineArray = array();
	$sum++;
	foreach ($line as $word) {
		if (in_array(array_count_values(str_split($word)), $lineArray)) {
			$sum--;
			break;
		}
		$lineArray[] = array_count_values(str_split($word));
	}
}

echo $sum . "\n";
