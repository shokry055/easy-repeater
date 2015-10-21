<?php 

/* secure */ 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


    // main repeater options //
	$options = array( 
        //start options as array
		array("name" => "text field 1",
              "desc" => "text field descr",
              "id" => "text_field",
              "type" => "text",
              "std" => "place holder"),
        
		array("name" => "textarea field 2",
              "desc" => "textarea field descr",
              "id" => "text_field2",
              "type" => "textarea",
              "std" => "textarea place holder"),
        
		array("name" => "checkbox 1",
              "desc" => "checkbox field descr",
              "id" => "checkbox",
              "type" => "checkbox",
              "std" => "1"),
        
		array("name" => "select",
              "desc" => "select field descr",
              "id" => "select1",
              "type" => "select",
              "options" => array(
                  "option1" => "option 1",
                  "option2" => "option 2",
                  "option3" => "option 3",
                  "option4" => "option 4",
                  "option5" => "option 5",
              ),
              "std" => "option4"
             ),
        
		array("name" => "radio",
              "desc" => "radio field descr",
              "id" => "radio1",
              "type" => "radio",
              "options" => array(
                  "option1" => "option 1",
                  "option2" => "option 2",
                  "option3" => "option 3",
                  "option4" => "option 4",
                  "option5" => "option 5",
              ),
              "std" => "option1"
             ),

		array("name" => "radio image",
              "desc" => "radio image",
              "id" => "radio_image",
              "type" => "rimage",
              "image_x" => "100",
              "image_y" => "100",
              "options" => array(
                  "option1" => plugin_dir_url( __FILE__ ) .'imgs/op1.png',
                  "option2" => plugin_dir_url( __FILE__ ) .'imgs/op2.png',
                  "option3" => plugin_dir_url( __FILE__ ) .'imgs/op3.png',
                  "option4" => plugin_dir_url( __FILE__ ) .'imgs/op4.png',
              ),
              "std" => "option3"
             ),
        
		array("name" => "upload",
              "desc" => "new image upload",
              "id" => "image_upload",
              "type" => "image",
              "std" => "option3",
              "std" => plugin_dir_url( __FILE__ ) .'imgs/no.png'
             ),

		array("name" => "upload",
              "desc" => "new image upload",
              "id" => "image_upload2",
              "type" => "image",
              "std" => "http://wiki.solid-run.com/images/7/75/No_image_available.png"
             ),

        array("name" => "categories",
              "desc" => "categories field select",
              "id" => "categories_1",
              "type" => "categories",
              "taxonomy" => "category",
              "hide_empty" => true
             ),
        
		array("name" => "pages",
              "desc" => "pages field select",
              "id" => "pages_1",
              "type" => "pages"
             ),
        
		array("name" => "post type",
              "desc" => "post type field select",
              "id" => "post_type",
              "type" => "post_type"
             )
        /// end options   
	 );
    

    // meta options //
	$options_meta = array( 
        //start options meta as array
		array("name" => "text field 1",
              "desc" => "text field descr",
              "id" => "text_field2",
              "type" => "text",
              "std" => "place holder"),
        
        array("name" => "categories",
              "desc" => "categories field select",
              "id" => "categories_2",
              "type" => "categories",
              "taxonomy" => "category",
              "hide_empty" => true
             ),
        
		array("name" => "pages",
              "desc" => "pages field select",
              "id" => "pages_2",
              "type" => "pages"
             ),
        
		array("name" => "post type",
              "desc" => "post type field select",
              "id" => "post_type2",
              "type" => "post_type"
             )
        /// end meta   
	 );
?>