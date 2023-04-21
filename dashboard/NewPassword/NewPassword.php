<?php

include('../Config/Congfig.php');
$Database = new Database;
$table = "user";
$msg['dpl'] =false;
$email = $_POST['useremail'];//eamil that forgot password
$Database->realescapstring($email);

$pass = mt_rand(100000, 999999);
$codeverify = mt_rand(100000,999999);
$CheckEmail =$Database-> $Database->GetCurrentData($table,"*","useremail='$email'");
if($CheckEmail == true){
    $column = "code = '$codeverify', useremail='$email'";
    $Database-> update($table, $column, $row);

    $headers = "MIME-Version: 1.0"."\r\n";
    $headers = "Content-type:text/html; charset=UTF-8"."'\r\n";
    $headers = "From: seyhaoeurn noreplaydomainname.com"."\r\n";
    $message = '<html>'.
                '<body>'.
                    '<p> We have received a request to reset your system password.</p>'.
                    '<h4>New Password: '.$pass.'</h4>'.
                    '<p> Click link below to verify your new password:</p>'.
                    '<p><a href="https://domainname.com/secondproject/dashboard/?email='.$email.'$newpass='.$pass.'$code='.$codeverify.'">
                        Click here to verify password. 
                    </a></p>'.
                '</body>'.
            '</html>';
    $subject = $pass.'is your new Password';
    if(mail($email, $subject, $message,"-f noreplaydomainname.com")){
        $msg['send']=true;
    }else{
        $msg['send']=false;
    }
    
    $msg['dpl'] = true;
}

echo  json_encode($msg);

?>