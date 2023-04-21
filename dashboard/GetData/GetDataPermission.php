<?php

include('../Config/Congfig.php');
$Database = new Database;
$uid = $_POST['uid'];
$table = "permission";  
$start = 0;
$end = 100;
$column1 = "*";
$column2 = "id";
// $condition = ;
$GetData = $Database->GetData($table,$column1,$column2 ,$start,$end,"uid=$uid");
$data = array();

if($GetData !='0'){
    foreach($GetData as $row){
        $data[] = array(
            "mid" => $row[2],
            "aid" => $row[3],
        );
    }
}

echo  json_encode($data);

?>