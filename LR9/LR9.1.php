<?php

    session_start();

    if(isset($_SESSION['username']))
        echo "logged in as ". $_SESSION['username'];
    else
        echo "not logged in";

    if(isset($_POST['login'])) {
        $servername = "localhost";
        $username = "postgres";
        $password = "*******";
        $database = "phplab";

        // Create connection
        $dbconn = pg_connect("host=$servername dbname=$database user=$username password=$password")
            or die('Could not connect: ' . pg_last_error());

         //create options for select
        $query = "SELECT * FROM users WHERE username='".$_POST['login']."' AND password='".md5($_POST['password'])."'";
        $result = pg_query($query);
        $row_cnt = pg_num_rows($result);
        if($row_cnt>0){
            while($row = pg_fetch_assoc($result)) {
                echo "logged in as ". $row['username'];
                $_SESSION['username']=$row['username'];
                header("Location: LR2.php");
            }
        } else
            echo "wrong login or password";
    }   
?>
<html>
    <head>
        <title>Login form</title>
    </head>
    <body>
        <form method="POST">
            <input type="text" placeholder="login" name="login" required/></br>
            <input type="password" placeholder="password" name="password" required/></br>
            <input type="submit" value="Login"/>
        </form>
    </body>
</html>