/*
 * BURST SMS API JS
 */

$(document).ready(function () {


    $('#send').click(function (e) {

        e.preventDefault();

        var mobileno = $("#mobileno").val();

        var message = $("#message").val();


        $.ajax({
            type: "POST",
            url: "library/sendapi.php",
            dataType: "json",
            data: {mobileno: mobileno, message: message},
            success: function (data) {
                var msg = '';
                if (data.msg.length > 0) {
                    $('#msg_placeholer').css("display", "block");
                    $.each(data.msg, function (index, value) {
                        msg += value;
                    });
                    $('#msg_placeholer').html(msg)
                }
            }

        });


    });

    $("form").on("keyup", "textarea.keepcount", function(e){
        maxChar = parseInt(480);
        charCount = parseInt($(this).val().length);

        if (typeof(chrome) !== 'undefined' && chrome) {
            charCount = $(this).val().replace(/(\r\n|\n|\r)/g,"  ").length;
        }
        
        $('#charcount').html(maxChar-charCount);
        
        if(charCount > maxChar) {
            e.preventDefault(); // do not allow more than 480 characters (3 sms in length)
            $(this).val($(this).val().substring(0,maxChar));
        }
    });
});

