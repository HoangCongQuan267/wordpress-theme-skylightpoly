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
        'has_archive'        => true,
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
        'rewrite'            => array('slug' => 'san-pham'),
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
 * Register Manual Custom Post Type
 */
function register_manual_post_type()
{
    $labels = array(
        'name'                  => _x('Manuals', 'Post type general name', 'custom-blue-orange'),
        'singular_name'         => _x('Manual', 'Post type singular name', 'custom-blue-orange'),
        'menu_name'             => _x('Manuals', 'Admin Menu text', 'custom-blue-orange'),
        'name_admin_bar'        => _x('Manual', 'Add New on Toolbar', 'custom-blue-orange'),
        'add_new'               => __('Add New', 'custom-blue-orange'),
        'add_new_item'          => __('Add New Manual', 'custom-blue-orange'),
        'new_item'              => __('New Manual', 'custom-blue-orange'),
        'edit_item'             => __('Edit Manual', 'custom-blue-orange'),
        'view_item'             => __('View Manual', 'custom-blue-orange'),
        'all_items'             => __('All Manuals', 'custom-blue-orange'),
        'search_items'          => __('Search Manuals', 'custom-blue-orange'),
        'parent_item_colon'     => __('Parent Manuals:', 'custom-blue-orange'),
        'not_found'             => __('No manuals found.', 'custom-blue-orange'),
        'not_found_in_trash'    => __('No manuals found in Trash.', 'custom-blue-orange'),
        'featured_image'        => _x('Manual Image', 'Overrides the "Featured Image" phrase', 'custom-blue-orange'),
        'set_featured_image'    => _x('Set manual image', 'Overrides the "Set featured image" phrase', 'custom-blue-orange'),
        'remove_featured_image' => _x('Remove manual image', 'Overrides the "Remove featured image" phrase', 'custom-blue-orange'),
        'use_featured_image'    => _x('Use as manual image', 'Overrides the "Use as featured image" phrase', 'custom-blue-orange'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'tai-lieu-ky-thuat'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 24,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('manual', $args);
}
add_action('init', 'register_manual_post_type');

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

/**
 * Register Quote Article Custom Post Type
 */
function register_quote_article_post_type()
{
    $labels = array(
        'name'                  => _x('Quote Articles', 'Post type general name', 'skylightpoly'),
        'singular_name'         => _x('Quote Article', 'Post type singular name', 'skylightpoly'),
        'menu_name'             => _x('Quote Articles', 'Admin Menu text', 'skylightpoly'),
        'name_admin_bar'        => _x('Quote Article', 'Add New on Toolbar', 'skylightpoly'),
        'add_new'               => __('Add New', 'skylightpoly'),
        'add_new_item'          => __('Add New Quote Article', 'skylightpoly'),
        'new_item'              => __('New Quote Article', 'skylightpoly'),
        'edit_item'             => __('Edit Quote Article', 'skylightpoly'),
        'view_item'             => __('View Quote Article', 'skylightpoly'),
        'all_items'             => __('All Quote Articles', 'skylightpoly'),
        'search_items'          => __('Search Quote Articles', 'skylightpoly'),
        'parent_item_colon'     => __('Parent Quote Articles:', 'skylightpoly'),
        'not_found'             => __('No quote articles found.', 'skylightpoly'),
        'not_found_in_trash'    => __('No quote articles found in Trash.', 'skylightpoly'),
        'featured_image'        => _x('Quote Image', 'Overrides the "Featured Image" phrase', 'skylightpoly'),
        'set_featured_image'    => _x('Set quote image', 'Overrides the "Set featured image" phrase', 'skylightpoly'),
        'remove_featured_image' => _x('Remove quote image', 'Overrides the "Remove featured image" phrase', 'skylightpoly'),
        'use_featured_image'    => _x('Use as quote image', 'Overrides the "Use as featured image" phrase', 'skylightpoly'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'bao-gia'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 24,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('quote_article', $args);
}
add_action('init', 'register_quote_article_post_type');

/**
 * Note: Permalink flush functionality has been removed to avoid undefined function errors
 * in the development environment. In a live WordPress installation, you can manually
 * flush permalinks by visiting Settings > Permalinks in the WordPress admin.
 */