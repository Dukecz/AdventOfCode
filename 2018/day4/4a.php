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
$guardMinutesAsleep = [];
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

			if (!isset($guardMinutesAsleep[$guardId])) {
				$guardMinutesAsleep[$guardId] = $dateTimeTo->diff($dateTimeFrom, true)->i;
			} else {
				$guardMinutesAsleep[$guardId] += $dateTimeTo->diff($dateTimeFrom, true)->i;
			}

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

arsort($guardMinutesAsleep);

foreach ($guardMinutesAsleep as $guardId => $minutesAsleep) {
	$mostSleepyGuardId = $guardId;
	break;
}

arsort($minutesAsleepMap[$mostSleepyGuardId]);

foreach ($minutesAsleepMap[$mostSleepyGuardId] as $minute => $amount) {
	$minuteWithMostSleepForGuard = $minute;
	break;
}

echo sprintf('Day 4 Part One result: %d' . PHP_EOL, $mostSleepyGuardId * $minuteWithMostSleepForGuard);
