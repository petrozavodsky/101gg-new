<div id="suggested_posts" data-id="<?php echo $post->ID ?>">
    <h3 class="suggested_posts__title"><?php echo $cj_teams_terms['name'] ?></h3>
    <div class="row category-posts">
        <?php

        $seen_posts = json_decode( stripslashes($_COOKIE['seen_posts']), true );

        // ADD CURRENT POST TO SEEN POSTS
        $seen_posts[] = $post->ID;

        $suggest_args = array(
            'post_type'			=> 'post',
            'post_status'		=> 'publish',
            'order_by'          => 'meta_value_num',
            'meta_key'          => 'post_views',
            'posts_per_page'    => 3,
            'post__not_in'		=> $seen_posts,
            'suppress_filters'  => true,
            'update_post_term_cache' => false, // don't retrieve post terms
            'update_post_meta_cache' => false, // don't retrieve post meta,
            'no_found_rows' => true, // counts posts, remove if pagination required,
            'date_query'	=> array(
                array(
                    'column'  => 'post_date',
                    'after'   => '-180 days'
                )
            )
        );

        $suggest_args['tax_query'] = array(
            array(
                'taxonomy' => 'teams',
                'field'    => 'ids',
                'terms'    => $cj_teams_terms['id'],
            )
        );


        $suggest_query = new WP_Query( $suggest_args );

        while ( $suggest_query->have_posts() ) :
            $suggest_query->the_post(); ?>
            <?php $posts_to_exclude_from_players[] = $post->ID; ?>
            <div class="col-md-4 category-post">
                <div class="post-wrapper">
                    <a href="<?php the_permalink() ?>">
                        <div class="post-image">
                            <picture>
                                <source srcset="<?php the_post_thumbnail_url( 'codeja-homepage-thumb' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
                                <source srcset="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                <img src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                            </picture>
                        </div>
                        <div class="post-excerpt">
                            <p>
                                <?php the_real_or_external_title() ?>
                            </p>
						<span class="btn btn-readmore btn-absolute">
							<span class="readmore-text">Watch NoW</span>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
                        </div>
                    </a>
                </div>
            </div>
        <?php endwhile; 	wp_reset_postdata();
        ?>
    </div>
</div>