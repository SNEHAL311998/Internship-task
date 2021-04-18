<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'fpassconfig.php';

if(isset($_POST["email"])){

    $emailto = $_POST["email"];
    $code = uniqid(true);
    $query = mysqli_query($conn,"INSERT INTO resetpassword(code,email) VALUES ('$code','$emailto')") ;
    if(!$query){
        exit("Error");
    }

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'snehal311998@gmail.com';                     //SMTP username
        $mail->Password   = 'hydralex990';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('snehal311998@gmail.com', 'Snehal');
        $mail->addAddress($emailto);     //Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'No-Reply');


        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetpassword.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Recovery';
        $mail->Body    = "<h1>Follow this <a href='$url'>link</a> to reset password $code</h1>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo '<script>alert("Resest password has been sent to your email")</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
}

//Instantiation and passing `true` enables exceptions

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Forgot Password</title>
</head>

<body style="background:#e0e0e0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand h1" href="#">Home Page</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link p-3" style="font-size:20px" href="#">Home <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-3" style="font-size:20px" href="index.php">Login</a>
                </li>

            </ul>

        </div>
    </nav>

    <header class="header" style="display:flex;justify-content:center;align-items:center;margin-top:100px;">
    <form method="POST">
        <div class="content"
            style="box-shadow:0 10px 10px rgba(0,0,0,0.1);width:500px;height:300px;background:white;border-radius:25px;padding:25px">
            <h1 style='color:#09d69c;text-align:center;margin-top:50px'>OTP Generation</h1>
            <div class="form-group">

                <input type="email" name="email" placeholder="Email" class="form-control my-3 p-4 "
                    style="border-radius: 25px;">
                <p style="text-align: center;">An OTP will be sent to your email.</p>

            </div>
            <div class="form-group">
           
            
                <div class="col-lg-7 btn-1" >
                    <button type="submit" class="btn"
                        style="width: 200px;margin-left: 110px; background: #09d69c;color: white; border-radius: 15px;">Send Mail</button>
                </div>
            </form>
            </div>
        </div>
    </header>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>
</body>

</html>