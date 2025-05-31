<?php
    $currentPage = "dashboard";
    require_once("../dashboard-content.php");
    require_once("../components/navbars.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compawnion - <?php echo current_page_title($currentPage) ?></title>
    <link rel="shortcut icon" type="image/jpg" href="../images/com/logo_ldpi.png"/>
    <link rel="stylesheet" href="../styles/page-styles/dashboard.css">
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


        <!-- PAGE SECTIONS INSIDE MAIN -->
        <div class="section">

            <h2 class="section__name">Notifications</h2>
            <div class="section__notification">
                <?php
                    $notification_array_size = min(sizeof($notification_titles), sizeof($notification_subtitles));
                    
                    for ($i=0; $i < $notification_array_size; $i++){
                        echo "<div class=\"notification card\">";
                        echo "<h3 class=\"card__title\">".$notification_titles[$i]."</h3>";
                        echo "<p class=\"card__subtitle\">".$notification_subtitles[$i]."</p>";
                        echo "</div>";
                    }
                ?>
            </div>

            <hr>

            <h2 class="section__name">Shortcuts</h2>
            <div class="section__shortcut">
            <?php
                    $shortcut_array_size = min(sizeof($shortcut_titles), sizeof($shortcut_subtitles), sizeof($shortcut_links));

                    for ($i=0; $i < $shortcut_array_size; $i++){
                        echo "<a href=\"".$shortcut_links[$i]."\">";
                        echo "<div class=\"shortcut card\">";
                        echo "<h3 class=\"card__title\">".$shortcut_titles[$i]."</h3>";
                        echo "<p class=\"card__subtitle\">".$shortcut_subtitles[$i]."</p>";
                        echo "</div>";
                        echo "</a>";
                    }
                ?>
            </div>
        </div>
        <div class="end-space" style="height: 3rem; width: 100%;"></div>
    </div>
</body>
</html>