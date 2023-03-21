jQuery(document).ready(function($) {
    $('#test_btn').click(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: ajaxurl,
            data: {
                action: "test2"
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {

            }
        });
    });

});