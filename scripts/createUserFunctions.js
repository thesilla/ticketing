
var submitbutton = document.getElementById("registerButton")
var closePwAlertButton = document.getElementById("closePwAlert");
var pwerrorModal = document.getElementById("pwerror");

function isPasswordSame() {

    var pw1 = document.getElementById("inputPassword1");
    var pw2 = document.getElementById("inputPassword2");
    var form1 = document.getElementById("createNewUserForm");


    if (pw1.value == pw2.value) {


        form1.submit();

    } else {

        pwerrorModal.style.display = "block";

    }

}



submitbutton.onclick = isPasswordSame;
closePwAlertButton.onclick = function () {

    pwerrorModal.style.display = "none";

}



