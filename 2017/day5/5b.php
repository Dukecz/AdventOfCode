<?php

$input = fopen('php://stdin', 'rb');
$steps = 0;

$jumpList = array();
$i = 0;

while(trim($line = fgets($input)) !== '') {
    $line = trim($line);
	$jumpList[$i++] = $line;
}

$i = 0;

while($i < count($jumpList)) {
	$offset = $jumpList[$i];
	$jumpList[$i] += $offset >= 3 ? -1 : +1;
	$i += $offset;
	$steps++;
}

echo $steps . "\n";
