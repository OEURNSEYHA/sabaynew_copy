<?php
    include('../Config/Congfig.php');
    $Database = new Database;
    $Database->config();
    $cn = $Database->cn;
    $id = 0;

    $optiontbl = $_POST['tbl'];
    $tab = array("1"=>"tbl_menu","2"=>"tbl_item","3"=>"ads","4"=>"user");
    $sql    = "SELECT id FROM ".$tab[$optiontbl]." ORDER BY id DESC";
    $result =  $cn->query($sql);
    if($result-> num_rows>0){
        $row   = $result->fetch_array();
        $id = $row[0];
        
    }
    $msg['autoid'] = $id;
   
    
    echo json_encode($msg);
?>