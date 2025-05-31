<?php

session_start();
    include("../db_info.php");

    $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdoQuery = "DELETE FROM community_posts_tb where id =".$_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute();

    $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "deleted event id = '.$_GET['id'].'", NOW())';
    $pdoConnect->query($pdoQuery);

    header('location: community.php');
    $pdoConnect = null;
?>