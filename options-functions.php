<?php 
/* secure */ 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
<?php 
        function easy_repeater_get_options_ex($dat,$id,$c_id,$std) {
        if( !empty($dat) AND isset($dat[$c_id][$id]['value']) ){
        $get_value = $dat[$c_id][$id]['value'];
        }
        if( !empty($get_value) ){
        $get_value = $get_value;
        }else{
        $get_value = $std;
        }
            return $get_value;
        }
	    function easy_repeater_create_opening_tag() { ?> 
        <?php }
	    function easy_repeater_create_closing_tag() { ?> 
        <?php } ?>

        <?php // text
        function easy_text_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name']; ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <input type="text" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" value="<?php echo esc_attr( $get_value ); ?>" />
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // textarea
        function easy_textarea_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name']; ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <textarea name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" ><?php echo esc_textarea( $get_value ); ?></textarea>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // checkbox
        function easy_checkbox_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name']; ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" value="0" />
                    <input type="checkbox" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" value="1" <?php if ( $get_value == '1'){ echo 'checked="checked"'; }?> />
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // select
        function easy_select_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        $options = $value['options'];
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name'] ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <select name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" >
                        <?php foreach( $options as $select_key=>$select_option ){ ?>
                            <option <?php if( $get_value == $select_key ){ echo 'selected="selected"';} ?> value="<?php echo $select_key ?>" ><?php echo $select_option ; ?></option>
                        <?php } ?>
                    </select>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // radio
        function easy_radio_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        $options = $value['options'];
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name'] ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <div class="radios">
                        <?php $zr = 0; foreach( $options as $select_key=>$select_option ){ ?>
                        <div><input <?php if( $get_value == $select_key ){ echo 'checked="checked"';} ?> id="rad<?php echo $value['id'].$c_id.$zr;  ?>" type="radio" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" value="<?php echo $select_key ?>" /><label for="rad<?php echo $value['id'].$c_id.$zr;  ?>"><?php echo $select_option ; ?></label></div>
                        <?php $zr++; } ?>
                    </div>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // rimage
        function easy_rimage_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        $options = $value['options'];
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name'] ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <div class="radios-image">
                        <?php $zr = 0; foreach( $options as $select_key=>$select_option ){ ?>
                        <div><input <?php if( $get_value == $select_key ){ echo 'checked="checked"';} ?> id="rad<?php echo $value['id'].$c_id.$zr;  ?>" type="radio" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" value="<?php echo $select_key ?>" />
                            <label for="rad<?php echo $value['id'].$c_id.$zr;  ?>"><img src="<?php echo $select_option ; ?>" alt="rad<?php echo $value['id'].$zr;  ?>" width="<?php echo $value['image_y']; ?>" height="<?php echo $value['image_x']; ?>" /></label>
                        </div>
                        <?php $zr++; } ?>
                    </div>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // categories
        function easy_categories_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = '';    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
		if ( empty ($value['taxonomy']) ){ $value['taxonomy'] == 'category';}
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name'] ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <select name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" >
                        <?php
						if( $value['hide_empty'] == 'true' ){ $hideif = 1 ; }else{ $hideif = 0 ; }
						$args_c = array(
							'taxonomy' => $value['taxonomy'],
							'hide_empty' => $hideif,
						);
						$options_c = get_categories( $args_c );
						foreach( $options_c as $category_z ){ ?>
                            <option <?php if( $get_value == $category_z->term_id ){ echo 'selected="selected"';} ?> value="<?php echo $category_z->term_id ?>" ><?php echo $category_z->name ; ?></option>
                        <?php } ?>
                    </select>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // pages
        function easy_pages_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = '';    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
		$pages = get_pages();
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name'] ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <select name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" >
                        <?php foreach( $pages as $page ){ ?>
                            <option <?php if( $get_value == $page->ID ){ echo 'selected="selected"';} ?> value="<?php echo $page->ID ?>" ><?php echo $page->post_title ; ?></option>
                        <?php } ?>
                    </select>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // post_type
        function easy_post_type_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = '';    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        $args = array( 'public' => true );
        $output = 'objects'; // names or objects
        $post_types = get_post_types( $args, $output );
		global $wp_post_types;
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name'] ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                    <select name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" >
                        <?php foreach( $post_types as $type ){$obj = $wp_post_types[$type->name]; ?>
                            <option <?php if( $get_value == $type->name ){ echo 'selected="selected"';} ?> value="<?php echo $type->name ?>" ><?php echo $obj->labels->singular_name ; ?></option>
                        <?php } ?>
                    </select>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>

        <?php // image
        function easy_image_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id'];    
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        $args = array( 'public' => true );
        $output = 'objects'; // names or objects
        $post_types = get_post_types( $args, $output );
        ?>
            <div class="row-option">
                <div class="col-1">
                    <?php echo $value['name'] ?>
                </div>
                <div class="col-2">
                        <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                        <img src="<?php echo $get_value; ?>" id="previmg" class="prv-image" alt="img" />
                        <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][value]" id="easy_image_url" class="inline-fields" value="<?php echo $get_value; ?>">
                        <button type="button" class="easy_upload-btn inline-fields"><i class="fa fa-plus"></i> <span><?php _e('add / change image','easy-repeater'); ?></button>
                        <button type="button" class="easy_remove-btn inline-fields"><i class="fa fa-close"></i> <span><?php _e('remove image','easy-repeater'); ?></button>
                    <p class="desc"><?php echo $value['desc'];?></p>
                </div>
            </div>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>
					
        <?php // taxonomy
        function easy_taxonomy_option($value,$c_id,$dat,$name) { 
		easy_repeater_create_opening_tag();
        $op_id = $value['id']; 
		$valuevv = $value;
        $std = $value['std'];    
        $get_value = easy_repeater_get_options_ex($dat,$op_id,$c_id,$std);
        $args = array( 'public' => true );
        $output = 'objects'; // names or objects
        $post_types = get_post_types( $args, $output );
		global $wp_post_types;
		?>
            <div class="row-option">
               <div class="col-1"><?php echo $value['name'] ?></div><br /><br />
                <div class="col-1">
                <?php _e('post type ...','easy-repeater'); ?>
                </div>
                <div class="col-2">
                    <input type="hidden" name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $value['id']; ?>][key]" value="<?php echo $value['id']; ?>">
                       <div class="jq-holder" id="main-types-selections">
                    <select name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $op_id ?>][value][type]" >
                        <?php  $zr = 0; foreach( $post_types as $type ){$obj = $wp_post_types[$type->name]; ?>
                            <option <?php if( $get_value['type'] == $type->name ){ echo 'selected="selected"';} ?> value="<?php echo $type->name ?>" ><?php echo $obj->labels->singular_name ; ?></option>
                        <?php  $zr++; } ?>
                    </select>
                        </div>
                </div><br />
                <div class="col-1">
                <?php _e('taxonomy ...','easy-repeater'); ?>
                </div>
                <div class="col-2">
                       <div class="jq-holder" id="main-types-selections">
					    <div class="mega-selection">
						<select name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $op_id; ?>][value][tax]">
                        <?php  $zr = 0; foreach( $post_types as $type ){$obj = $wp_post_types[$type->name]; ?>
						<?php 
							$taxonomy_objects = get_object_taxonomies( $type->name , 'objects' );
							$charray = count($taxonomy_objects);
							if ( $charray > 0 ){ 
							foreach( $taxonomy_objects as $taxonomy_objects => $value ){
							$args_c = array(
							'hide_empty'        => 0, 
							);
							$terms = get_terms( $taxonomy_objects , $args_c);
							$charray = count($terms);
							if ( $charray > 0 ){ $terms = get_terms( $taxonomy_objects , $args_c); ?>
								<option <?php if( $get_value['tax'] == $taxonomy_objects ){ echo 'selected="selected"';} ?> value="<?php echo $taxonomy_objects ?>" ><?php echo $value->labels->name ; ?></option>
							<?php }}} $zr++; } ?>
						</select>
					    </div>
                        </div>
                </div><br />
                <div class="col-1">
                <?php _e('term ...','easy-repeater'); ?>
                </div>
                <div class="col-2">
                       <div class="jq-holder" id="main-types-selections">
					    <div class="mega-selection">
						<select name="<?php echo $name ; ?>[<?php echo $c_id ; ?>][<?php echo $op_id; ?>][value][taxid]">
                        <?php  $zr = 0; foreach( $post_types as $type ){$obj = $wp_post_types[$type->name]; ?>
						<?php 
							$taxonomy_objects = get_object_taxonomies( $type->name , 'objects' );
							$charray = count($taxonomy_objects);
							if ( $charray > 0 ){ 
							?>
							<?php
							foreach( $taxonomy_objects as $taxonomy_objects => $value ){ 
							$args_c = array(
							'hide_empty'        => 0, 
							);
							$terms = get_terms( $taxonomy_objects , $args_c);
							$charray = count($terms);
							if ( $charray > 0 ){
							?>
							<optgroup label="<?php echo $value->labels->name; ?>">
							<?php
							foreach( $terms as $terms ){ ?>
								<option <?php if( $get_value['taxid'] == $terms->term_id ){ echo 'selected="selected"';} ?> value="<?php echo $terms->term_id ?>" ><?php echo $terms->name ; ?></option>
							<?php } ?>
							</optgroup>
							<?php }} ?>
							<?php } ?>
                        <?php  $zr++; } ?>
						</select>
					    </div>
                        </div>               
                </div>
            </div>
                <p class="desc"><?php echo $valuevv['desc'];?></p>
        <?php
		easy_repeater_create_closing_tag();
	    }
        ?>
					
					
					
					
					
					
    <?php  // main-repeater-function
	function easy_repeater_create_form($options,$c_id,$dat,$name) {
        $viewable_id = 0;
		foreach ($options as $value) {
			switch ( $value['type'] ) {
				case "text";        
					easy_text_option($value,$c_id,$dat,$name);
					break;
				case "textarea";
					easy_textarea_option($value,$c_id,$dat,$name);
					break;
				case "select";
					easy_select_option($value,$c_id,$dat,$name);
					break;
				case "radio";
					easy_radio_option($value,$c_id,$dat,$name);
					break;
				case "rimage";
					easy_rimage_option($value,$c_id,$dat,$name);
					break;
				case "categories";
					easy_categories_option($value,$c_id,$dat,$name);
					break;
				case "pages";
					easy_pages_option($value,$c_id,$dat,$name);
					break;
				case "post_type";
					easy_post_type_option($value,$c_id,$dat,$name);
					break;
				case "checkbox";
					easy_checkbox_option($value,$c_id,$dat,$name);
					break;
				case "image";
					easy_image_option($value,$c_id,$dat,$name);
					break;
				case "taxonomy";
					easy_taxonomy_option($value,$c_id,$dat,$name);
					break;
			}
		}
    }  
?>