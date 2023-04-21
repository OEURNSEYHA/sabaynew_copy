<style>
.fichero {
    border: 1px solid #D5D5D5;
    float: left;
    padding: 0px;
    margin: 2px;
    cursor: pointer;
    position: relative;
}

.fichero img {
    width: 100px;
    height: 100px;
    object-fit: cover;
}

.holdup {
    position: absolute;
    background: rgba(0, 0, 0, 0.2);
    width: 100px;
    height: 100px;
    top: 0px;
    visibility: hidden;
}

.fichero:hover .holdup {
    visibility: visible;
}
</style>
<?php 
include('../Config/Congfig.php');

// $BASE_URL=BASE_URL;

$dir ="../Images";
chdir($dir);
array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
$i=0;
foreach($files as $filename)
{
	if($i>=24){
		break;
	}
?>
<div class='fichero' data-src="../dashboard/Images/<?php echo $filename; ?>">
    <img src="../Images/<?php echo $filename; ?>" />
    <div class='holdup'></div>
</div>
<?php
$i++;
}

?>

<script src="../../../PHP/link/jquery.min.js"></script>
<script>
$(document).on("click", "div.fichero", function() {
    item_url = $(this).data("src");
    var args = top.tinymce.activeEditor.windowManager.getParams();
    win = (args.window);
    input = (args.input);
    win.document.getElementById(input).value = item_url;
    top.tinymce.activeEditor.windowManager.close();
});
</script>