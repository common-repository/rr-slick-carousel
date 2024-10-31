<?php 
/*
Plugin Name: RR Slick Carousel 
Plugin URI: http://shobuj.info/plugins/rr-slick-carousel-plugins/
Description: Highlight your speacial features or images in your website. 
Author: Shobuj ray
Version: 1.0
Author URI: http://shobuj.info/plugins/
*/

function rr_carousel_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'rr_carousel_latest_jquery');


function rr_carousel_plugin_main_js() {
    wp_enqueue_script( 'rr-carousel-js', plugins_url( '/js/slick.min.js', __FILE__ ), array('jquery'), 1.0, false);
    wp_enqueue_style( 'rr-carousel-css', plugins_url( '/slick/slick.css', __FILE__ ));
    wp_enqueue_style( 'rr-carouselmain-css', plugins_url( '/css/style.css', __FILE__ ));
}
add_action('init','rr_carousel_plugin_main_js');



// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

add_theme_support( 'post-thumbnails', array('post','page','rr-carousel-items') );;

/*Files to Include*/
require_once('carousel-items.php');

// shortcode for single items 
function rr_carousel_single_shortcode( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'id' => '',
		'category' => '',
		'play' => 'true',
		'inf' => 'true',
		'itemspeed' => '300',
		'dot' => 'true',
		'slides' => '',
		'scroll' => '',
	), $atts, 'single' ) );
	
	$q = new WP_Query(
        array( 'rr_carousel_cat' => $category, 'posts_per_page' =>-1, 'post_type' => 'rr-carousel-items')
        );		
		
	$list = '
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".'.$id.'").slick({
				autoplay: '.$play.',
				dots: '.$dot.',
				infinite: '.$inf.',
				speed: '.$itemspeed.',
				slidesToShow: '.$slides.',
				slidesToScroll: '.$scroll.',
			});
		}); 	
	</script>


	<div class="slider '.$id.'">';
	while($q->have_posts()) : $q->the_post();
		$thumb= get_the_post_thumbnail( $post->ID, 'carousel-image' );	
		$list .= '
		
			<div><div class="image">'.$thumb.'</div></div>
		
		';        
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('single', 'rr_carousel_single_shortcode');

// shortcode for multiple items
function rr_carousel_multiple_shortcode( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'id' => '',
		'category' => '',
		'play' => 'true',
		'inf' => 'true',
		'itemspeed' => '300',
		'dot' => 'true',
		'slides' => '',
		'scroll' => '',
	), $atts, 'multiple' ) );
	
   $q = new WP_Query(
        array( 'rr_carousel_cat' => $category, 'posts_per_page' =>-1, 'post_type' => 'rr-carousel-items')
        );	
		
	$list = '
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".'.$id.'").slick({
				autoplay: '.$play.',
				dots: '.$dot.',
				infinite: '.$inf.',
				speed: '.$itemspeed.',
				slidesToShow: '.$slides.',
				slidesToScroll: '.$scroll.',
			});
		}); 	
	</script>


	<div class="slider '.$id.'">';

	while($q->have_posts()) : $q->the_post();
		$thumb= get_the_post_thumbnail( $post->ID, 'carousel-image' );	
		$list .= '
		
			<div><div class="image">'.$thumb.'</div></div>
		
		';        
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('multiple', 'rr_carousel_multiple_shortcode');

// shortcode for one time items
function rr_carousel_onetime_shortcode( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'id' => '',
		'category' => '',
		'play' => 'false',
		'inf' => 'true',
		'itemspeed' => '300',
		'dot' => 'true',
		'slides' => '',
		'scroll' => '',
		'placeholders' => 'false',
		'touchmove' => 'false',
	), $atts, 'one-time' ) ); 
	
   $q = new WP_Query(
        array( 'rr_carousel_cat' => $category, 'posts_per_page' =>-1, 'post_type' => 'rr-carousel-items')
        );	
		
	$list = '
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".'.$id.'").slick({
				autoplay: '.$play.',
				dots: '.$dot.',
				infinite: '.$inf.',
				speed: '.$itemspeed.',
				slidesToShow: '.$slides.',
				slidesToScroll: '.$scroll.',
				placeholders: '.$placeholders.',
				touchMove: '.$touchmove.',
			});
		}); 	
	</script>
	
	<div class="slider '.$id.'">';

	while($q->have_posts()) : $q->the_post();
		$thumb= get_the_post_thumbnail( $post->ID, 'carousel-image' );	
		$list .= '
		
			<div><div class="image">'.$thumb.'</div></div>
		
		';        
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('one-time', 'rr_carousel_onetime_shortcode');





?>