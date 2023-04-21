$(document).ready(function () {

    /* Global variable */
    let EventClicksidebar = 0;
    var optionitem;
    let btnadd = $(".bar-content-information ");
    let body = $("body");
    let popup = $(".popup");
    let tbldata = $('#tbl-data');
    let loadingpage = $('.loadingpage');
    let indexrowtblmenu = "";
    let startshow = 0;
    let endshow = $('#option-show').val();
    let currentpage = $('#currentpage');
    let totalpage = $('#totalpage');
    let totaldata = $('#totaldata');
    let searchvalue = 0;
    let search = $('#search');
    let filtersearchval = $('#filtersearch');
    let iduser = $("#iduser").val();

    let filtersearch = [
        {},
        {
            "id": "Id",
            "title": "Title",
            "status": "Status"
        },
        {
            "id": "Id",
            "title": "Title",
            "detail": "Detail",
            "status": "Status"

        },
        {
            "id": "Id",
            "title": "Title",
            "url": "URL",
            "status": "Status"
        },
        {
            "id": "ID",
            "username": "UserName",
            "userpass": "UserPassword",
            "useremail": "UserEmail",
        }
    ]
    loadingpage.hide();
    btnadd.hide();
    /* call back Header Scroll */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 60) {
            $('.header').addClass('header-scroll');
        } else {
            $('.header').removeClass('header-scroll');
        }
    });

    /*call back Menubar*/
    $('.icon-menubar').click(function () {
        if (EventClicksidebar == 0) {
            $('.content-dashboard').css({ 'width': '100%' });
            $('.side-bar').addClass('hide-sidebar');
            EventClicksidebar = 1;
        } else if (EventClicksidebar == 1) {
            $('.content-dashboard').css({ 'width': '83.5%' });
            $('.side-bar').removeClass('hide-sidebar');
            EventClicksidebar = 0;
        }
    });

    /*call back btnclose popupmenu and item*/
    popup.hide();
    $('body').on('click', '.btn-close', function () {
        popup.hide();
    });
    $('body').on('click', '.btn-closeitemupload', function () {
        popup.hide();
    })
    /*call back option system*/
    let optionserch = "";
    $('.sub-system li').click(function () {
        let eThis = $(this);
        let textofsystem = eThis.find('a').text();
        let boxmenubar = $('.box-menubar').find('span');
        optionitem = eThis.data('id');
        boxmenubar.text(textofsystem);
        btnadd.show();


        if (optionitem == 4) {
            optionserch = '<option value="0"> FilterSearchUser </option>';
            for (i in filtersearch[optionitem]) {
                optionserch += `<option value='${i}'> ${filtersearch[optionitem][i]}</option>`;
                $("#filtersearch").html(optionserch);
            }

            GetDataUser();
        }
    })
    let role ;
    /**call back option  item **/
    $('.sub-system li').click(function () {
        search.val("");
        startshow = 0;
        currentpage.text(1);
        searchvalue = 0;
        let eThis = $(this);
        role = eThis.data("role");
        optionitem = eThis.data("id");
        btnadd.show();
        let textofitem = eThis.find('a').text();
        let boxmenubar = $(".box-menubar").find('span');
        boxmenubar.text(textofitem);
        if(role == 2){
           $(".btn-add").css({"pointer-events":"none"});
        
        }else{
            $(".btn-add").css({"pointer-events":"all"});
        }
        if (optionitem == 1) {
            GetDataMenu();
        } else if (optionitem == 2) {
            GetDataItem();
        } else if (optionitem == 3) {
            GetDataAds();
        }

        if (optionitem == 1) {
            optionserch = "<option value='0'> FiltersearchMenu </option>";
            for (i in filtersearch[optionitem]) {

                optionserch += `<option value='${i}'> ${filtersearch[optionitem][i]} </option>`;
                $('#filtersearch').html(optionserch);

            }

        } else if (optionitem == 2) {
            optionserch = "<option value='0'> FiltersearchItem </option>";
            for (i in filtersearch[optionitem]) {

                optionserch += `<option value='${i}'> ${filtersearch[optionitem][i]} </option>`;
                $('#filtersearch').html(optionserch);

            }
        }
        else if (optionitem == 3) {
            optionserch = "<option value='0'> FiltersearchAds </option>";
            for (i in filtersearch[optionitem]) {

                optionserch += `<option value='${i}'> ${filtersearch[optionitem][i]} </option>`;
                $('#filtersearch').html(optionserch);

            }
        }


    });

    /* function get auto id */
    const AutoIdMenu = () => {
        $.ajax({
            url: 'AutoID/AutoID.php',
            type: 'POST',
            data: { 'tbl': optionitem },
            // contentType: false,
            cache: false,
            // processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
                //work after success;
                body.find('.menuupload #id').val(parseInt(data.autoid) + 1);
                body.find('.menuupload #od').val(parseInt(data.autoid) + 1);
                body.find('.itemupload #id').val(parseInt(data.autoid) + 1);
                body.find('.itemupload #od').val(parseInt(data.autoid) + 1);
                body.find('.adsupload #id').val(parseInt(data.autoid) + 1);
                body.find('.userupload #id').val(parseInt(data.autoid) + 1);

            }
        });
    }

    /*call back Button ADD*/
    $('body').on('click', '.btn-add', function () {
        const form = {
            1: "FormMenu/FormMenu.php",
            2: "FormItem/FormItem.php",
            3: "FormAds/FormAds.php",
            4: "FormUser/FormUser.php",
            
        };

        popup.show();
        popup.load("" + form[optionitem] + "", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
            
                AutoIdMenu();
                body.find('#userid').val(iduser);
            if (optionitem == 2) {
                calleditor();
            }
            if (statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });


    /*save  data to database */
    $("body").on("click", ".btn-save", function () {
        let eThis = $(this);
        if (optionitem == 1) {
            SaveMenu(eThis);
        } else if (optionitem == 2) {
            SaveItem(eThis);
        } else if (optionitem == 3) {
            SaveAds(eThis);
        } else if (optionitem == 4) {
            SaveUser(eThis);
        }

    })

    /** Edit data  **/
    body.on('click', '.btn-edit', function () {
        let eThis = $(this);
        if (optionitem == 1) {
            GetEditMenu(eThis);
        } else if (optionitem == 2) {
            GetEditItem(eThis);
        } else if (optionitem == 3) {
            GetEditAds(eThis);
        } else if (optionitem == 4) {
            GetEditUser(eThis);
        }
    })

    /*function save user */
    const SaveUser = (eThis) => {
        let frm = eThis.closest('form.userupload');
        let frm_data = new FormData(frm[0]);

        let id = frm.find("#id");
        let username = frm.find("#username");
        let useremail = frm.find("#useremail");
        let usertype = frm.find("#usertype");
        let status = frm.find("#status");
       
        $.ajax({
            url: 'Action/insertdatauser.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;

            },
            success: function (data) {
                //work after success;
                alert('success');
                if (data['dpl'] == true) {

                    alert("Duplicate Email please input again");

                } else {
                    if (data.edit == true) { 

                        body.find('tr:eq('+indexrowtblmenu+') td:eq(0)').text(id.val());
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(1)').text(username.val());
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(2)').text(useremail.val());
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(3)').text(data.userpass);
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(4)').text(usertype.val());
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(7)').text(status.val());
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(8)').text(data.date);
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(9) img').attr("src",`../dashboard/Images/${data.img}`);
                        body.find('tr:eq('+indexrowtblmenu+') td:eq(9) img').attr("alt",`${data.img}`);
                        
                        popup.hide();

                    }else{
                        let tr = `

                                <tr>
                                    <td>${id.val()}</td>
                                    <td><p>${username.val()}</p> <span class="permission"> ADD</span> </td>
                                    <td>${useremail.val()}</td>
                                    <td>${data.userpass}</td>
                                    <td>${usertype.val()}</td>
                                    <td>${data.userip}</td>
                                    <td>${data.code}</td>
                                    <td>${status.val()}</td>
                                    <td>${data.date}</td>
                                    <td><img src="../dashboard/Images/${data.img}" alt="${data.img}" width="60px" height="50px"/></td>
                                    <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                                </tr>

                            `;
                            tbldata.find('tr:eq(0)').after(tr);
                            id.val(data.autoid + 1);
                           
                    }

                }

            }
        });
    }


    /**Get menu data form database**/
    const GetDataUser = () => {
        // let endshow = $('#option-show').val();
        let th = `
   <tr>
       <th width="3%">Id</th>
       <th width="20%">UserName</th>
       <th width="15%">UserEmail</th>
       <th width="15%">UserPass</th>
       <th width="5%">UserType</th>
       <th width="7%">UserIP</th>
       <th width="10%">Codeverify</th>
       <th width="5%">Status</th>
       <th width="10%">Date</th>
       <th width="10%">Image</th>
       <th wdith="3%">Action</th>
   </tr>
`;
        let tr = "";
        $.ajax({
            url: 'GetData/GetDataUser_Json.php',
            type: 'POST',
            data: {
                'start': startshow,
                'end': endshow,
                'search': searchvalue,
                'searchtxt': search.val(),
                'filtersearch': filtersearchval.val(),
                'filtershow': optionitem,
            },
            // contentType: false,
            cache: false,
            // processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
                loadingpage.show();
            },
            success: function (data) {
                //work after success;
                if (data.length == 0) {
                    tbldata.html(th);
                    loadingpage.hide();
                    return;
                }
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / endshow));

                data.map((item, id) => {
                    tr += `
                   <tr>
                       <td>${item.id}</td>
                       <td> <p>${item.username}</p> <span class="permission"> ADD</span></td>
                       <td>${item.useremail}</td>
                       <td>${item.userpass}</td>
                       <td>${item.usertype}</td>
                       <td>${item.userip}</td>
                       <td>${item.code}</td>
                       <td>${item.status}</td>
                       <td>${item.timelogin}</td>
                       <td><img src="../dashboard/Images/${item.img}" alt="${item.img}" width="60px" height="50px"/></td>
                       <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                    </tr>
               `;
                })
                tbldata.html(th + tr);
                loadingpage.hide();
                // startshow=0;

            }
        });

    }

    const GetEditUser = (eThis) => {
      
        let parent = eThis.parents("tr");
        let id = parent.find("td:eq(0)").text();
        let username = parent.find("td:eq(1) p").text();
        let useremail = parent.find("td:eq(2)").text();
        let userpass = parent.find("td:eq(3)").text();
        let usertype = parent.find("td:eq(4)").text();
        // let userip = parent.find("td:eq(5)").text();
        // let code = parent.find("td:eq(6)").text();
        let status = parent.find("td:eq(7)").text();
        let img = parent.find("td:eq(9) img").attr('alt');
        indexrowtblmenu = parent.index();
        const form = {
            1: "FormMenu/FormMenu.php",
            2: "FormItem/FormItem.php",
            3: "FormAds/FormAds.php",
            4: "FormUser/FormUser.php",
        };

        popup.show();
        $('.popup').load("" + form[optionitem] + "", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
            body.find('#editid').val(id);
            body.find('#id').val(id);
            body.find('#username').val(username);
            body.find('#useremail').val(useremail);
            body.find('#userpass').val(userpass);
            body.find('#usertype').val(usertype);
            body.find('#status').val(status);
            body.find('.box-imguser').css({ "backgroundImage": "url('../dashboard/Images/" + img + "')" });
            body.find("#imguser").val(img);
            
            if (statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }
    /*function save menu data*/
    const SaveMenu = (eThis) => {
        let parent = eThis.closest('form.menuupload');
        let id = parent.find("#id"),
            title = parent.find("#title"),
            od = parent.find("#od"),
            status = parent.find('#status'),
            img = parent.find("#imgmenu");
        let boximg = $(".box-imgmenu");
        let imgname = $("#imgmenu");
        if (id.val() == "") {
            alert("Please Input Id");
            id.focus();
            return;
        } else if (title.val() == "") {
            alert("Please Input Tittle ");
            title.focus();
            return;
        } else if (img.val() == "") {
            alert("Please Choose Image");
            return;

        }
        let frm = eThis.closest('form.menuupload');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'Action/insertdatamenu.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;

            },
            success: function (data) {
                //work after success;

                if (data['dpl'] == true) {
                    alert("Please Input title again Duplicatename");
                    title.focus();
                    return;
                } else {
                    if (data.edit == false) {

                        let tr = `
                            <tr>
                                <td>${id.val()}</td>
                                <td>${title.val()}</td>
                                <td>${od.val()}</td>
                                <td>${status.val()}</td>
                                <td> <img src="../dashboard/Images/${imgname.val()}" alt="${imgname.val()}" width="60px" height="30px"></td>
                                <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                                
                            </tr>
                
                            `;
                        tbldata.find('tr:eq(0)').after(tr);
                        id.val(data.autoid + 1);
                        title.val("");
                        title.focus();
                        od.val(data.autoid + 1);
                        imgname.val("");
                        boximg.css({ "backgroundImage": "url('../dashboard/Images/profile.jpg')" });


                    } else {

                        body.find('tr:eq(' + indexrowtblmenu + ') td:eq(0)').text(data.autoid);
                        body.find('tr:eq(' + indexrowtblmenu + ') td:eq(1)').text(title.val());
                        body.find('tr:eq(' + indexrowtblmenu + ') td:eq(2)').text(od.val());
                        body.find('tr:eq(' + indexrowtblmenu + ') td:eq(3)').text(status.val());
                        body.find('tr:eq(' + indexrowtblmenu + ') td:eq(4) img').attr('alt', '' + imgname.val() + '');
                        body.find('tr:eq(' + indexrowtblmenu + ') td:eq(4) img').attr('src', '../dashboard/Images/' + imgname.val() + '');
                        popup.hide();

                    }

                }

            }
        });
    }

    /**Get menu data form database**/
    const GetDataMenu = () => {
        // let endshow = $('#option-show').val();
        let th = `
                <tr>
                    <th width="5%">Id</th>
                    <th width="60%">Title</th>
                    <th width="10%"> Order ID</th>
                    <th width="5%">Status</th>
                    <th width="10%">Image</th>
                    <th wdith="10%">Action</th>
                </tr>
        `;
        let tr = "";
        $.ajax({
            url: 'GetData/GetDataMenu_Json.php',
            type: 'POST',
            data: {
                'start': startshow,
                'end': endshow,
                'search': searchvalue,
                'searchtxt': search.val(),
                'filtersearch': filtersearchval.val(),
                'filtershow': optionitem,
            },
            // contentType: false,
            cache: false,
            // processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
                loadingpage.show();
            },
            success: function (data) {
                //work after success;
                if (data.length == 0) {
                    tbldata.html(th);
                    loadingpage.hide();
                    return;
                }
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / endshow));

                data.map((item, id) => {
                    tr += `
                                <tr>
                                    <td>${item.id}</td>
                                    <td>${item.title} </td>
                                    <td>${item.od}</td>
                                    <td>${item.status}</td>
                                    <td> <img src="../dashboard/Images/${item.img}" alt="${item.img}" width="60px" height="30px"> </td>
                                    <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                                    </tr>
                            `;
                })
                tbldata.html(th + tr);
                loadingpage.hide();
                // startshow=0;
                if(role == 2){
                    $(".btn-edit").css({ "pointer-events":"none"});
                }else{
                    $(".btn-edit").css({ "pointer-events":"all"});

                }
            }
        });
    }

    /**Edit table menu**/
    const GetEditMenu = (eThis) => {
        let boximgmenu = $('.box-imgmenu');
        let imgname = $('#imgmenu');
        let parent = eThis.parents('tr');
        let id = parent.find('td:eq(0)').text();
        let title = parent.find('td:eq(1)').text();
        let od = parent.find('td:eq(2)').text();
        let status = parent.find('td:eq(3)').text();
        let img = parent.find('td:eq(4) img').attr('alt');
        indexrowtblmenu = parent.index();
        const form = {
            1: "FormMenu/FormMenu.php",
            2: "FormItem/FormItem.php",
            3: "FormAds/FormAds.php"
        };

        popup.show();
        $('.popup').load("" + form[optionitem] + "", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                body.find('#editid').val(id);
            body.find('#id').val(id);
            body.find('#title').val(title);
            body.find('#od').val(od);
            body.find('#status').val(status);
            body.find('.box-imgmenu').css({ "backgroundImage": "url('../dashboard/Images/" + img + "')" });
            body.find('#imgmenu').val(img);


            if (statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }


    /**Show Limit data menu**/
    $('#option-show').change(function () {
        endshow = $(this).val();
        if (optionitem == 1) {
            GetDataMenu();
        } else if (optionitem == 2) {
            GetDataItem();
        } else if (optionitem == 3) {
            GetDataAds();
        } else if(optionitem == 4){
            GetDataUser();
        }
    });

  
    /*function save item data*/
    const SaveItem = (eThis) => {
        tinymce.triggerSave();
        let parent = eThis.closest('form.itemupload');
        let id = parent.find("#id"),
            userid = parent.find("#userid"),
            menuid = parent.find("#mid"),
            title = parent.find("#title"),
            detail = parent.find("#detail"),
            od = parent.find("#od"),
            namelink = parent.find("#namelink"),
            status = parent.find('#status'),
            img = parent.find("#imgitem");
        let boximg = $(".boximgitem");
        let imgname = $("#imgitem");

        if (id.val() == "") {
            alert("Please Input Id");
            id.focus();
            return;
        } else if (userid.val() == "") {
            alert("Please Input User Id");
            userid.focus();
            return;
        } else if (title.val() == "") {
            alert("Please Input Tittle ");
            title.focus();
            return;
        } else if (detail.val() == "") {
            alert("Please Input detail");
            detail.focus();
            return;

        } else if (img.val() == "") {
            alert("Please Choose Image");
            return;

        }
        let frm = eThis.closest('form.itemupload');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'Action/insertdataitem.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {

                //work after success;
                if (data['dpl'] == true) {
                    alert("Please Input title again Duplicatename");
                    title.focus();
                    return;
                } else {
                    if (data.edit == false) {
                        let tr = `
                            <tr>
                                <td> ${data.autoid}</td>
                                <td> <span>  </span>  ${menuid.find('option:selected').text()}</td>
                                <td> ${title.val()} </td>
                                <td> ${userid.val()} </td>
                                <td> ${od.val()}</td>
                                <td> ${data.view}</td>
                                <td> ${data.date}</td>
                                <td> ${status.val()}</td>
                                <td> <img src="../dashboard/Images/${imgname.val()}" alt="${imgname.val()}" width="60px" height="30px"> </td>
                                <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                        `;
                        tbldata.find('tr:eq(0)').after(tr);
                        id.val(data.autoid + 1);
                        title.val("");
                        title.focus();
                        od.val(data.autoid + 1);
                        imgname.val("");
                        boximg.css({ "backgroundImage": "url('../dashboard/Images/profile.jpg')" })
                    } else {
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(0)`).text(id.val());
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(1)`).html(`<span>${menuid.val()}</span>${menuid.find('option:selected').text()}`);
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(2)`).text(title.val());
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(3)`).text(userid.val());
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(4)`).text(od.val());
                        // body.find(`tr:eq(${indexrowtblmenu}) td:eq(5)`).text(view.val())
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(7)`).text(status.val());
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(8) img`).attr('src', '../dashboard/Images/' + imgname.val() + '');
                        body.find(`tr:eq(${indexrowtblmenu}) td:eq(8) img`).attr('alt', '' + imgname.val() + '')
                        popup.hide();
                    }

                }
            }
        });
    }

    /**Get item data form database**/
    const GetDataItem = () => {

        let th = `
                <tr>
                    <th width="5%">Id</th>
                    <th width="11%">MenuID</th>
                    <th width="25%">Title</th>
                    <th width="10%">UserID</th>
                    <th width="5%"> OrderID</th>
                    <th width="3%"> View </th>
                    <th width="20%"> Date Post</th>
                    <th width="3%">Status</th>
                    <th width="10%"> Image</th>
                    <th width="10%">Action</th>
                </tr>
        `;
        let tr = "";
        $.ajax({
            url: 'GetData/GetDataItem_Json.php',
            type: 'POST',
            data: {
                'start': startshow,
                'end': endshow,
                'search': searchvalue,
                'searchtxt': search.val(),
                'filtersearch': filtersearchval.val(),
                'filtershow': optionitem,
            },

            // contentType: false,
            cache: false,
            // processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
                loadingpage.show();
            },
            success: function (data) {
                //work after success;
                if (data.length == 0) {
                    tbldata.html(th);
                    loadingpage.hide();
                    return;
                }

                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / endshow));
                data.map((item, id) => {
                    tr += `
                            <tr>
                                <td>${item.id}</td>
                                <td> <span hidden>${item.menu_id}</span> ${item.menutitle} </td>
                                <td>${item.title} </td>
                                <td>${item.user_id} </td>
                                <td>${item.od}</td>
                                <td>${item.click}</td>
                                <td> ${item.date_post} </td>
                                <td>${item.status}</td>
                                <td> <img src="../dashboard/Images/${item.img}" alt="${item.img}" width="60px" height="30px"> </td>
                                <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                        `;
                })
                tbldata.html(th + tr);
                loadingpage.hide();

            }
        });
    }

    /**Edit table item**/
    const GetEditItem = (eThis) => {

        let boximgmenu = $('.boximgitem');
        let imgname = $('#imgitem');
        let parent = eThis.parents('tr');
        let id = parent.find('td:eq(0)').text();
        let menuid = parent.find('td:eq(1) span').text();
        let title = parent.find('td:eq(2)').text();
        let userid = parent.find('td:eq(3)').text();
        let od = parent.find('td:eq(4)').text();
        let status = parent.find('td:eq(7)').text();
        let img = parent.find('td:eq(8) img').attr('alt');
        indexrowtblmenu = parent.index();
        const form = {
            1: "FormMenu/FormMenu.php",
            2: "FormItem/FormItem.php"
        };

        popup.show();
        $('.popup').load("" + form[optionitem] + "", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")

                body.find('#editid').val(id);
            body.find('#id').val(id);
            body.find('#userid').val(userid);
            body.find('select.menuid').val(menuid);
            body.find('#title').val(title);
            body.find('#od').val(od);
            body.find('#status').val(status);
            body.find('.boximgitem').css({ "backgroundImage": "url('../dashboard/Images/" + img + "')" });
            body.find('#imgitem').val(img);
            $.ajax({
                url: 'GetEditDataItem/GetEditDataItem.php',
                type: 'POST',
                data: { 'id': id },
                // contentType: false,
                cache: false,
                // processData: false,
                dataType: "json",
                beforeSend: function () {
                    //work before success;
                },
                success: function (data) {
                    //work after success;
                    $('#detail').val(data.detailedit);
                    calleditor();
                }
            });

            if (statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    /*function save ads */

    const SaveAds = (eThis) => {

        let frm = eThis.closest('form.adsupload');
        let frm_data = new FormData(frm[0]);
        let id = frm.find('#id');
        let url = frm.find('#url');
        let type = frm.find('#type');
        let status = frm.find('#status');
        let boximg = frm.find(".box-imgads");
        let imgads = frm.find("#imgads");

        $.ajax({
            url: 'Action/insertdataads.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;

            },
            success: function (data) {
                //work after success;
                if (data.edit == true) {
                    console.log('edit');
                    body.find(`tr:eq(${indexrowtblmenu}) td:eq(0)`).text(id.val());
                    body.find(`tr:eq(${indexrowtblmenu}) td:eq(1)`).text(url.val());
                    body.find(`tr:eq(${indexrowtblmenu}) td:eq(2)`).text(type.val());
                    body.find(`tr:eq(${indexrowtblmenu}) td:eq(3)`).text(status.val());
                    body.find(`tr:eq(${indexrowtblmenu}) td:eq(4) img`).attr("src", "../dashboard/Images/" + imgads.val() + "");
                    body.find(`tr:eq(${indexrowtblmenu}) td:eq(4) img`).attr("alt", imgads.val());
                    popup.hide();

                } else {
                    let tr = `
                    <tr>
                        <td> ${id.val()} </td>
                        <td> ${url.val()} </td>
                        <td>${type.val()}</td>
                        <td>${status.val()}</td>
                        <td> <img src="../dashboard/Images/${imgads.val()}" alt="${imgads.val()}" width="60px" height="30px"> </td>
                        <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                        
                    </tr>
                `;

                    tbldata.find('tr:eq(0)').after(tr);

                    id.val(data['autoid'] + 1);
                    url.val("");
                    url.focus();
                    imgads.val("");
                    boximg.css({ "backgroundImage": "url('../dashboard/Images/profile.jpg')" });

                }
            }
        });
    }
    // Get data ads
    const GetDataAds = () => {
        let th = `
                    <tr>
                        <th width="5%">Id</th>
                        <th width="70%">URL</th>
                        <th width="5%">TYPE</th>
                        <th width="5%">Status</th>
                        <th width="10%">Image</th>
                        <th wdith="5%">Action</th>
                    </tr>
                `;
        let tr = "";

        $.ajax({
            url: 'GetData/GetDataAds_Json.php',
            type: 'POST',
            data: {

                'start': startshow,
                'end': endshow,
                'search': searchvalue,
                'searchtxt': search.val(),
                'filtersearch': filtersearchval.val(),
                'filtershow': optionitem,

            },
            // contentType: false,
            cache: false,
            // processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
                loadingpage.show();
            },
            success: function (data) {
                // work after success;
                if (data.length == 0) {
                    tbldata.html(th);
                    loadingpage.hide();
                    return;
                } else {
                    totaldata.text(data[0]['total']);
                    totalpage.text(Math.ceil(data[0]['total'] / endshow));

                    data.map((item, id) => {
                        tr += `
                                <tr>
                                    <td>${item.id}</td>
                                    <td>${item.url} </td>
                                    <td>${item.type}</td>
                                    <td>${item.status}</td>
                                    <td> <img src="../dashboard/Images/${item.img}" alt="${item.img}" width="60px" height="30px"> </td>
                                   <td align="center"><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                                    </tr>
                            `;
                    })
                    tbldata.html(th + tr);
                    loadingpage.hide();
                    // startshow=0;
                }


            }
        });
    }
    // Get edit ads
    const GetEditAds = (eThis) => {

        let parent = eThis.parents('tr');
        let id = parent.find("td:eq(0)").text();
        let url = parent.find("td:eq(1)").text();
        let type = parent.find("td:eq(2)").text();
        let status = parent.find("td:eq(3)").text();
        let img = parent.find("td:eq(4) img").attr('alt');
        indexrowtblmenu = parent.index();
        alert(indexrowtblmenu);

        const form = {
            1: "FormMenu/FormMenu.php",
            2: "FormItem/FormItem.php",
            3: "FormAds/FormAds.php"
        };

        popup.show();
        $('.popup').load("" + form[optionitem] + "", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                body.find('#editid').val(id);
            body.find('#id').val(id);
            body.find('#url').val(url);
            body.find("#type").val(type);
            body.find("#status").val(status);
            body.find('.box-imgads').css({ "backgroundImage": "url('../dashboard/Images/" + img + "')" });
            body.find('#imgads').val(img);


            if (statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }






    /*upload menu img to database*/
    body.on('change', '#file-imgmenu', function () {
        let eThis = $(this);
        let frm = eThis.closest('form.menuupload');
        let frm_data = new FormData(frm[0]);

        // frm_data.append("file", eThis[0].files[0]);

        let boximg = $(".box-imgmenu");
        let imgname = $("#imgmenu");

        $.ajax({
            url: 'UploadImages/UploadImageMenu.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
                //work after success;
                alert("success");
                imgname.val(data['imgname']);
                boximg.css({ "backgroundImage": "url('../dashboard/Images/" + data['imgname'] + "')" });
            }
        });
    })

    /**Upload item img to database **/
    body.on('change', '#file-imgitem', function () {

        let boximg = $(".boximgitem");
        let imgname = $("#imgitem");
        let eThis = $(this);
        let frm = eThis.closest('form.itemupload');
        let frm_data = new FormData(frm[0]);

        $.ajax({
            url: 'UploadImages/UploadImageItem.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
                //work after success;
                alert("success");
                imgname.val(data['imgname']);
                boximg.css({ "backgroundImage": "url('../dashboard/Images/" + data['imgname'] + "')" });
            }
        });
    })

    /*Upload ads img to database*/
    body.on('change', '#file-imgads', function () {

        let boximg = $(".box-imgads");
        let imgname = $("#imgads");
        let eThis = $(this);
        let frm = eThis.closest('form.adsupload');
        let frm_data = new FormData(frm[0]);

        $.ajax({
            url: 'UploadImages/UploadImageAds.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
                //work after success;
                alert("success");
                imgname.val(data['imgname']);
                boximg.css({ "backgroundImage": "url('../dashboard/Images/" + data['imgname'] + "')" });
            }
        });
    })


     /*Upload ads img to database*/
     body.on('change', '#file-imguser', function () {

        let boximg = $(".box-imguser");
        let imgname = $("#imguser");
        let eThis = $(this);
        let frm = eThis.closest('form.userupload');
        let frm_data = new FormData(frm[0]);

        $.ajax({
            url: 'UploadImages/UploadImageUser.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
                //work after success;
                alert("success");
                imgname.val(data.imgname);
                boximg.css({ "backgroundImage": "url('../dashboard/Images/" + data['imgname'] + "')" });
            }
        });
    })

    /*Search data*/
    $('.iconsearch').click(function () {
        if (optionitem == 1) {
            searchvalue = 1;
            GetDataMenu();
        } else if (optionitem == 2) {
            searchvalue = 1;
            GetDataItem();
        } else if (optionitem == 3) {
            searchvalue = 1;
            GetDataAds();
        }
    })

    /**btn Next and Back **/
    /*Next page*/
    $('.btn-next').click(function () {
        if (optionitem == 1) {
            if (currentpage.text() == totalpage.text()) {
                alert("The End Pages");
            } else {
                currentpage.text(parseInt(currentpage.text()) + 1);
                startshow += parseInt(endshow);
                
                GetDataMenu();
            }
        } else if (optionitem == 2) {
            if (currentpage.text() == totalpage.text()) {
                alert("The End Pages");
            } else {
                currentpage.text(parseInt(currentpage.text()) + 1);
                startshow += parseInt(endshow);
                GetDataItem();
            }
        } else if (optionitem == 3) {
            if (currentpage.text() == totalpage.text()) {
                alert('End Page');
            } else {
                currentpage.text(parseInt(currentpage.text()) + 1);
                startshow += parseInt(endshow);
                GetDataAds();
            }
        } else if (optionitem == 4) {
            if (currentpage.text() == totalpage.text()) {
                alert('End Page');
            } else {
                currentpage.text(parseInt(currentpage.text()) + 1);
                startshow += parseInt(endshow);
                GetDataUser();
            }
        }
    })

    /*Back Page*/
    $('.btn-back').click(function () {
        if (optionitem == 1) {
            if (currentpage.text() == 1) {
                alert("The End Pages");
            } else {
                currentpage.text(parseInt(currentpage.text()) - 1);
                startshow -= parseInt(endshow);
                GetDataMenu();
            }
        } else if (optionitem == 2) {
            if (currentpage.text() == 1) {
                alert("The End Pages");
            } else {
                currentpage.text(parseInt(currentpage.text()) - 1);
                startshow -= parseInt(endshow);
                GetDataItem();
            }
        } else if (optionitem == 3) {
            if (currentpage.text() == 1) {
                alert("End page ");
            } else {
                currentpage.text(parseInt(currentpage.text()) - 1);
                startshow -= parseInt(endshow);
                GetDataAds();
            }
        } else if (optionitem == 4) {
            if (currentpage.text() == 1) {
                alert("End page ");
            } else {
                currentpage.text(parseInt(currentpage.text()) - 1);
                startshow -= parseInt(endshow);
                GetDataUser();
            }
        }

    })

    let userid = "" ;

    body.on('click','.permission', function(){
        let eThis = $(this);
        userid = eThis.parents("tr").find("td:eq(0)").text();
        popup.show();
        $('.popup').load("Permission/Permission.php", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success"){
          
                $.ajax({
                    url:"GetData/GetDataPermission.php",
                    type:"POST",
                    data:{'uid': userid},
                    caches:false,
                    dataType:"json",
                    beforeSend:function(){
    
                    },
                    success:function(data){
                        alert(data.length);
                        for(i=0; i<data.length; i++){
                            body.find("table#tblpermission tr:eq("+(parseInt(data[i].mid)+1)+") td select").val(data[i].aid);
                        }
                    }
                })
            }
           

            if (statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    })

   
    body.on('change','table#tblpermission tr td select', function(){
  
        let eThis = $(this);
        let parent = eThis.parents('tr');
        let mid = parent.find('td:eq(0) span').text();
        let aid = eThis.val();

        $.ajax({
            url:"Action/insertdatapermission.php",
            type:"POST",
            data:{
                'uid': userid,
                'mid': mid,
                'aid': aid,
            },
            caches: false,
            // dataType:"json",
            beforeSend: function(){
             
            },
            success:function(){
                // popup.last().remove();
                alert("success");
            }
        })
    })


    function calleditor() {
        tinymce.remove();
        tinymce.init({
            selector: "textarea", theme: "modern", width: "760", height: "450", relative_urls: false, remove_script_host: false,
            file_browser_callback: function (field_name, url, type, win) {
                var filebrowser = "../dashboard/js/filebrowser.php";
                filebrowser += (filebrowser.indexOf("?") < 0) ? "?type=" + type : "&type=" + type;
                tinymce.activeEditor.windowManager.open({
                    title: "Insert Photo",
                    width: 660,
                    height: 500,
                    url: filebrowser
                }, {
                    window: win,
                    input: field_name
                });
                return false;
            },
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools media code",
            ],
            menubar: true, toolbar1: "undo redo | insert | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
            toolbar2: "fontselect | fontsizeselect | forecolor media code",
        });
    }



});


