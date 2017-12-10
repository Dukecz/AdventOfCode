<?php

$input = '';

$input = str_split($input);

$garbage = false;
$ignoreNext = false;

$depth = 0;
$score = 0;

foreach ($input as $character) {
	if ($ignoreNext) {
		$ignoreNext = false;
	} else if ($character === '!') {
		$ignoreNext = true;
	} else if (!$garbage && $character === '<') {
		$garbage = true;
	} else if (!$garbage && $character === '{') {
		$score += ++$depth;
	} else if (!$garbage && $character === '}') {
		--$depth;
	} else if ($garbage && $character === '>') {
		$garbage = false;
	}
}

echo $score . "\n";
