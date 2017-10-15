(function($) {
    $(document).ready(function(){
        var ajaxurl = "http://www.101greatgoals.com/wp-admin/admin-ajax.php";

        var menu_default_max_height = $('#main-menu').css('max-height').replace('px', '');
        document.getElementById('main-menu').style.maxHeight = window.innerHeight - menu_default_max_height + 'px';

        $('#nav-icon3').click(function(e){
            var $this = $(this).parent();

            if ($this.hasClass('active')) {
                $('.menu-toggle').slideUp();
                $this.removeClass('active');
            } else {
                $('.menu-toggle').slideDown();
                $this.addClass('active');
            }
        });

        $('input').click(function(e) {
            var $this = $(this);

            if ($this.hasClass('active')) {
                return null;
            } else {
                $(this).addClass('active');
                $(this).val('');
            }
        });

        /* Homepage isotope */
        $('.grid').isotope({
            layoutMode: 'packery',
            itemSelector: '.grid-item',
            packery: {
                gutter: 20
            }
        });

        /*$('.open-social-btn').click(function(e){
            var $share_and_title =  $('.share-and-title');
            if ( ! $share_and_title.hasClass('active') ) {
                $share_and_title.addClass('active');
            } else {
                $share_and_title.removeClass('active');
            }
        });*/

        $(window).scroll(function() {
            var $title = $('#first-title-on-page');
            var $window = $(window);

            if ( !document.getElementById('on-scroll-title-mobile') && !document.getElementById('on-scroll-title') ) {
                return null;
            }

            var $titlePositionTop = $title.offset().top;
            var $titleHeight = $title.outerHeight();
            var $titleRealTop = $titlePositionTop + $titleHeight;
            var $menuLeft = $('.menu-wrapper').offset().left;

            var $share = $('#social-share');
            var $sharePositionTop = $share.offset().top;
            var $shareHeight = $title.outerHeight();
            var $shareRealTop = $sharePositionTop + $shareHeight;

            if ( $('.only-desktop').css('display') == 'none' ) {
                if ($(window).scrollTop() > ( $titleRealTop ) ) {
                    $('.share-and-title').addClass('active');
                } else {
                    $('.share-and-title').removeClass('active');
                }
            } else if ( $('.only-desktop').css('display') == 'block' ) {
                if ($window.scrollTop() > 0) {
                    $('.next-post-parent').addClass('active');
                    if ($(window).width() <= 1000)
                        $('.logo').css('left', $menuLeft + 42).addClass('no-translate-y');
                } else {
                    $('.next-post-parent').removeClass('active');
                    if ($(window).width() <= 1000)
                        $('.logo').css('left', '50%').removeClass('no-translate-y');
                }

                if ($(window).scrollTop() > $titleRealTop - 90) {
                    $('.site-header').addClass('active');
                    if ($(window).width() <= 1400 && $(window).width() > 1000)
                        $('.logo').css('left', $menuLeft + 42);
                } else {
                    $('.site-header').removeClass('active');
                    if ($(window).width() <= 1400 && $(window).width() > 1000)
                        $('.logo').css('left', '50%');
                }

                if ($(window).scrollTop() > $shareRealTop - 90 ) {
                    $('.header-shares').addClass('active');
                } else {
                    $('.header-shares').removeClass('active');
                }
            }
        });

        // ON SEARCH SUBMIT
        $('body').delegate('#search-form', 'submit', function() {
            var $search = $('.search-window');
            $search.removeClass('searching');
            $search.addClass('searching');
        });
        /*
         var scale = 1 / (window.devicePixelRatio || 1);
         var content = 'width=device-width, initial-scale=' + scale + ', minimum-scale=' + scale;

         document.querySelector('meta[name="viewport"]').setAttribute('content', content);*/
        $('.save.share').click(function(){
            console.log(ajaxurl);
            var post_id = $(this).data('post-id');
            var user_id = $(this).data('user-id');
            console.log(post_id);

            // AJAX SAVED POSTS
            $.ajax({
                url: ajaxurl,
                type : 'post',
                xhrFields: {
                    withCredentials: true
                },
                data: { action: 'save_post', post_id: post_id, user_id: user_id }
            }).done(function(response) {
                console.log(response);
            }).error(function(response){
                console.error(response);
            });
        });

        // SAVE MAIL TO FILE
        $('#main-website-newsletter').submit(function(e){
            e.preventDefault();
            var $this = $(this);

            // AJAX SAVED POSTS
            $.ajax({
                url: ajaxurl,
                type : 'post',
                data: { action: 'save_newsletter_details', email: $this.find('#newsletter-input').val() }
            }).done(function(response) {
                if (response == 1) {
                    $('.footer-wrapper .container').slideUp();
                    alert('Thank you, email added');
                } else if (response == 2) {
                    alert('Email already exists in our database');
                } else {
                    alert('Incorrect email entered');
                }
            }).error(function(response){
                console.error(response);
            });
        });

        $('.menu-item-has-children').click(function(e){
            var target = $(e.target);

            // CHECK IF TARGET IT IS THE MENU
            if ( target.hasClass('menu-item-has-children') || target.parent().hasClass('menu-item-has-children') ) {
                e.preventDefault();
            }

            var $this = $(this);

            if (target.hasClass('active') || target.parent().hasClass('active') ) {
                $this.removeClass('active');
                $this.find('.sub-menu').slideUp();
            } else {
                $this.addClass('active');
                $this.find('.sub-menu').slideDown();
            }
        });

        $('[data-toggle="tooltip"]').tooltip();

        // load right sidebar
        jQuery.get( "http://greatgoals101.staging.wpengine.com/sidebar/", function( data ) {
            jQuery( ".sidebar-container" ).append( data );
            jQuery( ".sidebar-container-loader" ).hide( 'fast' );
        });

    }); // IF DOCUMENT READY
})( jQuery ); // CLOSE JQUERY