<?php

$input = fopen('php://stdin', 'rb');
$matches = [];

$rules = [];
$stepsBefore = [];
$stepsAfter = [];
$resultString = '';

while(!empty($line = trim(fgets($input)))) {
	preg_match('/Step ([A-Z]) must be finished before step ([A-Z]) can begin\./', $line, $matches);
	list(, $stepBefore, $stepAfter) = $matches;
	$rules[$stepBefore][] = $stepAfter;
	$stepsBefore[$stepBefore] = true;
	$stepsAfter[$stepAfter] = true;
}

$availableSteps = array_keys(array_diff_key($stepsBefore, $stepsAfter));

while (!empty($availableSteps)) {
	$usableSteps = $availableSteps;

	foreach ($rules as $prerequizities) {
		$usableSteps = array_diff($usableSteps, $prerequizities); // check that only steps without prerequizities can be next
	}

	sort($usableSteps);

	$nextStep = array_shift($usableSteps);
	if (!empty($rules[$nextStep])) {
		foreach ($rules[$nextStep] as $newAvailableStep) {
			$availableSteps[] = $newAvailableStep;
		}
	}
	$resultString .= $nextStep;
	$availableSteps = array_unique($availableSteps);
	unset($availableSteps[array_search($nextStep, $availableSteps)]); // used step is no longer available
	unset($rules[$nextStep]); // no need for the rule anymore
}

echo sprintf('Day 7 Part One result: %s' . PHP_EOL, $resultString);
