<?php

$input = $argv[1];

$array = str_split($input);
$sum = 0;

for ($i = 0; $i < count($array) / 2; $i++) {
	if ($array[$i] == $array[$i + count($array) / 2]) {
		$sum += $array[$i + count($array) / 2];
	}
}

echo $sum * 2;
