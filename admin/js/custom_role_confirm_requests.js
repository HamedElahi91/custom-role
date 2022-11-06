jQuery(document).ready(function($) {
    $('.action-requests').click(function(e) {
        e.preventDefault();
        console.log($(this).data('customerid'));
        switch ($(this).data('action')) {
            case "confirm_major_buyer":
                $.ajax({
                    type: "post",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "receive_customer_requests",
                        customerid: $(this).data('customerid'),
                        type: "confirm_major_buyer"
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response.success);
                    }
                });
                break;
            case "refuse_major_buyer":
                $.ajax({
                    type: "post",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "receive_customer_requests",
                        customerid: $(this).data('customerid'),
                        type: "refuse_major_buyer"
                    },
                    dataType: "json",
                    success: function(response) {

                    }
                });
                break;
            case "confirm_fixed_customer":
                $.ajax({
                    type: "post",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "receive_customer_requests",
                        customerid: $(this).data('customerid'),
                        type: "confirm_fixed_customer"
                    },
                    dataType: "json",
                    success: function(response) {

                    }
                });
                break;
            case "refuse_fixed_customer":
                $.ajax({
                    type: "post",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "receive_customer_requests",
                        customerid: $(this).data('customerid'),
                        type: "refuse_fixed_customer"
                    },
                    dataType: "json",
                    success: function(response) {

                    }
                });
                break;
            default:
        }
    });
});