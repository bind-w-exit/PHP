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


// Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=phplab user=postgres password=*******")
    or die('Could not connect: ' . pg_last_error());


$query = "SELECT * FROM data INNER JOIN operations ON operations.id = data.optype";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$outputJSON = "";
if (pg_num_rows($result) > 0) {
    while($row = pg_fetch_assoc($result)) {
        $outputJSON .= "{ \"id\" : " . $row['id'] . ", \"name\" : \"" . $row['name'] . "\", \"input\" : " . $row['input'] . ", \"output\" : " . $row['output'] . "},";
    }
}

echo "[";
echo substr($outputJSON, 0, -1);
echo "]";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
?>