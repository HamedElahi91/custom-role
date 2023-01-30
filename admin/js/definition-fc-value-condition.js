jQuery(document).ready(function($) {
    $('#save-val-condition').click(function(e) {
        e.preventDefault();
        let valueCondition = $('#value-condition').val();
        if (valueCondition != "" && !isNaN(valueCondition)) {
            $.ajax({
                type: "post",
                url: definition_ajax_url.ajax_url,
                data: {
                    action: "update_fc_value_condition",
                    value: valueCondition
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    alert('err');
                }

            });
        } else {
            alert('no');
        }
    });
});