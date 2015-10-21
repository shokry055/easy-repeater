<?php

/* secure */ 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// dynamic menu
global $er_menu_name_slug;
$er_menu_name = get_option('repeat_menu_name');
if ( empty($er_menu_name) ){ $er_menu_name = 'easy repeater'; }
$er_menu_name_slug = str_replace(" ","-",$er_menu_name);

// menu actions 
add_action('admin_menu', 'easy_repeater_create_menu');
add_action('admin_menu', 'easy_repeater_create_decu_menu');

// create master menus
function easy_repeater_create_menu() {
global $er_menu_name;
//create menu
    add_menu_page( 'easy repeater options', $er_menu_name, 'manage_options', 'easy-repeater', 'easy_repeater_options', plugin_dir_url( __FILE__ ) .'imgs/icon.png' );
	add_submenu_page( 'easy-repeater', __('repeater options','easy-repeater'), 'repeater options', 'manage_options', 'easy-repeater-main-options', 'easy_repeater_main_options' );
	//call register settings function
	add_action( 'admin_init', 'easy_repeater_save_repeater_settings' );
}
// decument url
function easy_repeater_create_decu_menu() {
    global $submenu;
    $url = 'http://mohamedshokry.com/easy-repeater/documentation.html';
    $submenu['easy-repeater'][] = array(__('documentation','easy-repeater'), 'manage_options', $url);
}

// adminbar manus 
add_action( 'admin_init', 'easy_repeater_reg_menu' );
function easy_repeater_reg_menu(){ 
add_action( 'admin_bar_menu', 'easy_repeater_make_parent_node', 999 );
function easy_repeater_make_parent_node( $wp_admin_bar ) {
    global $er_menu_name_slug;
    $args = array(
        'id'     => 'easy_repeater_top',
        'title'  => '<span class="ab-icon2"></span>'.$er_menu_name_slug,
        'parent' => false,
        'href' => menu_page_url('easy-repeater',false)
    );
    $args2 = array(
        'id'     => 'easy_repeater_sub',
        'title'  => __('repeater options','easy-repeater'),
        'parent' => false,
        'href' => menu_page_url('easy-repeater-main-options',false),
        'parent' => 'easy_repeater_top'
    );
    $args3 = array(
        'id'     => 'easy_repeater_sub2',
        'title'  => __('documentation','easy-repeater'),
        'parent' => false,
        'href' => 'http://mohamedshokry.com/easy-repeater/documentation.html',
        'parent' => 'easy_repeater_top'
    );
    $wp_admin_bar->add_node( $args );
    $wp_admin_bar->add_node( $args2 );
    $wp_admin_bar->add_node( $args3 );
}
}

//register settings function
function easy_repeater_save_repeater_settings() {
	//register our settings
    function easy_repeater_main_array_serliz( $input ) {
    if (is_array($input) == "Array"){
    $input = serialize($input);
    return $input;
    }else{
    return "null";
    }
    }
	
//register our settings
function easy_repeater_select_array_serliz( $input ) {
    if (is_array($input) == "Array"){
    $input = serialize($input);
    return $input;
    }else{
    $kk = array('post');
    return serialize($kk);
    }
    }
	
//register our settings
function easy_repeater_main_input_Sanitizing( $input ) {
        $sanitized = sanitize_text_field( $input );
        return $sanitized;
    }
	register_setting( 'repeater-option_main', 'repeat_main_name', 'easy_repeater_main_input_Sanitizing' );
	register_setting( 'repeater-option_main', 'repeat_main_number', 'easy_repeater_main_input_Sanitizing' );
	register_setting( 'repeater-option_main', 'repeat_menu_name', 'easy_repeater_main_input_Sanitizing' );
	register_setting( 'repeater-option_main', 'repeat_menu_des', 'easy_repeater_main_input_Sanitizing' );
	register_setting( 'repeater-option_main', 'easy_post_meta_title', 'easy_repeater_main_input_Sanitizing' );
	register_setting( 'repeater-option_main', 'repeat_meta_number', 'easy_repeater_main_input_Sanitizing' );
	register_setting( 'repeater-option_main', 'repeat_meta_post_type', 'easy_repeater_select_array_serliz' );
	register_setting( 'repeater-option', 'repeat_main_array_save' , 'easy_repeater_main_array_serliz' );
}

