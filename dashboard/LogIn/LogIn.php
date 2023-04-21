<?php
 include('../Config/Congfig.php');
    date_default_timezone_set("Asia/Phnom_Penh");
//    session_end();
    session_start();
    $_SESSION['login']=false;
    $Database = new Database;
    $cn = $Database->cn;
    $email = $_POST['useremail'];
    $email = $Database-> realescapstring ($email);
    $pass  = $_POST['userpass'];
    $pass  = $Database-> realescapstring ($pass);
    $pass  = md5($pass);
 
    
    $userip = $_SERVER['REMOTE_ADDR'];
    $timelogin = date('Y-m-d h:i:s ');
    $table = "user";
    $column = "*";
    $row = "useremail ='$email'";
    $CheckEmail = $Database->Duplicate($table,$column,$row);
    $msg['checkemail']=false;
    $msg['checkpass']=false;
    
    if($CheckEmail == true){
   
        $CurrentData = $Database->GetCurrentData($table,"*","useremail='$email'");
        $msg['checkemail']=true;
        if(password_verify($pass, $CurrentData[3])){
            $msg['checkpass'] = true;
            $column = "userip='$userip', timelogin='$timelogin'";
            $Database-> update($table, $column, $row);
            $_SESSION['login']=true;
            $_SESSION['id']=$CurrentData[0];
            $_SESSION['useremail']=$email;
            $_SESSION['usertype']=$CurrentData[4];
        }
    }

    echo json_encode($msg);

?>