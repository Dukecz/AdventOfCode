<?php

$input = fopen('php://stdin', 'rb');

$inputData = [];
$resultFound = '';

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);

	if (!empty($resultFound)) continue; // to avoid exiting before all input has been processed

	if (empty($inputData)) {
		$inputData[] = $line;
		continue;
	}

	foreach ($inputData as $record) {
		if (levenshtein($line, $record) === 1) {

			$line = str_split($line);
			$record = str_split($record);

			$resultFound = implode(array_intersect_assoc($line, $record));
			break;
		}
	}

	$inputData[] = $line;
}

echo sprintf('Day 2 Part Two result: %s' . PHP_EOL, $resultFound);
