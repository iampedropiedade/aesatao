$(document).ready(function () {
    $('#redirect-from-type-regexp').click(function () {
        $('.regexp-note').show();
        $('.type-M').show();
    });
    $('#redirect-from-type-url').click(function () {
        $('.regexp-note').hide();
        $('.type-M').hide();
        if ($('#redirect-type-M').attr("checked")) {
            $('#redirect-type-U').click();
        }
    });
    $('#redirect-type-P').click(function () {
        $('.redirect-type-U-panel').slideUp();
        $('.redirect-type-F-panel').slideUp();
        $('.redirect-type-P-panel').slideDown();
        $('.redirect-matches').hide();
    });
    $('#redirect-type-U').click(function () {
        $('.redirect-type-P-panel').slideUp();
        $('.redirect-type-F-panel').slideUp();
        $('.redirect-type-U-panel').slideDown();
        $('.redirect-matches').hide();
    });
    $('#redirect-type-F').click(function () {
        $('.redirect-type-F-panel').slideDown();
        $('.redirect-type-U-panel').slideUp();
        $('.redirect-type-P-panel').slideUp();
        $('.redirect-matches').hide();
    });
    $('#redirect-type-M').click(function () {
        $('.redirect-type-P-panel').slideUp();
        $('.redirect-type-F-panel').slideUp();
        $('.redirect-type-U-panel').slideDown();
        $('.redirect-matches').show();
    });
    
    $('.del-button').click(function () {
        if (window.confirm("Are you sure that you want to delete this redirect?")) {
            var rowID = $(this).parents('tr').eq(0).attr("id");
            rowID = rowID.replace('redirect-row-', '');
            var tokenValue = $("#validation-token-wrapper").find('input').val();
            var submitURL = $("#validation-token-wrapper").find('a').attr("href");
            var postValues = {
                ccm_token: tokenValue,
                redirectID: rowID
            };
            $.post(submitURL, postValues, function (data) {
                if (data.result == "OK") {
                    rowID = '#redirect-row-' + data.rowID;
                    $(rowID).find('td').css('background-color', '#ff9999');
                    setTimeout('$("'+rowID+'").remove();', 1000);
                }
            }, "json");
        }
    });
});