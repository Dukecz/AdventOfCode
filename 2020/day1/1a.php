<?php

$input = fopen('php://stdin', 'rb');

$data = [];

while(!empty(trim($line = fgets($input)))) {
	$data[] = (int) trim($line);
}

sort($data);

$result = 0;
$dataCount = count($data);

for ($i = 0; $i < $dataCount - 1; ++$i) {
	for($j = $i + 1; $j < $dataCount; ++$j) {
		if ($data[$i] + $data[$j] === 2020) {
			echo sprintf('Day 1 Part One result: %d * %d = %d' . PHP_EOL, $data[$i], $data[$j], $data[$i] * $data[$j]);
		}
	}
}
