<?php
    include('../../../dashboard/Config/Congfig.php');
    $Database = new Database;

    $cn =  $Database -> cn;

    if(isset($_POST['offset']) && isset($_POST['limit'])){
        $limit = $_POST['limit'];
        $offset = $_POST['offset'];
        $mid = $_POST['mid'];
        $sql = "SELECT img,title,detail,date_post,id,menu_id,name_link FROM tbl_item WHERE  status=1 AND menu_id= $mid LIMIT $limit,$offset";
        $result = $cn->query($sql);
        $data = array();
        if($result->num_rows > 0){ 
        while($row = $result->fetch_array()){     
            $time = date("h:i:s a",strtotime($row[3]));
            $date = date("Y-m-d",strtotime($row[3]));   
            $data[] = array(
                "img"=> $row[0],
                "title"=> $row[1],
                "detail"=> mb_substr( strip_tags($row[2]),0,100,'utf8'),
                "date_post"=>  $Database->get_post_date($time, $date), 
                "id"=> $row['4'],
                "menuid"=>$row['5'],
                "name_link" => $row['6'],
            );
}
}

}
echo  json_encode($data);
?>