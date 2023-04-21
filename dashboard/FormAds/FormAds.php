    <link rel="stylesheet" href="../dashboard/FormAds/FormAds.css">
    <form class="adsupload">
        <div class="btn-close">
            <span>x</span>
        </div>
        <input type="text" name="editid" id="editid" value="0">
        <input type="text" name="id" id="id" class="id" placeholder="ID" /><br>
        <input type="text" name="url" id="url" class="url" placeholder="URL" /><br>
        <select name="type" id="type" class="type">
            <option value="0">TYPE</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select><br>
        <select name="status" id="status" class="status"><br>
            <option value="0">Status</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select><br>
        <div class="box-imgads">
            <input type="file" name="file-imgads" id="file-imgads">
        </div>
        <input type="text" name="imgads" id="imgads">
        <div class="btn-save">
            <span>SAVE</span>
            <!-- <img src="../../../Firstproject/images/loading.gif" alt="" width="100px"> -->
        </div>
    </form>