

length = 1;
$("#inputMacAddress").focusin(function (evt) {

    $(this).keypress(function () {
        content = $(this).val();
        content1 = content.replace(/\:/g, '');
        length = content1.length;
        if (((length % 2) == 0) && length < 10 && length > 1) {
            $('#inputMacAddress').val($('#inputMacAddress').val() + ':');
        }

    });

});



