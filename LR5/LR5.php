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

$dataArray = [
  [12, 15, 15],
  [21, 15, 15],
  [30, 15, 15]
];

echo '<pre>';
print_r($dataArray);
echo '</pre>';
echo "<br>";

$matrixSum = new MatrixSum($dataArray);
echo 'Row[0] sum = ';
echo $matrixSum->calc(true, 0);
echo "<br>";
echo "<br>";

$matrixSum = new MatrixAvg($dataArray);
echo 'Column[2] avg = ';
echo $matrixSum->calc(false, 2);

?>

</body>
</html>
