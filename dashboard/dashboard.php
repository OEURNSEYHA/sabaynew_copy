<?php 
    include('../dashboard/Config/Congfig.php');
    $Database = new Database;
    $table = "user";
    session_start();
    
    if(!isset($_SESSION['login']) || $_SESSION['login'] == false){
        header('Location:http://localhost/secondProject/index/');
    }

  
        
   

    $userip = $_SERVER['REMOTE_ADDR'];
    $email = $_SESSION['useremail'];
    
    $CurrentData = $Database->GetCurrentData($table,"*","useremail='$email'");
    
    if($CurrentData == '0'){
        header('Location:http://localhost/secondProject/index');
    }else{
        if($userip != $CurrentData[5]){
            header('Location:http://localhost/secondProject/index/');
        }
    }

    $userid = $CurrentData[0];
    $username = $CurrentData[1];
    $usertype = $CurrentData[4];
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../dashboard/style/dashboard.css">
    <!-- <link rel="stylesheet" href="../dashboard/FormAds/FormAds.css"> -->
    <link rel="stylesheet" href="../../PHP/link/fontawesome-free-6.1.1-web/css/all.css">
    <script src="../../PHP/link/jquery.min.js"></script>
    <script src="../dashboard/tinymce/js/tinymce/tinymce.min.js"></script>
    <link rel="stylesheet" href="../dashboard/FormUser/FormUser.css">
</head>
<link rel="stylesheet" href="../dashboard/Action">

<body>
    <div class="wrappage">
        <!-- side bar  -->
        <div class="side-bar">
            <div class="header-sidebar">
                <span>Dashboard</span>
            </div>
            <?php
                include('../dashboard/Menu/Menu.php');
            ?>
        </div>
        <!--content page  -->
        <div class=" content-dashboard">
            <!-- header -->
            <div class="header">
                <div class="box-menubar">
                    <i class="fa-solid fa-bars icon-menubar"></i>
                    <span>Project video 81</span>


                </div>
                <div class="box-search">
                    <input type="text" name="search" id="search" placeholder="Search">
                    <select name="filtersearch" id="filtersearch">

                    </select>
                    <div class="iconsearch">
                        <i class="fa-solid fa-magnifying-glass "></i>
                    </div>
                </div>
                <div class="setting">
                    <input type="text" name="iduser" id="iduser" value="<?php echo  $userid?>" hidden>


                    <div class="admin">
                        <img src="../dashboard/Images/<?php echo $CurrentData[9]  ?>" alt="">
                        <div class="subprofile">
                            <div class="profile">
                                <img src="../dashboard/Images/<?php echo $CurrentData[9] ?>" alt="">
                            </div>
                            <div class="name-email">
                                <span><?php echo $username;   ?></span>
                                <span><?php  echo $email;  ?></span>
                            </div>
                            <!-- <div class="line"></div> -->
                            <a href="http://localhost/SecondProject/dashboard/" class="btn-logout">LOG OUT</a>
                            <div class="line"></div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content information -->
            <div class="content-information">
                <div class="bar-content-information">
                    <div class="btn-add">
                        <span>ADD</span>
                    </div>
                    <div class="option-show-data">
                        <select name="option-show" id="option-show" class="option-show ">
                            <option value="3"> 3</option>
                            <option value="5"> 5</option>
                            <option value="10"> 10 </option>
                            <option value="20"> 20 </option>
                            <option value="100"> 100 </option>
                        </select>
                        <div class="slide-show">
                            <div class="btn-back">
                                <i class="fa-solid fa-chevron-left"></i>
                            </div>
                            <div class="btn-all-ofpage">
                                <span id="currentpage">1</span> /<span id="totalpage"> 0</span> of
                                <span id="totaldata"> 0 </span>
                            </div>
                            <div class="btn-next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="content-data">
                    <table id="tbl-data">
                    </table>
                </div>


            </div>

        </div>
    </div>
    <div class="loadingpage">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
    <div class="popup"></div>
</body>

<script src="../dashboard/js/dashborad.js">
</script>


</html>