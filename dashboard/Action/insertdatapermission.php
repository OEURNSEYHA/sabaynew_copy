<?php
    include('../Config/Congfig.php');

    $Database = new Database;
    $table = "permission";
    $uid = $_POST['uid'];
    $mid = $_POST['mid'];
    $aid = $_POST['aid'];
    $msg['edit']= false;

    $row = "uid = $uid && mid = $mid";
    $Duplicate = $Database->Duplicate($table,"*",$row);
    if($Duplicate == false){
        $value = "null,$uid,$mid,$aid";
        $Database->insert($table,$value);
    }else{
        $column = "aid = $aid";
        $Database->update($table, $column, $row);
        
        $msg['edit']=true;
    }

    echo json_encode($msg);
?>