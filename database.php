<?php
    include_once("db_info.php");
    $post = array();

    $dsn = "mysql:host=$host;dbname=$db_name";

    $pdo = new PDO($dsn, $user, $password);

    $qry = $pdo->query("CREATE DATABASE if not exists $db_name");

    $post_query = $pdo->query("SELECT * FROM posts");

    while($row = $post_query->fetch(PDO::FETCH_ASSOC)){
        array_push($post, $row);
    }




?>