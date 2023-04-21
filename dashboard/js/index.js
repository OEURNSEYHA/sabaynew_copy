$(document).ready(function () {
    let email = $("#email");
    let pass = $("#password");
    let inputfield = $('input');
    let btnresetpass = $(".reset-password");
    $(document).keypress(function (i) {
        console.log(i);
        var keycode = (i.keyCode ? i.keyCode : i.which);
        if (keycode == '13') {
           $(".btn-login").click();

        }
    });

    $(".btn-login").click(function () {
        if (email.val() == "") {
            alert("Please Input Email ");
            email.focus();
            return;
        } else if (pass.val() == "") {
            alert("Please Input Password");
            pass.focus();
            return;
        }
        $.ajax({
            url: "LogIn/LogIn.php",
            type: 'POST',
            data: {
                useremail: email.val(),
                userpass: pass.val(),
            },
            cache: false,
            dataType: "json",
            beforSend: function () {
                alert("hello");
            },
            success: function (data) {
                if (data.checkemail == false) {
                    alert("Please check your email again ⚡!");
                    email.focus();
                    return;
                } else {
                    if (data.checkpass == false) {
                        alert("Please check your PassWord again ⚡💀!");
                        pass.focus();
                        return;

                    } else {
                        window.location.href = ("dashboard.php");
                        email.val("");
                        pass.val("");
                    }
                }
            }

        })
    })

    inputfield.keyup(function(event){
        let keycode = (event.keyCode ? event.keyCode  : event.which);
        if( keycode == 37 || keycode == 38  || keycode == 39 || keycode == 40 ){
          let indexfield =  inputfield.index(this);
           if(keycode == 37 || keycode == 38){
                indexfield= indexfield - 1;
           }else{
                indexfield= indexfield + 1;
           }
           if(inputfield.eq(indexfield).length > 0){
            inputfield.eq(indexfield).focus();
           }
        }
    })

    btnresetpass.click(function(){
       if(email.val()==""){
            alert("Please input email");
            email.focus();
            return;
       }

       $.ajax({
            url:'NewPassword/NewPassword.php',
            type: 'POST',
            data:{useremail: email.val()},
            caches: false,
            dataType:"json",
            beforSend: function(){

            },
            success:function(data){
                alert(data.dpl);
                if(data.dpl == true){
                    alert("Check You email to get new Password");
                }else{
                    alert("Please try again.!");
                }
            }
       })
    })
    
})