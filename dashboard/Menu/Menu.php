<?php

    $data = array();
    $table = "permission";
    $column1 ="*";
    $column2 = "id";
    $start =0;
    $end = 10;
    $condition = "uid = $userid";
    $GetData = $Database->GetData($table,$column1,$column2,$start,$end,$condition);
    if($GetData != '0'){
        foreach($GetData as $row){
            $data[] = array(
                "mid" => $row[2],
                "aid" => $row[3],
            );
        }
    }
    $menu = array(
        "fa-solid fa-user-plus/SyStem" => array(
            array("4","User")
        ),
        "fa-solid fa-sitemap/Item"=>array(
            array("1","Menu"),
            array("2","News"),
            array("3","ADS"),
        )
    )
 
?>

<div class="menu">


    <ul>
        <?php
            foreach($menu as $key => $val){
                $mykey = explode("/",$key);
                ?>
        <li>
            <a href="#">
                <span><?php echo  $mykey[1] ?></span>
                <i class="<?php echo  $mykey[0] ?>"></i>
            </a>
            <div class="sub-system">

                <ul>
                    <?php
                
                    if( $usertype === "admin"){
                        foreach($val as $datas){
                   ?>
                    <li data-role="1" data-id="<?php echo  $datas[0]; ?>">
                        <a href="#"> <?php echo  $datas[1]; ?> </a>
                    </li>
                    <?php
                        }
                        
                    }else{
                        foreach($val as $datas){
                            foreach($data as $val2){
                                // $val2['uid'];  $val2 =  ['aid'];
                                $role = 0;
                                if($val2['mid']== $datas[0] && $val2['aid'] !=0){
                                    $role=$val2['aid'];
                                    ?>
                    <li data-role="<?php echo $role;  ?>" data-id="<?php echo $datas[0]; ?>">



                        <a href="#"> <?php   echo $datas[1];    ?></a>
                    </li>
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </ul>

            </div>
        </li>

        <?php
            }
        ?>
    </ul>



    <!-- 
    <ul>
        <li>
            <a href="#">
                <span>System</span>
                <i class="fa-solid fa-user-plus"></i>
            </a>
            <div class="sub-system">
                <ul>
                    <li data-id="4">
                        <a href="#"> User </a>
                    </li>
                    <li data-id="5">
                        <a href="#">Permission</a>
                    </li>
                </ul>

            </div>
        </li>
        <li class="list-item"><a href="#">
                Item <i class="fa-solid fa-sitemap"></i></a>
            <div class="sub-system">
                <ul>
                    <li data-id="1">
                        <a href="#"> Menu </a>
                    </li>
                    <li data-id="2">
                        <a href="#"> News </a>
                    </li>
                    <li data-id="3">
                        <a href="#"> ADS </a>
                    </li>
                </ul>
            </div>
        </li>
        <li><a href="">Tour</a></li>

    </ul> -->
</div>