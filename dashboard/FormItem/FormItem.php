<link rel="stylesheet" href="../dashboard/FormItem/FormItem.css">
<form class="itemupload">
    <div class="btn-closeitemupload">
        <span>x</span>
    </div>
    <div class="left">
        <input type="text" name="editid" id="editid" value="0" hidden>
        <div class="boxid">
            <input type="text" name="id" id="id" placeholder="Id">
        </div>
        <div class="boxuserid">
            <input type="text" name="userid" id="userid" class="userid" placeholder="User ID">
        </div>
        <select name="mid" id="mid" class="menuid">
            <option value="0">Menu ID</option>
            <?php

                include('../Config/Congfig.php');
                $Database = new Database;
                $Database -> config();
                $cn = $Database->cn;
                $sql = "SELECT id, title FROM tbl_menu WHERE status=1";
                $result= $cn->query($sql);
                if($result->num_rows>0 ){
                    while($row = $result->fetch_array()){
                        ?>
            <option value="<?php echo $row[0]?>"> <?php echo  $row[1];?> </option>

            <?php
                    }
                }
            ?>

        </select><br>
        <div class="box-orderid">
            <input type="text" name="od" id="od" class="od" placeholder="Order Id">
        </div>
        <div class="boxname">
            <input type="text" name="title" id="title" class="title" placeholder="Title">
        </div>
        <select name="status" id="status" class="status">
            <option value="0">Status </option>
            <option value="1">1 </option>
            <option value="2">2 </option>
        </select>

        <div class=" boximgitem">
            <input type="file" name="file-imgitem" id="file-imgitem" class="file-imgitem">
        </div>
        <input type="text" name="imgitem" id="imgitem" class="imgitem" hidden>
        <div class="btn-save">
            <span> SAVE </span>
        </div>
    </div>
    <div class="right">
        <div class="boxdesc">
            <textarea name="detail" id="detail" class="detail"></textarea>
        </div>

    </div>




</form>




</script>