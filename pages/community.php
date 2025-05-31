<?php
    $currentPage = "community";
    require_once("../components/navbars.php");
    include_once("../components/custom-input.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compawnion - <?php echo current_page_title($currentPage) ?></title>
    <link rel="shortcut icon" type="image/jpg" href="../images/com/logo_ldpi.png"/>
    <link rel="stylesheet" href="../styles/page-styles/community.css">
    <link rel="stylesheet" href="../styles/index.css">

</head>
<body>
    
    <?php
        require_once("../components/navbars.php");
        navbar_landscape($currentPage);
    ?>
    
    <?php
        if($_SESSION["accountType"] == "admin"){?>
            <div class="add-post-btn">
                <div class="add-symbol">
                    <?php include("../icons/add-icon.php") ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="add-post-btn" style="display: none;">
                <div class="add-symbol">
                    <?php include("../icons/add-icon.php") ?>
                </div>
            </div>
        <?php }
    ?>



    <div class="main">
        <p class="admin-pass-text" style="display: none;"><?php echo $_SESSION['password']; ?></p>
        <p class="account-type-text" style="display: none;"><?php echo $_SESSION['accountType']; ?></p>
        <div id="top"></div>
        <?php navbar_mobile($currentPage); ?>

        <div class="main__title-div">
            <h2 class="main__title-div__text" id="page-title"><?php echo $pageTitle; ?></h2>
        </div>

        <div class="main__post">
            <?php //include_once("../user_home-content.php") ?>
            <?php
                include("../db_info.php");
                $post = array();
            
                $dsn = "mysql:host=$host;dbname=$db_name";
            
                $pdo = new PDO($dsn, $user, $password);
            
                $qry = $pdo->query("CREATE DATABASE if not exists $db_name");
            
                $post_query = $pdo->query("SELECT * FROM community_posts_tb
                ORDER BY id DESC;");
                
                while($row = $post_query->fetch(PDO::FETCH_ASSOC)){
                    array_push($post, $row);
                    extract($row);

                    $pdoQuery = "SELECT * FROM reported_posts_tb WHERE reportedBy = BINARY '".$_SESSION['username']."' AND postId = ".$id;
                    $pdoResult = $pdo->prepare($pdoQuery);
                    $pdoResult->execute();
                
                    $postRepCount = $pdoResult->rowCount();
                    ?>
                    
                    <div class="card-stationary post" id="post_<?php echo $id ?>">
                        <!-- <a href='delete-post.php?id='.$id;?>delete</a> -->
                        
                        
                        <?php
                                if($username == $_SESSION['username'] || $_SESSION['accountType'] == "admin"){ ?>
                                    <div class="button image-report-btn del">
                                        <div class="report-btn__icon del">
                                            <?php include("../icons/delete-icon.php") ?>
                                        </div>
                                    </div>
                                    <div class="button image-report-btn rep" style="display: none;">
                                    </div>
                                <?php }
                            ?>
                        <div class="post-container">
                            <div class="post__content-holder">
                                <div class="post__info-holder">
                                    <h3 class="pet__info">
                                        Event: <em><?php echo $eventName ?></em>
                                    </h3>
                                    <h3 class="pet__info">
                                        Date/Time: <em><?php echo $eventDate ?></em>
                                    </h3>
                                    <h3 class="pet__info">
                                        Location: <em><?php echo $eventLocation ?></em>
                                    </h3>
                                    <h3 class="post__info-title">
                                        Description:
                                    </h3>
                                    <h3 class="post__info-content">
                                        <?php echo $eventDesc ?>
                                    </h3>
                                    
                                </div>
                            </div>
                        </div>
                       
                        <div class="action-buttons">
                        <?php
                            if($username == $_SESSION['username'] || $_SESSION['accountType'] == "admin"){ ?>
                                <div class="button report-btn del">
                                    <div class="report-btn__icon del">
                                        <?php include("../icons/delete-icon.php") ?>
                                    </div>
                                </div>
                                <div class="button report-btn rep" style="display: none;">
                                </div>
                            <?php }
                        ?>
                        </div>
                    </div>
                    <div class="deletepost-modal">
                        <div class="deletepost-modal-card">
                            <div class="deletepost-modal-content">
                                <h2 class="deletepost-message">
                                    Delete event</br><br>
                                    <em id="deletepost-name"><?php echo $eventName ?></em>
                                </h2>
                            </div>
                            <?php
                                if($_SESSION['accountType'] == "admin"){
                                    custom_input("password", "admin-pass", "admin-pass".$id, "Admin Password", TRUE, "100"); ?>
                                    <?php 
                                }
                            ?>


                            <div class="deletepost-modal-action-btn">
                                <div class="deletepost-modal-close-btn negative button">
                                    <p class="button-text">Cancel</p>
                                </div>
                                <a class="deletepost-modal-close-btn positive button" href="delete-comm-post.php?id=<?php echo $id ?>">
                                    <p class="button-text">Delete</p>
                                </a>
                            </div>

                        </div>                  
                    </div>


                
                    
            <?php } ?>
            <div class="end-space" style="height: 3rem"></div>
        </div>

        
    </div>


    <div class="addpost-modal">
        <form action="upload-comm.php" method="POST" enctype="multipart/form-data">
        <div class="addpost-modal-card">
            <div class="modal-card__top">
                <div class="close-addpostmodal-btn">
                    <?php include("../icons/add-icon.php") ?>
                </div>
            </div>
            <div class="addpost-modal-container">
                
                <div class="addpost-modal-content-input small">
                        <?php 
                            custom_input("text", "pet-class", "pet-class", "Event", TRUE, "100");
                            custom_input("text", "pet-breed", "pet-breed", "Date & Time", TRUE, "100");
                            custom_input("text", "pet-sex", "pet-sex", "Location", TRUE, "100");
                        ?>
                </div>
                <div class="addpost-modal-content-input">
                        <?php include_once("../components/custom-input.php") ?>
                        <?php 
                            custom_textarea("other-desc", "other-desc", "7.1rem", "50", "4", "128", "Description", TRUE);
                            custom_input_script();
                        ?>
                </div>
            </div>
            <div class="modal-actions">
                <button type="submit" name="post-event" id="post-pet" class="button">Post</button>
            </div>
        </div>

        </form>
    </div>


    <?php include_once("../components/toast.php") ?>
    <script src="../js/community.js"></script>
</body>
</html>