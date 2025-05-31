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
        $pdoConnect->query('UPDATE users_tb
    SET fullname = "'.$_POST['displayname'].'", password = "'.$_POST['password'].'" WHERE username = "'.$_POST['username'].'"');
    
    $pdoQuery = "SELECT * FROM users_tb WHERE username = '".$_SESSION["username"]."'";
                    $pdoRes = $pdoConnect->query($pdoQuery);
                    while($row = $pdoRes->fetch(PDO::FETCH_ASSOC)){
                        $_SESSION["accountType"] = $row["accountType"];
                        $_SESSION["isVerified"] = $row["isVerified"];
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["hasPfp"] = $row["hasPfp"];
                        $_SESSION["fullname"] = $row["fullname"];
                        $_SESSION["password"] = $row["password"];
                    }

                    $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "updated info of '.$_POST['username'].'", NOW())';
                    $pdoConnect->query($pdoQuery);
    header("location: accounts.php");

    } elseif(isset($_POST['delbtn'])){
        $pdoConnect->query('DELETE FROM users_tb
        WHERE username = "'.$_POST['username'].'"');

        $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "deleted '.$_POST['username'].'\'s account", NOW())';
        $pdoConnect->query($pdoQuery);
    header("location: accounts.php");
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
    <a class="btnlink" id="gohomebtn" href="accounts.php">Go Back</a>
    <br><br><br><br><br>


    <?php

        include("../db_info.php");
        include("../components/custom-input.php");
        $users = array();

        $dsn = "mysql:host=$host;dbname=$db_name";

        $pdo = new PDO($dsn, $user, $password);

        $qry = $pdo->query("CREATE DATABASE if not exists $db_name");

        $post_query = $pdo->query("SELECT * FROM users_tb
        WHERE id = ".$_GET['id']."
        ORDER BY username ASC;");

        echo "<p class='adminpassvalue' style='display: none;'>".$_SESSION['password']."</p>";
        ?> <form method="post"> <?php
        while($row = $post_query->fetch(PDO::FETCH_ASSOC)){
            array_push($users, $row);
            extract($row);
            custom_inp("text", "username", "username", "*Username*", FALSE, 100, $username, TRUE);
            custom_inp("text", "displayname", "displayname", "Display Name", FALSE, 100, $fullname, FALSE);
            custom_inpp("password", "password", "password", "Password", FALSE, 100, $password, FALSE);
            
            
            ?>
                
            <br>
            <?php custom_input("password", "adminpassword", "adminpassword", "Admin Password", FALSE, 100); ?>
            <div class="actions">
            <div class="bbtn" id="updatebtn">Update</div>
            <button class="hidden" type="submit" name="updatebtn" id="updatebtn-ac">Update</button>
            
            <?php 
                if($_SESSION['username'] != $row['username']){ ?>
                    <div class="bbtn" id="delbtn">Delete</div>
                    <button class="hidden" type="submit" name="delbtn" id="delbtn-ac">Delete</button>

                    <?php
                } else { ?>
                    <div class="hidden" id="delbtn">Delete</div>
                    <button class="hidden" type="submit" name="delbtn" id="delbtn-ac">Delete</button>
                    <?php
                }
            
            ?>
            </div>
            
        </form>
        <br><br>
            <?php


            // echo $row['username'];

        }
        

        // $post_query = $pdo->query("SELECT * FROM users_tb
        // WHERE NOT username = '".$_SESSION['username']."'
        // ORDER BY username ASC;");


        
        $post_query = $pdo->query("SELECT * FROM audits WHERE username = '".$users[0]['username']."'
        ORDER BY actionDate DESC;");
        ?> <h2 class="hist">Account History</h2> <?php
        while($row = $post_query->fetch(PDO::FETCH_ASSOC)){
            array_push($users, $row);
            extract($row);

            ?>
                <div class="card-static">
                    <p><?php echo $row['username']." &nbsp; -- &nbsp; ".$row['eventDesc']." &nbsp; &nbsp; &nbsp; &nbsp; <span>".$row['actionDate']."</span>" ?></p>
                </div>
                <br>



            <?php


            // echo $row['username'];

        }
        




    ?>



<script>
    document.querySelector("#updatebtn").addEventListener('click', ()=>{
        if(document.querySelector("#adminpassword").value == document.querySelector(".adminpassvalue").textContent){
            document.querySelector("#updatebtn-ac").click()
        }
        else{
            showToast("Incorrect Admin Password!", 2)
        }
    })
    document.querySelector("#delbtn").addEventListener('click', ()=>{
        if(document.querySelector("#adminpassword").value == document.querySelector(".adminpassvalue").textContent){
            document.querySelector("#delbtn-ac").click()
        }
        else{
            showToast("Incorrect Admin Password!", 2)
        }
    })
</script>

<?php include_once("../components/toast.php");
custom_input_script(); ?>
    
    <script src="../js/forgot.js"></script>      
</body>
</html>