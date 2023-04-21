<?php
    include("../Config/Congfig.php");
    $Database  = new Database;
    $table = "tbl_menu";
    
    $id = $_POST['editid'];
    $title = trim($_POST['title']);
    // $title = $cn->real_escape_string($title);
    $column = $title;
    $title = $Database->realescapstring ($column);
    $img   = $_POST['imgmenu'];
    $od = $_POST['od'];
    $name_link = $Database->slugStr($title);
    $status = $_POST['status'];
    // $sql = "SELECT title FROM tbl_menu WHERE title = '$title' && id !=$id";
    // $result = $cn->query($sql);
    // if($result->num_rows > 0){
    //     $msg['dpl']=true;
    // }
    $column = "title";
    $row = " title = '$title' && id !=$id";
    if($Database->Duplicate($table, $column, $row) == true){
        $msg['dpl']=true;
    }
    else{
        
        if($id == 0){
           
            $value = "null,'$title','$img',$od,'$name_link',$status";
            $Database->insert($table, $value);
            
            // $sql = "INSERT INTO tbl_menu VALUES(null,'$title','$img',$od,'$name_link',$status)";
            // $cn->query($sql);
            // $autoid = $cn->insert_id;
            $msg['autoid'] = $Database->lastid; 
            $msg['edit']=false;
           
        }else{
           
            // $sql = " UPDATE `tbl_menu` SET `title`='$title',`img`='$img',`od`=$od,`name_link`='$name_link',`status`=$status WHERE `id` = $id";
            // $cn->query($sql);
          
            $column = " `title`='$title',`img`='$img',`od`=$od,`name_link`='$name_link',`status`=$status";
            $row = "`id` = $id";
            $Database->update($table, $column, $row);
            $msg['edit'] = true;
           
        }
        
    $msg['dpl'] = false;
    
    }
    
   


    echo json_encode($msg);
    
    
?>