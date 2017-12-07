<?php

$input = "";

$input = explode("\t", $input);

$seen = [];
$steps = 0;

while(!in_array($input, $seen)) {
	$seen[] = $input;
	$max = 0;
	$location = 0;
	foreach($input as $key => $bank) {
		if ($bank > $max) {
			$max = $bank;
			$location = $key;
		}
	}
	
	$input[$location] = 0;
	$location++;
	$i = 0;
	while ($max > 0) {
		$key = ($i + $location) % (count($input));
		$input[$key]++;
		--$max;
		++$location;
	}
	$steps++;
}

echo $steps . "\n";
echo count($seen) - array_search($input, $seen) . "\n";
