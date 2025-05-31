<?php
    if(isset($_POST['forgot']) || isset($_POST['send']) || isset($_POST['verify']) || isset($_POST['set-pass'])){
        
    }
    else {
        header("location: pages/home.php");
    }
    
    include("db_info.php");
    $pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoQuery = 'SELECT * FROM users_tb';
    $pdoResult = $pdoConnect->query($pdoQuery);
    while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){
        echo '<p class="email-list" style="display: none;">'.$row['email'].'</p>';
    }
    if (isset($_POST['set-pass'])) {
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdoConnect->query("UPDATE users_tb SET password = '".$_POST['confirmpassword']."' WHERE email = '".$_POST['email-from-verify']."'");
        ?> 
        <form action="login.php" method="post">
            <button type="submit" id="goto-login" name="goto-login" style="display:none;"></button>
        </form>
        <script>
            document.querySelector("#goto-login").click();
            // alert("Password Successfully Changed");
        </script> <?php
        // header("location: login.php");
    }

    use PHPMailer\PHPMailer\PHPMailer;
                    
    function sendmail(){
        global $pdoConnect;
        $name = "Compawnion";
        $to = $_POST['forgot-email'];
        $subject = "Recover your Compawnion Account";
        
        $verificationCode = substr(number_format(time()*rand(), 0, '', ''), 0, 6);
        $body = "<h2>Your account recovery code is:</h2><br><h2>".$verificationCode."</h2>";


            
            $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdoConnect->query("UPDATE users_tb SET verificationCode = '".$verificationCode."' WHERE email = '".$_POST['forgot-email']."'");
            


        $from = "cs.josegabrielrcastillo@gmail.com";
        $password = "akrivmcsmyxcuypy";

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
            // echo "Email is sent!";
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
    <link rel="shortcut icon" type="image/jpg" href="images/com/logo_ldpi.png"/>
    <link rel="stylesheet" href="styles/page-styles/verify-email.css">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <main>
    <?php include_once("components/custom-input-root.php") ?>
                <?php
                    if(isset($_POST['send'])){ ?>
                        <div class="modal-title">
                            <h2 class="modal-title-text">Enter your <br><em>Recovery Code</em></h2>
                            <p id="email-message">The Recovery Code is sent to <br><em id="email-detail">
                                <?php echo $_POST['forgot-email'] ?> </em>
                            </p>
                        </div>
                        <form method="post">
                            <?php 
                                custom_input("text", "verification-code", "verification-code", "Verification Code", TRUE, "6");
                                custom_input_script();
                            ?>
                            <input type="text" name="email-from-send" id="email-from-send" style="display:none;" value="<?php echo $_POST['forgot-email'] ?>">
                            <div class="button txt-btn positive" id="verify-code">Verify</div>
                            <button class="button txt-btn positive hidden" id="verify-code-actual" type="submit" name="verify">Verify</button>
                        </form>
                        

                        <?php
                        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $pdoQuery = "SELECT * FROM users_tb WHERE email = '".$_POST['forgot-email']."'";
                        $pdoRes = $pdoConnect->query($pdoQuery);
                        $verCode = 0;
                        while($row = $pdoRes->fetch(PDO::FETCH_ASSOC)){
                            $verCode = (int)$row["verificationCode"];
                        }
                        $verCodeMul = $verCode * 3; ?>
                        <p class="hidden" id="verification-code-mul" style="display: none;"><?php echo $verCodeMul ?></p>
                        <div class="button txt-btn positive hidden" style="display:none;" id="send-code">Send Recovery Code</div>
                        <button class="button txt-btn positive hidden" style="display:none;" id="send-code-actual" type="submit" name="send">Send Recovery Code</button>
                        

                        <script>
                            const verCodeMul = document.querySelector("#verification-code-mul")
                            const verCode = parseInt(verCodeMul.textContent) / 3
                            const verifyBtn = document.querySelector("#verify-code")
                            const verifyBtnActual = document.querySelector("#verify-code-actual")
                            const codeInput = document.querySelector("#verification-code.modern-text-input")
                            const codeStr = verCode.toString()

                            console.log(verifyBtnActual)
                            verifyBtn.addEventListener('click', ()=>{
                                if(codeStr == codeInput.value){
                                    verifyBtnActual.click()
                                } else {
                                    showToast("Incorrect Code!", 2)
                                }
                            })
                        </script>
                        
                        
                        
                        <?php
                        
                    } elseif (isset($_POST['verify'])){ ?>
                        
                        <div class="modal-title">
                            <h2 class="modal-title-text">Create New<br><em>Password</em></h2>
                            <p id="email-message">Create new password for<em id="email-detail">
                                <?php 
                                
                                $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $pdoQuery = "SELECT * FROM users_tb WHERE email = '".$_POST['email-from-send']."'";
                                $pdoRes = $pdoConnect->query($pdoQuery);
                                $verCode = 0;
                                while($row = $pdoRes->fetch(PDO::FETCH_ASSOC)){
                                    echo " ".$row["fullname"];
                                }
                                ?> </em>
                            </p>
                        </div>
                        <form method="post">
                        <?php
                                custom_input("password", "passwordd", "passwordd", "New Password", TRUE, "100");
                                custom_input("password", "confirmpassword", "confirmpassword", "Confirm Password", TRUE, "100");
                                custom_input_script();
                                ?>
                            <input type="text" name="email-from-verify" id="email-from-verify" style="display:none;" value="<?php echo $_POST['email-from-send'] ?>">
                            <div class="button txt-btn positive" id="set-pass">Set Password</div>
                            <button class="button txt-btn positive hidden" id="set-pass-actual" type="submit" name="set-pass">Set Password</button>
                            
                        </form>
                        <script>
                            const newPass = document.querySelector("input#passwordd")
                            const conPass = document.querySelector("input#confirmpassword")
                            const setpassBtn = document.querySelector("div#set-pass")
                            const setpassBtnActual = document.querySelector("button#set-pass-actual")
                            const conPassDiv = document.querySelector(".modern-textbox.confirmpassword")
                            const conPassPH = document.querySelector(".placeholder.confirmpassword")


                            setpassBtn.addEventListener('click', ()=>{
                                if(newPass.value == conPass.value){
                                    setpassBtnActual.click()
                                }
                            })
                            conPass.addEventListener('input', ()=> {
                                if(newPass.value != conPass.value){
                                    conPassDiv.classList.add("no-content")
                                    conPassPH.textContent = "Passwords does not match"
                                }
                                else{
                                    if(conPassDiv.classList.contains("no-content")){
                                        conPassDiv.classList.remove("no-content")
                                        conPassPH.textContent = "Confirm Password"
                                    }
                                }
                                if(conPassDiv.classList.contains("no-content") && conPass.value == ""){
                                    conPassDiv.classList.remove("no-content")
                                    conPassPH.textContent = "Confirm Password"
                                }
                            })
                            newPass.addEventListener('input', ()=> {
                                if(newPass.value != conPass.value){
                                    conPassDiv.classList.add("no-content")
                                    conPassPH.textContent = "Passwords does not match"
                                }
                                else{
                                    if(conPassDiv.classList.contains("no-content")){
                                        conPassDiv.classList.remove("no-content")
                                        conPassPH.textContent = "Confirm Password"
                                    }
                                }
                                if(conPassDiv.classList.contains("no-content") && conPass.value == ""){
                                    conPassDiv.classList.remove("no-content")
                                    conPassPH.textContent = "Confirm Password"
                                }
                            })
                            
                        </script>




                        <p class="hidden" id="verification-code-mul" style="display: none;"><?php echo $verCodeMul ?></p>
                        <div class="button txt-btn positive hidden" style="display:none;" id="send-code">Send Recovery Code</div>
                        <button class="button txt-btn positive hidden" style="display:none;" id="send-code-actual" type="submit" name="send">Send Recovery Code</button>
                        <?php
                    } else { ?>
                        <div class="modal-title">
                            <h2 class="modal-title-text">Forgot<br><em>Password</em></h2>
                            <p id="email-message">Enter your account's linked email <br><em id="email-detail">
                                <?php echo $_SESSION['email'] ?> </em>
                            </p>
                        </div>
                        <form method="post">
                        <?php
                                custom_input("text", "forgot-email", "forgot-email", "Linked Email", TRUE, "100");
                                custom_input_script(); ?>
                            <div class="button txt-btn positive" id="send-code">Send Recovery Code</div>
                            <button class="button txt-btn positive hidden" id="send-code-actual" type="submit" name="send">Send Recovery Code</button>
                            
                        </form>
                        <script>

                            const emailInp = document.querySelector("input#forgot-email")
                            const emailBtn = document.querySelector("#send-code")
                            const emailBtnActual = document.querySelector("#send-code-actual")
                            const emails = document.querySelectorAll(".email-list")
                            let emaillist = []

                                    for(let i=0; i<emails.length; i++){
                                        emaillist.push(emails[i].textContent)
                                    }
                                
                            emailBtn.addEventListener('click', ()=>{
                                if(emaillist.includes(emailInp.value) || emailInp.value == ""){
                                    emailBtnActual.click()
                                }
                                else {
                                    showToast("Email not linked to any account", 2)
                                }
                            })
                        </script>
                        <?php
                    }


                ?>
<a href="login.php"><p>Go Back to Login</p></a>
<?php include_once("components/toast.php") ?>
    </main>
    
    <script src="js/forgot.js"></script>      
</body>
</html>