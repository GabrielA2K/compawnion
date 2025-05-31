<?php
    $currentPage = "donate";
    require_once("../components/navbars.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compawnion - <?php echo current_page_title($currentPage) ?></title>
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

        <div class="main__title-div">
            <h2 class="main__title-div__text" id="page-title"><?php echo $pageTitle ?></h2>
        </div>



        <div class="main__post">



            <?php //include_once("../user_home-content.php") ?>
                    
                    <div class="card-stationary post" id="post_<?php echo $id ?>">
                        <!-- <a href='delete-post.php?id='.$id;?>delete</a> -->

                        <div class="post__image-holder">
                            <img class="post__image" src="../images/gcash.png" alt="">
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
                                    <h2 class="post-title">GCash</h2>
                                </div>
                                <div class="post__info-holder">
                                    <h3 class="pet__info">
                                        09112123679<em><?php echo $petClass ?></em>
                                    </h3>
                                </div>
                            </div>
                        </div>
                       
                        <br>
                    </div>


                    <div class="card-stationary post" id="post_<?php echo $id ?>">
                        <!-- <a href='delete-post.php?id='.$id;?>delete</a> -->

                        <div class="post__image-holder">
                            <img class="post__image" src="../images/maya.jpg" alt="">
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
                                    <h2 class="post-title">Maya</h2>
                                </div>
                                <div class="post__info-holder">
                                    <h3 class="pet__info">
                                        09112123679<em><?php echo $petClass ?></em>
                                    </h3>
                                </div>
                            </div>
                        </div>
                       
                        <br>
                    </div>


                    <div class="card-stationary post" id="post_<?php echo $id ?>">
                        <!-- <a href='delete-post.php?id='.$id;?>delete</a> -->

                        <div class="post__image-holder">
                            <img class="post__image" src="../images/paypal.jpg" alt="">
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
                                    <h2 class="post-title">PayPal</h2>
                                </div>
                                <div class="post__info-holder">
                                    <h3 class="pet__info">
                                        @CompawnionPH<em><?php echo $petClass ?></em>
                                    </h3>
                                </div>
                            </div>
                        </div>
                       
                        <br>
                    </div>

            <div class="end-space" style="height: 5rem"></div>
        </div>


        
    
</body>
</html>