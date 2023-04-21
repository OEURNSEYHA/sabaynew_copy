<?php
    include('../Config/Congfig.php');


    $sql = "SELECT * FROM tbl_menu ORDER BY id DESC";
    $result = $cn->query($sql);
    while($row = $result->fetch_array()){
 ?>

<tr>
    <td> <?php echo  $row[0]; ?></td>
    <td> <?php echo  $row[1]; ?></td>
    <td> <?php echo  $row[3]; ?></td>
    <td> <?php echo  $row[4]; ?></td>
    <td><?php echo  $row[5]; ?> </td>

    <td><img src="../dashboard/Images/<?php echo  $row[2]; ?>" alt="" width="50px"> </td>

</tr>

<?php

    }


?>