<?php
    $currentPage = "notifications";
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

        
    
</body>
</html>