<?php
    require_once './models/DatabaseModel.php';
    require_once './models/OperationModel.php';
    require_once './views/HeaderView.php';


    if($_GET['action']=='view_all'){
        $db=new Database($servername, $username, $password, $database);
        $data_array=$db->fetch_all_from_db();
        $table_body="";
        for($i=0;$i<count($data_array);$i++){
            $table_body.="<tr><td>".$data_array[$i]['id']."</td><td>".$data_array[$i]['name']."</td><td>".$data_array[$i]['input']."</td><td>".$data_array[$i]['output']."</td><td><a href='index.php?action=delete_op&op_id=".$data_array[$i]['id']."'>Delete</a></td></tr>";
        }
        require_once './views/TableView.php';
    } else if($_GET['action']=='add_new_op'){
        $db=new Database($servername, $username, $password, $database);
        $data_array=$db->fetch_operation_types_from_db();
        $operation_options="";
        for($i=0;$i<count($data_array);$i++){
            $operation_options.="<option value='".$data_array[$i]['id']."'>".$data_array[$i]['name']."</option>";
        }
        require_once './views/FormView.php';
    } else if(isset($_POST['opdata'])){
        $data_array=explode(" ", $_POST['opdata']);
        $newop=NULL;
        if($_POST['optype'] == 1){
            $newop = new MatrixSum($data["matrix"]);
        } else if($_POST['optype'] == 2){
            $newop = new MatrixAvg($data["matrix"]);
        }
        }
        $db=new Database($servername, $username, $password, $database);
        $db->add_operation($_POST['optype'],$_POST['opdata'],$newop->calc());
        header('Location: index.php?action=view_all');
    } else if($_GET['action']=='delete_op'){
        $db=new Database($servername, $username, $password, $database);
        $db->delete_operation($_GET['op_id']);
        header('Location: index.php?action=view_all');
    }
    else{
        echo 'wrong operation';
    }
?>