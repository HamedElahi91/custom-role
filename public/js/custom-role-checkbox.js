jQuery(window).ready(function($) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const params = urlParams.get('action');

    //I have to check login page at the backend and front.
    if (params == 'register') {
        var container = $('#reg_password');
        $("<p class=\"custom-role-checkbox\" ><input type=\"checkbox\" name=\"fixed_customer\" id=\"fixed_customer\" >مشتری ثابت هستم</p>").insertAfter(container);
        $("<p class=\"custom-role-checkbox\" style=\"margin-top:15px;\"><input type=\"checkbox\" name=\"major_buyer\" id=\"major_buyer\" >خریدار عمده هستم</p>").insertAfter(container);
    }
    $('.wd-switch-to-register').on('click', function() {
        if ($('div.col-register') != 'none' && $("#fixed_customer").length == 0 && $("#major_buyer").length == 0) {
            var container = $('#reg_password');
            $("<p class=\"custom-role-checkbox\" ><input type=\"checkbox\" name=\"fixed_customer\" id=\"fixed_customer\" >مشتری ثابت هستم</p>").insertAfter(container);
            $("<p class=\"custom-role-checkbox\" style=\"margin-top:15px;\"><input type=\"checkbox\" name=\"major_buyer\" id=\"major_buyer\" >خریدار عمده هستم</p>").insertAfter(container);
        }
    });

    $(document).on('click', 'input[type="checkbox"]', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });

    $("button[name='register']").click(function() {
        var user_email = $('#reg_email').val();

        if (null != user_email && $('#fixed_customer').is(":checked")) {

            $.ajax({
                type: "post",
                url: my_ajax_url.ajax_url,
                dataType: 'json',
                data: {
                    action: 'custom_role_register_request_fixed_customer',
                    user_email: user_email
                },
                success: function(response) {
                    // console.log(response);
                }
            });
        }
        if (null != user_email && $('#major_buyer').is(":checked")) {

            $.ajax({
                type: "post",
                url: my_ajax_url.ajax_url,
                dataType: 'json',
                data: {
                    action: 'custom_role_register_request_major_buyer',
                    user_email: user_email
                },
                success: function(response) {
                    // console.log(response);

                }
            });
        }

    });

});