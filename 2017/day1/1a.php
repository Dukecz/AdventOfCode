<?php

$input = $argv[1];

$array = str_split($input);
$sum = 0;

for ($i = 0; $i < count($array) - 1; $i++) {
	if ($array[$i] == $array[$i + 1]) {
		$sum += $array[$i];
	}
}

if ($array[0] == $array[count($array) - 1]) $sum += $array[count($array) - 1];


echo $sum;
