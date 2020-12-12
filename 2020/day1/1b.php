<?php

$input = fopen('php://stdin', 'rb');

$data = [];

while(!empty(trim($line = fgets($input)))) {
	$data[] = (int) trim($line);
}

sort($data);

$result = 0;
$dataCount = count($data);

for ($i = 0; $i < $dataCount - 2; ++$i) {
	for($j = $i + 1; $j < $dataCount - 1; ++$j) {
		for($k = $j + 1; $k < $dataCount; ++$k) {
			if ($data[$i] + $data[$j] + $data[$k] === 2020) {
				echo sprintf('Day 1 Part Two result: %d * %d * %d = %d' . PHP_EOL, $data[$i], $data[$j], $data[$k], $data[$i] * $data[$j] * $data[$k]);
			}
		}
	}
}
