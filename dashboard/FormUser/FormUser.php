<form class=" userupload">
    <div class="btn-close"><span>x</span></div>
    <input type="text" name="editid" id="editid" value="0"><br>
    <input type="id" name="id" id="id" placeholder="Id"><br>
    <input type="text" name="username" id="username" placeholder="Username"><br>
    <input type="email" name="useremail" id="useremail" placeholder="UserEmail"><br>
    <input type="text" name="userpass" id="userpass" placeholder="UserPassword"><br>

    <select name="usertype" id="usertype">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select><br>
    <select name="status" id="status">
        <option value="0">Status</option>
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
    <div class="box-imguser">
        <input type="file" name="file-imguser" id="file-imguser" class="file-imguser">

    </div>
    <input type="text" name="imguser" id="imguser">
    <div class="btn-save">
        <span>SAVE</span>
    </div>
</form>