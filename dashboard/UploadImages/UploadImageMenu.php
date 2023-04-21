<?php

    $photo  = $_FILES['file-imgmenu'];
    $photoName = $photo['name'];
    // $photoSize = $photo['size'];
    $imgName = mt_rand(100000,999999);

    $tmp = $photo['tmp_name'];
    // $tmp = $_FILES['file']['tmp_name'];
    $ext = pathinfo( $photoName, PATHINFO_EXTENSION);
    $img = time().$imgName.'.'.$ext;
    $msg['imgname'] = $img;
    $condition_ext = array('jpg','JPG','jpeg','JPEG');
    if(!in_array($ext, $condition_ext)){
        $msg['extension'] = true;
    }else{
        $msg['extension'] = false;
        $msg['img']= $img;
        move_uploaded_file($tmp,'../Images/'.$img);

    }

    echo json_encode($msg);

?>