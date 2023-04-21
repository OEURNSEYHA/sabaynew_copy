<?php
    include('../Config/Congfig.php');

    $Database = new Database;
    $cn = $Database->cn;
    $start = $_POST['start'];
    $end = $_POST['end'];
    $searchopt = $_POST['search'];
    $valuesearch = $_POST['searchtxt'];
    $filtersearchval = $_POST['filtersearch'];
    $table = 'ads';
    $column1 = "*";
    $column2 = "id";
    $condition = "id>0"; 
    
    $rowcount = $Database-> countdata($table, $condition);
    if($searchopt == 0){
        $GetData = $Database -> GetData($table,$column1,$column2,$start,$end,$condition);
        
    }else{
        if($searchopt === 'id'  || $searchopt ==='status'){
            
            $condition = "$filtersearchval = '$valuesearch'";
            $GetData = $Database-> GetData($table,$column1,$column2,$start,$end,$condition);
            $rowcount = $Database->countdata($table, $condition);
            
        }else{
            
            $condition = "$filtersearchval LIKE '%$valuesearch%'";
            $GetData = $Database-> GetData($table,$column1,$column2,$start,$end,$condition);
            $rowcount = $Database -> countdata($table, $condition);
        }
    }

    $data = array();
    if($GetData != '0'){
        foreach($GetData as $row){
            $data[] = array(
                "id" => $row[0],
                "url"=> htmlspecialchars( $row[1]),
                "img"=> $row[2],
                "type"=>$row[3],
                "status"=>$row[4],
                "total" => $rowcount,
            );
        }
    }

    echo json_encode($data);
?>