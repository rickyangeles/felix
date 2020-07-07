<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Testimonials.
	 */

	$labels = [
		"name" => __( "Testimonials", "felix" ),
		"singular_name" => __( "Testimonial", "felix" ),
		"menu_name" => __( "Testimonials", "felix" ),
		"all_items" => __( "All Testimonials", "felix" ),
		"add_new" => __( "Add new Testimonial", "felix" ),
		"add_new_item" => __( "Add new Testimonial", "felix" ),
		"edit_item" => __( "Edit Testimonial", "felix" ),
		"new_item" => __( "New Testimonial", "felix" ),
		"view_item" => __( "View Testimonial", "felix" ),
		"view_items" => __( "View Testimonials", "felix" ),
		"search_items" => __( "Search Testimonials", "felix" ),
		"not_found" => __( "No Testimonials found", "felix" ),
		"not_found_in_trash" => __( "No Testimonials found in trash", "felix" ),
		"parent" => __( "Parent Testimonial:", "felix" ),
		"featured_image" => __( "Featured image for this Testimonial", "felix" ),
		"set_featured_image" => __( "Set featured image for this Testimonial", "felix" ),
		"remove_featured_image" => __( "Remove featured image for this Testimonial", "felix" ),
		"use_featured_image" => __( "Use as featured image for this Testimonial", "felix" ),
		"archives" => __( "Testimonial archives", "felix" ),
		"insert_into_item" => __( "Insert into Testimonial", "felix" ),
		"uploaded_to_this_item" => __( "Upload to this Testimonial", "felix" ),
		"filter_items_list" => __( "Filter Testimonials list", "felix" ),
		"items_list_navigation" => __( "Testimonials list navigation", "felix" ),
		"items_list" => __( "Testimonials list", "felix" ),
		"attributes" => __( "Testimonials attributes", "felix" ),
		"name_admin_bar" => __( "Testimonial", "felix" ),
		"item_published" => __( "Testimonial published", "felix" ),
		"item_published_privately" => __( "Testimonial published privately.", "felix" ),
		"item_reverted_to_draft" => __( "Testimonial reverted to draft.", "felix" ),
		"item_scheduled" => __( "Testimonial scheduled", "felix" ),
		"item_updated" => __( "Testimonial updated.", "felix" ),
		"parent_item_colon" => __( "Parent Testimonial:", "felix" ),
	];

	$args = [
		"label" => __( "Testimonials", "felix" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "testimonials",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "testimonials", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-format-quote",
		"supports" => [ "title", "editor", "thumbnail", "revisions" ],
		"taxonomies" => [ "category" ],
	];

	register_post_type( "testimonials", $args );

	/**
	 * Post Type: Documentations.
	 */

	$labels = [
		"name" => __( "Documentations", "felix" ),
		"singular_name" => __( "Documentation", "felix" ),
		"menu_name" => __( "Documentation", "felix" ),
		"all_items" => __( "All Documentations", "felix" ),
		"add_new" => __( "Add New", "felix" ),
		"add_new_item" => __( "Add New Documentation", "felix" ),
		"edit_item" => __( "Edit Documentation", "felix" ),
		"new_item" => __( "New Documentation", "felix" ),
		"view_item" => __( "View Documentation", "felix" ),
		"view_items" => __( "View Documentations", "felix" ),
		"search_items" => __( "Search Documentations", "felix" ),
		"not_found" => __( "No Documentations Found", "felix" ),
		"not_found_in_trash" => __( "No Documentations found in trash", "felix" ),
		"parent" => __( "Parent Documentation", "felix" ),
		"featured_image" => __( "Featured image for this Documentation", "felix" ),
		"set_featured_image" => __( "Set featured image for this Documentation", "felix" ),
		"remove_featured_image" => __( "Remove featured image for this Documentation", "felix" ),
		"use_featured_image" => __( "Use as featured image for this Documentation", "felix" ),
		"archives" => __( "Documentation Archives", "felix" ),
		"insert_into_item" => __( "insert into Documentation", "felix" ),
		"uploaded_to_this_item" => __( "Uploaded to this Documentation", "felix" ),
		"filter_items_list" => __( "Filter Documentation List", "felix" ),
		"items_list_navigation" => __( "Documentations list navigation", "felix" ),
		"items_list" => __( "Documentations list", "felix" ),
		"attributes" => __( "Documentations Attribure", "felix" ),
		"name_admin_bar" => __( "Documentation", "felix" ),
		"item_published" => __( "Documentation published", "felix" ),
		"item_published_privately" => __( "Documentation published privately", "felix" ),
		"item_reverted_to_draft" => __( "Documentation reverted to darft", "felix" ),
		"item_scheduled" => __( "Documentation Scheduled", "felix" ),
		"item_updated" => __( "Documentation Updated", "felix" ),
		"parent_item_colon" => __( "Parent Documentation", "felix" ),
	];

	$args = [
		"label" => __( "Documentations", "felix" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "page",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "documentation", "with_front" => false ],
		"query_var" => true,
		"supports" => [ "title", "editor", "page-attributes" ],
	];

	register_post_type( "documentation", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


?>
