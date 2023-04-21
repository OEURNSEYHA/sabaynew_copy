<link rel="stylesheet" href="../index/Page/Detail/detail.css">
<?php
    $mid= $_GET['mid'];
    $item = $_GET['item'];
    $sql ="UPDATE tbl_item SET click = click+1 WHERE name_link = '$item' ";
    $cn->query($sql); 
    $sql="SELECT img,title,detail,date_post FROM tbl_item WHERE status=1 AND menu_id=$mid AND name_link= '$item'  ";
    $result = $cn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_array()){
            ?>
<div class=" wrappage-detail">
    <div class="content-detail-right">
        <div class="title-detail-category">
            <?php  echo $row[1]; ?>
        </div>
        <div class="date">
            <?php 
                $time = date("h:i:s a", strtotime($row[3]));
                $date = date("Y-m-d", strtotime($row[3]));
                echo $Database-> get_post_date($time,$date);
             ?>
        </div>
        <div class="line-after-title"></div>
        <?php
           
            echo $row[2];

        ?>
    </div>
</div>
<?php
}
}

?>