//solve first save problem
function easy_problem_fix() {
	if( get_option('repeat_main_name') == '' ){ update_option( 'repeat_main_name', ""); }
	if( get_option('repeat_main_number') == '' ){ update_option( 'repeat_main_number', ""); }
	if( get_option('repeat_menu_name') == '' ){ update_option( 'repeat_menu_name', ""); }
	if( get_option('repeat_menu_des') == '' ){ update_option( 'repeat_menu_des', ""); }
	if( get_option('easy_post_meta_title') == '' ){ update_option( 'easy_post_meta_title', ""); }
	if( get_option('repeat_meta_number') == '' ){ update_option( 'repeat_meta_number', ""); }
	if( get_option('repeat_meta_post_type') == '' ){ update_option( 'repeat_meta_post_type', ""); }
}
register_activation_hook( __FILE__, 'easy_problem_fix' );	

//footer function
function easy_repeater_footer(){ 
    echo '<div class="repeater-footer">';
    $f_text = __( 'all rights resered for %s Powered by : %s by %s .','easy-repeater');
    echo sprintf( $f_text , get_bloginfo( 'name' ),'<a href="https://wordpress.org/" target="_blank">Wordpress</a>','<a href="http://mohamedshokry.com/easy-repeater" target="_blank">easy repeater</a>')  ;
    echo '</div>';
}


//repeater function
function easy_repeater_options() {
    include( plugin_dir_path( __FILE__ ) . 'options-functions.php');
	if( file_exists( GETTEMPLATEPTHTOPLUG . '/easy-options.php' ) ) {
		include( GETTEMPLATEPTHTOPLUG . '/easy-options.php');
	}else{
		include( plugin_dir_path( __FILE__ ) . 'options.php');
	}
?>

<div class="wrap repeater-container">
    <div class="repeater-header">
        <h2><?php $main_title_name = get_option('repeat_main_name');
            if ( !empty($main_title_name) ){ echo $main_title_name; }else{_e('Easy Repeater','easy-repeater');} ?></h2>
        <small><?php $main_title_des = get_option('repeat_menu_des');
            if ( !empty($main_title_des) ){ echo $main_title_des; }else{_e('repeating fields','easy-repeater');} ?></small>
    </div>

<form method="post" action="options.php">
    <?php settings_fields( 'repeater-option' ); ?>
    <?php do_settings_sections( 'repeater-option' ); ?>
    
    <div class="input_fields_wrap handles exbnda">
        <button class="add_field_button"><i class="fa fa-plus"></i> <span><?php _e('Add More Fields','easy-repeater'); ?></span></button><span class="loader-img"></span>
    <?php 
    $dat = get_option('repeat_main_array_save');
    if ( !empty($dat) AND str_word_count($dat) > 5 ){
    $dat =  unserialize($dat);
    $i = 1;
/*  if you want check array :D  
        echo "<pre>";
        print_r($dat);
        echo "</pre>";
*/
    foreach($dat as $key=>$value ){
    ?>
        <div id="main-block<?php echo $key; ?>">
            <h2 class="block-head">
                   <span class="move"><i class="fa  fa-arrows-alt"></i></span>
                   <b class="expand"></b>
                   <input class="main-tile-input" type="text" value="<?php echo $value['block_main_name_top'] ?>" name="repeat_main_array_save[<?php echo $key ; ?>][block_main_name_top]" />
                   <a href="#" class="remove_field">X</a>
            </h2>
            <div class="options-holder" id="oh<?php echo $key ; ?>">
            <?php 
                easy_repeater_create_form($options,$key,$dat,'repeat_main_array_save');
            ?>
            </div>
        </div>
    <?php
    $i++; }
    }else{
    update_option( 'repeat_main_array_save', "");
    ?>
    <div id="main-block0">    
    <h2 class="block-head">
       <span class="move"><i class="fa  fa-arrows-alt"></i></span>
       <b class="expand"></b>
       <input class="main-tile-input" type="text" value="<?php _e('block title ...','easy-repeater'); ?>" name="repeat_main_array_save[0][block_main_name_top]" />
       <a href="#" class="remove_field">X</a>
    </h2>
    <div class="options-holder" id="oh0">
    <?php 
            easy_repeater_create_form($options,"0","",'repeat_main_array_save');
    ?>
    </div>
    </div>
    <?php } ?>
    </div>
    <button type="submit" name="submit" id="submit" class="save_field_button"><i class="fa fa-save"></i> <span><?php _e('Save Changes','easy-repeater'); ?></span></button>
</form>
    <?php echo easy_repeater_footer(); ?>
</div>
<?php }



