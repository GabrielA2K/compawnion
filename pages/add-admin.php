<?php
    session_start();
    if($_SESSION['accountType'] != "admin"){
        header("location: home.php");
    }
    include("../db_info.php");

    $pdoConnect = new PDO("mysql:host=$db_host", $db_username, $db_password);
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdoConnect->query("USE $db_name");
    
    if(isset($_POST['updatebtn'])){
        $pdoConnect->query('INSERT INTO users_tb(username, password, fullname, accountType, isVerified, verifiedAt, hasPfp) VALUES ("'.$_POST['username'].'", "'.$_POST['password'].'", "'.$_POST['displayname'].'", "admin", "true", NOW(), "false")');
        $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "added '.$_POST['username'].' as an admin", NOW())';
        $pdoConnect->query($pdoQuery);


    header("location: accounts.php");

    }
    $pdoQuery = 'SELECT * FROM users_tb';
    $pdoResult = $pdoConnect->query($pdoQuery);
    while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){
        echo '<p class="username-list" style="display: none;">'.$row['username'].'</p>';
        echo '<p class="email-list" style="display: none;">'.$row['email'].'</p>';
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
    <a class="btnlink" id="gohomebtn" href="dashboard.php">Go Back</a>
    <br><br><br><br><br>


    <?php

        include("../db_info.php");
        include("../components/custom-input.php");

        echo "<p class='adminpassvalue' style='display: none;'>".$_SESSION['password']."</p>";
        ?> <form method="post"> <?php
        
            custom_inp("text", "username", "username", "Admin Username", TRUE, 100, "", FALSE);
            custom_inp("text", "displayname", "displayname", "Admin Display Name", TRUE, 100, "", FALSE);
            custom_inpp("password", "password", "password", "Admin Password", TRUE, 100, "", FALSE);
            
            
            ?>
                
            <br>
            <?php custom_input("password", "adminpassword", "adminpassword", "Current Admin Password", FALSE, 100); ?>
            <div class="actions">
            <div class="bbtn" id="updatebtn">Add Admin Account</div>
            <button class="hidden" type="submit" name="updatebtn" id="updatebtn-ac">Update</button>
            </div>
            
        </form>

            <?php


            // echo $row['username'];        



    ?>

<script>
</script>

<?php include_once("../components/toast.php");
custom_input_script(); ?>
    
    <script src="../js/add-admin.js"></script>      
</body>
</html>