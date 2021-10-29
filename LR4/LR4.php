<!DOCTYPE html>
<html>
<body>

<?php

//first task
function task1($a, $b){
	$y = 2.225;
	$f = 0;
	if($y < $a and $y >= 1.5){
		$f = pow($a, $y + 1) + $b * exp($y - 1);
		echo $f."</br></br>";
	}
	if($y > 2 * $a){
		$f = (pow($a, $y + 1) + $b * exp($y - 1)) / sqrt($a * $y);
		echo $f."</br></br>";
	}
}

//second task
function task2($a, $b){
	$g = 22;
	$end = 3.1;
	$steps = 8;

	$step = ($end - $g) / $steps;

	for($i = 0; $i <= $steps; $i++){
		$t=$a * $b * (1 - sin($g + 5)) + sqrt($b) / pow(cos($g), 2);
		echo $t."</br>";
		$g+=$step;
	}
}
echo "Result for task 1 </br>";
task1(2.703, 12.385);
echo "Result for task 2 </br>";
task2(1.85, 6.21);
?>

</body>
</html>
