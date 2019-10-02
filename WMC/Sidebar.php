<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Adds Foo_Widget widget.
 */
class WMC_Sidebar {

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
    add_action( 'widgets_init', [$this, 'register_wmc_sidebar'] );
	}

  public function register_wmc_sidebar() {
    register_sidebar( array(
			'id' => 'TopHeader',
			'name' => __( 'Top Header' ),
			'description' => __( 'Top Header' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		) );

    register_sidebar( array(
			'id' => 'OffCanvasLeft',
			'name' => __( 'Off Canvas Left' ),
			'description' => __( 'Off Canvas Left' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		) );

    register_sidebar( array(
			'id' => 'OffCanvasRight',
			'name' => __( 'Off Canvas Right' ),
			'description' => __( 'Off Canvas Right' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		) );

  }

}
