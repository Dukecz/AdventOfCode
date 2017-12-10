<?php

$input = fopen('php://stdin', 'rb');
$steps = 0;

$registers = array();

while(trim($line = fgets($input)) !== '') {
	$proceed = false;
	$line = trim($line);
	list($registerName, $command, $changeValue, $if, $ifRegister, $ifOperator, $ifValue) = explode(' ', $line);
	$registerValue = isset($registers[$ifRegister]) ? $registers[$ifRegister] : 0;

	switch ($ifOperator) {
		case '>':
			$proceed = $registerValue > $ifValue;
			break;
		case '>=':
			$proceed = $registerValue >= $ifValue;
			break;
		case '<':
			$proceed = $registerValue < $ifValue;
			break;
		case '<=':
			$proceed = $registerValue <= $ifValue;
			break;
		case '==':
			$proceed = $registerValue == $ifValue;
			break;
		case '!=':
			$proceed = $registerValue != $ifValue;
			break;
		default:
	}

	if ($proceed) {
		$registerValue = isset($registers[$registerName]) ? $registers[$registerName] : 0;
		switch ($command) {
			case 'inc':
				$registers[$registerName] = $registerValue + $changeValue;
				break;
			case 'dec':
				$registers[$registerName] = $registerValue - $changeValue;
				break;
			default:
		}
	}
}

$max = PHP_INT_MIN;
foreach ($registers as $register) {
	if ($register > $max) $max = $register;
}

echo $max . "\n";
