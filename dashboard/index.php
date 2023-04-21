<?php 
    session_start();
    session_destroy();
    include('../dashboard/Config/Congfig.php');
    $Database= new Database; 
    if(isset($_GET['newpass'])){
        $table = "user";
        $newPass = $_GET['newpass'];
        $newPass = md5($newPass);
        $newPass = password_get_info($newPass, PASSWORD_DEFAULT);
        $code = $_GET['code'];
        $email = $_GET['email'];
        $row = "useremail ='$email'";
        $CheckEmail = $Database->Duplicate($table,"*",$row);
        if($CheckEmail == true){
            $column = "pass='$newpass', useremail='$email'";
            $Database-> update($table, $column, $row);
            echo  "<script> alert('hello');</script>";
        }else{
            echo "<script> alert('Please try again');</script>";
        }
    }
   

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/index.css">
    <script src="../../Php1/link/jquery.min.js" />rc=""></script>
</head>

<body>

    <div class="wrappage">
        <div class="wrappage-left">
            <div class="top-wrappage-left">
                <span> ADMN PANEL</span>
            </div>
            <form class="admin">

                <input type="email" name="email" id="email" placeholder="Email"><br>
                <input type="password" name="password" id="password" placeholder="Password"><br>
                <div class="box-option">
                    <div class="reset-password">
                        <span>Don't have password ? </span>
                    </div>
                    <div class="btn-login">
                        <span>LOGIN</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="wrappage-right">
            <span>WELCOME TO MY SYSTEM</span>
            <img src="../dashboard/Images/MyPhoto.jpg" alt="">
        </div>
    </div>
</body>
<script src="../dashboard/js/index.js"></script>

</html>