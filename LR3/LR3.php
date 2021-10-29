<!DOCTYPE html>
<html>
<body>

<?php

//first task
$a = 2.703;
$b = 12.385;
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

//second task
$a = 1.85;
$b = 6.21;
$g = 22;
$end = 3.1;
$steps = 8;

$step = ($end - $g) / $steps;

for($i = 0; $i <= $steps; $i++){
	$t=$a * $b * (1 - sin($g + 5)) + sqrt($b) / pow(cos($g), 2);
    echo $t."</br>";
	$g+=$step;
}
?>

</body>
</html>
