<?php

/**
 * Helper Functions
 *
 * Utility and helper functions for the theme
 *
 * @package WordPress
 * @subpackage Skylight_Poly
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get hero slides from custom post type
 *
 * @return array Array of hero slides
 */
function get_hero_slides()
{
    $args = array(
        'post_type' => 'hero_slide',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_key' => '_hero_slide_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );

    $slides = get_posts($args);
    $hero_slides = array();

    foreach ($slides as $slide) {
        $hero_slides[] = array(
            'id' => $slide->ID,
            'title' => $slide->post_title,
            'content' => $slide->post_content,
            'image' => get_the_post_thumbnail_url($slide->ID, 'full'),
            'subtitle' => get_post_meta($slide->ID, '_hero_slide_subtitle', true),
            'button_text' => get_post_meta($slide->ID, '_hero_slide_button_text', true),
            'button_url' => get_post_meta($slide->ID, '_hero_slide_button_url', true),
            'slide_order' => get_post_meta($slide->ID, '_hero_slide_order', true)
        );
    }

    return $hero_slides;
}

/**
 * Get products from custom post type
 *
 * @param int $limit Number of products to retrieve
 * @return array Array of products
 */
function get_products($limit = -1)
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $products = get_posts($args);
    $product_list = array();

    foreach ($products as $product) {
        $product_list[] = array(
            'id' => $product->ID,
            'title' => $product->post_title,
            'content' => $product->post_content,
            'excerpt' => $product->post_excerpt,
            'image' => get_the_post_thumbnail_url($product->ID, 'full'),
            'featured' => get_post_meta($product->ID, 'featured_product', true),
            'price' => get_post_meta($product->ID, 'product_price', true),
            'link' => get_post_meta($product->ID, 'product_link', true),
            'permalink' => get_permalink($product->ID)
        );
    }

    return $product_list;
}

/**
 * Get products by categories
 *
 * @param array $categories Array of category IDs
 * @param int $limit Number of products per category
 * @return array Array of products grouped by category
 */
function get_products_by_categories($categories = array(), $limit = 5)
{
    $products_by_category = array();

    // Get categories and products from customizer data
    if (function_exists('get_product_categories')) {
        $all_categories = get_product_categories();
    } else {
        $all_categories = array();
    }

    if (function_exists('get_products_data')) {
        $all_products = get_products_data();
    } else {
        $all_products = array();
    }

    // If no categories specified, use all available categories
    if (empty($categories)) {
        $categories = $all_categories;
    }

    foreach ($all_categories as $category) {
        if (empty($category['slug']) || empty($category['name'])) {
            continue;
        }

        // Filter products for this category
        $category_products = array();
        $product_count = 0;

        foreach ($all_products as $product) {
            if ($product_count >= $limit) {
                break;
            }

            if (isset($product['category']) && $product['category'] === $category['slug']) {
                // Extract numeric price from formatted string
                $price_numeric = '';
                $discount_price_numeric = '';

                if (isset($product['price']) && !empty($product['price'])) {
                    // Remove currency symbols, units, and formatting to get numeric value
                    $price_numeric = preg_replace('/[^0-9]/', '', $product['price']);
                    $price_numeric = !empty($price_numeric) ? intval($price_numeric) : '';
                }

                if (isset($product['discount_price']) && !empty($product['discount_price'])) {
                    $discount_price_numeric = preg_replace('/[^0-9]/', '', $product['discount_price']);
                    $discount_price_numeric = !empty($discount_price_numeric) ? intval($discount_price_numeric) : '';
                }

                // Convert customizer product data to expected format
                $category_products[] = array(
                    'id' => uniqid(), // Generate unique ID for customizer products
                    'title' => isset($product['title']) ? $product['title'] : '',
                    'content' => isset($product['description']) ? $product['description'] : '',
                    'excerpt' => isset($product['description']) ? wp_trim_words($product['description'], 20) : '',
                    'image' => isset($product['image']) ? $product['image'] : '',
                    'featured' => false,
                    'price' => $price_numeric,
                    'discount_price' => $discount_price_numeric,
                    'discount' => '',
                    'unit' => isset($product['unit']) ? $product['unit'] : '',
                    'custom_badge' => isset($product['badge']) ? $product['badge'] : '',
                    'hot_tag' => '',
                    'link' => isset($product['link']) ? $product['link'] : '#',
                    'permalink' => isset($product['link']) ? $product['link'] : '#'
                );
                $product_count++;
            }
        }

        // Only add category if it has products
        if (!empty($category_products)) {
            // Create a mock category object with required WordPress taxonomy properties
            $category_obj = (object) array(
                'term_id' => uniqid(),
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => '',
                'taxonomy' => 'product_category',
                'parent' => 0,
                'count' => count($category_products)
            );

            $products_by_category[$category['slug']] = array(
                'category' => $category_obj,
                'products' => $category_products
            );
        }
    }

    return $products_by_category;
}

