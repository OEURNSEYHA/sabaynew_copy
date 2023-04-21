<?php 
    include('../Config/Congfig.php');
    $Database = new Database;
    $Database-> config();
    $cn = $Database->cn;
    $id = $_POST['id'];
    
    $sql = "SELECT detail FROM tbl_item WHERE id=$id";
    $result = $cn->query($sql);
    $row = $result->fetch_array();

    $msg['detailedit'] =$row[0];
    
    echo  json_encode($msg);
    
?>