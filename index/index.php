<?php  
include('../index/_config_inc.php');
    include('../dashboard/Config/Congfig.php');
    
    $Database = new Database;
    $Database -> config();
    $cn = $Database->cn;
    
    $BASE_URL = BASE_URL;
    $BASE_PATH = BASE_PATH;
    $mid = 0;
    $item =0;
    if(isset($_GET['mid'])){
        $mid = $_GET['mid'];
    }
    if(isset($_GET['item'])){
        $item = $_GET['item'];
    }

    
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabay News Copy</title>
    <link rel="icon" href="../dashboard/Images/logosabay.jpg">
    <link rel="stylesheet" href="../index/Style/style.css">
    <link rel="stylesheet" href="../../PHP/link/fontawesome-free-6.1.1-web/css/all.css">
    <script src="../../PHP/link/jquery.min.js"></script>
</head>

<body>
    <div class="wrappage">
        <div class="header">
            <i class="fa-solid fa-bars icon-menubar"></i>
            <div class="content-header">
                <ul>
                    <?php 
           
                         $active = '';
                         if($mid == 0){
                            $active = 'active';
                         }
                    ?>
                    <li class="<?php echo $active ?>"><a href="index.php">ទំព័រដើម</a></li>
                    <?php 
                        $sql = "SELECT id,title FROM tbl_menu WHERE status=1 ORDER BY od DESC";
                        $result = $cn->query($sql);
                        while ($row = $result->fetch_array()) {
                            if($row[0] == $mid){
                                $active = 'active';
                            }else {
                                $active = '';
                            }
                           
                            ?>
                    <li class='<?php echo  $active ?>'><a href="?mid=<?php echo $row[0] ?>">
                            <?php echo $row[1]  ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php 
        if($mid==0){
           include('../index/Page/HomePage/HomePage.php');
        }else if($mid > 0){
            if($item==0){
                include('../index/Page/Category/category.php');
            }else{
                include('../index/Page/Detail/detail.php');
            }
            
        }
        
        include(BASE_PATH.'Footer/footer.php');
    ?>
    </div>

</body>
<script>
$(document).ready(function() {
    let i = 0;

    $('.icon-menubar').click(function() {
        if (i == 0) {


            $('.content-header').css({
                'margin': '0',
                'transition': 'all 0.7s',
                'width': '100%'
            })
            i = 1;

        } else if (i == 1) {
            $('.content-header').removeAttr('style');
            i = 0;
        }
    })





})
</script>

</html>