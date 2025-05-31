<?php
    session_start();
    if($_SESSION['accountType'] != "admin"){
        header("location: home.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compawnion - Verify Your Account</title>
    <link rel="shortcut icon" type="image/jpg" href="../images/com/logo_ldpi.png"/>
    <link rel="stylesheet" href="../styles/page-styles/accounts.css">
    <link rel="stylesheet" href="../styles/page-styles/verify-email.css">
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body>
    <a class="btnlink" id="gohomebtn" href="dashboard.php">Go Back to Home</a>
    <br><br><br><br><br>


    <?php

        include("../db_info.php");
        $users = array();

        $dsn = "mysql:host=$host;dbname=$db_name";

        $pdo = new PDO($dsn, $user, $password);

        $qry = $pdo->query("CREATE DATABASE if not exists $db_name");

        // $post_query = $pdo->query("SELECT * FROM users_tb
        // WHERE NOT username = '".$_SESSION['username']."'
        // ORDER BY username ASC;");

        $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "viewed  the registered accounts", NOW())';
        $pdo->query($pdoQuery);


        $post_query = $pdo->query("SELECT * FROM users_tb
        ORDER BY accountType ASC, username ASC;");

        while($row = $post_query->fetch(PDO::FETCH_ASSOC)){
            array_push($users, $row);
            extract($row);

            ?>
                <div class="card-static">
                    <p><?php echo "Username: ".$row['username']." <br>Name: ".$row['fullname']." <br>(".$row['accountType'].")" ?></p>
                    <a href="account-edit.php?id=<?php echo $id ?>">More</a>
                </div>
                <br>



            <?php


            // echo $row['username'];

        }
        




    ?>



<?php include_once("../components/toast.php") ?>
    
    <script src="../js/forgot.js"></script>      
</body>
</html>