<?php
/**
 * Build By:
 * www.CODEJA.net - Turning imagination into creation
 *
 * Team Member:
 * Full Name: Kirill Lavrishev
 * Contact Information: #0526142466 / k@codeja.net
 *
 * File Details:
 * Date of creation: 28-Nov-16 / 15:29
 * Last updated: 28-Nov-16 / 15:29 By Kirill Lavrishev
 *
 *

* @name : codeja_is_category_or_posts_with_category
          *
 * this function get categories array or string and first of all check if it array or string.
 * if it is array it will create string from it, otherwise it will left it as default string.
 * after that the function checks if current page category is part of the array or is the same like the string.
 *
 * @param: $categories (array or string)
           * @return true / false
                     */
function codeja_is_category_or_posts_with_category( $categories ) {
	// IF NOT AN ARRAY ALREADY, MAKE IT AN ARRAY
	if ( !is_array( $categories ) ) {
		$categories = explode( ',', $categories );
	}

	// LOOP THROUGH ALL THE CATEGORIES AND FIND IF IN ARRAY
	foreach ( get_the_category() as $category ) {
		if ( in_array( $category->cat_ID, $categories ) ) {
			return true;
		}
	}

	return false;
}


/**
 * Adds  codeja widget for 101 great golas for posts by categories.
 */
class codeja_sidebar_post_widget extends WP_Widget {
	public function __construct() {
		/**
		 * Register widget with WordPress.
		 */
		parent::__construct(

			'codeja_sidebar_post_category_widget', // Base ID

			'SW', // Name

			array( 'description' => __( 'A Widget that displays posts by single category or by many categories and enable to sort them by rank, date or random. maximum 5 posts per widget. you may use this in sidebar.', 'text_domain' ), ) // Args

		);
	}

