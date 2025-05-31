<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    function sendmail(){
        $name = "Compawnion";
        $to = $_SESSION['email'];
        $subject = "Verify your Compawnion Account";
        
        $verificationCode = substr(number_format(time()*rand(), 0, '', ''), 0, 6);
        $body = "<h1>Your account verification code is:</h1><br><h2>".$verificationCode."</h2>";


            include("db_info.php");

            $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $post_query = $pdoConnect->query("UPDATE users_tb SET verificationCode = '".$verificationCode."' WHERE username = '".$_SESSION['username']."'");
            


        $from = "cs.josegabrielrcastillo@gmail.com";
        $password = "jhikvpijgupqwrvj";

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();


        $mail->isSMTP();
        // $mail->SMTPDebug = 3;                        
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to);
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo "Email is sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    }

        if (isset($_POST['send'])) {
            sendmail();
        }
?>