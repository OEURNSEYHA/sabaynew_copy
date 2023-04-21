<?php
    include('../Config/Congfig.php');
    $Database = new Database;
    // $Database -> config();
    // $cn = $Database-> cn;
    $table = "ads";
    $id = $_POST['editid'];
    $url = $_POST['url'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $img = $_POST['imgads'];
   
    if($id==0){
        //insert to database;
        $value = "null,'$url','$img',$type,$status";
        $Database->insert($table,$value);
        $msg['autoid']  = $Database->lastid;
        $msg['edit']=false;
       
    }else{
        //update data;
         // $sql = " UPDATE `tbl_menu` SET `title`='$title',`img`='$img',`od`=$od,`name_link`='$name_link',`status`=$status WHERE `id` = $id";
        $column = "`url`='$url', `img`='$img', `type`= $type, `status`=$status";
        $row = "`id` = $id";
        $Database -> update($table, $column, $row); 
        $msg['edit']= true;
    }

    echo json_encode($msg);
    
    
?>