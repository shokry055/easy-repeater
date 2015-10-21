<?php 

/* secure */ 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'easy_repeater_meta_setup' );
add_action( 'load-post-new.php', 'easy_repeater_meta_setup' );


function easy_repeater_meta_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'er_easy_add_post_meta_boxes' );
  add_action( 'save_post', 'er_easy_save_post_meta', 10, 2 );  
    
/* main admin function. */
function er_easy_add_post_meta_boxes() {
    $meta_title_box = get_option('easy_post_meta_title');
    if ( empty($meta_title_box) ){ $meta_title_box = esc_html__( 'easy repeter meta','easy-repeater' ); }
    $get_array_post = get_option('repeat_meta_post_type');
    if ( !empty($get_array_post) ){
    $get_array_post = unserialize($get_array_post);
    }else{
    $get_array_post = array('post');
    }
    foreach( $get_array_post as $post_type ){
    add_meta_box('easy_repeater_class_id',$meta_title_box,'er_easy_repeater_class_meta_box',$post_type,'advanced','default');
    }
}
    
/* Save the meta box's post metadata. */
function er_easy_save_post_meta( $post_id, $post ) {

  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['reapeter_meta_id_nonce'] ) || !wp_verify_nonce( $_POST['reapeter_meta_id_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
  return $post_id;
    
  /* sanitizing  $_post */
    
  /* Get the posted data and sanitize it for use as an HTML class. */
  $new_meta_value = ( isset( $_POST['reapeter_meta_id'] ) ? serialize( $_POST['reapeter_meta_id'] ) : '' );
  $new_meta_value2 = ( isset( $_POST['reapeter_meta_key'] ) ? $_POST['reapeter_meta_key'] : '' );
  
/* reset post meta if key false : desabled 
  if( $new_meta_value2 != "true" ){ $new_meta_value = 'false'; }
*/

  /* Get the meta key. */
  $meta_key = 'reapeter_meta_id';
  $meta_key2 = 'reapeter_meta_key';

  /* Get the meta value of the custom field key. */
  $meta_value = get_post_meta( $post_id, $meta_key, true );
  $meta_value2 = get_post_meta( $post_id, $meta_key2, true );

    
    
  /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  /* If the new meta value does not match the old value, update it. */
  elseif ( $new_meta_value && $new_meta_value != $meta_value )
    update_post_meta( $post_id, $meta_key, $new_meta_value );
  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, $meta_key, $meta_value );
    
  /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value2 && '' == $meta_value2 )
    add_post_meta( $post_id, $meta_key2, $new_meta_value2, true );
  /* If the new meta value does not match the old value, update it. */
  elseif ( $new_meta_value2 && $new_meta_value2 != $meta_value2 )
    update_post_meta( $post_id, $meta_key2, $new_meta_value2 );
  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value2 && $meta_value2 )
    delete_post_meta( $post_id, $meta_key2, $meta_value2 );
}
    

function er_easy_repeater_class_meta_box( $object, $box ) { ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'reapeter_meta_id_nonce' );
    include( plugin_dir_path( __FILE__ ) . 'options-functions.php');
	if( file_exists( GETTEMPLATEPTHTOPLUG . '/easy-options.php' ) ) {
		include( GETTEMPLATEPTHTOPLUG . '/easy-options.php');
	}else{
		include( plugin_dir_path( __FILE__ ) . 'options.php');
	}
    $cheack = get_post_meta( $object->ID, "reapeter_meta_key", true ); ?>
    <input type="hidden" value="false" name="reapeter_meta_key" checked="c" />
    <input type="checkbox" id="reapeter_meta_key_id" class="inline-inner megacheackbox" value="true" name="reapeter_meta_key" <?php if( $cheack == "true" ){ echo'checked="checked"'; } ?> />
    <label for="reapeter_meta_key_id" id="toggle-check"><span></span></label>
    <p class="desc"><?php _e('enable or disable fields','easy-repeater'); ?></p>

    <div class="input_fields_wrap handles exbnda ecolabs" <?php if ( $cheack != "true" ){ echo 'style="display:none;"'; } ?>>
    <br />
    <button class="add_field_button nomabottom"><i class="fa fa-plus"></i> <span><?php _e('Add More Fields','easy-repeater'); ?></span></button><span class="loader-img"></span>
    <?php
        $dat = get_post_meta( $object->ID, 'reapeter_meta_id', true );
        if ( !empty($dat) AND str_word_count($dat) > 5 ){
        $dat =  unserialize($dat);
        $i = 1;
        foreach($dat as $key=>$value ){
    ?>
        <div id="main-block<?php echo $key; ?>">
            <h2 class="block-head">
                   <span class="move"><i class="fa  fa-arrows-alt"></i></span>
                   <b class="expand"></b>
                   <input class="main-tile-input" type="text" value="<?php echo $value['block_main_name_top'] ?>" name="reapeter_meta_id[<?php echo $key ; ?>][block_main_name_top]" />
                   <a href="#" class="remove_field">X</a>
            </h2>
            <div class="options-holder" id="oh<?php echo $key ; ?>">
            <?php 
                easy_repeater_create_form($options_meta,$key,$dat,'reapeter_meta_id');
            ?>
            </div>
        </div>
    <?php
    $i++; }
    }else{
    ?>
    <div id="main-block0">    
    <h2 class="block-head">
       <span class="move"><i class="fa  fa-arrows-alt"></i></span>
       <b class="expand"></b>
       <input class="main-tile-input" type="text" value="<?php _e('block title ...','easy-repeater'); ?>" name="reapeter_meta_id[0][block_main_name_top]" />
       <a href="#" class="remove_field">X</a>
    </h2>
    <div class="options-holder" id="oh0">
    <?php 
            easy_repeater_create_form($options_meta,"0","",'reapeter_meta_id');
    ?>
    </div>
    </div>
    <?php } ?>
</div>

<?php 
}
} 
// end main admin functions 

// front end function 
function easy_repeater_get_easy_meta() {
  $post_id = get_the_ID();
  if ( !empty( $post_id ) ) {
    $post_class = get_post_meta( $post_id, 'reapeter_meta_id', true );
    if( !empty($post_class) ){
        $classes = unserialize($post_class);
    }else{
        $classes = null;
    }
  }
  return $classes;
}
function easy_repeater_get_easy_active_meta() {
  $post_id = get_the_ID();
  if ( !empty( $post_id ) ) {
    $post_class = get_post_meta( $post_id, 'reapeter_meta_key', true );
    if( !empty($post_class) ){
        $classes = $post_class;
    }else{
        $classes = "false";
    }
  }
  return $classes;
}