//repeater main function
function easy_repeater_main_options() {
?>
<div class="wrap repeater-container">
    <div class="repeater-header">
        <h2><?php _e('Easy Repeater options','easy-repeater'); ?></h2>
        <small><?php _e('main options','easy-repeater'); ?></small>
    </div>

<form method="post" action="options.php">
    <?php settings_fields( 'repeater-option_main' ); ?>
    <?php do_settings_sections( 'repeater-option_main' ); ?>
    
    <div class="main-options-cc">
        <div class="headline-option">
            <?php _e('main repeater options','easy-repeater'); ?>
        </div>
        <div class="row-option">
            <div class="col-1">
                <?php _e('main name','easy-repeater'); ?>
            </div>
            <div class="col-2">
                <input type="text" name="repeat_main_name" value="<?php echo esc_attr( get_option('repeat_main_name') ); ?>" />
            </div>
        </div>
        <div class="row-option">
            <div class="col-1">
                <?php _e('main description','easy-repeater'); ?>
            </div>
            <div class="col-2">
                <textarea name="repeat_menu_des" ><?php echo esc_attr( get_option('repeat_menu_des') ); ?></textarea>
            </div>
        </div>
        <div class="row-option">
            <div class="col-1">
                <?php _e('max number of repeats','easy-repeater'); ?>
            </div>
            <div class="col-2">
                <input type="number" name="repeat_main_number" value="<?php echo esc_attr( get_option('repeat_main_number') ); ?>" />
            </div>
        </div>
        <div class="row-option">
            <div class="col-1">
                <?php _e('menu name','easy-repeater'); ?>
            </div>
            <div class="col-2">
                <input type="text" name="repeat_menu_name" value="<?php echo esc_attr( get_option('repeat_menu_name') ); ?>" />
            </div>
        </div>
        <br />
        <div class="headline-option">
            <?php _e('post meta repeater options','easy-repeater'); ?>
        </div>
        <div class="row-option">
            <div class="col-1">
                <?php _e('post meta title','easy-repeater'); ?>
            </div>
            <div class="col-2">
                <input type="text" name="easy_post_meta_title" value="<?php echo esc_attr( get_option('easy_post_meta_title') ); ?>" />
            </div>
        </div>
        <div class="row-option">
            <div class="col-1">
                <?php _e('max number of meta repeats','easy-repeater'); ?>
            </div>
            <div class="col-2">
                <input type="number" name="repeat_meta_number" value="<?php echo esc_attr( get_option('repeat_meta_number') ); ?>" />
            </div>
        </div>
        <div class="row-option">
            <div class="col-1">
                <?php _e('meta post type','easy-repeater'); ?>
            </div>
            <div class="col-2">
                <?php 
                $args = array( 'public' => true );
                $output = 'objects'; // names or objects
                $post_types = get_post_types( $args, $output );
                $get_array_post = get_option('repeat_meta_post_type');
                $get_array_post = unserialize($get_array_post);
                if ( empty ($get_array_post) ){ update_option( 'repeat_main_array_save', ""); $get_array_post = array(); } 
                ?>
                <select multiple="multiple" name="repeat_meta_post_type[]" class="mul-sel" >
                    <?php foreach( $post_types as $type ){ ?>
                        <option <?php if (in_array( $type->name , $get_array_post)){ echo 'selected="selected"';} ?> value="<?php echo $type->name ?>" ><?php echo $type->name  ; ?></option>
                    <?php } ?>
                </select>
                <p class="desc"><?php _e('you can choose more than one post type by holding "CTRL" ','easy-repeater'); ?></p>
            </div>
        </div>
        
    </div>
    <button type="submit" name="submit" id="submit" class="save_field_button"><i class="fa fa-save"></i> <span><?php _e('Save Changes','easy-repeater'); ?></span></button>
</form>
    <?php echo easy_repeater_footer(); ?>
</div>
<?php } ?>