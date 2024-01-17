$(document).ready(function() {

    document.getElementById("new-password").addEventListener("keyup", Password_Compare);
    document.getElementById("confirm-password").addEventListener("keyup", Password_Compare);

    document.getElementById("btn-change-username").addEventListener("click", function(event) {
        event.preventDefault();
        ChangeUsername();
    });

    document.getElementById("btn-change-password").addEventListener("click", function(event) {
        event.preventDefault();
        ChangePassword();
    });

    document.getElementById("btn-change-email").addEventListener("click", function(event) {
        event.preventDefault();
        ChangeEmail();
    });
})

function Password_Compare() {

    var password1 = document.getElementById("new-password");
    var password2 = document.getElementById("confirm-password");
    var button = document.getElementById("btn-change-password");

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

function ChangeUsername() {
    $.ajax({
        url: `/api/users/update`,
        type: 'POST',
        dataType: 'json',
        data: {
            'username': $('#username-text').val()
        },
        success: function(response) {
            if (response.result === 'success') {
                $('#username-result').text('Username changed successfully.');
                $('#username-result').addClass('text-success');
                $('#username-result').removeClass('text-danger');
            } else if (response.result === 'error') {
                $('#username-result').text(response.error);
                $('#username-result').addClass('text-danger');
                $('#username-result').removeClass('text-success');
            }
        },
        error: function(response) {
            $('#username-result').addClass('text-danger');
            $('#username-result').text("An error occured.");
        }
    });
}

function ChangePassword() {
    $.ajax({
        url: `/api/users/update`,
        type: 'POST',
        dataType: 'json',
        data: {
            'current-password': $('#current-password').val(),
            'password': $('#new-password').val(),
        },
        success: function(response) {
            if (response.result === 'success') {
                $('#password-result').text('Password changed successfully.');
                $('#password-result').addClass('text-success');
                $('#password-result').removeClass('text-danger');
            } else if (response.result === 'error') {
                $('#password-result').text(response.error);
                $('#password-result').addClass('text-danger');
                $('#password-result').removeClass('text-success');
            }
        },
        error: function(response) {
            $('#password-result').addClass('text-danger');
            $('#password-result').text("An error occured.");
        }
    });
}

function ChangeEmail() {
    $.ajax({
        url: `/api/users/update`,
        type: 'POST',
        dataType: 'json',
        data: {
            'email': $('#email-text').val()
        },
        success: function(response) {
            if (response.result === 'success') {
                $('#email-result').text('Email changed successfully.');
                $('#email-result').addClass('text-success');
                $('#email-result').removeClass('text-danger');
            } else if (response.result === 'error') {
                $('#email-result').text(response.error);
                $('#email-result').addClass('text-danger');
                $('#email-result').removeClass('text-success');
            }
        },
        error: function(response) {
            $('#email-result').addClass('text-danger');
            $('#email-result').text("An error occured.");
        }
    });
}