<?php

$input = fopen('php://stdin', 'rb');

$inputData = [];
$matches = [];

while(!empty(trim($line = fgets($input)))) {
	$line = trim($line);

	preg_match('/\[([0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9] [0-9][0-9]:[0-9][0-9])\] (.*)/', $line, $matches);
	list(, $dateTime, $event) = $matches;
	$inputData[$dateTime] = $event;
}

ksort($inputData);

$guardId = 0;
$dateTimeFrom = null;
$minutesAsleepMap = [];

foreach ($inputData as $dateTime => $event) {
	switch ($event) {
		case 'falls asleep':
			$dateTimeFrom = new DateTime($dateTime);
			break;
		case 'wakes up':
			$dateTimeTo = new DateTime($dateTime);
			$dateTimeTo->sub(new DateInterval('PT1M'));
			$diff = $dateTimeTo->diff($dateTimeFrom, true);

			for ($i = (int) $dateTimeFrom->format('i'); $i <= (int) $dateTimeTo->format('i'); ++$i) {
				if (!isset($minutesAsleepMap[$guardId][$i])) {
					$minutesAsleepMap[$guardId][$i] = 1;
				} else {
					++$minutesAsleepMap[$guardId][$i];
				}
			}

			break;
		default:
			preg_match('/Guard #([0-9]+) begins shift/', $event, $matches);
			list(, $guardId) = $matches;
			break;
	}
}

$mostSleepyGuardId = 0;
$minuteWithMostSleepForGuard = 0;
$maxSleptMinute = 0;

foreach ($minutesAsleepMap as $guardId => $minutes) {
	if (max($minutes) > $maxSleptMinute) {
		$maxSleptMinute = max($minutes);
		$mostSleepyGuardId = $guardId;
		$minuteWithMostSleepForGuard = array_keys($minutes, max($minutes));
	}
}

echo sprintf('Day 4 Part Two result: %d' . PHP_EOL, $mostSleepyGuardId * $minuteWithMostSleepForGuard[0]);
