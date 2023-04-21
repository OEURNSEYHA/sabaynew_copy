<?php
include('../Config/Congfig.php');
$Database = new Database;
// $Database->config();
// $cn = $Database->cn;
$table = "tbl_menu";
$column1 = "*";
$column2 = "id";

$start = $_POST['start'];
$end = $_POST['end'];
// $totalsql = "SELECT COUNT(*) AS total FROM tbl_menu";
// $resultcount = $cn->query($totalsql);
// $rowcount = $resultcount->fetch_array();
$condition = "id > 0";
$rowcount = $Database->countdata($table, $condition);
$searchopt = $_POST['search'];
$valuesearch= $_POST['searchtxt'];
$filtersearchval = $_POST['filtersearch'];
//  -- for test execute data json---
//    $sql = "SELECT * FROM tbl_menu ORDER BY id DESC";  
    $data = array();
    if($searchopt == 0){
        // $sql = "SELECT * FROM tbl_menu ORDER BY id DESC LIMIT $start,$end";
        // $condition = "status = 1";
        // $start = $start;
        // $end = $end;
        $GetData = $Database-> GetData($table,$column1,$column2,$start,$end,"id > 0");
    }else{
        if($filtersearchval === 'id' || $filtersearchval==='status'){  
            // $sql = "SELECT * FROM tbl_menu WHERE $filtersearchval = '$valuesearch'  ORDER BY id DESC LIMIT $start,$end ";
            // $totalsql = "SELECT COUNT(*) AS total FROM tbl_menu WHERE $filtersearchval = '$valuesearch'";
            // $resultcount = $cn->query($totalsql);
            // $rowcount = $resultcount->fetch_array();
          
            $condition = "$filtersearchval = '$valuesearch'";
            $GetData = $Database-> GetData($table,$column1,$column2,$start,$end,$condition);
            $rowcount = $Database->countdata($table, $condition);
            
            
        }else{
            // $sql = "SELECT * FROM tbl_menu WHERE $filtersearchval LIKE '%$valuesearch%'  ORDER BY id DESC LIMIT $start,$end ";
            // $totalsql = "SELECT COUNT(*) AS total FROM tbl_menu WHERE $filtersearchval LIKE '%$valuesearch%' ";
            // $resultcount = $cn->query($totalsql);
            // $rowcount = $resultcount->fetch_array();
            
            $condition = "$filtersearchval LIKE '%$valuesearch%'";
            $GetData = $Database->GetData($table,$column1,$column2,$start,$end,$condition);
            $rowcount = $Database->countdata($table, $condition);
            
        }
        
        
    }
  
        // $result = $cn->query($sql);
        if($GetData != '0'){
          foreach($GetData as $row){
            $data[] = array(
                        "id"=>$row[0],
                        "title" => $row[1],
                        "img"=> $row[2],
                        "od"=> $row[3],
                        "name_link"=> $row[4],
                        "status"=> $row[5],
                        "total"=> $rowcount, 
                    );
          }
        }
        
        // while($row = $result->fetch_array()){
        //     $data[] = array(
        //         "id"=>$row[0],
        //         "title" => $row[1],
        //         "img"=> $row[2],
        //         "od"=> $row[3],
        //         "name_link"=> $row[4],
        //         "status"=> $row[5],
        //         "total"=> $rowcount,
        //     );
        // }
    
    

echo json_encode($data);


?>