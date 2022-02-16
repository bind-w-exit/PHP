<!DOCTYPE html>
<html>
<body>

<?php

abstract class Operation {

	protected $array;

  public function __construct($array) {
    $this->array = $array;
  }

  public function set_array($array){
    $this->array = $array;
  }

  public function get_array($array){
    return $this->array;
  }

  abstract public function calc($itIsRow, $rowOrColumnNumber);
}

class MatrixSum extends Operation {
	public function calc($itIsRow, $rowOrColumnNumber){
    $sum = 0;

    if($itIsRow)
      foreach ($this->array[$rowOrColumnNumber] as $a)
        $sum += $a;   
    else
      foreach ($this->array as $a)
        $sum += $a[$rowOrColumnNumber];

    return $sum;
  }
}

class MatrixAvg extends Operation {
  public function calc($itIsRow, $rowOrColumnNumber){
    $sum = 0;
    $i = 0;
    if($itIsRow)
      foreach ($this->array[$rowOrColumnNumber] as $a){
        $sum += $a;
        $i++;  
      }   
    else
      foreach ($this->array as $a){
        $sum += $a[$rowOrColumnNumber];
        $i++;
      }     
    return $sum/$i;
  }
}

$inputfile = fopen("input.txt", "r") or die("Unable to open file!");
$outputfile = fopen("output.txt", "w") or die("Unable to open file!");

while(!feof($inputfile)){
  $fileline=fgets($inputfile);
  $paramArray=explode("; ", $fileline);

  echo '<pre>';
  print_r($paramArray);
  echo '</pre>';
  echo "<br>";

  $dataArray = json_decode($paramArray[3], true);

  if($paramArray[0] == 'sum'){
    $matrix = new MatrixSum($dataArray["matrix"]);
  } else if($paramArray[0]=='avg'){
    $matrix = new MatrixAvg($dataArray["matrix"]);
  }

  fwrite($outputfile, "Mean of operation with array equals to ".$matrix->calc(($paramArray[1] == 'row'), $paramArray[2]));
  fwrite($outputfile,"\n");

}

fclose($inputfile);
fclose($outputfile);

?>

</body>
</html>