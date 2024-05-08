<?php

/**
 * Class for providing widget functionality.
 */
class HOSTXTEND_DOMAIN_CHECK_Widget extends WP_Widget {

	/**
	 * Constructor.
	 * 
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'wp24_domaincheck_widget',
			'hostxtend Domain Check',
			array(
				'description' => __( 'Display domaincheck form.', 'hostxtend-domain-check' ),
			)
		);
	}

	/**
	 * Widget execution.
	 * 
	 * @param array $args 
	 * @param array $instance 
	 * @return void
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo do_shortcode( '[wp24_domaincheck]' );
		echo $args['after_widget'];
	}

	/**
	 * Widget options.
	 * 
	 * @param array $instance 
	 * @return void
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Domain Check', 'hostxtend-domain-check' );
		
		echo '<p>';
		echo '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">'. esc_attr_e( 'Title:', 'hostxtend-domain-check' ) . '</label>';
		echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . 
			esc_attr( $this->get_field_name( 'title' ) ) . '" type="text" value="' . esc_attr( $title ) . '">';
		echo '</p>';
	}

	/**
	 * Save widget options.
	 * 
	 * @param array $new_instance 
	 * @param array $old_instance 
	 * @return array New Options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

}

/**
 * Register widget.
 * 
 * @return void
 */
function register_wp24_domaincheck_widget() {
	register_widget( 'HOSTXTEND_DOMAIN_CHECK_Widget' );
}
add_action( 'widgets_init', 'register_wp24_domaincheck_widget' );
