$('#name, #phone').on('input', function(){
    $("#send_a_message").removeAttr("disabled");
    $(this).removeClass("border border-danger");
});

$('#send_a_message').on('click', function() {
    $("#send_a_message").attr("disabled", "disabled");
    $("#sendMessageSpinner").show();
    $("#failureMessage").hide();
    $("#successMessage").hide();
    var name = $('#name').val();
    var phone = $('#phone').val();
    var event_type = $("#event_type").val();
    var need_tools = $("#need_tools").val();
    var date = $("#date").val();
    var time = $("#time").val();
    var contact_message = $('#contact_message').val();

    function show_err(elm){
        $("#" + elm).focus();
        $("#" + elm).addClass("border border-danger");
        $("#sendMessageSpinner").hide();
        return 0;
    }

    if (name=="" || name.length<3) {
        show_err("name");
    }

    else if (phone=="" || phone.length<5) {
        show_err("phone");
    }

    else {
        $.ajax({
            url: "./func/mail.php",
            type: "POST",
            data: {
                name: name,
                phone: phone,
                event_type: event_type,
                need_tools: need_tools,
                date: date,
                time: time,
                contact_message: contact_message,
                sendMail: 1
            },
            cache: false,
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                $("#sendMessageSpinner").hide();
                if(dataResult.statusCode==200){
                    $("#send_a_message").removeAttr("disabled");
                    $('#successMessage').show('');
                    $('#email-form').hide('');
                    $('#email-form').serialize();
                    $("#email-form")[0].reset();
                }
                else if(dataResult.statusCode==201){
                    $("#send_a_message").removeAttr("disabled");
                    $('#failureMessage').show('');
                }

                else{
                    $("#send_a_message").removeAttr("disabled");
                    $("#failureMessage").show();
                    $('#failureMessage').html(dataResult.statusCode);
                }
            }
        });
    }


});