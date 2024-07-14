/* Contact Form */
function checkEmail(email) {
    var check = /^[\w\.\+-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]{2,6}$/;
    if (!check.test(email)) {
        return false;
    }
    return true;
}

function sendMessage() {
  
    // receive the provided data
    var name = $("input#name").val();
    var email = $("input#email").val();
    var subject = $("input#subject").val();
    var phone = $("input#phone").val();
    var message = $("textarea#message").val();

    message = 'message';
    // check if all the fields are filled
    if (name == '' || phone == '' || email == '' || subject == '' || message == '') {
        $("div#output").show().html('<button type="button" class="close" data-dismiss="alert-close">x</button><p class="alert-close">Debes llenar toda la informacion de los campos!</p>');

        return false;
    }

    // verify the email address
    if (!checkEmail(email)) {
        $("div#output").show().html('<button type="button" class="close" data-dismiss="alert">x</button><p>Por favor escriba una direccion de correo valida</p>');
        return false;
    }

    // make the AJAX request
    var dataString = $('#cform').serialize();
    $.ajax({
        type: "POST",
        url: 'contact.php',
        data: dataString,
        dataType: 'json',
        success: function (data) {
            if (data.success == 0) {
                var errors = '<ul><li>';
                if (data.name_msg != '')
                    errors += data.name_msg + '</li>';
                if (data.email_msg != '')
                    errors += '<li>' + data.email_msg + '</li>';
                if (data.phone_msg != '')
                    errors += '<li>' + data.phone_msg + '</li>';
                if (data.message_msg != '')
                    errors += '<li>' + data.message_msg + '</li>';
                if (data.subject_msg != '')
                    errors += '<li>' + data.subject_msg + '</li>';

                $("div#output").removeClass('alert-success').addClass('alert-error').show().html('<button type="button" class="close" data-dismiss="alert">x</button><p> No se pudo completar su solicitud. Mire los errores a continuacion!</p>' + errors);
            }
            else if (data.success == 1) {
                $("#name").val("");
                $("#email").val("");
                $("#subject").val("");
                $("#phone").val("");
                $("#message").val("");
                $("#city").val("");
                $("div#output").removeClass('alert-error').addClass('alert-success').show().html('<button type="button" class="close" data-dismiss="alert">x</button><p>Su mensaje fue enviado correctamente!</p>');
            }

        },
        error: function (error) {
            $("div#output").removeClass('alert-success').addClass('alert-error').show().html('<button type="button" class="close" data-dismiss="alert">x</button><p> No se pudo completar su solicitud. Mire los errores a continuacion!</p>' + error.statusText);
        }
    });

    return false;
}