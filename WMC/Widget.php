<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Adds WMC_Widget widget.
 */
class WMC_Widget extends WP_Widget {

  /**
	 * instance of this class
	 *
	 * @since 3.12
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

    /**
     * use for magic setters and getter
     * we can use this when we instantiate the class
     * it holds the variable from __set
     *
     * @see function __get, function __set
     * @access protected
     * @var array
     * */
    protected $vars = array();

    /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'tdm_wmc_widget', // Base ID
			esc_html__( 'TDM WOO Mini Cart' ), // Name
			array( 'description' => esc_html__( 'A WOO Mini Cart' ), ) // Args
		);
    add_action( 'widgets_init', [$this, 'register_wmc_widget'] );
	}

  public function register_wmc_widget() {
    register_widget( 'WMC_Widget' );
  }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
    $data['before_widget'] = $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      $data['before_title'] = $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$template = 'default';
		if ( ! empty( $instance['template'] ) ) {
      $data['template'] = $instance['template'];
			$template = $instance['template'];
		}

    if ( ! empty( $instance['custom_main_class'] ) ) {
      $data['custom_main_class'] = apply_filters( 'tdm_mwc_widget_title', $instance['custom_main_class'] );
		}

    $data['content_widget'] = esc_html__( 'Hello, World!');
    $data['after_widget']   = $args['after_widget'];

		$template_name = 'mini-cart.php';
		if($template == 'dropdown'){
			$template_name = 'mini-cart-dropdown.php';
		}elseif($template == 'off-canvas'){
			$template_name = 'mini-cart-off-canvas.php';
		}elseif($template == 'off-canvas-left'){
			$template_name = 'mini-cart-off-canvas-left.php';
		}elseif($template == 'off-canvas-right'){
			$template_name = 'mini-cart-off-canvas-right.php';
		}
    WMC_View::get_instance()->public_partials('/widget/' . $template_name, $data);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title              = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Mini Cart');
		$custom_main_class  = ! empty( $instance['custom_main_class'] ) ? $instance['custom_main_class'] : '';
		$template  					= ! empty( $instance['template'] ) ? $instance['template'] : '';

    $data['title']            			= $title;
    $data['get_field_id_title']     = $this->get_field_id( 'title' );
    $data['get_field_name_title']   = $this->get_field_name( 'title' );

    $data['custom_main_class']            			= $custom_main_class;
    $data['get_field_id_custom_main_class']     = $this->get_field_id( 'custom_main_class' );
    $data['get_field_name_custom_main_class']   = $this->get_field_name( 'custom_main_class' );

    $data['template']            				= $template;
    $data['get_field_id_template']     	= $this->get_field_id( 'template' );
    $data['get_field_name_template']   	= $this->get_field_name( 'template' );

		$data['template_select'] = [
			'default' => 'default',
			'dropdown' => 'Dropdown',
			'off-canvas-left' => 'Off Canvas Left',
			'off-canvas-right' => 'Off Canvas Right',
		];

		WMC_View::get_instance()->admin_partials('/widget/form.php', $data);
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['custom_main_class'] = ( ! empty( $new_instance['custom_main_class'] ) ) ? sanitize_text_field( $new_instance['custom_main_class'] ) : '';
		$instance['template'] = ( ! empty( $new_instance['template'] ) ) ? sanitize_text_field( $new_instance['template'] ) : '';

		return $instance;
	}

} // class WMC_Widget
