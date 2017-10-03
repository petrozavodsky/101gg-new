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
 * Date of creation: 19-Dec-16 / 14:28
 * Last updated: 19-Dec-16 / 14:28 By Kirill Lavrishev
 *
 */

class DFB_Banner extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'DFP Banner',
			'description' => 'Add Id for DFP Banner',
		);
		parent::__construct( 'dfp_codeja_banner', 'DFP Banner', $widget_ops );
	}

	public function widget( $args, $instance ) {
		if (wp_is_mobile() && $instance['if_dfb_mobile_or_desktop'] == 3 ) {
			echo "<div style='text-align: center; margin: 10px auto;' class='dfb-banner-default-class only-mobile {$instance['dfb_banner_extra_class']}' id='{$instance['dfp_id_number']}'>";
			echo "<script>";
			echo "googletag.cmd.push(function() { googletag.display('{$instance['dfp_id_number']}'); });";
			echo "</script>";
			echo "</div>";
		} elseif ($instance['if_dfb_mobile_or_desktop'] == 2 && !wp_is_mobile()) {
			echo "<div style='text-align: center; margin: 10px auto;' class='dfb-banner-default-class only-desktop {$instance['dfb_banner_extra_class']}' id='{$instance['dfp_id_number']}'>";
			echo "<script>";
			echo "googletag.cmd.push(function() { googletag.display('{$instance['dfp_id_number']}'); });";
			echo "</script>";
			echo "</div>";
		} elseif ($instance['if_dfb_mobile_or_desktop'] == 1) {
			echo "<div style='text-align: center; margin: 10px auto;' class='dfb-banner-default-class  {$instance['dfb_banner_extra_class']}' id='{$instance['dfp_id_number']}'>";
			echo "<script>";
			echo "googletag.cmd.push(function() { googletag.display('{$instance['dfp_id_number']}'); });";
			echo "</script>";
			echo "</div>";
		}
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$dfp_id_number = ! empty( $instance['dfp_id_number'] ) ? $instance['dfp_id_number'] : '';
		$dfb_banner_extra_class = ! empty( $instance['dfb_banner_extra_class'] ) ? $instance['dfb_banner_extra_class'] : '';
		$if_dfb_mobile_or_desktop = ! empty( $instance['if_dfb_mobile_or_desktop'] ) ? $instance['if_dfb_mobile_or_desktop'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title(for internal use):' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dfp_id_number' ) ); ?>"><?php _e( esc_attr( 'DFP Number:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dfp_id_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dfp_id_number' ) ); ?>" type="text" value="<?php echo esc_attr( $dfp_id_number ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dfb_banner_extra_class' ) ); ?>"><?php _e( esc_attr( 'DFP Extra Class:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dfb_banner_extra_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dfb_banner_extra_class' ) ); ?>" type="text" value="<?php echo esc_attr( $dfb_banner_extra_class ); ?>">
		</p>

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


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['dfp_id_number'] = ( ! empty( $new_instance['dfp_id_number'] ) ) ? strip_tags( $new_instance['dfp_id_number'] ) : '';
		$instance['dfb_banner_extra_class'] = ( ! empty( $new_instance['dfb_banner_extra_class'] ) ) ? strip_tags( $new_instance['dfb_banner_extra_class'] ) : '';
		$instance['if_dfb_mobile_or_desktop'] = ( ! empty( $new_instance['if_dfb_mobile_or_desktop'] ) ) ? strip_tags( $new_instance['if_dfb_mobile_or_desktop'] ) : '';

		return $instance;
	}
}

// Register dfb widget
function register_dfb_widget() {
	register_widget( 'DFB_Banner' );
}
add_action( 'widgets_init', 'register_dfb_widget' );