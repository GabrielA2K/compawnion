<?php
    session_start();

    if(isset($_SESSION["username"]) && $_SESSION["isVerified"] == "false")
    {
        header("location: ../verify_email.php");
    }
    elseif(isset($_SESSION["username"]) && $_SESSION["isVerified"] == "true")
    {
        
    }
    else
    {
      header("location: ../login.php");
    }

    $pageNames = array("Home", "Events", "Donate", "Notifications", "Dashboard");
        $pages = array("home", "community", "donate", "notifications", "dashboard");
        $icons = array("home", "community", "donate", "notifications", "dashboard");
    $pageTitle = "";


    include("../db_info.php");
    $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoQuery = "SELECT * FROM users_tb WHERE username = '".$_SESSION["username"]."'";
    $pdoResult = $pdoConnect->query($pdoQuery);
    while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){
        $_SESSION["accountType"] = $row["accountType"];
        $_SESSION["isVerified"] = $row["isVerified"];
    }

    if($_SESSION["accountType"] == "admin")
    {
        $pageNames = array("Dashboard", "User Posts", "Reported Posts", "Events", "Donation");
        $pages = array("dashboard", "home", "reported-posts", "community", "donate");
        $icons = array("dashboard", "userposts", "report", "community", "donate");
    }
    elseif($_SESSION["accountType"] == "mod")
    {
        $pageNames = array("dashboard", "User Posts", "Events", "Donate", "Notifications");
        $pages = array("Dashboard", "home","community", "donate", "notifications");
        $icons = array("Dashboard", "userposts","community", "donate", "notifications");
    }
    elseif($_SESSION["accountType"] == "user") 
    {
        $pageNames = array("Home", "Events", "Donate", "Menu");
        $pages = array("home", "community", "donate", "dashboard");
        $icons = array("home", "community", "donate", "dashboard");
    }




    function current_page_title($page){
        global $pages, $pageNames, $pageTitle;
        for($i = 0; $i < count($pages); $i++){
            if($page == $pages[$i]){ 
                return $pageNames[$i];
            }
        }       
    }
    function navbar_landscape($page) { 
        global $pages, $pageNames, $pageTitle, $icons; ?>


        <div class="title-bar">
            <img src="../images/com/logo.png" alt="paw logo" class="title-bar__logo">
            <h2 class="title-bar__title">ComPawnion</h2>
            <?php if($_SESSION['hasPfp'] == "false") { ?>
                    <div class="letter-avatar"><?php echo strtoupper(mb_substr($_SESSION['fullname'], 0, 1)); ?></div>
                    <!-- <img src="../images/default/def_user.png" alt="paw logo" class="title-bar__avatar"> -->
                    <?php
                } else{?>
                    <img src="../database/profile_images/<?php echo $_SESSION['username'] ?>.jpg" alt="paw logo" class="title-bar__avatar">
                    <?php
                } ?>
            <!-- <img src="../images/com/logo.png" alt="paw logo" class="title-bar__avatar"> -->


            <div class="tablet-nav">
                <?php
                    for($i = 0; $i < count($pages); $i++){ ?>
                        <?php if($page == $pages[$i]){ 
                            $pageTitle = $pageNames[$i];?>
                            <a href=<?php echo $pages[$i].".php"; ?>  class="tablet-nav__item__icon tablet-nav-icon-selected">
                        <?php } else { ?>
                            <a href=<?php echo $pages[$i].".php"; ?>  class="tablet-nav__item__icon tablet-nav-icon-default">
                        <?php } ?>
                            <?php include("../icons/".$icons[$i]."-icon.php") ?>
                            </a>
                    <?php } ?>
                    
                <div class="tablet-nav__item__underline-div">

                <?php
                    for($i = 0; $i < count($pages); $i++){
                        if($page == $pages[$i]){ ?>
                            <div class="tablet-nav-underline tablet-nav-selected"></div>
                        <?php } else { ?>
                            <div class="tablet-nav-underline"></div>
                        <?php } 
                    } ?>

                </div>
            </div>
        </div>


        <div class="side-nav">
            <div class="side-nav__user">
                <?php if($_SESSION['hasPfp'] == "false") { ?>
                    <div class="letter-avatar-sidenav"><?php echo strtoupper(mb_substr($_SESSION['fullname'], 0, 1)); ?></div>
                    <!-- <div class="side-nav__user__avatar" style="background: url('../images/default/def_user.png'); background-size: cover;"></div> -->
                    <?php
                } else{?>
                    <div class="side-nav__user__avatar" style="background: url('../database/profile_images/<?php echo $_SESSION['username'] ?>.jpg'); background-size: cover;" ></div>
                    <?php
                } ?>
                <!-- <div class="side-nav__user__avatar" style="background: url('images/default/admin.png'); background-size: cover; border: 2px solid #818DFF;" ></div> -->
                <!-- <div class="side-nav__user__avatar"></div> -->
                <!-- <img class="side-nav__user__avatar" src="images/icons-color/default_user_ldpi.png" alt="paw logo"> -->
                <?php
                include("../db_info.php");
                $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdoQuery = 'SELECT * FROM users_tb where username = "'.$_SESSION['username'].'"';
                    $pdoResult = $pdoConnect->query($pdoQuery);
                    while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){?>
                        <h2 class="side-nav__user__name"><?php echo $row["fullname"] ?></h2>
                    <?php }

                ?>
                
                <!-- <h2 class="side-nav__user__name">gab</h2> -->
            </div>
            <div class="side-nav__item-group">
            <?php
                for($i = 0; $i < count($pages); $i++){ ?>
                    <?php if($page == $pages[$i]){ ?>
                        <a href=<?php echo $pages[$i].".php"; ?> class="side-nav__item side-nav__item-selected">
                            <div class="selected-bar"></div>
                            <div class="side-nav__item__icon side-nav-icon-selected">
                    <?php } else { ?>
                        <a href=<?php echo $pages[$i].".php"; ?> class="side-nav__item side-nav__item-default">
                            <div class="side-nav__item__icon side-nav-icon-default">
                    <?php } ?>
                        <?php include("../icons/".$icons[$i]."-icon.php") ?>
                        </div>
                    
                    <?php if($page == $pages[$i]){ ?>
                        <p class="side-nav__item__text side-nav-selected"><?php echo $pageNames[$i] ?></p>
                    <?php } else { ?>
                        <p class="side-nav__item__text side-nav-default"><?php echo $pageNames[$i] ?></p>
                    <?php } ?>
                    </a>
                <?php } ?>

            </div>
            <div class="logout-btn">
                <a href="../logout.php" class="side-nav__item side-nav__item-default">
                    <div class="side-nav__item__icon side-nav-icon-default">
                        <?php include("../icons/logout-icon.php") ?>
                    </div>
                    <p class="side-nav__item__text side-nav-default">Logout</p>
                </a>
            </div>

        </div>
    <?php }

    function navbar_mobile($page) { 
        global $pages, $pageNames, $icons; ?>
        <div class="mobile-title-bar">
            <img src="../images/com/logo.png" alt="paw logo" class="mobile-title-bar__logo">
            <h2 class="mobile-title-bar__title">ComPawnion</h2>
            <?php if($_SESSION['hasPfp'] == "false") { ?>
                    <div class="letter-avatar"><?php echo strtoupper(mb_substr($_SESSION['fullname'], 0, 1)); ?></div>
                    <!-- <img src="../images/default/def_user.png" alt="paw logo" class="mobile-title-bar__avatar"> -->
                    <?php
                } else{?>
                    <img src="../database/profile_images/<?php echo $_SESSION['username'] ?>.jpg" alt="paw logo" class="mobile-title-bar__avatar">
                    <?php
                } ?>
            <!-- <img src="../images/com/logo.png" alt="paw logo" class="mobile-title-bar__avatar"> -->
        </div>

        <div class="mobile-nav">

        <?php
            for($i = 0; $i < count($pages); $i++){
                if($page == $pages[$i]){ ?>
                    <a href=<?php echo $pages[$i].".php"; ?>  class="mobile-nav__item__icon mobile-nav-icon-selected">
                <?php } else { ?>
                    <a href=<?php echo $pages[$i].".php"; ?>  class="mobile-nav__item__icon mobile-nav-icon-default">
                <?php } ?>
                <?php include("../icons/".$icons[$i]."-icon.php") ?>
                </a>
            <?php } ?>

            
            <div class="mobile-nav__item__underline-div">
            <?php
                for($i = 0; $i < count($pages); $i++){
                    if($page == $pages[$i]){ ?>
                        <div class="mobile-nav-underline mobile-nav-selected"></div>
                    <?php } else { ?>
                        <div class="mobile-nav-underline"></div>
                    <?php } 
                } ?>
            </div>
        </div>
        <script>
            const titlebarAvatar = document.querySelectorAll(".title-bar__avatar")
            const letterAvatar = document.querySelectorAll(".letter-avatar")
            const sidenavAvatar = document.querySelectorAll(".side-nav__user__avatar")
            const letterSidenav = document.querySelectorAll(".letter-avatar-sidenav")
            const mobileAvatar = document.querySelectorAll(".mobile-title-bar__avatar")
            const sidenavName = document.querySelectorAll(".side-nav__user__name")

            for(let i=0; i<titlebarAvatar.length; i++){
                titlebarAvatar[i].addEventListener('click', ()=>{
                    window.location="../pages/profile.php"
                })
            }
            for(let i=0; i<letterAvatar.length; i++){
                letterAvatar[i].addEventListener('click', ()=>{
                    window.location="../pages/profile.php"
                })
            }
            for(let i=0; i<sidenavAvatar.length; i++){
                sidenavAvatar[i].addEventListener('click', ()=>{
                    window.location="../pages/profile.php"
                })
            }
            for(let i=0; i<letterSidenav.length; i++){
                letterSidenav[i].addEventListener('click', ()=>{
                    window.location="../pages/profile.php"
                })
            }
            for(let i=0; i<mobileAvatar.length; i++){
                mobileAvatar[i].addEventListener('click', ()=>{
                    window.location="../pages/profile.php"
                })
            }
            for(let i=0; i<sidenavName.length; i++){
                sidenavName[i].addEventListener('click', ()=>{
                    window.location="../pages/profile.php"
                })
            }
            
        </script>
    <?php }
?>