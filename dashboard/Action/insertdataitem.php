<?php
    include('../Config/Congfig.php');
    $Database = new Database;
    $Database->config();
    $cn = $Database->cn;
    date_default_timezone_set("Asia/Phnom_Penh");
    $id = $_POST['editid']; 
    $table  = "tbl_item";
    $menu_id = $_POST['mid'];
    $title = $_POST['title'];
    $column = $title;
    $Database->realescapstring($column);
    $detail = $_POST['detail'];
    $img = $_POST['imgitem'];
    $user_id = $_POST['userid'];
    $od = $_POST['od'];
    $date_post = date("Y-m-d  h:i:s a");
    $click = 1;
    $name_link = $Database->slugStr($title);
    $status = $_POST['status'];
    
    // $sql = "SELECT title FROM tbl_item WHERE title = '$title' && id != $id";
    // $result = $cn->query($sql);
    // if($result->num_rows > 0){
    //     $msg['dpl']=true;
    // }
    
    $column = "title";
    $row = "title = '$title' && id != $id";
    if( $Database->Duplicate($table,$column,$row) == true){
        $msg['dpl']=true;
    }
    else{
        if($id == 0){
           
            // $sql = "INSERT INTO tbl_item VALUES(null,$menu_id,'$title','$detail','$img',$user_id,$od,'$date_post',$click,'$name_link',$status)";
            // $cn->query($sql);
            
            $value = "null,$menu_id,'$title','$detail','$img',$user_id,$od,'$date_post',$click,'$name_link',$status";
            $Database->insert($table,$value);
            $msg['view']= $click;
            $msg['date']=$date_post;
            $autoid =  $cn->insert_id;
            $msg['autoid'] = $autoid;
            $msg['edit']=false;
            
        }else{
            
        //    $sql = "UPDATE `tbl_item` SET `menu_id`=$menu_id ,`title`='$title',`detail`='$detail',`img`='$img',`user_id`=$user_id,`od`= $od,`date_post`='$date_post',`click`=$click,`name_link`='$name_link',`status`=$status WHERE `id`=$id";
        //    $cn->query($sql);
        
            $column = " `menu_id`=$menu_id ,`title`='$title',`detail`='$detail',`img`='$img',`user_id`=$user_id,`od`= $od,`date_post`='$date_post',`click`=$click,`name_link`='$name_link',`status`=$status";
            $row = "`id`=$id";
            $Database->update($table, $column, $row);
            $msg['edit'] = true;
            
        }
        $msg['dpl']=false;
    }
    
   

    echo json_encode($msg);

?>