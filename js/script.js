function checkUsername(val) {
    var check = /^[_a-z]+$/g;

    // if (!check.test(val)) {
    //     document.getElementById('checktext').innerHTML = 'Only lower case latin letters and \'_\' are allowed!';
    //     document.getElementById('checktext').style.color = 'red';
    //     document.getElementById('uname').value = '';
    // } else {
    //     document.getElementById('checktext').innerHTML = '';

    // }

    //by using jquery
    if (!check.test(val)) {
        $('#checktext').html('Only lower case latin letters and \'_\' are allowed!');
        $('#checktext').css('color', 'red');
    } else {
        $('#checktext').html('');
    }
}

//ajax
function checkUser(val) {
    $.ajax({
        url: '../model/duplicateUsers.php',
        method: 'POST',
        data: {
            'username': val
        },
        async: false
    }).done(function (data) {
        var check = JSON.parse(data);
        if (check.success == true) {
            $('#checkuser').html('This username is already taken!');
            $('#checkuser').css('color', 'red');
            $('#uname').val('');
        } else {
            $('#checkuser').html('Username Available!');
            $('#checkuser').css('color', 'lightgreen');
        }
    });
}

function checkUsermail(val) {
    var check = /^([a-zA-Z0-9]\.?)+[^\.]@([a-zA-Z0-9]\.?)+[^\.]$/g;
    if (!check.test(val)) {
        $('#checkmail').html('Please enter a valid email address!');
        $('#checkmail').css('color', 'red');
        $('#email').val('');
    } else {
        $('#checkmail').html('');
    }
}

function checkUserpass(val) {
    var check = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_!@#\$%\^&\*])(?=.{8,})/g;
    if (!check.test(val)) {
        $('#checkpass').html('Password must contain 8 characters and at least 1 lowercase letter, 1 uppercase letter, 1 number & 1 special character!');
        $('#checkpass').css('color', 'red');
        $('#email').val('');
    } else {
        $('#checkpass').html('');
    }
}
