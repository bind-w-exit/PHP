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
$dbconn = pg_connect("host=localhost dbname=phplab user=postgres password=*****")
    or die('Could not connect: ' . pg_last_error());


$query = 'SELECT * FROM operations';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$operation_options="";
if (pg_num_rows($result) > 0) {
    while($row = pg_fetch_assoc($result)) {
        $operation_options.="<option value='".$row['id']."'>".$row['name']."</option>";
    }
}


if(isset($_GET['deletedata'])){
    $query = "DELETE FROM data WHERE id=".$_GET['deletedata'];
    pg_query($query);
}


if(isset($_POST['opdata'])){
    $data = json_decode($_POST['opdata'], true);
    
    if($_POST['optype'] == 1){
        $matrix = new MatrixSum($data["matrix"]);
    } else if($_POST['optype'] == 2){
        $matrix = new MatrixAvg($data["matrix"]);
    }

    $query = "INSERT INTO data VALUES (DEFAULT, " . $_POST['optype'] . ", '" .$_POST['opdata'] . "', " . $matrix->calc(($data["isRow"] == 'row'), $data["number"]) . ")";
    pg_query($query);
}


$query = "SELECT * FROM data INNER JOIN operations ON operations.id=data.optype;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$table_body="";
if (pg_num_rows($result) > 0) {
    while($row = pg_fetch_assoc($result)) {
        $table_body.="<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['input']."</td><td>".$row['output']."</td><td><a href='lr.php?deletedata=".$row['id']."'>Delete</a></td></tr>";
    }
}


// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);

?>

<html>
    <head>
        <title>LR7</title>
    </head>
    <body>
        <form method="POST" action="LR.php">
            <p>
                <label for="optype">Select operation type:</label>
            </p>
            <p>
                <select name="optype">
                    <?php echo $operation_options; ?>
                </select>
            </p>
            <p>
                <label for="opdata">Enter JSON like {"isRow": true, "number": 2, "matrix" : [[12, 15, 15], [21, 15, 15], [30, 15, 15]]} :</label>
            </p>
            <p>
                <input type="text" name="opdata" required>
            </p>
            <p>
                <input type="submit" value="Send data">
            </p>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operation</th>
                    <th>Input</th>
                    <th>Output</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table_body; ?>
            </tbody>
        </table>
    </body>
</html>