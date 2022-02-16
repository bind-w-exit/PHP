<?php
    require_once './config.php';
    class Database{
        private $servername;
        private $username;
        private $password;
        private $database;
        public function __construct($servername, $username, $password, $database) {
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
        public function fetch_all_from_db(){
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT `data`.id, `operations`.name, `data`.inputdata, `data`.outputdata FROM data INNER JOIN operations ON `operations`.id=`data`.operationid ORDER BY `data`.id;";
            $result = $conn->query($sql);
            $data_array=array();
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    array_push($data_array,$row);
                }
            } else{echo "Empty";}
            $conn->close();
            return $data_array;
        }
        public function fetch_operation_types_from_db(){
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT id, name FROM operations;";
            $result = $conn->query($sql);
            $data_array=array();
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    array_push($data_array,$row);
                }
            } else{echo "Empty";}
            $conn->close();
            return $data_array;
        }
        public function add_operation($optype,$opdata,$result){
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO `data` VALUES (DEFAULT, '".$optype."', '".$opdata."', '".$result."');";
            $conn->query($sql);
            $conn->close();
        }
        public function delete_operation($id){
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "DELETE FROM data WHERE id=".$id.";";
            $conn->query($sql);
            $conn->close();
        }
    }
?>