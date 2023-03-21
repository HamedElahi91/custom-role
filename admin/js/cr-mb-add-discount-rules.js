(function($) {
    'use strict';
    $(document).ready(function() {
        $('#fc-search-product').select2({
            tags: true,
            tokenSeparators: [',', ';'],
            ajax: {
                url: ajaxurl,
                dataType: 'json',
                type: 'post',
                data: function(params) {
                    return {
                        action: "fc_search_products_data_fetch",
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    var options = [];
                    if (data) {
                        // data is the array of arrays, and each of them contains ID and the Label of the option
                        $.each(data, function(id, title) { // do not forget that "index" is just auto incremented value
                            options.push({ id: id, text: title });
                        });
                    }
                    return {
                        results: options
                    };
                },
                cache: true
            },
            minimumInputLength: 3
        });

        $('.fc-repeater').repeater({
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.fc-repeater',
                selector: '.fc-inner-repeater'
            }],
            show: function() {
                $(this).slideDown();
                $('.select2').select2();

            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });

    });



    /*
        $('#mb-discount-rules-save-chenges').click(function(e) {
            e.preventDefault();
            // console.log($('.repeater').repeaterVal());
            // console.log($('.inner-repeater').repeaterVal());
        });

            */

})(jQuery);