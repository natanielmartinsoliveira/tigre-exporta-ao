(function ($, Drupal) {
    Drupal.behaviors.myBehavior = {
        attach: function (context, settings) {    
            var scroll_start = 0;
            //var startchange = 0;
            //var offset = startchange.offset();
            //if (startchange.length){
                $(document).scroll(function() { 
                scroll_start = $(this).scrollTop();
                if(scroll_start > 0) {
                    $("#navbar-collapse").css({
                        'background-color': '#ffffff',
                        "margin-top": "-39px",
                        "box-shadow": "0 1px 0 rgba(12,13,14,0.1), 0 1px 3px rgba(12,13,14,0.1), 0 4px 20px rgba(12,13,14,0.035), 0 1px 1px rgba(12,13,14,0.025)"
                        });
                    } else {
                    $('#navbar-collapse').css({
                        'background-color': 'transparent',
                        "margin-top": "0",
                        "box-shadow": "none"
                        });
                    }
                });
            //}
        }
    };
})(jQuery, Drupal);