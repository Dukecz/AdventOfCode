<?php
set_time_limit(300);
$number = 0;
$input = "iwrupvqb";
$result;
$temp = "";

do {
	$temp = $input . $number;
	$result = md5($temp);
	$number++;
} while (strpos($result, "000000") !== 0);

echo $temp . " " . $result;