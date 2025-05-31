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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compawnion - Verify Your Account</title>
    <link rel="shortcut icon" type="image/jpg" href="../images/com/logo_ldpi.png"/>
    <link rel="stylesheet" href="../styles/page-styles/verify-email.css">
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body>
    <main>

                <?php
                    if(isset($_POST['send'])){ ?>
                        <div class="modal-title">
                            <h2 class="modal-title-text">Enter your <br><em>Verification Code</em></h2>
                            <p id="email-message">The Verification Code is sent to <br><em>
                                <?php echo $_SESSION['email'] ?> </em>
                            </p>
                        </div>
                        <?php include_once("../components/custom-input.php") ?>
                        <form action="../components/send.php" method="post">
                            <?php 
                                custom_input("text", "verification-code", "verification-code", "Verification Code", TRUE, "6");
                                custom_input_script();
                            ?>
                            <button class="button txt-btn positive" id="verify-code" type="submit" name="verify">Verify</button>
                        </form>
                        <?php
                    } elseif (isset($_POST['verify'])){
                        $pdoQuery = 'INSERT INTO audits(username, eventDesc, actionDate) VALUES ("'.$_SESSION['username'].'", "verified their account", NOW())';
                        $pdoConnect->query($pdoQuery);
                    } else { ?>
                        <div class="modal-title">
                            <h2 class="modal-title-text">Verify your account,<br><em><?php echo $_SESSION['fullname'] ?></em></h2>
                        </div>
                        <form method="post">
                            <button class="button txt-btn positive" id="send-code" type="submit" name="send">Send Verification Code</button>
                        </form>
                        <?php
                    }


                ?>


    </main>
                
</body>
</html>