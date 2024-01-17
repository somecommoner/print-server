$(document).ready(function() {

    document.getElementById("password").addEventListener("keyup", Password_Compare);
    document.getElementById("confirm-password").addEventListener("keyup", Password_Compare);

})

function Password_Compare() {

    var password1 = document.getElementById("password");
    var password2 = document.getElementById("confirm-password");
    var button = document.getElementById("button-create");

    var check1;
    var check2;

    var regex = /^(?=.*\d).{8,}$/;

    //check if pas
    if (password1.value.match(regex)) {
        password1.classList.remove('is-invalid');
        password1.classList.add('is-valid');
        check1 = true;
    } else {
        password1.classList.add('is-invalid');
        check1 = false;
    }

    if (password1.value === password2.value) {
        password2.classList.remove('is-invalid');
        password2.classList.add('is-valid');
        check2 = true;
    } else {
        password2.classList.add('is-invalid');
        check2 = false;
    }

    if (check1 && check2) {
        button.disabled = false;
    } else {
        button.disabled = true;
    }


}