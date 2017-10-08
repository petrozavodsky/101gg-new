jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.wpse72394_plugin', {
        init : function(ed, url) {
            // Register command for when button is clicked
            ed.addCommand('wpse72394_insert_shortcode', function() {
                content =  '[button text="" text_color="" color="" link=""]';
                tinymce.execCommand('mceInsertContent', false, content);
            });

            // Register buttons - trigger above command when clicked
            ed.addButton('wpse72394_button', {title : 'Insert Button', cmd : 'wpse72394_insert_shortcode', icon: 'link'});
        },
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('wpse72394_button', tinymce.plugins.wpse72394_plugin);


});


