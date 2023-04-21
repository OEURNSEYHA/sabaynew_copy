<?php
    include('../Config/Congfig.php');
  
    $Database = new Database;
    $Database->config();
    $cn = $Database->cn;
    $table = "tbl_item";
    $start = $_POST['start'];
    $end = $_POST['end'];
    $searchopt = $_POST['search'];
    $valuesearch= $_POST['searchtxt'];
    $filtersearchval = $_POST['filtersearch'];
    
    // $totalsql = "SELECT COUNT(*) AS total FROM tbl_item";
    // $resultcount = $cn->query($totalsql);
    // $rowcount = $resultcount ->fetch_array();
    
    $condition = "id>0";
    $rowcount = $Database->countdata($table, $condition);
    
    if($searchopt == 0){
        
        // $sql = "SELECT  tbl_item.*, tbl_menu.id, tbl_menu.title FROM tbl_item INNER JOIN tbl_menu ON
        //                 tbl_item.menu_id = tbl_menu.id ORDER BY tbl_item.id DESC  LIMIT $start,$end";
                        
        $table = "tbl_item INNER JOIN tbl_menu ON tbl_item.menu_id = tbl_menu.id";
        $column1 = " tbl_item.*, tbl_menu.id, tbl_menu.title";
        $column2 = "tbl_item.id ";
        $condition = "tbl_item.id > 0 AND tbl_menu.id > 0";
        $GetData = $Database->GetData($table,$column1,$column2,$start,$end,$condition);
        
    }else if ($searchopt == 1){
        
        if($filtersearchval === "id" || $filtersearchval === "status"){   
            
            // $sql = "SELECT  tbl_item.*, tbl_menu.id, tbl_menu.title FROM tbl_item INNER JOIN tbl_menu ON
            //                 tbl_item.menu_id = tbl_menu.id WHERE tbl_item.$filtersearchval = '$valuesearch' ORDER BY tbl_item.id DESC  LIMIT $start,$end";                
            // $totalsql = "SELECT COUNT(*) AS total FROM tbl_item WHERE";
            // $resultcount = $cn->query($totalsql);
            // $rowcount = $resultcount->fetch_array();
            
            $table = "tbl_item INNER JOIN tbl_menu ON tbl_item.menu_id = tbl_menu.id";
            $condition = " tbl_item.$filtersearchval = '$valuesearch'";
            $column1 = " tbl_item.*, tbl_menu.id, tbl_menu.title ";
            $column2 = "tbl_item.id";
            $GetData = $Database->Getdata($table,$column1,$column2,$start,$end,$condition);
            $rowcount = $Database-> countdata($table, $condition);
            
            
        }else{
            
            // $sql = "SELECT  tbl_item.*, tbl_menu.id, tbl_menu.title FROM tbl_item INNER JOIN tbl_menu ON
            //                 tbl_item.menu_id = tbl_menu.id WHERE tbl_item.$filtersearchval LIKE '%$valuesearch%' ORDER BY tbl_item.id DESC  LIMIT $start,$end";
                            
            // $totalsql = "SELECT COUNT(*) AS total FROM tbl_item WHERE $filtersearchval LIKE '%$valuesearch%' ";
            // $resultcount = $cn->query($totalsql);
            // $rowcount = $resultcount->fetch_array();
           
            $table = "tbl_item INNER JOIN tbl_menu ON tbl_item.menu_id = tbl_menu.id";
            $condition = "$filtersearchval LIKE '%$valuesearch%'";
            $column1 = " tbl_item.*, tbl_menu.id, tbl_menu.title ";
            $column2 = "tbl_item.id";
            $GetData = $Database->Getdata($table,$column1,$column2,$start,$end,$condition);
            $rowcount = $Database->countdata($table, $condition);
            
        }
        
    }
  
    $data= array();
    // $result = $cn->query($sql);
    if($GetData !='0'){
        foreach($GetData as $row){
            $data [] = array(
                "id"=>  $row[0],
                "menu_id"=>  $row[11],
                "menutitle" => $row[12],
                "title"=>  $row[2],
                "detail"=>  $row[3],
                "img"=>  $row[4],
                "user_id"=>  $row[5],
                "od"=>  $row[6],
                "date_post"=>  $row[7],
                "click"=>  $row[8],
                "name_link"=>  $row[9],
                "status"=>  $row[10],
                "total"=> $rowcount,
            );
        }
    }
   
     
     echo json_encode($data);

?>