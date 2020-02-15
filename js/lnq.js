 $(function(){
// hides stuffs on page load
$('#signInBtnB').hide();
$('#validate').hide();
$('#validError').hide();
$('#validOk').hide();
$('#regok').hide();
$('#updatep').hide();
$('#changepass').hide();
$('#statupdateinput').hide();
$('#viewProfile').hide();
// $('input').focus(function() {
//     $('#signInBtnB').hide();
// })
    // function below controls the back buton
    $('#backBtn').click(() => {
        window.history.back();
    });

    //code for the sidebar animation
    $('#openN').click(() => {
        $('#mySidenav').css('width', '250px');
    });
     $('.closebtn').click(() => {
        $('#mySidenav').css('width', '0');
     });

     //Validates the sign up form
     $('#uname').blur(() => {
        $.ajax({
            url: '/lnq/process/check.php',
            type: 'post',
            data: {"uname": $('#uname').val()},
            success:(data) => {
                $('#userP').text(data);
                //alert(data);
            }
        });
      
     });
     
     $('#email').blur(() => {
        $.ajax({
           url: '/lnq/process/check.php',
           type: 'post',
           data: {"email": $('#email').val()},
           success:(data) => {
               $('#emailP').text(data);
               //alert(data);
           }
       });
    });

    $('#pnum').blur(() => {
        $.ajax({
           url: '/lnq/process/check.php',
           type: 'post',
           data: {"phone": $('#pnum').val()},
           success:(data) => {
               $('#pnumP').text(data);
               //alert(data);
           }
       });
     
    });
    //verifies password length
    $('#pass').keyup(() => {
        passwrd = $('#pass').val();
        if(passwrd.length < 6){
            $('#pwordP').text("Password length must be greater than 5");
        }else{
            $('#pwordP').text("");
        } 
    });
    //verifies that passwords match
    $('#vpass').keyup(() => {
         passwrd = $('#pass').val();
         vpasswrd = $('#vpass').val();
        if (passwrd != vpasswrd){
            $('#vpwordP').text("Password Mismatch");
        }else{
            $('#vpwordP').text(""); 
        } 
    });
    // toggles the signup btn after correct captcha has been input
    $('#validBtn').click(() => {
        name = $('#name').val();
        uname = $('#uname').val();
        email = $('#email').val();
        phone = $('#pnum').val();
        pword = $('#pass').val();
        vpword = $('#vpass').val();
        userP = $('#userP').text();
        emailP = $('#emailP').text();
        pnumP = $('#pnumP').text();
        pwordP = $('#pwordP').text();
        vpwordP = $('#vpwordP').text();
        gender = $('input[name="sex"]:checked').val();
        userInput = $('#cap').val();
        captcha = $('#validate').text();
        if (name && uname && email && phone && pword && vpword && gender && userInput) {
           if (userP =="" && emailP=="" && pnumP=="" && pwordP=="" && vpwordP=="" ) {
                if (userInput.toUpperCase() == captcha) {
                    $('#validBtn').hide();
                    $('#validError').hide();
                    $('#validOk').show();
                    $('#signInBtnB').show();
                    
                } else {
                    $('#validError').show();
                }
            } 
        }
    });

    //signs up the user
    $('#signInBtnB').click((e) => {
        e.preventDefault;
        let formdata = {
            "name": $('#name').val(),
            "uname": $('#uname').val(),
            "email": $('#email').val(),
            "pnum": $('#pnum').val(),
            "sex": $('input[name="sex"]:checked').val(),
            "pword": $('#pass').val(),
            "vpword": $('#vpass').val(),
            "captcha": $('#cap').val()
        }
        
        $.ajax({
            url: '/lnq/process/reg.php',
            type: 'post',
            data: formdata,
            success:(data) => {
                if (data == "Registration successful..redirecting") {
                    $('form').hide();
                    $('#regok').text(data);
                    $('#regok').show();

                        setTimeout(() => {
                        window.location.href="/lnq/userhome.php";
                    }, 2000);
                }else{
                    window.location.href="/lnq/signup.php"; 
                } 
            
                
            }
        });
    });

    // opens the edit profile form
    $('#ep').click(() => {
        $('#updatep').fadeIn();
        $('#changepass').fadeOut();
    });

    // opens the change password form
    $('#cp').click(() => {
        $('#changepass').fadeIn();
        $('#updatep').fadeOut();
    });

    // updates the user profile
    let emailonload = $('#uemail').val(); //gets the user's current email
    let phoneonload = $('#upnum').val(); //gets the user's current phone
    let nameonload = $('#upname').val(); //gets the user's current name
    //checks to make sure the user isn't inputting another user's email
    $('#uemail').blur(() => {
        if( emailonload == $('#uemail').val() ){
            $('#UemailP').text("");
        }else{
            $.ajax({
                url: '/lnq/process/check.php',
                type: 'post',
                data: {"email": $('#uemail').val()},
                success:(data) => {
                    $('#UemailP').text(data);
                }
            });
        }
    });
    //checks to make sure the user isn't inputting another user's phone number
    $('#upnum').blur(() => {
        if( phoneonload == $('#upnum').val() ){
            $('#UemailP').text("");
        }else{
            $.ajax({
                url: '/lnq/process/check.php',
                type: 'post',
                data: {"phone": $('#upnum').val()},
                success: function(data) {
                    $('#UpnumP').text(data);
                }
            });
        }
    });

    // updates the user's profile
    $('#updateBtn').click((e) => {
        e.preventDefault;
        userId = $('#userId').val();
        name = $('#upname').val();
        email = $('#uemail').val();
        phone = $('#upnum').val();
        UemailP = $('#UemailP').text();
        UpnumP = $('#UpnumlP').text();
        console.log(userId + " " + name + " " + email + " " + phone);
        let profileUpdate = {
            "id": userId,
            "name" : name ,
            "email" :email ,
            "pnum" : phone
        }
        if(UemailP){
            $('#UemailP').text("please use a valid email");
        }
        else if(UpnumP){
            $('#UpnumP').text("phone number is already in use");
        }
        else if(nameonload == name && emailonload == email && phoneonload == phone){
            $('#updatep').hide();
            $('#dumpn').text('Update Succesfull');
            setTimeout(() => {
                window.location.href="/lnq/profile.php";
            }, 1000);
        }
        else{
            $.ajax({
                url: '/lnq/process/profileform.php',
                type: 'post',
                data: profileUpdate,
                success:(data) => {
                    $('#updatep').hide();
                    $('#dumpn').text(data);
                    setTimeout(() => {
                        window.location.href="/lnq/profile.php";
                    }, 1000);
                }
            });
        }   
    });
//verifies password length
    $('#newpass').keyup(() => {
        passwrd = $('#newpass').val();
        if(passwrd.length < 6){
            $('#newpassP').text("Password length must be greater than 5");
        }else{
            $('#newpassP').text("");
        } 
    });

//checks to make sure that the password and verify password fields of the change password form match
    $('#vnewpass').keyup(() => {
        npasswrd = $('#newpass').val();
        nvpasswrd = $('#vnewpass').val();
        if (npasswrd != nvpasswrd){
            $('#vnewpassP').text("Password Mismatch");
        }else{
            $('#vnewpassP').text(""); 
        } 
    });  
       
// updates the user's password
    $('#passBtn').click((e) => {
        e.preventDefault;
        id = $('#userId').val();
        oldpass = $('#oldpass').val();
        npasswrd = $('#newpass').val();
        nvpasswrd = $('#vnewpass').val();
        np = $('#newpassP').text();
        vnp = $('#vnewpassP').text();
        //console.log(oldpass);
        if (oldpass && npasswrd && nvpasswrd && !np && !vnp) {
            let changepassdata = {
                "id": id,
                "oldpass": oldpass,
                "newpass": npasswrd,
                "vnewpass": nvpasswrd
            }
            //console.log(changepassdata);
            $.ajax({
                url: '/lnq/process/passwordform.php',
                type: 'post',
                data: changepassdata,
                success: (data) => {
                    //console.log(data);
                    var dta = "Old password incorrect  ";
                    if(data == dta){
                        $('#dumpn').text(data);
                    }else{
                        $('#changepass').hide();
                        $('#dumpn').text(data);
                        setTimeout(() => {
                            window.location.href="/lnq/profile.php";
                        }, 1000);
                    }
                    
                }
            });
        } else {
            $('#dumpn').text("please fill in the correct data");
        }
    });

    // for status update
    $('#updateS').click(() => {
        let viewvalue = $('#statupdateinput').is(":visible");
        var userstat_id = $('#userId').val(); 
        let userstat = $('#statupdateinput').val();
        if(!viewvalue){
            $('#statupdateinput').fadeIn();
        }else{
            if (userstat_id && userstat) { 
                let changeuserstat = {
                    "id": userstat_id,
                    "userstatus": userstat
                }
                $.ajax({
                    url: '/lnq/process/profileform.php',
                    type: 'post',
                    data: changeuserstat,
                    success: (data) => {
                        setTimeout(() => {
                            window.location.href="/lnq/profile.php";
                        }, 1000);
                    }
                });
                $('#statupdateinput').fadeOut();
            }
        }
    });
    // for search 
    $('#inputsrch').keyup(() => {
       // console.log($('#inputsrch').val().substr(0,1));
        if ($('#inputsrch').val().substr(0,1) === '@') { //for forum search
            if ($('#inputsrch').val() === '@') {
                
            }else{
                $('.tt').remove();
                $('.ttg').remove();
                $('.ttn').remove();
                let searchlen  = $('#inputsrch').val().length;
                let usersearch = {
                    "searchgrp" : $('#inputsrch').val().slice(1,searchlen)
                }
                
                $.ajax({
                    url: '/lnq/process/profileform.php',
                    type: 'post',
                    data: usersearch,
                    success: (data) => {
                        $('.tt').remove();
                        $('.ttg').remove();
                        $('.ttn').remove();
                        $('#contentArea').append(data);
                    }
                }); 
            }
             
        }else{ // for name and username search 
            $('.tt').remove();
            $('.ttg').remove();
            $('.ttn').remove();
            
            let usersearch = {
                "searchwrd" : $('#inputsrch').val(),
                "usedname" : $('.sidebaruname').text()
            }
            
            $.ajax({
                url: '/lnq/process/profileform.php',
                type: 'post',
                data: usersearch,
                success: (data) => {
                    $('.tt').remove();
                    $('.ttg').remove();
                    $('.ttn').remove();
                    $('#contentArea').append(data);
                }
            });  
        }

        
    });

    //briefprofile modal
    $('#contentArea').on('click','.tt', function() {
        let briefname = $(this).find('.briefname').text();
        let ownerName = $('.sidebaruname').text();
        $('#umodbod').empty();
        console.log("You are already friends with "+briefname);
        $.ajax({
            url: '/lnq/process/profileform.php',
            type: 'post',
            data: {"usname":briefname, "ownerName":ownerName},
            success: (data) => {
                if (data == "You are already friends with "+briefname) {
                    $('#reqSend').hide();
                    $('#viewProfile').show();   
                }
                $('#umodbod').empty();
                $('#umodbod').append(data);  
            }
        }); 
    });

    //onclick of send request
    $('#reqSend').click(function(){
        let request_to = $('#moduname').text();
        let request_from = $('.sidebaruname').text();
        $.ajax({
            url: '/lnq/process/profileform.php',
            type: 'post',
            data: {"request_to":request_to, "request_from":request_from},
            success: (data) => {
                $('#umodbod').hide();
                $('#reqSend').hide();
                $('#reqNote').append(data);
                
            }
        });
    });

    // shows request popup
    $('.popup').click(function(){
        $('#myPopup').toggleClass("show");;
    });
    $('#contentArea').click(function(){
        $('#myPopup').removeClass("show");;
    });

    //briefprofile modal2
    $('#myPopup').on('click','.reqP', function() {
        let briename = $(this).find('.reqName').text();
        $('#umodbod2').empty();
        $.ajax({
            url: '/lnq/process/profileform.php',
            type: 'post',
            data: {"usname":briename},
            success: (data) => {
                $('#umodbod2').empty();
                $('#umodbod2').append(data);  
            }
        }); 
    });

    //onclick of accept request
    $('#reqAccept').click(function(){
        let request_fromd = $('#moduname').text();
        let request_tod = $('.sidebaruname').text();
        $.ajax({
            url: '/lnq/process/profileform.php',
            type: 'post',
            data: {"request_tod":request_tod, "request_fromd":request_fromd},
            success: (data) => {
                console.log(data);
                
            }
        });
    });

    
});



