<?php
	/*
	Plugin Name: easy repeater
	Plugin URI:  http://mohamedshokry.com/easy-repeater
	Description: easy repeater is a small wordpress plugin to repeat fields and making dynamic content easy way.
	Version:     2.0.2
	Author:      shokry055
	Author URI:  http://mohamedshokry.com
	License:     GPL2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
	Domain Path: /languages
	Text Domain: easy-repeater
	*/

	/* secure */ 
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	define('GETTEMPLATEPTHTOPLUG', get_template_directory().'/');
	/* enqueues - admin */
	function easy_repeater_repeat_admin_eq() {
		if ( is_rtl() ){
		wp_enqueue_style( 'mian-css-admin', plugin_dir_url( __FILE__ ) . 'css/easy-repeater-admin.css' );
		wp_enqueue_style( 'mian-css-admin_rtl', plugin_dir_url( __FILE__ ) . 'css/rtl.css' );
		}else{
		wp_enqueue_style( 'mian-css-admin', plugin_dir_url( __FILE__ ) . 'css/easy-repeater-admin.css' );
		}
		wp_enqueue_style( 'font_awesom-admin', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
		$max_fields_main = get_option('repeat_main_number');
		if ( empty($max_fields_main) ){ $max_fields_main = 10; }
		$max_fields_mta = get_option('repeat_meta_number');
		if ( empty($max_fields_mta) ){ $max_fields_mta = 10; }
		/// get current page
		$screen = get_current_screen();
		if ( $screen->base == 'post' ){
		$main_type = 'reapeter_meta_id';
		$max_fields = $max_fields_mta;
		}else{
		$main_type = 'repeat_main_array_save';
		$max_fields = $max_fields_main;
		}
		?>
		<script type="text/javascript">
			var pluginurl = '<?php echo plugin_dir_url( __FILE__ ); ?>',
				path = '<?php echo get_home_path(); ?>',
				nx = '<?php echo $main_type; ?>',
				max_fields = '<?php echo $max_fields; ?>';
		</script>
		<?php
		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'ajax-script', plugin_dir_url( __FILE__ ) .'/js/easy-repeater-js.js', array('jquery') );
		wp_localize_script( 'ajax-script', 'ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' )/*, 'namex' => 'vvvvvvvvvvv' */ ) );

	}

	/* eq in pages and posts and easy repeater only */
	add_action( 'current_screen', 'easy_repeater_chaeck_where_am_i' );
	function easy_repeater_chaeck_where_am_i() {
		$currentScreen = get_current_screen();
		if ( isset( $_GET['page'] ) ){ $easy_repeater_page = $_GET['page']; }else{ $easy_repeater_page = '';}
    	global $er_menu_name_slug;
		if( $currentScreen->base == "post" OR $easy_repeater_page == "easy-repeater" OR $easy_repeater_page == "easy-repeater-main-options") {
		add_action( 'admin_enqueue_scripts', 'easy_repeater_repeat_admin_eq' );
		}
	}


	/* global $get_easy_fields; */
	function easy_repeater_get_repeater(){
		$dat = get_option('repeat_main_array_save');
		$get_easy_fields = unserialize( $dat );
		if ( !empty($get_easy_fields) ){
		return $get_easy_fields;
		}else{
		return array();
		}
	}

	/* main structure */
	include( plugin_dir_path( __FILE__ ) . 'options_admin.php');
	include( plugin_dir_path( __FILE__ ) . 'easy-metabox.php');


	/* easy language */
	function easy_repeater_internationalization()
	{
		load_plugin_textdomain('easy-repeater', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	add_action('init', 'easy_repeater_internationalization');

	// ajax call   ADD NEW
	add_action( 'wp_ajax_my_action', 'easy_repeater_action_callback' );
	function easy_repeater_action_callback() {
	global $wpdb;
    include( plugin_dir_path( __FILE__ ) . 'options-functions.php');
	if( file_exists( GETTEMPLATEPTHTOPLUG . '/easy-options.php' ) ) {
		include( GETTEMPLATEPTHTOPLUG . '/easy-options.php');
	}else{
		include( plugin_dir_path( __FILE__ ) . 'options.php');
	}
    $aa = intval( $_POST['aa'] );
    $xx = intval( $_POST['xx'] );
    $namee = $_POST['name'];
    $pathpath = intval( $_POST['pathpath'] ); 
    if( $namee == "reapeter_meta_id" ){ $options = $options_meta ;}else{$options = $options;}

?>
    <div id="main-block<?php echo $xx; ?>">
        <h2 class="block-head">
       <span class="move"><i class="fa  fa-arrows-alt"></i></span>
       <b class="expand"></b>
       <input class="main-tile-input" type="text" value="<?php _e('block title ...','easy-repeater'); ?>" name="<?php echo $namee ; ?>[<?php echo $xx ; ?>][block_main_name_top]" />
       <a href="#" class="remove_field">X</a>
    </h2>
        <div class="options-holder" id="oh<?php echo $xx; ?>">
            <?php
                easy_repeater_create_form($options,$xx,"",$namee);
            ?>
        </div>
    </div>
    <?php
	wp_die();
	}