<?php
    session_start();

    include("../db_info.php");
    $warning = "";


    if(isset($_POST['post-event'])){
        
                    $pdoConnect = new PDO("mysql:host=$db_host", $db_username, $db_password);
                    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $pdoConnect->query("USE $db_name");
                    $pdoConnect->query('INSERT INTO community_posts_tb(eventName, eventDate, eventLocation, eventDesc) VALUES ("'.$_POST["pet-class"].'", "'.$_POST["pet-breed"].'", "'.$_POST["pet-sex"].'", "'.$_POST["other-desc"].'")');
                    
                    $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "posted an event named: '.$_POST['pet-class'].'", NOW())';
                    $pdoConnect->query($pdoQuery);
                    
                    
                    
                    header("location: community.php?uploadsuccess");
                    //throw success message
    }

?>
