<?php
    include("db_info.php");
    $warning = "";


    try {
        $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch (PDOException $exc) {
        $pdoConnect = new PDO("mysql:host=$db_host", $db_username, $db_password);
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdoConnect->query("CREATE DATABASE if not exists $db_name");
        $pdoConnect->query("USE $db_name");
        $pdoConnect->query("CREATE TABLE tbuser (id int AUTO_INCREMENT NOT NULL, username varchar(100) NOT NULL, password varchar(100) NOT NULL, fullname varchar(100) NOT NULL, contact varchar(16), email varchar(100), telegram varchar(100), twitter varchar(100), facebook varchar(100), PRIMARY KEY (id))");
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin1", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin2", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin3", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin4", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin5", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin66", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admin7", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminfg", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminsf", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admincvb", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminbk", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminjhk", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminhj", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminlhj", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminxcv", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("adminxb", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect->query('INSERT INTO tbuser(username, password, fullname, contact, email, telegram, twitter, facebook) VALUES ("admingd", "admin", "Admin", "0", "no@email.com", "na", "na", "na")');
        $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo $exc->getMessage();
    }






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p {
            display: none;
        }

        h2 {

            color: green;
        }

        h2.active {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    $pdoQuery = 'SELECT * FROM tbuser';
    $pdoResult = $pdoConnect->query($pdoQuery);
    while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){
        echo '<p class="usernames">'.$row['username'].'</p>';
    }    
    ?>
    <form method="post">
        <input type="text" name="txt" class="txt">
        <h2 class="yes">HELLO</h2>
    </form>

    <?php
         include("db_info.php");
         $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
         $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $pdoQuery = 'SELECT * FROM users_tb where username = '.$_SESSION['username'];
             $pdoResult = $pdoConnect->query($pdoQuery);
             while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){
                 echo $row["fullname"];
             }

         ?>



    ?>



    <script>
        const users = document.querySelectorAll(".usernames")
        const txt = document.querySelector(".txt")
        const h2 = document.querySelector("h2")
        let usernamelist = []

        for(let i=0; i<users.length; i++){
            usernamelist.push(users[i].textContent)
        }
        console.log(usernamelist)



        txt.addEventListener("input", () => {
            // console.log("clicked")
            console.log(txt.value)
            
                // console.log(document.querySelectorAll(".usernames")[i].textContent)
                if(usernamelist.includes(txt.value)){
                    h2.classList.add('active')
                    console.log("LOOP")
                }
                else{
                    h2.classList.remove('active')
                }
            
        })
    </script>
</body>
</html>