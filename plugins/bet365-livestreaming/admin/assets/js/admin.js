(function ($) {

    $(document).ready(function () {

        var media_uploader = null;

        $('.cjbl-image-upload-btn').click(function() {
            var connected_to = $(this).data('connected-to');
            var $update_id = $('#' + connected_to + '-id');
            var $update_src = $('#' + connected_to + '-img');

            cjbl_media_uploader($update_id,$update_src);
        });

        function cjbl_media_uploader($update_id,$update_src) {
            media_uploader = wp.media({
                frame:    "post",
                state:    "insert",
                multiple: false
            });

            media_uploader.on("insert", function() {
                var json = media_uploader.state().get("selection").first().toJSON();
                console.log(json);

                $update_id.val(json.id);
                $update_src.attr('src', json.url);
            });


            media_uploader.open();
        }

        $('#cjbl-get-new-games').click(function () {
            $(this).attr("disabled", 'disabled');
            $('.spinner').addClass('active');
            $('#cjbl-get-new-games-description').hide();
            $.ajax({
                data: {
                    action: 'import_new_games'
                },
                url: ajax_object.ajax_url,
                dataType: 'text',
                success: function (result) {
                    console.log('cjbl success');
                    console.log(result);

                    $(this).attr("disabled", false);

                    if (result != 0) {
                        $('#cjbl-get-new-games-description').html('<strong id="cjbl-db-updated">Database' +
                            ' Updated!</strong>' +
                            ' imported' +
                            ' ' + result + ' games.').fadeIn();
                    } else {
                        $('#cjbl-get-new-games-description').html('<strong id="cjbl-db-up-to-date">Database' +
                            ' is up-to-date! </strong>').fadeIn();
                    }

                    $('.spinner').removeClass('active');
                }.bind(this),
                error: function (result) {
                    console.log('cjbl error');
                    console.log(result);
                }
            })
        });
    });
})(jQuery);
