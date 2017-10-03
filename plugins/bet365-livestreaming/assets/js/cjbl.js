(function ($) {
    $(document).ready(function () {
        $('.cjbl-scroll-right').hover(function () {
            var list_items = $('.cjbl-categories-list');

            var seen_width = list_items[0].offsetWidth;
            var full_width = list_items[0].scrollWidth;

            var move_left = full_width - seen_width;

            console.log(move_left);
                list_items.animate({
                    left: "-" + move_left
                }, 1000, function() {
                    reset_left_right_scroll();
                });

        }, function(){
            var list_items = $('.cjbl-categories-list');
            list_items.stop();

            reset_left_right_scroll();
        });

        $('.cjbl-scroll-left').hover(function () {
            var list_items = $('.cjbl-categories-list');

            list_items.animate({
                left: "0"
            }, 1000, function() {
                reset_left_right_scroll();
            });

        }, function(){
            var list_items = $('.cjbl-categories-list');
            list_items.stop();

            reset_left_right_scroll();
        });

        function reset_left_right_scroll() {
            var list_items = $('.cjbl-categories-list');

            var offset = list_items[0].offsetLeft.toString().replace('-', '');

            console.log(offset);

            $('.cjbl-scroll-right').css('right', '-' + offset + 'px');
            $('.cjbl-scroll-left').css('left', offset + 'px');
        }

        // TABLE CATEGORY SELECTOR
        $('.cjbl-categories-list li').click(function(){
            var $this = $(this);
            var id = $this.attr('id');

            $('.cjbl-categories-list li').removeClass('active');
            $this.addClass('active');

            var choose_table = $('#cjbl-tab-' + id);
            $('.cjbl-table-tab').removeClass('active');
            choose_table.addClass('active');

        });


        // OPEN / CLOSE TABLE LIST
        $('.cjbl-full-list-header').click(function(e){
            e.preventDefault();
           var $this = $(this);

           if ( $this.hasClass('active') ) {
               return null;
           } else {
               console.log('sdf');
               $this.next().find('tr').slideDown(5000);
           }
        });
    });
})(jQuery);
