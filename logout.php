<?php
    session_start();
    include("db_info.php");

    $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "logged out", NOW())';
    $pdoConnect->query($pdoQuery);

    unset($_SESSION['username']);
    session_destroy();
    header('location: login.php');
?>