	/**
	 * Front-end display of widget.
	 * @see WP_Widget::widget()
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 * @logic - here we will do all the logic of the args we get.
	 */
	public function widget( $args, $instance ) {
		// ATTRIBUTES
      /*  echo '<pre style="direction: ltr; text-align: left">';
        print_r($instance);
        echo '</pre>';*/
		$selected_categories = $instance['selected_categories'];
        $selected_tags = $instance['selected_tags'];
        $selected_livestreaming = $instance['selected_livestreaming'];
		$posts_to_show = $instance['posts_to_show'];
        $url = $instance['url'];
        $posts_per_page = is_numeric($instance['posts_per_page']) && $instance['posts_per_page'] != 0 ? $instance['posts_per_page'] : 5;
		$template = $instance['template_select'];
		$where_to_appear = $instance['where_to_appear'];
		$appear_everywhere = $instance[ 'appear_everywhere' ] == 1 ? true : false;

        // TAXONOMIES
        $get_taxonomies = get_object_taxonomies( 'post', 'objects' );

        // DELETE UNNEEDED TAXONOMIES
        unset( $get_taxonomies['category'] );
        unset( $get_taxonomies['post_tag'] );
        unset( $get_taxonomies['post_format'] );
        unset( $get_taxonomies['clean_feeds'] );
        unset( $get_taxonomies['yst_prominent_words'] );

		// CHECK IF APPEAR ON FRONT PAGE
		$appear_on_homepage = false;
		if ( is_home() || is_front_page() ) {
			$appear_on_homepage = $instance['appear_on_homepage'] ? true : false;
		}

		// ADD DEFAULT WIDGET CLASS TO "CLASS"
		$args['before_widget'] = str_replace('class="', 'class="codeja-smart-widget ' . $template . ' ', $args['before_widget']);

		remove_all_filters('posts_orderby');

		// QUERY ARGUMENTS
		$query_args = array(
			'order'                 => 'DESC',
			'post_status'           => 'publish',
			'post_type'             => array( 'post', CJBL::$post_type ),
			'suppress_filters'	    => 'true',
			'update_post_term_cache' => false, // don't retrieve post terms
			'update_post_meta_cache' => false // don't retrieve post meta,
		);

        if ( ! empty ( $posts_per_page ) && $posts_per_page != 0 ) {
            $query_args['posts_per_page'] = $posts_per_page;
        } else {
            $query_args['posts_per_page'] = 5;
        }

        if ( ! empty ( $selected_categories ) ) {
            $selected_categories__exploded = explode( ',', $selected_categories );

            unset( $query_args['tag__in'] );
            $query_args['category__in'] = $selected_categories__exploded;
        }

		if ( ! empty ( $selected_tags ) ) {
            $selected_tags__exploded = explode( ',', $selected_tags );

            unset( $query_args['tag__in'] );
            $query_args['tag__in'] = $selected_tags__exploded;
        }

        // GET ALL TAXONOMIES
        $i = 0;
        foreach ( $get_taxonomies as $value ) {
            $name = 'selected_' . $value->name;
            if ( $instance[$name] ) {
                if ( $i === 0 ) {
                    $query_args['tax_query'] = array();
                    $i++;
                }

                $selected_taxonomies = explode( ',', $instance[$name] );

                $query_args['tax_query']['relation'] = 'OR';
                $query_args['tax_query'][] = array(
                        'taxonomy' => $value->name,
                        'field' => 'term_id',
                        'terms' => $selected_taxonomies,
                        'operator' => 'IN'
                );
            }
        }

        if ( ! empty ( $selected_livestreaming ) ) {
            $selected_livestreaming__exploded = explode( ',', $selected_livestreaming );

            unset( $query_args['category__in'] );
            unset( $query_args['tag__in'] );
            unset( $query_args['tax_query'] );
            $query_args['post_type'] = CJBL::$post_type;
            $query_args['tax_query'] =  array(
                array (
                    'taxonomy' => CJBL::$taxonomy,
                    'operator' => 'IN',
                    'field' => 'term_id',
                    'terms' => $selected_livestreaming__exploded,
                )
            );
        }

/*        echo '<pre style="direction: ltr; text-align: left">';
        print_r($query_args);
        echo '</pre>';*/

		// SWITCH THROUGH ORDER BY AND ASSIGN CORRECT ORDER

		switch($instance['order_by']) {
			case 'top':
				$query_args['orderby'] = 'post_views';
				$query_args['date_query'] = array(
					'relation'   => 'OR',
					array(
						'column'  => 'post_date',
						'after'   => '-2 days'
					)
				);
				break;
			case 'new':
				$query_args['orderby'] = 'post_date';
				break;
			case 'random':
				$query_args['orderby'] = 'rand';
				break;
			default:
				$query_args['orderby'] = 'rand';
				break;
		}

		// IF POSTS SELECTED
        if ( ! empty ( $posts_to_show )  ) {
            unset( $query_args['category__in'] );
            unset( $query_args['tag__in'] );
            unset( $query_args['orderby'] );
            unset( $query_args['tax_query'] );

            $posts_to_show__exploded = explode( ',', $posts_to_show );

            $query_args['posts_per_page'] = count( $posts_to_show__exploded );
            $query_args['post__in'] = $posts_to_show__exploded;
        }

		$show_on_screen = false;

		if (wp_is_mobile() && $instance['if_dfb_mobile_or_desktop'] != 2) {
			$show_on_screen = true;
		} else if ($instance['if_dfb_mobile_or_desktop'] != 3 && !wp_is_mobile()) {
			$show_on_screen = true;
		} elseif ($instance['if_dfb_mobile_or_desktop'] == 1) {
			$show_on_screen = true;
		}

		if ( $show_on_screen ) {
			if ( codeja_is_category_or_posts_with_category( $where_to_appear ) || $appear_on_homepage || $appear_everywhere ) : ?>
				<?php echo $args['before_widget'] // DIV ID CLASS?>

				<?php echo $args['before_title'] // H2 ?>

                <!-- IF URL BEING USED -->
                <?php if ( ! empty ( $url ) ) : ?>
                    <a href="<?php echo $url ?>"<?php echo cj_is_amp() ? null : ' style="font-family: inherit"'; ?>>
				 <?php echo $instance['real_title'] ?>
                    </a>
				 <?php else : ?>
                    <?php echo $instance['real_title'] ?>
                <?php endif; ?>

				<?php echo $args['after_title'] // CLOSE H2 ?>

				<?php $query = new WP_Query( $query_args ); ?>
				<?php if ( $query->have_posts() ) : $i = 1; ?>
					<?php if ( $template == 'numbers' ) : ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php $post_title = get_the_real_or_external_title(); ?>
                            <ul class="list-unstyled">
								<li class="clearfix">
									<a href="<?php echo the_permalink() . cj_is_amp() ? '?is_amp' : null; ?>" title="<?php echo $post_title ?>" <?php echo cj_is_amp() ? ' class="amp-cj-widget-link"' : null; ?>>
										<div class="thumb-placeholder ripple-out">
											<span class="number"><?php echo $i ?></span>
										</div>
										<div class="title-placeholder">
											<p class="title">
												<?php the_cut_and_dots( $post_title, 100 ) ?>
											</p>
										</div>
									</a>
								</li>
							</ul>
							<?php $i ++; endwhile;?>
					<?php elseif ( $template == 'videos' ) : ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php $post_title = get_the_real_or_external_title(); ?>
							<?php if ( $i == 1 ) : // IF FIRST POST - BIG THUMBNAIL ?>
								<div class="big-thumbnail">
									<a href="<?php the_permalink() ?>" title="<?php echo $post_title ?>">
										<div class="thumb-thumbnail">
											<?php the_post_thumbnail( 'codeja-homepage-thumb' ); ?>
										</div>
										<div class="play-button">
											<img
												src="<?php echo get_template_directory_uri() . '/images/play-button.png' ?>"/>
										</div>
									</a>
								</div>
								<?php $i ++;
								continue; endif; ?>
							<ul class="list-unstyled">
								<li class="clearfix">
									<a href="<?php the_permalink() ?>" title="<?php echo $post_title ?>">
										<div class="thumb-placeholder">
											<?php the_post_thumbnail( 'codeja-small-horizontal', array( 'title' => get_the_title() ) ); ?>
										</div>
										<div class="title-placeholder">
											<p class="title">
												<?php the_cut_and_dots( $post_title, 75 ) ?>
											</p>
										</div>
									</a>
									<div class="running-border">
									</div>
								</li>
							</ul>
							<?php $i ++; endwhile; ?>
					<?php elseif ( $template == 'thumbnails' ) : ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php $post_title = get_the_real_or_external_title(); ?>
                            <ul class="list-unstyled">
								<li class="clearfix">
									<a href="<?php the_permalink() ?>" title="<?php echo $post_title ?>">
										<div class="thumb-placeholder">
											<?php the_post_thumbnail( 'codeja-small-horizontal' ); ?>
										</div>
										<div class="title-placeholder">
											<p class="title">
												<?php the_cut_and_dots( $post_title, 60 ) ?>
											</p>
										</div>
									</a>
									<div class="running-border">
									</div>
								</li>
							</ul>
							<?php $i++; endwhile;  ?>
					<?php endif; // CLOSE TEMPLATE SELECTION ?>
					<?php endif; // CLOSE IF HAVE POSTS ?>
			<!--		<?php /*if ( !is_home() && !is_front_page() ) : */?>
					<?php /*wp_reset_postdata(); */?>
					--><?php /*endif; */?>
				<?php echo $args['after_widget'] // CLOSE WIDGET DIV?>

			<?php endif;
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return null
	 */
	public function form( $instance ) {
		// LOAD OUTSIDE JS
		if( is_admin() ) {
			wp_enqueue_script('admin_enqueue_scripts', get_template_directory_uri() . '/js/posts-widget.js', array('jquery'));
			wp_enqueue_style('admin_enqueue_scripts', get_template_directory_uri() . '/css/posts-widget.css');
		}

		$real_title = $instance[ 'real_title' ];
		$posts_to_show = $instance[ 'posts_to_show' ];
		$title = $instance[ 'title' ];
		$url = $instance['url'];
		$selected_categories = $instance[ 'selected_categories' ];
		$selected_tags = $instance[ 'selected_tags' ];
        $selected_livestreaming = $instance[ 'selected_livestreaming' ];
		$where_to_appear = $instance[ 'where_to_appear' ];
		$template_select = $instance[ 'template_select' ];
		$order_by = $instance[ 'order_by' ];
		$posts_per_page = $instance[ 'posts_per_page' ];
		$appear_on_homepage = $instance[ 'appear_on_homepage' ];
		$appear_everywhere = $instance[ 'appear_everywhere' ];
		$if_dfb_mobile_or_desktop = ! empty( $instance['if_dfb_mobile_or_desktop'] ) ? $instance['if_dfb_mobile_or_desktop'] : '';



		// INIT
		$get_categories = get_option_of_all_categories();
        $get_taxonomies = get_object_taxonomies( 'post', 'objects' );

        // DELETE UNNEEDED TAXONOMIES
        unset( $get_taxonomies['category'] );
        unset( $get_taxonomies['post_tag'] );
        unset( $get_taxonomies['post_format'] );
        unset( $get_taxonomies['clean_feeds'] );
        unset( $get_taxonomies['yst_prominent_words'] );
		?>
		<!-- HIDDEN TITLE -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Hidden Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<!-- REAL TITLE -->
		<p>
			<label for="<?php echo $this->get_field_id( 'real_title' ); ?>"><?php _e( 'Real Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'real_title' ); ?>" name="<?php echo $this->get_field_name( 'real_title' ); ?>" type="text" value="<?php echo esc_attr( $real_title ); ?>" />
		</p>

		<!-- POSTS SELECT -->
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_to_show' ); ?>"><?php _e( 'Select Posts by Id (leave empty to use categories):' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'posts_to_show' ); ?>" name="<?php echo $this->get_field_name( 'posts_to_show' ); ?>" type="text" placeholder="Post ID's with ',' between" value="<?php echo esc_attr( $posts_to_show ); ?>" />
		</p>

		<!-- CATEGORY SELECT -->
		<p>
			<label for="<?php echo $this->get_field_id( 'selected_categories' ); ?>"><?php _e( 'Select Categories:' ); ?></label>
			<select class="widefat codeja-multi-select" data-id="<?php echo $this->get_field_id( 'selected_categories' ); ?>">
				<?php echo $get_categories ?>
			</select>
			<div class="<?php echo $this->get_field_id( 'selected_categories' ); ?>">
			<?php if ($selected_categories) : ?>
				<?php foreach( explode(',',$selected_categories) as $selected_id) : // EXPLODE TO MAKE ARRAY AND START LOOP ?>
					<span class="selected-category" data-id="<?php echo $selected_id?>">
						<?php print_r ( get_the_category_by_ID($selected_id) ) // ECHO NOT WORKING HERE ?>
						<a class="delete-category">&#10006;</a>
					</span>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>
			<input type="hidden" id="<?php echo $this->get_field_id( 'selected_categories' ); ?>" name="<?php echo $this->get_field_name( 'selected_categories' ); ?>" class="<?php echo $this->get_field_id( 'selected_categories' ); ?>-input" value="<?php echo esc_attr( $selected_categories ); ?>">
		</p>

        <!-- TAGS SELECT -->
        <p>
            <label for="<?php echo $this->get_field_id( 'selected_tags' ); ?>"><?php _e( 'Select Tags by Id:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'selected_tags' ); ?>" name="<?php echo $this->get_field_name( 'selected_tags' ); ?>" type="text" placeholder="Tags ID's with ',' between" value="<?php echo esc_attr( $selected_tags ); ?>" />
        </p>

        <!-- PLAYERS MANAGERS AND ETC SELECT -->
        <?php foreach ( $get_taxonomies as $value ) :
            $name = 'selected_' . $value->name;
            $label = $value->labels->name;
            $value = $instance[$name];
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( $name ); ?>"><?php _e( 'Select ' . $label . ' by Id:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( $name ); ?>" name="<?php echo $this->get_field_name( $name ); ?>" type="text" placeholder="<?php echo $label ?> ID's with ',' between" value="<?php echo esc_attr( $value ); ?>" />
            </p>
        <?php endforeach; ?>

        <!-- LIVE STREAMING SELECT -->
        <p>
            <label for="<?php echo $this->get_field_id( 'selected_livestreaming' ); ?>"><?php _e( 'Select Live Streaming by Id:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'selected_livestreaming' ); ?>" name="<?php echo $this->get_field_name( 'selected_livestreaming' ); ?>" type="text" placeholder="Livestreaming Categories ID's with ',' between" value="<?php echo esc_attr( $selected_livestreaming ); ?>" />
        </p>

		<!-- WHERE TO SHOW SELECT -->
		<p>
			<label for="<?php echo $this->get_field_id( 'where_to_appear' ); ?>"><?php _e( 'Where To Show:' ); ?></label>
			<select class="widefat codeja-multi-select" data-id="<?php echo $this->get_field_id( 'where_to_appear' ); ?>">
                <?php echo $get_categories ?>
			</select>
			<div class="<?php echo $this->get_field_id( 'where_to_appear' ); ?>" >
			<?php if ($where_to_appear) : ?>
				<?php foreach( explode(',',$where_to_appear) as $selected_id) : // EXPLODE TO MAKE ARRAY AND START LOOP ?>
					<span class="selected-category" data-id="<?php echo $selected_id?>">
							<?php print_r ( get_the_category_by_ID($selected_id) ) // ECHO NOT WORKING HERE ?>
						<a class="delete-category">&#10006;</a>
						</span>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>
			<input type="hidden" id="<?php echo $this->get_field_id( 'where_to_appear' ); ?>" name="<?php echo $this->get_field_name( 'where_to_appear' ); ?>" class="<?php echo $this->get_field_id( 'where_to_appear' ); ?>-input" value="<?php echo esc_attr( $where_to_appear ); ?>">
		</p>

		<!-- TEMPLATE SELECT -->
		<p>
			<label for="<?php echo $this->get_field_id( 'template_select' ); ?>"><?php _e( 'Select Template:' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'template_select' ); ?>" name="<?php echo $this->get_field_name( 'template_select' ); ?>">
				<option value="numbers" <?php is_selected('numbers', $template_select) ?>>numbers</option>
				<option value="thumbnails" <?php is_selected('thumbnails', $template_select) ?>>thumbnails</option>
				<option value="videos" <?php is_selected('videos', $template_select) ?>>videos</option>
			</select>
			<ul class="demo list-unstyled">
					<li>Numbers: <a href="https://dl.dropboxusercontent.com/s/x536fckjxxm987z/chrome_2016-11-29_19-41-10.png" target="_blank">click here</a></li>
					<li>Thumbnails: <a href="https://dl.dropboxusercontent.com/s/l6o4ernmayewpfa/chrome_2016-11-29_19-41-27.png" target="_blank">click here</a></li>
					<li>Videos: <a href="https://dl.dropboxusercontent.com/s/y21l1at4152c5fh/chrome_2016-11-29_19-39-41.png" target="_blank">click here</a></li>
			</ul>
		</p>

		<!-- ORDER BY SELECT -->
		<p>
			<label for="<?php echo $this->get_field_id( 'order_by' ); ?>"><?php _e( 'Order By:' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'order_by' ); ?>" name="<?php echo $this->get_field_name( 'order_by' ); ?>">
				<option value="top" <?php is_selected('top', $order_by) ?>>top</option>
				<option value="new" <?php is_selected('new', $order_by) ?>>new</option>
				<option value="random" <?php is_selected('random', $order_by) ?>>random</option>
			</select>
		</p>

		<!-- POSTS PER PAGE INPUT -->
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'How Many posts to show:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="number" value="<?php echo esc_attr( $posts_per_page ); ?>" />
		</p>

		<!-- APPEAR ON HOMEPAGE CHECKBOX -->
		<p>
			<label for="<?php echo $this->get_field_id( 'appear_on_homepage' ); ?>"><?php _e( 'Show on homepage?' ); ?></label>
			<input class="widefat" <?php is_checked($appear_on_homepage) ?> id="<?php echo $this->get_field_id( 'appear_on_homepage' ); ?>" name="<?php echo $this->get_field_name( 'appear_on_homepage' ); ?>" type="checkbox" value="1" />
		</p>

		<!-- APPEAR EVERYWHERE -->
		<p>
			<label for="<?php echo $this->get_field_id( 'appear_everywhere' ); ?>"><?php _e( 'Show everywhere by default?' ); ?></label>
			<input class="widefat" <?php is_checked($appear_everywhere) ?> id="<?php echo $this->get_field_id( 'appear_everywhere' ); ?>" name="<?php echo $this->get_field_name( 'appear_everywhere' ); ?>" type="checkbox" value="1" />
		</p>

        <!-- USE URL? URL UNPUT -->
        <p>
            <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL for title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
        </p>

		<!-- SHOW ON MOBILE OR DESKTOP -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'if_dfb_mobile_or_desktop' ) ); ?>"><?php _e( esc_attr( 'Choose where this DFB Ad will appear:' ) ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'if_dfb_mobile_or_desktop' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'if_dfb_mobile_or_desktop' ) ); ?>">
				<option value="1" <?php echo esc_attr( $if_dfb_mobile_or_desktop ) == 1 ? 'selected' : ''; ?>>Both</option>
				<option value="2" <?php echo esc_attr( $if_dfb_mobile_or_desktop ) == 2 ? 'selected' : ''; ?>>Desktop</option>
				<option value="3" <?php echo esc_attr( $if_dfb_mobile_or_desktop ) == 3 ? 'selected' : ''; ?>>Mobile</option>
			</select>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['real_title'] = ( !empty( $new_instance['real_title'] ) ) ? strip_tags( $new_instance['real_title'] ) : '';
		$instance['posts_to_show'] = ( !empty( $new_instance['posts_to_show'] ) ) ? strip_tags( $new_instance['posts_to_show'] ) : '';
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['url'] = ( !empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		$instance['selected_categories'] = ( !empty( $new_instance['selected_categories'] ) ) ? strip_tags( trim($new_instance['selected_categories'], ',') ) : '';
		$instance['selected_tags'] = ( !empty( $new_instance['selected_tags'] ) ) ? strip_tags( trim($new_instance['selected_tags'], ',') ) : '';
		$instance['selected_livestreaming'] = ( !empty( $new_instance['selected_livestreaming'] ) ) ? strip_tags( trim($new_instance['selected_livestreaming'], ',') ) : '';
		$instance['where_to_appear'] = ( !empty( $new_instance['where_to_appear'] ) ) ? strip_tags( trim($new_instance['where_to_appear'], ',') ) : '';
		$instance['template_select'] = ( !empty( $new_instance['template_select'] ) ) ? strip_tags( $new_instance['template_select'] ) : '';
		$instance['order_by'] = ( !empty( $new_instance['order_by'] ) ) ? strip_tags( $new_instance['order_by'] ) : '';
		$instance['posts_per_page'] = ( !empty( $new_instance['posts_per_page'] ) ) ? strip_tags( $new_instance['posts_per_page'] ) : '';
		$instance['appear_on_homepage'] = ( !empty( $new_instance['appear_on_homepage'] ) ) ? strip_tags( $new_instance['appear_on_homepage'] ) : '';
		$instance['appear_everywhere'] = ( !empty( $new_instance['appear_everywhere'] ) ) ? strip_tags( $new_instance['appear_everywhere'] ) : '';
		$instance['if_dfb_mobile_or_desktop'] = ( ! empty( $new_instance['if_dfb_mobile_or_desktop'] ) ) ? strip_tags( $new_instance['if_dfb_mobile_or_desktop'] ) : '';

		// TAXONOMIES
        $get_taxonomies = get_object_taxonomies( 'post', 'objects' );

        // DELETE UNNEEDED TAXONOMIES
        unset( $get_taxonomies['category'] );
        unset( $get_taxonomies['post_tag'] );
        unset( $get_taxonomies['post_format'] );
        unset( $get_taxonomies['clean_feeds'] );
        unset( $get_taxonomies['yst_prominent_words'] );

        foreach ( $get_taxonomies as $value ) {
            $name = 'selected_' . $value->name;
            $instance[$name] = ( !empty( $new_instance[$name] ) ) ? strip_tags( trim($new_instance[$name], ',') ) : '';
        }

		$debug = '';
		foreach ($new_instance as $key => $value) {
			$debug .= $key . ': ' . $value . ', ';
		}

		$instance['debug'] = $debug;
		return $instance;
	}
}

// Register and load the widget
function codeja_load_posts_widget() {
	register_widget( 'codeja_sidebar_post_widget' );
}

// register this widget via hook:
add_action( 'widgets_init', 'codeja_load_posts_widget' );