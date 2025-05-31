<?php
session_start();
    include("../db_info.php");

    $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $post_query = $pdoConnect->query("SELECT * FROM posts_tb WHERE id = '".$_GET['id']."'");
    while($row = $post_query->fetch(PDO::FETCH_ASSOC)){
        unlink("../".$row['imageLink']);
    }

    $pdoQuery = "DELETE FROM posts_tb where id =".$_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute();

    $pdoQuery = "DELETE FROM reported_posts_tb where postId =".$_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute();

    $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "deleted post id = '.$_GET['id'].'", NOW())';
    $pdoConnect->query($pdoQuery);

    header('location: home.php');
    $pdoConnect = null;
?>