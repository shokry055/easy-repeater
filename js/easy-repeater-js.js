/*jslint browser: true*/
/*global $, jQuery, alert*/
/*global $ ,Waypoint, jQuery, alert ,max_fields , pluginurl ,path , tinymce , wp , nx */
jQuery(document).ready(function($) {
    'use strict';
    function getall() {
        $('.handles').sortable({
            handle: 'span.move'
        });
        $('div.exbnda > div > .block-head > b.expand').unbind();
	$('.easy_upload-btn').click(function(e) {
		e.preventDefault();
        var thiss = $(this);
		var image = wp.media({ 
			title: 'Upload Image',
			// mutiple: true if you want to upload multiple files at once
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			console.log(uploaded_image);
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			thiss.prev('#easy_image_url').val(image_url);
			thiss.prev('#easy_image_url').prev('#previmg').attr("src",image_url);
		});
	}); 
    $('.easy_remove-btn').click(function(e) {
        $(this).prev('.easy_upload-btn').prev('#easy_image_url').removeAttr("value");
        $(this).prev('.easy_upload-btn').prev('#easy_image_url').prev('#previmg').removeAttr("src");
    });
        $('div.exbnda > div > .block-head > b.expand').click(function() {
            if ($(this).hasClass("bropped")) {
            $('.options-holder.oppened').slideUp('slow').addClass("cclossed").removeClass("oppened");
            $(this).removeClass("bropped");
            } else {
                $('.options-holder.oppened').slideUp('slow').addClass("cclossed").removeClass("oppened");
                $(this).parent('h2').next('.options-holder').slideDown('slow').addClass("oppened").removeClass("cclossed");
                $('.expand,.expand.bropped').removeClass("bropped");
                $(this).addClass("bropped");
            }
        });
    };
    $('#toggle-check').click(function(e){
        $('.ecolabs').slideToggle("normal");
    });
    var wrapper = $(".input_fields_wrap"), //Fields wrapper
        add_button = $(".add_field_button"), //Add button ID
        mm = $('.input_fields_wrap > div:last-child').attr('id');
		if(! mm ){ var mm = "0"; };
        var x = mm.match(/\d+/),
        cvv = $('.input_fields_wrap > div:last-child').attr('id');
		if(! cvv ){ var cvv = "0"; };
        var a = cvv.match(/\d+/);
	$(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            var ns = $('.input_fields_wrap > div').size();
            if (ns < max_fields) { //max input box allowed
                x++; //text box id increment
                a++; //text box id increment
            var data = {
                        'action': 'my_action',
                        'aa': a,
                        'xx': x,
                        'name': nx,
                        'pathpath': path
            };
			$('.loader-img').fadeIn();
            jQuery.post(ajax_object.ajax_url, data, function(data) {
                $(wrapper).append(data);
					setTimeout( function() { 
						$('.loader-img').fadeOut();
						getall();
					}, 1200);        
            });
            }else{ alert('no more ::  max number ' +  max_fields)}
        });
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('div').remove();
            a--;
            x++; //text box id increment
        });
    getall();
    $('#main-types-selections > .mega-selection > label').click(function(e){ 
    
    });
});