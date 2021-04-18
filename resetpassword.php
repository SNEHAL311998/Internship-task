<?php
include("fpassconfig.php");

if(!isset($_GET["code"])){
    exit("cant find Page");
}

$code = $_GET["code"];

$getemailquery = mysqli_query($conn , "SELECT email FROM resetpassword WHERE code='$code'");
if(mysqli_num_rows($getemailquery)==0){
    echo"<script>alert('Incorrect code')</script>";
}

if(isset($_POST["password"])){
    $pw = $_POST["password"];
    $row = mysqli_fetch_array($getemailquery);
    $email = $row["email"];

    $query = mysqli_query($conn,"UPDATE logininfo SET password='$pw' WHERE email = '$email'");

    if($query){
        $query = mysqli_query($conn,"DELETE FROM resetpassword WHERE code='$code'");
        echo'<script>alert("Password Updated")</script>';
        exit();
    }
    else{
        echo'<script>alert("Something went wrong!!")</script>';
    }
}
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

    <title>Reset Password</title>
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
            style="box-shadow:0 10px 10px rgba(0,0,0,0.1);width:500px;height:400px;background:white;border-radius:25px;padding:25px">
            <h1 style='color:#09d69c;text-align:center;margin-top:50px'>Reset Password</h1>
            <div class="form-group">

                <input type="password" name="password" placeholder="Password" class="form-control my-3 p-4 "
                    style="border-radius: 25px;">
                

            </div>
            <div class="form-group">
           
            
                <div class="col-lg-7 btn-1" >
                    <button type="submit" class="btn"
                        style="width: 200px;margin-left: 110px; background: #09d69c;color: white; border-radius: 15px;">Submit</button>
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