// get_product_categories function removed to avoid redeclaration with customizer.php

// get_sales_contacts function removed to avoid redeclaration with customizer.php

// get_brand_logos function removed to avoid redeclaration with customizer.php

/**
 * Get testimonials from custom post type
 *
 * @param int $limit Number of testimonials to retrieve
 * @return array Array of testimonials
 */
function get_testimonials($limit = -1)
{
    $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $testimonials = get_posts($args);
    $testimonial_list = array();

    foreach ($testimonials as $testimonial) {
        $testimonial_list[] = array(
            'id' => $testimonial->ID,
            'title' => $testimonial->post_title,
            'content' => $testimonial->post_content,
            'excerpt' => $testimonial->post_excerpt,
            'image' => get_the_post_thumbnail_url($testimonial->ID, 'full'),
            'permalink' => get_permalink($testimonial->ID)
        );
    }

    return $testimonial_list;
}

/**
 * Get brand logos from custom post type
 *
 * @param int $limit Number of brand logos to retrieve
 * @return array Array of brand logos
 */
function get_brand_logos_posts($limit = -1)
{
    $args = array(
        'post_type' => 'brand_logo',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $logos = get_posts($args);
    $logo_list = array();

    foreach ($logos as $logo) {
        $logo_list[] = array(
            'id' => $logo->ID,
            'title' => $logo->post_title,
            'content' => $logo->post_content,
            'image' => get_the_post_thumbnail_url($logo->ID, 'full'),
            'permalink' => get_permalink($logo->ID)
        );
    }

    return $logo_list;
}

/**
 * Format phone number for display
 *
 * @param string $phone Phone number
 * @return string Formatted phone number
 */
function format_phone_number($phone)
{
    // Remove all non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // Format based on length
    if (strlen($phone) == 10) {
        return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
    } elseif (strlen($phone) == 11) {
        return substr($phone, 0, 1) . ' (' . substr($phone, 1, 3) . ') ' . substr($phone, 4, 3) . '-' . substr($phone, 7);
    }

    return $phone;
}

/**
 * Get current region settings
 *
 * @return array Current region contact information
 */
function get_current_region_info()
{
    $default_region = get_theme_mod('header_default_region', 'vietnam');
    $current_region = isset($_SESSION['selected_region']) ? $_SESSION['selected_region'] : $default_region;

    return array(
        'region' => $current_region,
        'phone' => get_theme_mod("header_region_{$current_region}_phone"),
        'email' => get_theme_mod("header_region_{$current_region}_email"),
        'address' => get_theme_mod("header_region_{$current_region}_address")
    );
}

/**
 * Sanitize HTML content
 *
 * @param string $content HTML content to sanitize
 * @return string Sanitized content
 */
function sanitize_html_content($content)
{
    $allowed_tags = array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'p' => array(),
        'span' => array(
            'class' => array()
        ),
        'div' => array(
            'class' => array()
        )
    );

    if (function_exists('wp_kses')) {
        return wp_kses($content, $allowed_tags);
    }

    return strip_tags($content, '<a><br><em><strong><p><span><div>');
}

/**
 * Get social media links
 *
 * @return array Array of social media links
 */
function get_social_media_links()
{
    return array(
        'facebook' => get_theme_mod('social_facebook_url'),
        'twitter' => get_theme_mod('social_twitter_url'),
        'instagram' => get_theme_mod('social_instagram_url'),
        'linkedin' => get_theme_mod('social_linkedin_url'),
        'zalo' => get_theme_mod('social_zalo_url')
    );
}
