<?php
session_start();
    $currentPage = "profile";
    require_once("../components/navbars.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compawnion - Profile</title>
    <link rel="shortcut icon" type="image/jpg" href="../images/com/logo_ldpi.png"/>
    <link rel="stylesheet" href="../styles/page-styles/profile.css">
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body>
    <?php
        require_once("../components/navbars.php");
        navbar_landscape($currentPage);
    ?>
    
    <div class="main">
        <div id="top"></div>
        <?php navbar_mobile($currentPage); ?>

        <div class="main__post">


            <div class="card-static profile-section">
                <div class="profile-image-section">
                    <img class="profile-img" src="../database/profile_images/<?php echo $_SESSION['username'] ?>.jpg" alt="">
                    <h2 class="profile-name" id="profile-name"><?php echo $_SESSION['fullname'] ?></h2>
                </div>
                <div class="profile-info-section">
                    <div class="btn-change" id="btn-change-picture">
                        Change Picture
                    </div>
                </div>
                    
                
            </div>

            <?php //include_once("../user_home-content.php") ?>
            <?php
                include("../db_info.php");
                $post = array();
            
                $dsn = "mysql:host=$host;dbname=$db_name";
            
                $pdo = new PDO($dsn, $user, $password);
            
                $qry = $pdo->query("CREATE DATABASE if not exists $db_name");
            
                $post_query = $pdo->query("SELECT posts_tb.id, posts_tb.imageLink, posts_tb.petName, posts_tb.petClass, posts_tb.petBreed, posts_tb.petSex, posts_tb.petAge, posts_tb.petDesc, posts_tb.reason, users_tb.fullname, users_tb.contact, users_tb.email, users_tb.fullname, users_tb.telegram, users_tb.twitter, users_tb.facebook, users_tb.username
                FROM posts_tb
                INNER JOIN users_tb ON posts_tb.username = users_tb.username
                WHERE posts_tb.username = '".$_SESSION['username']."'
                ORDER BY posts_tb.id DESC;");
                
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
                        <div class="button image-report-btn del">
                            <div class="report-btn__icon del">
                                <?php include("../icons/delete-icon.php") ?>
                            </div>
                        </div>

                        <div class="post__image-holder">
                            <img class="post__image" src="../<?php echo $imageLink ?>" alt="">
                            <div class="image-action-buttons">
                            
                                <div class="button image-adopt-btn show-adopt-modal">
                                    <!-- <h2 class="adopt-btn__text">Adopt</h2> -->
                                    <div class="adopt-btn__icon">
                                        <?php include("../icons/adopt-button-icon.php") ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-container">
                            <div class="post__content-holder">
                                <div class="post__title-holder">
                                    <h2 class="post-title"><?php echo $petName ?></h2>
                                </div>
                                <div class="post__info-holder">
                                    <h3 class="pet__info">
                                        Classification: <em><?php echo $petClass ?></em>
                                    </h3>
                                    <h3 class="pet__info">
                                        Breed: <em><?php echo $petBreed ?></em>
                                    </h3>
                                    <h3 class="pet__info">
                                        Sex: <em><?php echo $petSex ?></em>
                                    </h3>
                                    <h3 class="pet__info">
                                        Age: <em><?php echo $petAge ?></em>
                                    </h3>
                                    <h3 class="post__info-title">
                                        Other Descriptions:
                                    </h3>
                                    <h3 class="post__info-content">
                                        <?php echo $petDesc ?>
                                    </h3>
                                    <h3 class="post__info-title">
                                        Reason for rehoming:
                                    </h3>
                                    <h3 class="post__info-content">
                                        <?php echo $reason ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                       
                        <br>
                    </div>
                    <div class="deletepost-modal">
                        <div class="deletepost-modal-card">
                            <div class="deletepost-modal-content">
                                <h2 class="deletepost-message">
                                    Delete rehoming post for</br><br>
                                    <em id="deletepost-name"><?php echo $petName ?></em>
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
                                <a class="deletepost-modal-close-btn positive button" href="delete-post.php?id=<?php echo $id ?>">
                                    <p class="button-text">Delete</p>
                                </a>
                            </div>

                        </div>                  
                    </div>

                
                    
            <?php } 
            $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "visited their profile", NOW())';
            $pdoConnect->query($pdoQuery);
            ?>

            <div class="end-space" style="height: 3rem"></div>
        </div>

        <?php for($i = 0; $i < sizeof($post); $i++){ ?>
        <div class="view-image-modal">
            <div class="view-image-container">
                <img class="view-image" src="../<?php echo $post[$i]["imageLink"]; ?>" alt="">
            </div>
        </div>
        


    <?php } ?>

                <form action="upload-new-pfp.php" method="POST" enctype="multipart/form-data">
                <div class="setpfp-modal">
                    <div class="modal-card-setpfp" id="setpfp-modal-card">
                        <div class="modal-card__top">
                            <div class="close-btn-setpfp">
                                <?php include("../icons/add-icon.php") ?>
                            </div>
                        </div>
                        <div class="modal-title">
                            <h2 class="modal-title-text">Update your <br><em>Profile Picture</em></h2>
                        </div>

                        <div class="addpost-modal-image-container">
                            <input type="file" name="file" id="post-image-file" accept="image/*" hidden required>
                            <div class="addpost-modal-image empty">
                                <img src="images/empty-image1.png" alt=" " class="addpost-image">
                            </div>
                            <div class="change-image-btn button txt-btn">
                                <p class="change-image-btn-text txt-btn-text">Upload Image</p>
                            </div>
                        </div>
                        <button name="upload-new-pfp" type="submit" class="button txt-btn positive proceed second-step" id="close-setpfp-modal">
                            <p class="txt-btn-text">Change</p>
                        </button>
                    </div>
                </div>
                </form>

        
    
        <script src="../js/profile.js"></script>
</body>
</html>