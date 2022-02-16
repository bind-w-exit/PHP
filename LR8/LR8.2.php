<?php
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost/lr/LR.php");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        curl_close($ch);
        $data_object=json_decode($output);

        $table_body="";
        for($i=0;$i<count($data_object);$i++){
        	$table_body.="<tr><td>".$data_object[$i]->id."</td><td>".$data_object[$i]->name."</td><td>".serialize($data_object[$i]->input)."</td><td>".$data_object[$i]->output."</td></tr>";
        }
?>
<html>
    <head>
        <title>LR8</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operation</th>
                    <th>Input</th>
                    <th>Output</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table_body; ?>
            </tbody>
        </table>
    </body>
</html>