// JavaScript Document
$(function() {
    $('#reveal').click(function() {
        if ($(this).is(':checked')) {
            $('#password')
                .replaceWith(
                    $('#password').clone().attr('type', 'text').attr('AUTOCOMPLETE', 'OFF')
                );
      } else {
            $('#password')
                .replaceWith(
                   $('#password').clone().attr('type', 'password')
                );
        }
    });
});