<div id="inside-post-tags-and-odds" data-id="<?php echo $post->ID ?>">
    <style scoped>
        .loader {
            display: block;
            animation: pumping 1s linear infinite;
        }

        @keyframes pumping {
            0% { opacity: 1; }
            50% { opacity: 0.1; }
            100% { opacity: 1; }
        }
    </style>

    <?php ajax_get_tags_and_odds(); ?>
</div>