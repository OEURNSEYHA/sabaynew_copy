<?php 
    $Database = new Database;
 
 ?>

<link rel="stylesheet" href="../index/Page/Category/category.css">
<div class="content-wrappage">

    <div class="content-detail">
        <div class="top-category">
            <?php  
    $sql  = "SELECT img,title,id,menu_id,name_link FROM tbl_item WHERE status=1 AND menu_id = $mid LIMIT 0,2";
    $result = $cn->query($sql);
    while($row = $result->fetch_array()){
        ?>

            <a href="index.php?mid=<?php echo $row[3]?>&item=<?php echo $row[4]; ?>" class="item-topcategory">
                <div class="box-imgtopcategory">
                    <img src="../dashboard/Images/<?php echo $row[0]?>" alt="">
                </div>
                <div class="detail-topcategory">
                    <span>
                        <?php echo mb_substr(strip_tags($row['1']),0,100) ?>
                    </span>
                </div>
            </a>

            <?php
    }
    ?>
        </div>

        <?php 
   if($mid > 0){
       $sql = "SELECT img,title,detail,date_post,id,menu_id,name_link FROM tbl_item WHERE status=1 AND menu_id=$mid LIMIT 2,3";
  }
  $result = $cn->query($sql);

    if($result->num_rows > 0){ 
    
    while($row = $result->fetch_array()){        
    ?>
        <a href="<?php BASE_PATH  ?>?mid=<?php echo $row[5] ?>&item=<?php echo $row[6] ?>">
            <div class="item-news">

                <div class="box-img">
                    <img src="../dashboard/Images/<?php echo $row[0];  ?>" alt="">
                </div>
                <div class="box-text">
                    <span class="title-detail">
                        <?php echo $row[1]; ?>
                    </span>
                    <span class="detail">
                        <?php echo mb_substr(strip_tags($row[2]), 0,100,'utf8') ?>
                    </span>
                    <span class="date">
                        <?php
                          $time = date("h:i:s a",strtotime($row[3]));
                          $date = date("Y-m-d", strtotime($row[3]));
                          echo $Database->get_post_date($time,$date);
                         ?>
                        </spn>
                </div>


            </div>
        </a>
        <?php
            }
        }
        
    ?>
        <div class="item-category">

        </div>
    </div>
    <div class=" right-content">
        right
    </div>

</div>

<script src="../../../../PHP/link/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var mid = <?php echo  $mid ?>;
    var flag = 4;
    $('.loading').hide();
    $(window).scroll(function() {
        if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
            $.ajax({
                url: '../index/Page/Category/GetDatacategory.php ',
                type: 'POST',
                data: {
                    'offset': flag,
                    'limit': 5,
                    'mid': mid,

                },
                // contentType: false,
                cache: false,
                // processData: false,
                dataType: "json",
                beforeSend: function() {
                    //work before success;
                    $('.loading').show();
                },
                success: function(data) {
                    //work after success;
                    let itemcategory = "";
                    flag += 5;
                    $('.loading').hide();
                    data.map((item, id) => {
                        itemcategory += `
                         <a class="item-news" href="index.php?mid=${item.menuid}&&item=${item.name_link}" >
                                <div class="box-img">
                                    <img src="../dashboard/Images/${item.img}" alt="">
                                </div>
                                <div class="box-text">
                                    <span class="title-detail">
                                        ${item.title}
                                    </span>
                                    <span class="detail">
                                       ${item.detail}
                                    </span>
                                    <span class="date">
                                     ${item.date_post}
                                    </span>
                                </div>
                            </a> 
                        `
                        console.log(item.img);
                    });
                    $('.item-category').html(itemcategory);
                }

            });

        }
    })

})
</script>