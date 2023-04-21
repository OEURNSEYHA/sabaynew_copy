<?php
    $Database = new Database;
?>
<link rel="stylesheet" href="../index/Page/HomePage/HomePage.css">
<div class="wrappage-home">

    <div class="top-category">
        <!-- left -->
        <div class="wrappage-home-left">
            <div class="category-homepage">
                <div class="category-left">
                    <?php  
                    $sql = "SELECT title,detail,img,date_post,id,menu_id,name_link FROM tbl_item WHERE status = 1 AND menu_id = 1 ORDER BY id DESC LIMIT 0,2";
                    $result = $cn->query($sql);
                    if($result->num_rows > 0){
                       while($row = $result->fetch_array()){
                       ?>
                    <a href="index.php?mid=<?php echo $row[5] ?>&&item=<?php echo  $row[6]  ?>" class="category1">
                        <div class="box-imgcategory1">
                            <div class="name-category">
                                <span>
                                    កីឡា
                                </span>
                            </div>
                            <img src="../dashboard/Images/<?php echo $row[2]  ?>" alt="">
                            <div class="background-hover">
                                <div class="detail-category1">
                                    <div class="text-detail-category1">
                                        <span class="big-detail">
                                            <span>
                                                <?php echo $row[0] ?>
                                            </span>
                                        </span><br>

                                        <span class="small-detail">
                                            <span>
                                                <?php echo  $row[1] ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="date-category1">
                                        <span>
                                            <?php 
                                            // $originalDate = "2023-02-13";
                                            
                                            $date = date("Y-m-d",strtotime($row[3]));
                                            $time = date("h:i:s a",strtotime($row[3]));
                                             echo  $Database -> get_post_date($time, $date);
                                             ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </a>

                    <?php
                       }
                    }
                ?>
                </div>

                <div class="category-right">
                    <?php 
                    $sql = "SELECT title,detail,img,date_post,id,menu_id,name_link FROM tbl_item WHERE status= 1 AND menu_id=2 ORDER BY id DESC LIMIT 0,2";
                    
                    $result = $cn->query($sql);
                    if($result->num_rows>0){
                        while($row = $result->fetch_array()){
                           ?>
                    <a href="index.php?mid=<?php echo $row[5] ?>&&item=<?php echo $row[6] ?>" class="category2">
                        <div class="box-imgcategory2">
                            <div class="name-category">
                                <span>
                                    បច្ចេកវិទ្យា
                                </span>
                            </div>
                            <img src="../dashboard/Images/<?php echo $row[2] ?>" alt="">
                            <div class="background-hover">
                                <div class="detail-category2">
                                    <div class="text-detail-category2">
                                        <span class="big-detail">
                                            <span>
                                                <?php  echo $row[0] ?>
                                            </span>
                                        </span><br>

                                        <span class="small-detail">
                                            <span>
                                                <?php  echo $row[1] ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="date-category1">
                                        <span>
                                            <?php  
                                            $date = date("Y-m-d", strtotime($row[3]));
                                            $time = date("h:i:s a", strtotime($row[3]));
                                            echo $Database->get_post_date($time,$date);
                                             ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                }
                ?>

                </div>

            </div>
        </div>

        <!-- right -->
        <div class="wrappage-home-right">
            <?php
        $cn = $Database->cn;

        $sql = "SELECT img FROM ads WHERE id BETWEEN 1 AND 2  AND status = 1";
        $result = $cn->query($sql);
      
            while($row = $result->fetch_array()){
                ?>

            <div class="box-ads">
                <img src="../dashboard/Images/<?php echo $row[0] ?>" alt="">
            </div>

            <?php
            }
        


?>


        </div>
    </div>

    <div class="category-komsan">
        <div class="name-categorykomsan-home">
            <span>​កម្សាន្ត​</span>
            <a href="index.php?mid=3" class="btnsee-more"> See More</a>
        </div>
        <div class="item-categorykomsan-home">
            <?php 
                $sql = "SELECT title,img,date_post,click,id,menu_id,name_link FROM tbl_item WHERE status=1 AND menu_id = 3 ORDER BY id DESC LIMIT 0,3 ";
                $result = $cn->query($sql);
                if($result -> num_rows > 0){
                    while($row = $result->fetch_array()){
                        ?>

            <a href="index.php?mid=<?php echo $row[5] ?>&&item=<?php echo $row[6] ?>" class="box-item-categorykomsan">
                <div class="box-imgitemkomsan">
                    <img src="../dashboard/Images/<?php echo $row[1] ?>" alt="">
                </div>
                <div class="box-desckomsan">
                    <div class="text-desckomsan">
                        <span>
                            <?php echo  $row[0]  ?>
                        </span>
                    </div>
                    <div class="date-veiwkomsan">
                        <span class="datekomsan">
                            <i class="fa-solid fa-calendar-days"> </i>
                            <span>
                                <?php 
                                    $date = date("Y-m-d", strtotime($row[2]));
                                    $time = date("h:i:s a", strtotime($row[2]));
                                    echo $Database->get_post_date($time,$date);
                                ?>
                            </span>
                        </span>
                        <span class="veiwkomsan"><i class="fa-regular fa-eye"></i>
                            <span><?php echo $row[3] ?> </span>
                        </span>
                    </div>
                </div>

            </a>
            <?php
                    }
                }
        ?>
        </div>





    </div>

    <div class="category-komsan">
        <div class="name-categorykomsan-home">
            <span>​​បច្ចេកវិទ្យា​</span>
            <a href="index.php?mid=2" class="btnsee-more"> See More</a>
        </div>
        <div class="item-categorykomsan-home">
            <?php 
                $sql = "SELECT title,img,date_post,click,id,menu_id,name_link FROM tbl_item WHERE status=1 AND menu_id = 2 ORDER BY id DESC LIMIT 0,3 ";
                $result = $cn->query($sql);
                if($result -> num_rows > 0){
                    while($row = $result->fetch_array()){
                        ?>

            <a href="index.php?mid=<?php echo $row[5] ?>&&item=<?php echo $row[6] ?>" class="box-item-categorykomsan">
                <div class="box-imgitemkomsan">
                    <img src="../dashboard/Images/<?php echo $row[1] ?>" alt="">
                </div>
                <div class="box-desckomsan">
                    <div class="text-desckomsan">
                        <span>
                            <?php echo  $row[0]  ?>
                        </span>
                    </div>
                    <div class="date-veiwkomsan">
                        <span class="datekomsan">
                            <i class="fa-solid fa-calendar-days"> </i>
                            <span>
                                <?php 
                                    $date = date("Y-m-d", strtotime($row[2]));
                                    $time = date("h:i:s a", strtotime($row[2]));
                                    echo $Database->get_post_date($time,$date);
                                ?>
                            </span>
                        </span>
                        <span class="veiwkomsan"><i class="fa-regular fa-eye"></i>
                            <span><?php echo $row[3] ?> </span>
                        </span>
                    </div>
                </div>

            </a>
            <?php
                    }
                }
        ?>
        </div>





    </div>

    <div class="category-komsan">
        <div class="name-categorykomsan-home">
            <span>​​កីឡា​</span>
            <a href="index.php?mid=1" class="btnsee-more"> See More</a>
        </div>
        <div class="item-categorykomsan-home">
            <?php 
                $sql = "SELECT title,img,date_post,click,id,menu_id,name_link FROM tbl_item WHERE status=1 AND menu_id = 1 ORDER BY id DESC LIMIT 0,3 ";
                $result = $cn->query($sql);
                if($result -> num_rows > 0){
                    while($row = $result->fetch_array()){
                        ?>

            <a href="index.php?mid=<?php echo $row[5] ?>&&item=<?php echo $row[6] ?>" class="box-item-categorykomsan">
                <div class="box-imgitemkomsan">
                    <img src="../dashboard/Images/<?php echo $row[1] ?>" alt="">
                </div>
                <div class="box-desckomsan">
                    <div class="text-desckomsan">
                        <span>
                            <?php echo  $row[0]  ?>
                        </span>
                    </div>
                    <div class="date-veiwkomsan">
                        <span class="datekomsan">
                            <i class="fa-solid fa-calendar-days"> </i>
                            <span>
                                <?php 
                                $date = date("Y-m-d", strtotime($row[2]));
                                $time = date("h:i:s a", strtotime($row[2]));
                                echo $Database->get_post_date($time,$date);
                                ?>
                            </span>
                        </span>
                        <span class="veiwkomsan"><i class="fa-regular fa-eye"></i>
                            <span><?php echo $row[3] ?> </span>
                        </span>
                    </div>
                </div>

            </a>
            <?php
                    }
                }
        ?>
        </div>





    </div>
</div>

</div>