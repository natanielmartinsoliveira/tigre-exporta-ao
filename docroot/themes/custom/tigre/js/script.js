(function ($, Drupal) {
    Drupal.behaviors.myBehavior = {
        attach: function (context, settings) {    
            var scroll_start = 0;
			
			$(window).on('resize', function(){
				  var win = $(this); //this = window
				  var scroll_init = $(this).scrollTop();
				  if (win.width() > 691 ) { 
					$( ".navbar-collapse" ).removeClass( "scrollingmenu" ); 
				  }
				  
			});
            $(document).ready(function(){
                
                function navBarVerify($param) {
                    scroll_start = $(this).scrollTop();
                    // From top
                    if(scroll_start > 0) {
                        navBarBlue();
						
                    } else {
                        if ($(window).width() > 768){
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
						$( ".navbar-header" ).removeClass( "scrollingbar" );
						
                    }
					    if ($(window).width() <= 768){
							$( "#navbar-collapse" ).addClass( "scrollingmenu" );
						}
                 }
                
                function navBarBlue() {
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
                    $("#navbar-collapse .logo img")[0].src = 'http://34.193.90.181/export/themes/custom/tigre/assets/images/logo-azul.png';
                    if ($(window).width() <= 768){
                        $(".navbar-header").css({
                            'background': '#0083ca'
                        });
						$( ".navbar-header" ).addClass( "scrollingbar" );
						$( "#navbar-collapse" ).removeClass( "scrollingmenu" );
						
                    }
                }
                if( $(".menu--main--close").length == 0) {
                    $("#block-views-block-contatos-block-1").after("<span class='menu--main--close'>X</span>");
                }
                if( $(".menu--main--divider").length == 0) {
                    $(".menu--main--close").after("<div class='menu--main--divider'></div>");
                }
                navBarVerify();
                $(document).scroll(function() { 
                    if( $(".menu--flutuante--header--ativo").length == 0) {
                        navBarVerify();
                        // From middle, session products
                        if ( $(window).width() > 992 ) {
                            if ( scroll_start > 800) {
                                $('.card-contato').fadeOut();
                            } else {
                                $('.card-contato').fadeIn();
                            }
                        }
                    }else{
                        if($(window).scrollTop() === 0){
                            $('#navbar-collapse').css({"margin-top": "0px"});
                        }else{
                            $('#navbar-collapse').css({"margin-top": "-39px"});
                        }
                    }
                });

                $(".js-open-filter-mob").click(function() { 
                    $('.tree').css({"display": "block", "padding-top": "0px"});
                    $('.js-open-filter-mob-close').css({"display": "inline-block"});
                });
                $(".js-open-filter-mob-close").click(function() { 
                    $('.tree').css({"display": "none", "padding-top": "21px"});
                    $('.js-open-filter-mob-close').css({"display": "none"});
                });
                // $(".file-link a").click(function(e) { 
                //     if( $('#down-clicked').val() == "" ){
                //         var idElem = $(this).attr('href');
                //         var urlElem = encodeURIComponent(idElem);
                //         e.preventDefault();
                //         $('#down-clicked').val(urlElem);
                //         $('#modal--download-catalogo').modal('show');
                //     }
                // });
                $("#edit-submit--2").click(function(e) { 
                    var idClicked = $('#down-clicked').val();
                    window.open(decodeURIComponent(idClicked)); 
                });
                
                

                $('.menu--main li a').each(function () {
                    $(this).addClass('menu--main--link');
                });
                //$(".menu--main--catalogos").hide();
                //$(".menu--main--products").hide();
                //$("#block-tigre-main-menu ul:after").hide();
                
                $(".menu--main--link").click(function(e) { 
                    
                    if ('#produtos' == $(this).attr('href') || '#materiais-tecnicos' == $(this).attr('href')) {
                        $('.menu--main--link').removeClass('js-menu--ativo');
                        $(this).addClass('js-menu--ativo');
                        $('.menu--flutuante--header').addClass('menu--flutuante--header--ativo');
                        navBarBlue();
                        $('#navbar-collapse').css({
                            'background-color': 'transparent',
                            "box-shadow": "none"
                        });
                        if($(window).scrollTop() === 0){
                            $('#navbar-collapse').css({"margin-top": "0px"});
                        }else{
                            $('#navbar-collapse').css({"margin-top": "-39px"});
                        }
                        //$("#block-tigre-main-menu ul:after").show();
                        $("#block-busca").hide();
                        $("#block-views-block-contatos-block-1").hide();
                        $('.menu--main--close').css({"display": "block"});
                        $('.menu--main--divider').css({"display": "block"});
                        e.preventDefault();
                    }
                    if ('#produtos' == $(this).attr('href') ) {
                        $(".menu--main--catalogos").hide();
                        $(".menu--main--products").show();
                    }
                    if ('#materiais-tecnicos' == $(this).attr('href') ) {
                        $(".menu--main--products").hide();
                        $(".menu--main--catalogos").show();
                    } 
                });
                $(".menu--main--close").click(function(e) { 
                    $('.menu--flutuante--header').removeClass('menu--flutuante--header--ativo');
                    $("#block-busca").show();
                    $("#block-views-block-contatos-block-1").show();
                    $(".menu--main--catalogos").hide();
                    $(".menu--main--products").hide();
                    $('.menu--main--close').css({"display": "none"});
                    $('.menu--main--link').removeClass('js-menu--ativo');
                    $('.menu--main--divider').css({"display": "none"});
                    
                    navBarVerify();
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
                $(".block-roleapagina-btn").click(function() { 
                    if( $("#main-content").length > 0) {
                        $('html, body').animate({
                            scrollTop: $("#main-content").offset().top - 200
                        }, 500);
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

                $('.menu--icon--main').click(function(e) {
                    //$('.menu--header--box').hide();
                    $('.menu--header--box').removeClass('active--box');
                    $('#' + $(this).attr('title')).toggleClass('active--box');
                    e.preventDefault();
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