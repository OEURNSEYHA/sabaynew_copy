<?php
    date_default_timezone_set("Asia/Phnom_Penh");
    include('../Config/Congfig.php');
    $Database = new Database;
    // $cn = $Database->cn;

    
    
    $id = $_POST['editid'];
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userpass = $_POST['userpass'];
    $userpass = md5($userpass);
    $userpass = password_hash($userpass, PASSWORD_DEFAULT);
  
    $usertype = $_POST['usertype'];
    $status = $_POST['status'];
    $userip =  $_SERVER['REMOTE_ADDR'];  
    $code = 34567890;
    $timelogin = date('Y-m-d h:i:s a');
    $img= $_POST['imguser'];
    $msg['img']=$img;
    $msg['userip'] =   $userip ;
    $msg['code'] = $code;
    $msg['date'] = $timelogin;
    $msg['userpass'] = $userpass;
    $table = "user";
    
    // $sql = "INSERT INTO user VALUES(null,'$username','$useremail','$userpass','$usertype','$userip',$code,$status,'$timelogin')";
    // $cn->query($sql);
    
    $column = "useremail";
    
    $row = " useremail = '$useremail' && id != $id ";
    
    if($Database->Duplicate($table, $column,$row) == true){
        
        $msg['dpl'] = true;
        
    }else{
        
        if($id==0){
            
            $msg['edit']=false;
            $value = "null,'$username','$useremail','$userpass','$usertype','$userip',$code,$status,'$timelogin','$img'";
            $Database ->insert($table,$value);
            
        }
        
        else{
            
            $msg['edit']=true;  
            $row = "`id` = $id";
            $column = "`username`='$username',`useremail`='$useremail',`userpass`='$userpass',`usertype`='$usertype',`userip`='$userip',`code`=$code,`status`= $status,`timelogin`='$timelogin',`img`='$img'";
            $Database->update($table, $column, $row);
            
        }
        
        $msg['dpl']=false;
       
    }
   
    
    // $column = "useremail";
    // $row= "useremail = '$useremail' AND id != $id";
    // if($Database-> Duplicate($table. $column, $row) == true){
    //     $msg['dpl'] = true; 
    // }else{
    //     if($id == 0){
    //         $value = "null,'$username','$useremail','$userpass','$usertype','$userip',$code, $status, '$timelogin'";
    //         $msg['edit'] = false;
    //         $Database->insert($table,$value);
    //     }else{
    //         $Database->update($table, $column, $row);
    //         $msg['edit']=true;
    //     }
    //     $msg['dpl'] = false;
    // }

    echo json_encode($msg);
    
?>