<?php

/**
 * Custom Post Types Registration
 * 
 * This file contains all custom post type registrations including:
 * - Hero Slideshow post type
 * - Product post type
 * - Testimonial post type
 * - Brand Logo post type
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Hero Slideshow Custom Post Type
 */
function register_hero_slideshow_post_type()
{
    $labels = array(
        'name'                  => _x('Hero Slides', 'Post type general name', 'custom-blue-orange'),
        'singular_name'         => _x('Hero Slide', 'Post type singular name', 'custom-blue-orange'),
        'menu_name'             => _x('Hero Slideshow', 'Admin Menu text', 'custom-blue-orange'),
        'name_admin_bar'        => _x('Hero Slide', 'Add New on Toolbar', 'custom-blue-orange'),
        'add_new'               => __('Add New', 'custom-blue-orange'),
        'add_new_item'          => __('Add New Hero Slide', 'custom-blue-orange'),
        'new_item'              => __('New Hero Slide', 'custom-blue-orange'),
        'edit_item'             => __('Edit Hero Slide', 'custom-blue-orange'),
        'view_item'             => __('View Hero Slide', 'custom-blue-orange'),
        'all_items'             => __('All Hero Slides', 'custom-blue-orange'),
        'search_items'          => __('Search Hero Slides', 'custom-blue-orange'),
        'parent_item_colon'     => __('Parent Hero Slides:', 'custom-blue-orange'),
        'not_found'             => __('No hero slides found.', 'custom-blue-orange'),
        'not_found_in_trash'    => __('No hero slides found in Trash.', 'custom-blue-orange'),
        'featured_image'        => _x('Hero Slide Image', 'Overrides the "Featured Image" phrase', 'custom-blue-orange'),
        'set_featured_image'    => _x('Set hero slide image', 'Overrides the "Set featured image" phrase', 'custom-blue-orange'),
        'remove_featured_image' => _x('Remove hero slide image', 'Overrides the "Remove featured image" phrase', 'custom-blue-orange'),
        'use_featured_image'    => _x('Use as hero slide image', 'Overrides the "Use as featured image" phrase', 'custom-blue-orange'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'hero-slide'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-images-alt2',
        'supports'           => array('title', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('hero_slide', $args);
}
add_action('init', 'register_hero_slideshow_post_type');

/**
 * Register Product Custom Post Type
 */
function register_product_post_type()
{
    $labels = array(
        'name'                  => _x('Products', 'Post type general name', 'custom-blue-orange'),
        'singular_name'         => _x('Product', 'Post type singular name', 'custom-blue-orange'),
        'menu_name'             => _x('Products', 'Admin Menu text', 'custom-blue-orange'),
        'name_admin_bar'        => _x('Product', 'Add New on Toolbar', 'custom-blue-orange'),
        'add_new'               => __('Add New', 'custom-blue-orange'),
        'add_new_item'          => __('Add New Product', 'custom-blue-orange'),
        'new_item'              => __('New Product', 'custom-blue-orange'),
        'edit_item'             => __('Edit Product', 'custom-blue-orange'),
        'view_item'             => __('View Product', 'custom-blue-orange'),
        'all_items'             => __('All Products', 'custom-blue-orange'),
        'search_items'          => __('Search Products', 'custom-blue-orange'),
        'parent_item_colon'     => __('Parent Products:', 'custom-blue-orange'),
        'not_found'             => __('No products found.', 'custom-blue-orange'),
        'not_found_in_trash'    => __('No products found in Trash.', 'custom-blue-orange'),
        'featured_image'        => _x('Product Image', 'Overrides the "Featured Image" phrase', 'custom-blue-orange'),
        'set_featured_image'    => _x('Set product image', 'Overrides the "Set featured image" phrase', 'custom-blue-orange'),
        'remove_featured_image' => _x('Remove product image', 'Overrides the "Remove featured image" phrase', 'custom-blue-orange'),
        'use_featured_image'    => _x('Use as product image', 'Overrides the "Use as featured image" phrase', 'custom-blue-orange'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'product'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-products',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('product', $args);
}
add_action('init', 'register_product_post_type');

/**
 * Register Testimonial Custom Post Type
 */
function register_testimonial_post_type()
{
    $labels = array(
        'name'                  => _x('Testimonials', 'Post type general name', 'custom-blue-orange'),
        'singular_name'         => _x('Testimonial', 'Post type singular name', 'custom-blue-orange'),
        'menu_name'             => _x('Testimonials', 'Admin Menu text', 'custom-blue-orange'),
        'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar', 'custom-blue-orange'),
        'add_new'               => __('Add New', 'custom-blue-orange'),
        'add_new_item'          => __('Add New Testimonial', 'custom-blue-orange'),
        'new_item'              => __('New Testimonial', 'custom-blue-orange'),
        'edit_item'             => __('Edit Testimonial', 'custom-blue-orange'),
        'view_item'             => __('View Testimonial', 'custom-blue-orange'),
        'all_items'             => __('All Testimonials', 'custom-blue-orange'),
        'search_items'          => __('Search Testimonials', 'custom-blue-orange'),
        'parent_item_colon'     => __('Parent Testimonials:', 'custom-blue-orange'),
        'not_found'             => __('No testimonials found.', 'custom-blue-orange'),
        'not_found_in_trash'    => __('No testimonials found in Trash.', 'custom-blue-orange'),
        'featured_image'        => _x('Customer Photo', 'Overrides the "Featured Image" phrase', 'custom-blue-orange'),
        'set_featured_image'    => _x('Set customer photo', 'Overrides the "Set featured image" phrase', 'custom-blue-orange'),
        'remove_featured_image' => _x('Remove customer photo', 'Overrides the "Remove featured image" phrase', 'custom-blue-orange'),
        'use_featured_image'    => _x('Use as customer photo', 'Overrides the "Use as featured image" phrase', 'custom-blue-orange'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 22,
        'menu_icon'          => 'dashicons-testimonial',
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_post_type');

/**
 * Register Brand Logo Custom Post Type
 */
function register_brand_logo_post_type()
{
    $labels = array(
        'name'                  => _x('Brand Logos', 'Post type general name', 'custom-blue-orange'),
        'singular_name'         => _x('Brand Logo', 'Post type singular name', 'custom-blue-orange'),
        'menu_name'             => _x('Brand Logos', 'Admin Menu text', 'custom-blue-orange'),
        'name_admin_bar'        => _x('Brand Logo', 'Add New on Toolbar', 'custom-blue-orange'),
        'add_new'               => __('Add New', 'custom-blue-orange'),
        'add_new_item'          => __('Add New Brand Logo', 'custom-blue-orange'),
        'new_item'              => __('New Brand Logo', 'custom-blue-orange'),
        'edit_item'             => __('Edit Brand Logo', 'custom-blue-orange'),
        'view_item'             => __('View Brand Logo', 'custom-blue-orange'),
        'all_items'             => __('All Brand Logos', 'custom-blue-orange'),
        'search_items'          => __('Search Brand Logos', 'custom-blue-orange'),
        'parent_item_colon'     => __('Parent Brand Logos:', 'custom-blue-orange'),
        'not_found'             => __('No brand logos found.', 'custom-blue-orange'),
        'not_found_in_trash'    => __('No brand logos found in Trash.', 'custom-blue-orange'),
        'featured_image'        => _x('Brand Logo Image', 'Overrides the "Featured Image" phrase', 'custom-blue-orange'),
        'set_featured_image'    => _x('Set brand logo image', 'Overrides the "Set featured image" phrase', 'custom-blue-orange'),
        'remove_featured_image' => _x('Remove brand logo image', 'Overrides the "Remove featured image" phrase', 'custom-blue-orange'),
        'use_featured_image'    => _x('Use as brand logo image', 'Overrides the "Use as featured image" phrase', 'custom-blue-orange'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'brand-logo'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 23,
        'menu_icon'          => 'dashicons-format-image',
        'supports'           => array('title', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('brand_logo', $args);
}
add_action('init', 'register_brand_logo_post_type');

/**
 * Register Product Category Taxonomy
 */
function register_product_category_taxonomy()
{
    $labels = array(
        'name'                       => _x('Product Categories', 'Taxonomy General Name', 'custom-blue-orange'),
        'singular_name'              => _x('Product Category', 'Taxonomy Singular Name', 'custom-blue-orange'),
        'menu_name'                  => __('Product Categories', 'custom-blue-orange'),
        'all_items'                  => __('All Product Categories', 'custom-blue-orange'),
        'parent_item'                => __('Parent Product Category', 'custom-blue-orange'),
        'parent_item_colon'          => __('Parent Product Category:', 'custom-blue-orange'),
        'new_item_name'              => __('New Product Category Name', 'custom-blue-orange'),
        'add_new_item'               => __('Add New Product Category', 'custom-blue-orange'),
        'edit_item'                  => __('Edit Product Category', 'custom-blue-orange'),
        'update_item'                => __('Update Product Category', 'custom-blue-orange'),
        'view_item'                  => __('View Product Category', 'custom-blue-orange'),
        'separate_items_with_commas' => __('Separate product categories with commas', 'custom-blue-orange'),
        'add_or_remove_items'        => __('Add or remove product categories', 'custom-blue-orange'),
        'choose_from_most_used'      => __('Choose from the most used', 'custom-blue-orange'),
        'popular_items'              => __('Popular Product Categories', 'custom-blue-orange'),
        'search_items'               => __('Search Product Categories', 'custom-blue-orange'),
        'not_found'                  => __('Not Found', 'custom-blue-orange'),
        'no_terms'                   => __('No product categories', 'custom-blue-orange'),
        'items_list'                 => __('Product categories list', 'custom-blue-orange'),
        'items_list_navigation'      => __('Product categories list navigation', 'custom-blue-orange'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'product-category'),
    );

    register_taxonomy('product_category', array('product'), $args);
}
add_action('init', 'register_product_category_taxonomy');