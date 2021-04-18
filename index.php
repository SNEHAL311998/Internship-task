<?php


require_once 'config.php
$loginUrl = $google_client->createAuthUrl();

$login_attempts = 0;

if(isset($_SESSION["locked"])){
    $difference = time() - $_SESSION["locked"];
    if($difference > 10){
        unset($_SESSION["locked"]);
        $login_attempts = 0;
    }
}

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $login_attempts = $_POST["hidden"];
        $conn = mysqli_connect("localhost:3303", "","","");
        $query = "select * from logininfo where username = '$username' and password = '$password'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
            if($count >0){
                header('Location: home1.php');
            }
            else{
                $login_attempts++;
                $_SESSION["error"] = "User not found, Number of attempts is .$login_attempts.";
            }
    }
?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Login</title>
</head>

<body>

    <!-- Login start -->

    <section class="form ">
        <div class="container">
            <div class="row no-gutters">
                <div class="login">
                    <h1>Login</h1>

                    <?php if (isset($_SESSION["error"])) { ?>
                        <p style="color:red"><?= $_SESSION["error"]; ?></p>
                   <?php unset($_SESSION["error"]); 
                } ?>

                </div>
                <div class="col-lg-5 ">
                    <img src="./images/login-img.png" alt="login-image" class="img-fluid image1">
                </div>
                <div class="col-lg-7 column-2">
                    <form action="" method="post">
                        <div class="form-group">
                        <?php
                            echo "<input type='hidden' name = 'hidden' value ='".$login_attempts."'>";
                        ?>
                            <div class="col-lg-7">
                                <input type="text" name="username" placeholder="username" class="form-control my-3 p-4">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-7">
                                <input type="password" name="password" placeholder="Password" class="form-control my-3 p-4 ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-7 btn-1">

                                <?php 
                                
                                    if($login_attempts > 2){
                                        $_SESSION["locked"] = time();
                                       echo "<script>alert('Please wait for 30 seconds')</script> ";
                                    }
                                    else{
                                ?>
                                <button type="submit" class="btn1">Login</button>
                            <?php }?>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-7 btn-1">
                                <button type="button" class="btn1" style="width: 200px;" onClick = "window.location = '<?php echo $loginUrl?>';">Login via
                                    <span style="color: #4285F4;">G</span><span style="color: #EA4335;">o</span><span
                                        style="color: #FBBC05;">o</span><span style="color: #4285F4;">g</span><span
                                        style="color: #34A853;">l</span><span style="color: #EA4334;">e</span>  </button>
                            </div>
                        </div>
                        <div class="form-row">
                            <a href="forgotpass.php">Forgot Password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Login end -->

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
