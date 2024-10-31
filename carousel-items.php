<?php
add_action( 'init', 'rr_carousel_custom_post' );
function rr_carousel_custom_post() {

	register_post_type( 'rr-carousel-items',
		array(
			'labels' => array(
				'name' => __( 'Carousel Items' ),
				'singular_name' => __( 'Carousel Item' ),
				'add_new_item' => __( 'Add New Carousel Item' )
			),
			'public' => true,
			'supports' => array('thumbnail', 'title'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'rr-carousel-item'),
		)
	);
		

}


function rr_carousel_taxonomy() {
	register_taxonomy(
		'rr_carousel_cat',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'rr-carousel-items',                  //post type name
		array(
			'hierarchical'          => true,
			'label'                         => 'Carousel Category',  //Display name
			'query_var'             => true,
			'show_admin_column'			=> true,
			'rewrite'                       => array(
				'slug'                  => 'carousel-category', // This controls the base slug that will display before each term
				'with_front'    => true // Don't display the category base before
				)
			)
	);
}
add_action( 'init', 'rr_carousel_taxonomy');   


/* Move featured image box under title */
add_action('do_meta_boxes', 'change_image_box');
function change_image_box()
{
    remove_meta_box( 'postimagediv', 'carousel Items', 'side' );
    add_meta_box('postimagediv', __('Upload Carousel Image'), 'post_thumbnail_meta_box', 'rr-carousel-items', 'normal', 'high');
}

?>