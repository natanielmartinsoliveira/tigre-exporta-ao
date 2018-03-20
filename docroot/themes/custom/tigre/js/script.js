(function ($, Drupal) {
    Drupal.behaviors.myBehavior = {
        attach: function (context, settings) {    
            var scroll_start = 0;
            $(document).ready(function(){
                
                function navBarVerify($param) {
                    scroll_start = $(this).scrollTop();
                    // From top
                    if(scroll_start > 0) {
                        $("#navbar-collapse").css({
                            'background-color': '#fff',
                            "margin-top": "-39px",
                            "box-shadow": "0 1px 0 rgba(12,13,14,0.1), 0 1px 3px rgba(12,13,14,0.1), 0 4px 20px rgba(12,13,14,0.035), 0 1px 1px rgba(12,13,14,0.025)"
                            });
                        $(".menu--main li a").css({
                                'color': '#000000'
                        });
                        $(".menu--busca li a").css({
                            'color': '#000000'
                        });
                        // $("#navbar-collapse .logo img").css({
                        //         'background': 'url(themes/custom/tigre/assets/images/logo-azul.png) no-repeat'
                        //     });
                        $("#navbar-collapse .logo img")[0].src = 'http://34.193.90.181/export/themes/custom/tigre/assets/images/logo-azul.png';
                        if (screen.width <= 768){
                            $(".navbar-header").css({
                                'background': '#0083ca'
                            });
                        }
                    } else {
                        if (screen.width > 768){
                            $('#navbar-collapse').css({
                                'background-color': 'transparent',
                                "margin-top": "0",
                                "box-shadow": "none"
                            });
                            $(".menu--main li a").css({
                                'color': '#ffffff'
                            });
                            $(".menu--busca li a").css({
                                'color': '#ffffff'
                            });
                            
                            $("#navbar-collapse .logo img")[0].src = 'http://34.193.90.181/export/themes/custom/tigre/logo.svg';
                        } else {
                            $(".navbar-header").css({
                                'background': 'transparent'
                            });
                        }
                    }
                 }
                 
                navBarVerify();
                $(document).scroll(function() { 
                    navBarVerify();
                    // From middle, session products
                    if (scroll_start > 800) {
                        $('.card-contato').fadeOut();
                      } else {
                        $('.card-contato').fadeIn();
                      }
                });

                $(".busca--btn").click(function() { 
                    if( $("#search-block-form--2").length > 0) {
                        $('html, body').animate({
                            scrollTop: $("#search-block-form").offset().top - 200
                        }, 1000);
                    }else{
                        $('#modal-div').modal('show');
                    }
                });

                // $(function () {
                //     $( "#tree3 .selected" ).parents('#tree3 .branch').map(function() {
                //     console.log($(this));
                //     var icon = $(this).children('i:first');

                //     icon.toggleClass('glyphicon-folder-open glyphicon-folder-close');

                //     $(this).children().children().toggle();
                //     })

                // });

                $("#search-block-form").click(function (){
                    $('html, body').animate({
                        scrollTop: $("#search-block-form").offset().top - 200
                    }, 1000);
                });

                $.fn.extend({
                    treed: function (o) {
                      
                      var openedClass = 'glyphicon-minus-sign';
                      var closedClass = 'glyphicon-plus-sign';
                      
                      if (typeof o != 'undefined'){
                        if (typeof o.openedClass != 'undefined'){
                        openedClass = o.openedClass;
                        }
                        if (typeof o.closedClass != 'undefined'){
                        closedClass = o.closedClass;
                        }
                      };
                      
                        //initialize each of the top levels
                        var tree = $(this);
                        tree.addClass("tree");
                        tree.find('li').has("ul").each(function () {
                            var branch = $(this); //li with children ul
                            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                            branch.addClass('branch');
                            branch.on('click', function (e) {
                                if (this == e.target) {
                                    var line = $(this).children('a:first');
                                    line.toggleClass('is-active');
                                    var icon = $(this).children('i:first');
                                    icon.toggleClass(openedClass + " " + closedClass);
                                    $(this).children().children().toggle();
                                }
                            })
                            branch.children().children().toggle();
                        });
                        //fire event from the dynamically added icon
                      tree.find('.branch .indicator').each(function(){
                        $(this).on('click', function () {
                            $(this).closest('li').click();
                        });
                      });
                        //fire event to open branch if the li contains an anchor instead of text
                        // tree.find('.branch>a').each(function () {
                        //     $(this).on('click', function (e) {
                        //         $(this).closest('li').click();
                        //         e.preventDefault();
                        //     });
                        // });
                        //fire event to open branch if the li contains a button instead of text
                        tree.find('.branch>button').each(function () {
                            $(this).on('click', function (e) {
                                $(this).closest('li').click();
                                e.preventDefault();
                            });
                        });
                        
                    }
                });

                $('#tree3', context).once('myCustomBehavior').each(function () {
                    $(this).treed({openedClass:'glyphicon-chevron-right is-active', closedClass:'glyphicon-chevron-down'});

                    $('#tree3 li').find('a').each(function () {
                        if (document.location.pathname == $(this).attr('href')) {
                            $(this).parents('#tree3 .branch').map(function() {
                                var line = $(this).children('a:first');
                                line.toggleClass('is-active');
                                var icon = $(this).children('i:first');
                                icon.toggleClass('glyphicon-chevron-right is-active glyphicon-chevron-down');
                                $(this).children().children().toggle();
                            })
                        }
                    });

                });
            });
        }
    };
})(jQuery, Drupal);