<?php 

function generate_captcha($len = 6) {
    $chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
    
    $captcha = '';
    for($i = 0; $i < $len; $i++) {
        $captcha .= $chars[rand(0, strlen($chars) - 1)];
    }

    return $captcha;
}

function generate_captcha_img($captcha) {
    $width = 26*strlen($captcha); $height = 50;
    $img = imagecreate($width, $height);
    $background_color = imagecolorallocate($img, 209, 180, 214);
    
    // captcha text
    for ($i = 0; $i < strlen($captcha); $i++) {
        $text_color = imagecolorallocate($img, rand(100, 255), 255, 255);
        imagettftext($img, 16, rand(-10, 10), 20*($i+1), 30, $text_color, 'captcha.ttf', $captcha[$i]);
    }

    // image noise
    $ellipse_count = 5;
    for ($i = 0; $i < $ellipse_count; $i++) {
        $x = rand(-1*($width/2), $width + ($width/2));
        $y = rand(-1*($height/2), $height + ($height/2));
        $h  = rand($height/2, 2*$height);
        $w  = rand($width/2, 2*$width);
        $noise_color  = imagecolorallocate($img, 150, rand(1, 150), 200);
        imageellipse($img, $x, $y, $w, $h, $noise_color);
    }

    ob_start(); 
    imagepng($img);
    $img_data = ob_get_contents(); 
    ob_end_clean();
    imagedestroy($img);

    return 'data:image/png;base64,'.base64_encode($img_data);
}


?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php //$captcha = generate_captcha(); ?>
    <p><?php //echo $captcha ?></p>
    <img style="width: 200px;" src="<?php //echo generate_captcha_img($captcha) ?>">

</body>

</html> -->