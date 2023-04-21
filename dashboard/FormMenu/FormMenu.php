<link rel="stylesheet" href="../dashboard/FormMenu/FormMenu.css">
<form class="menuupload">
    <div class="btn-close">
        <span>x</span>
    </div>
    <input type="text" name="editid" id="editid" value="0">
    <input type="text" name="id" id="id" class="id" placeholder="ID" /><br>
    <input type="text" name="title" id="title" class="name" placeholder="Title" /><br>
    <input type="text" name="od" id="od" class="od" placeholder="Order ID"><br>
    <select name="status" id="status" class="status"><br>
        <option value="0">Status</option>
        <option value="1">1</option>
        <option value="2">2</option>
    </select><br>
    <div class="multiimg-menu">
        <div class="box-imgmenu">
            <input type="file" name="file-imgmenu" id="file-imgmenu">
            <input type="text" name="imgmenu" id="imgmenu">
        </div>
        <!-- <div class="box-imgmenu">
            <input type="file" name="file-imgmenu" id="file-imgmenu">
            <input type="text" name="imgmenu[]" id="imgmenu">
        </div>
        <div class="box-imgmenu">
            <input type="file" name="file-imgmenu" id="file-imgmenu">
            <input type="text" name="imgmenu[]" id="imgmenu">
        </div> -->
    </div>


    <div class="btn-save">
        <span>SAVE</span>
        <!-- <img src="../../../Firstproject/images/loading.gif" alt="" width="100px"> -->
    </div>
</form>