<?php
    session_start();
    include("../db_info.php");
    $pdoConnect = new PDO("mysql:host=$db_host", $db_username, $db_password);
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdoConnect->query("USE $db_name");
    
function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    //return $destination; 
}
?>

<?php
    include("db_info.php");
    // $warning = "";

    if ($_FILES['file']['size'] > 0){}
    {
        $file = $_FILES['file'];
        print_r($_FILES);
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExtTmp = explode(".", $fileName);
        $fileExt = strtolower(end($fileExtTmp));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 5000000){
                    // $fileNameNew = $_SESSION['username'].".".$fileExt;
                    $fileNameNew = $_SESSION['username'].".jpg";
                    $fileDestination = '../database/profile_images/'.$fileNameNew;
                    // $fileDestinationCompressed = 'database/post_images_compressed/'.$fileNameNew;
                    //imagejpeg($fileTmpName, $fileDestination, 75); 
                    // move_uploaded_file($fileTmpName, $fileDestination);
                    $unlinkthis = "../database/profile_images/".$_SESSION['username'].".jpg";
                    unlink($unlinkthis);
                    compressImage($fileTmpName, $fileDestination, 70);
                    
                    $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "updated their profile picture", NOW())';
                    $pdoConnect->query($pdoQuery);
                    
                    header("location: profile.php?uploadsuccess");
                    //throw success message
                }
                else{
                    echo "File too large";
                }
            }
            else{
                echo "Error Uploading";
            }
        }
        else{
            echo "File not supported";
        }
    }

?>
