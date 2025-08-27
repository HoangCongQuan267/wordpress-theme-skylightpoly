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
 * Get products by categories from WordPress product post type
 *
 * @param array $categories Array of category slugs (optional)
 * @param int $limit Number of products per category (default: 4)
 * @return array Array of products grouped by category
 */
function get_products_by_categories($categories = array(), $limit = 4)
{
    $products_by_category = array();

    // Get product categories from WordPress taxonomy
    $category_terms = get_terms(array(
        'taxonomy' => 'product_category',
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC'
    ));

    if (is_wp_error($category_terms) || empty($category_terms)) {
        return $products_by_category;
    }

    // If specific categories are requested, filter the terms
    if (!empty($categories)) {
        $category_terms = array_filter($category_terms, function($term) use ($categories) {
            return in_array($term->slug, $categories);
        });
    }

    foreach ($category_terms as $category_term) {
        // Get products for this category
        $products_query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_category',
                    'field' => 'term_id',
                    'terms' => $category_term->term_id,
                ),
            ),
        ));

        $category_products = array();

        if ($products_query->have_posts()) {
            while ($products_query->have_posts()) {
                $products_query->the_post();
                $product_id = get_the_ID();

                // Get product meta data
                $custom_badge = get_post_meta($product_id, 'custom_badge', true);
                $discount = get_post_meta($product_id, 'discount', true);
                $hot_tag = get_post_meta($product_id, 'hot_tag', true);
                $product_price = get_post_meta($product_id, 'product_price', true);
                $discount_price = get_post_meta($product_id, 'discount_price', true);
                $price_unit = get_post_meta($product_id, 'price_unit', true);
                $product_link = get_post_meta($product_id, 'product_link', true);

                // Format product data
                $category_products[] = array(
                    'id' => $product_id,
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    'excerpt' => get_the_excerpt(),
                    'image' => get_the_post_thumbnail_url($product_id, 'full'),
                    'custom_badge' => $custom_badge,
                    'discount' => $discount,
                    'hot_tag' => $hot_tag,
                    'price' => $product_price,
                    'discount_price' => $discount_price,
                    'unit' => $price_unit ?: 'đơn vị',
                    'link' => $product_link ?: get_permalink($product_id),
                    'permalink' => get_permalink($product_id)
                );
            }
            wp_reset_postdata();
        }

        // Only add category if it has products
        if (!empty($category_products)) {
            $products_by_category[$category_term->slug] = array(
                'category' => $category_term,
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

/**
 * SEO Helper Functions
 */

/**
 * Generate SEO-friendly title
 *
 * @param string $title Page title
 * @param string $separator Title separator
 * @return string SEO optimized title
 */
function generate_seo_title($title = '', $separator = '|')
{
    $site_name = get_bloginfo('name');
    $site_description = get_bloginfo('description');
    
    if (empty($title)) {
        if (is_front_page()) {
            return $site_name . ' ' . $separator . ' ' . $site_description;
        } elseif (is_single()) {
            return get_the_title() . ' ' . $separator . ' ' . $site_name;
        } elseif (is_page()) {
            return get_the_title() . ' ' . $separator . ' ' . $site_name;
        } elseif (is_category()) {
            return single_cat_title('', false) . ' ' . $separator . ' ' . $site_name;
        } elseif (is_tag()) {
            return single_tag_title('', false) . ' ' . $separator . ' ' . $site_name;
        } elseif (is_archive()) {
            return get_the_archive_title() . ' ' . $separator . ' ' . $site_name;
        }
    }
    
    return $title . ' ' . $separator . ' ' . $site_name;
}

/**
 * Generate meta description
 *
 * @param string $description Custom description
 * @return string Meta description
 */
function generate_meta_description($description = '')
{
    if (!empty($description)) {
        return wp_trim_words($description, 25, '...');
    }
    
    if (is_front_page()) {
        $default_desc = get_theme_mod('seo_default_meta_description', get_bloginfo('description'));
        return wp_trim_words($default_desc, 25, '...');
    } elseif (is_single() || is_page()) {
        $custom_desc = get_post_meta(get_the_ID(), '_meta_description', true);
        if (!empty($custom_desc)) {
            return wp_trim_words($custom_desc, 25, '...');
        }
        
        $excerpt = get_the_excerpt();
        if (!empty($excerpt)) {
            return wp_trim_words($excerpt, 25, '...');
        }
        
        $content = get_the_content();
        return wp_trim_words(strip_tags($content), 25, '...');
    } elseif (is_category()) {
        $desc = category_description();
        if (!empty($desc)) {
            return wp_trim_words(strip_tags($desc), 25, '...');
        }
    } elseif (is_tag()) {
        $desc = tag_description();
        if (!empty($desc)) {
            return wp_trim_words(strip_tags($desc), 25, '...');
        }
    }
    
    return wp_trim_words(get_bloginfo('description'), 25, '...');
}

/**
 * Generate meta keywords
 *
 * @return string Meta keywords
 */
function generate_meta_keywords()
{
    $keywords = array();
    
    if (is_single() || is_page()) {
        $custom_keywords = get_post_meta(get_the_ID(), '_meta_keywords', true);
        if (!empty($custom_keywords)) {
            return $custom_keywords;
        }
        
        // Get tags as keywords
        $tags = get_the_tags();
        if ($tags) {
            foreach ($tags as $tag) {
                $keywords[] = $tag->name;
            }
        }
        
        // Get categories as keywords
        $categories = get_the_category();
        if ($categories) {
            foreach ($categories as $category) {
                $keywords[] = $category->name;
            }
        }
    }
    
    // Add default keywords
    $default_keywords = get_theme_mod('seo_default_meta_keywords', '');
    if (!empty($default_keywords)) {
        $default_array = explode(',', $default_keywords);
        $keywords = array_merge($keywords, array_map('trim', $default_array));
    }
    
    return implode(', ', array_unique($keywords));
}

/**
 * Get Open Graph image
 *
 * @return string OG image URL
 */
function get_og_image()
{
    if (is_single() || is_page()) {
        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if ($featured_image) {
            return $featured_image;
        }
    }
    
    $default_og_image = get_theme_mod('seo_default_og_image');
    if ($default_og_image) {
        return $default_og_image;
    }
    
    $custom_logo = get_theme_mod('custom_logo');
    if ($custom_logo) {
        return wp_get_attachment_image_url($custom_logo, 'large');
    }
    
    return '';
}

/**
 * Generate canonical URL
 *
 * @return string Canonical URL
 */
function get_canonical_url()
{
    if (is_front_page()) {
        return home_url('/');
    } elseif (is_single() || is_page()) {
        return get_permalink();
    } elseif (is_category()) {
        return get_category_link(get_queried_object_id());
    } elseif (is_tag()) {
        return get_tag_link(get_queried_object_id());
    } elseif (is_archive()) {
        return get_post_type_archive_link(get_post_type());
    }
    
    return home_url('/');
}

/**
 * Check if current page should be indexed
 *
 * @return bool Whether page should be indexed
 */
function should_index_page()
{
    // Don't index admin, login, or search pages
    if (is_admin() || is_search() || is_404()) {
        return false;
    }
    
    // Check if page has noindex meta
    if (is_single() || is_page()) {
        $noindex = get_post_meta(get_the_ID(), '_meta_noindex', true);
        if ($noindex === '1') {
            return false;
        }
    }
    
    return true;
}

/**
 * Generate robots meta tag
 *
 * @return string Robots meta content
 */
function generate_robots_meta()
{
    $robots = array();
    
    if (should_index_page()) {
        $robots[] = 'index';
        $robots[] = 'follow';
    } else {
        $robots[] = 'noindex';
        $robots[] = 'nofollow';
    }
    
    return implode(', ', $robots);
}
