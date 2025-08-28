<?php

/**
 * Theme Functions
 *
 * Main functions file that includes all modular components
 *
 * @package WordPress
 * @subpackage Skylight_Poly
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include WordPress functions stub for linter compatibility only when WordPress functions aren't available
if (!function_exists('wp_enqueue_style')) {
    require_once dirname(__FILE__) . '/wp-functions-stub.php';
}

// Define theme constants
define('THEME_VERSION', '1.0.0');

// Define theme directory constants conditionally
if (!defined('THEME_DIR')) {
    if (function_exists('get_template_directory')) {
        define('THEME_DIR', get_template_directory());
    } else {
        define('THEME_DIR', dirname(__FILE__));
    }
}
if (!defined('THEME_URL')) {
    if (function_exists('get_template_directory_uri')) {
        define('THEME_URL', get_template_directory_uri());
    } else {
        define('THEME_URL', 'http://localhost/wp-content/themes/wordpress-theme-skylightpoly');
    }
}

// Include modular files
require_once THEME_DIR . '/inc/theme-setup.php';
require_once THEME_DIR . '/inc/enqueue-scripts.php';
require_once THEME_DIR . '/inc/custom-post-types.php';
require_once THEME_DIR . '/inc/meta-boxes.php';
require_once THEME_DIR . '/inc/customizer.php';
require_once THEME_DIR . '/inc/helper-functions.php';

// Additional theme-specific functions can be added here
// Keep this file minimal and organized

/**
 * Add SEO meta boxes to posts and pages
 */
function add_seo_meta_boxes()
{
    add_meta_box(
        'seo_meta_box',
        'SEO Settings',
        'seo_meta_box_callback',
        array('post', 'page', 'product', 'quote_article', 'manual'),
        'normal',
        'high'
    );
}
if (function_exists('add_action')) {
    add_action('add_meta_boxes', 'add_seo_meta_boxes');
}

// Enhanced SEO Functions
// Remove WordPress version from head for security
if (function_exists('remove_action')) {
    remove_action('wp_head', 'wp_generator');
}

// Add XML Sitemap support
function enable_xml_sitemap()
{
    if (function_exists('add_theme_support')) {
        add_theme_support('wp-sitemap');
    }
}
if (function_exists('add_action')) {
    add_action('after_setup_theme', 'enable_xml_sitemap');
}

// Optimize robots.txt
function custom_robots_txt($output, $public)
{
    if ('0' == $public) {
        return $output;
    }

    $site_url = parse_url(site_url());
    $path = (!empty($site_url['path'])) ? $site_url['path'] : '';

    $output = "User-agent: *\n";
    $output .= "Disallow: {$path}/wp-admin/\n";
    $output .= "Disallow: {$path}/wp-includes/\n";
    $output .= "Disallow: {$path}/wp-content/plugins/\n";
    $output .= "Disallow: {$path}/wp-content/themes/\n";
    $output .= "Disallow: {$path}/wp-content/uploads/\n";
    $output .= "Allow: {$path}/wp-content/uploads/*.jpg\n";
    $output .= "Allow: {$path}/wp-content/uploads/*.jpeg\n";
    $output .= "Allow: {$path}/wp-content/uploads/*.png\n";
    $output .= "Allow: {$path}/wp-content/uploads/*.gif\n";
    $output .= "Allow: {$path}/wp-content/uploads/*.webp\n";
    $output .= "\n";
    $output .= "Sitemap: " . site_url('/wp-sitemap.xml') . "\n";

    return $output;
}
if (function_exists('add_filter')) {
    add_filter('robots_txt', 'custom_robots_txt', 10, 2);
}

// Add canonical URL support
function add_canonical_url()
{
    if (function_exists('is_singular') && is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '" />' . "\n";
    } elseif ((function_exists('is_home') && is_home()) || (function_exists('is_front_page') && is_front_page())) {
        echo '<link rel="canonical" href="' . esc_url(home_url('/')) . '" />' . "\n";
    } elseif (function_exists('is_category') && is_category()) {
        echo '<link rel="canonical" href="' . esc_url(get_category_link(get_queried_object_id())) . '" />' . "\n";
    } elseif (function_exists('is_tag') && is_tag()) {
        echo '<link rel="canonical" href="' . esc_url(get_tag_link(get_queried_object_id())) . '" />' . "\n";
    } elseif (function_exists('is_archive') && is_archive()) {
        echo '<link rel="canonical" href="' . esc_url(get_post_type_archive_link(get_post_type())) . '" />' . "\n";
    }
}
if (function_exists('add_action')) {
    add_action('wp_head', 'add_canonical_url', 1);
}

// Optimize image loading with lazy loading
function add_lazy_loading_to_images($content)
{
    if ((function_exists('is_admin') && is_admin()) || (function_exists('is_feed') && is_feed()) || (function_exists('is_preview') && is_preview())) {
        return $content;
    }

    $content = preg_replace('/<img(.*?)src=/', '<img$1loading="lazy" src=', $content);
    return $content;
}
if (function_exists('add_filter')) {
    add_filter('the_content', 'add_lazy_loading_to_images');
}

// Add structured data for breadcrumbs
function add_breadcrumb_structured_data()
{
    if (function_exists('is_front_page') && is_front_page()) {
        return;
    }

    $breadcrumbs = array();
    $breadcrumbs[] = array(
        '@type' => 'ListItem',
        'position' => 1,
        'name' => 'Trang chủ',
        'item' => home_url('/')
    );

    $position = 2;

    if (function_exists('is_single') && is_single()) {
        if (function_exists('get_post_type') && get_post_type() === 'post') {
            $breadcrumbs[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => 'Bài viết',
                'item' => home_url('/tin-tuc/')
            );
        } elseif (function_exists('get_post_type') && get_post_type() === 'product') {
            $breadcrumbs[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => 'Sản phẩm',
                'item' => get_post_type_archive_link('product')
            );
        }

        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position,
            'name' => get_the_title(),
            'item' => get_permalink()
        );
    }

    if (!empty($breadcrumbs)) {
        echo '<script type="application/ld+json">';
        echo json_encode(array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $breadcrumbs
        ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        echo '</script>' . "\n";
    }
}
if (function_exists('add_action')) {
    add_action('wp_head', 'add_breadcrumb_structured_data');
}

/**
 * SEO meta box callback
 */
function seo_meta_box_callback($post)
{
    wp_nonce_field('seo_meta_box_nonce', 'seo_meta_box_nonce');

    $meta_description = get_post_meta($post->ID, '_meta_description', true);
    $meta_keywords = get_post_meta($post->ID, '_meta_keywords', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="meta_description">Meta Description</label></th>';
    echo '<td><textarea id="meta_description" name="meta_description" rows="3" cols="50" style="width:100%;">' . esc_textarea($meta_description) . '</textarea>';
    echo '<p class="description">Recommended length: 150-160 characters</p></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="meta_keywords">Meta Keywords</label></th>';
    echo '<td><input type="text" id="meta_keywords" name="meta_keywords" value="' . esc_attr($meta_keywords) . '" style="width:100%;" />';
    echo '<p class="description">Separate keywords with commas</p></td>';
    echo '</tr>';
    echo '</table>';
}

/**
 * Save SEO meta box data
 */
function save_seo_meta_box($post_id)
{
    if (!isset($_POST['seo_meta_box_nonce']) || !wp_verify_nonce($_POST['seo_meta_box_nonce'], 'seo_meta_box_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['meta_description'])) {
        update_post_meta($post_id, '_meta_description', sanitize_textarea_field($_POST['meta_description']));
    }

    if (isset($_POST['meta_keywords'])) {
        update_post_meta($post_id, '_meta_keywords', sanitize_text_field($_POST['meta_keywords']));
    }
}
if (function_exists('add_action')) {
    add_action('save_post', 'save_seo_meta_box');
}

/**
 * Add SEO options to customizer
 */
function add_seo_customizer_options($wp_customize)
{
    // SEO Section
    $wp_customize->add_section('seo_settings', array(
        'title' => 'SEO Settings',
        'priority' => 30,
    ));

    // Site Meta Description
    $wp_customize->add_setting('site_meta_description', array(
        'default' => 'Skylight Plastic - Chuyên cung cấp sản phẩm nhựa chất lượng cao, giá cả hợp lý, giao hàng nhanh chóng trên toàn quốc.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('site_meta_description', array(
        'label' => 'Site Meta Description',
        'section' => 'seo_settings',
        'type' => 'textarea',
        'description' => 'Default meta description for your site (150-160 characters recommended)',
    ));

    // Site Meta Keywords
    $wp_customize->add_setting('site_meta_keywords', array(
        'default' => 'nhựa, sản phẩm nhựa, skylight plastic, chất lượng cao',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('site_meta_keywords', array(
        'label' => 'Site Meta Keywords',
        'section' => 'seo_settings',
        'type' => 'text',
        'description' => 'Default meta keywords for your site (separate with commas)',
    ));

    // Open Graph Image
    $wp_customize->add_setting('site_og_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    if (class_exists('WP_Customize_Image_Control')) {
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_og_image', array(
            'label' => 'Default Open Graph Image',
            'section' => 'seo_settings',
            'description' => 'Default image for social media sharing (1200x630px recommended)',
        )));
    }
}
if (function_exists('add_action')) {
    add_action('customize_register', 'add_seo_customizer_options');
}

/**
 * Add active class to manual menu item when on manual archive page
 */
function add_manual_menu_active_class($classes, $item, $args)
{
    if (function_exists('is_post_type_archive') && function_exists('home_url') && is_post_type_archive('manual')) {
        // Check if this menu item links to the manual page
        $manual_url = home_url('/tai-lieu-ky-thuat/');
        if (isset($item->url) && ($item->url === $manual_url || $item->url === rtrim($manual_url, '/'))) {
            $classes[] = 'current-menu-item';
        }
    }
    return $classes;
}
if (function_exists('add_filter')) {
    add_filter('nav_menu_css_class', 'add_manual_menu_active_class', 10, 3);
}

/**
 * Add active class to products menu item when on products page
 */
function add_products_menu_active_class($classes, $item, $args)
{
    // Check if we're on products page (page-products.php) or products archive
    $is_products_page = false;

    if (function_exists('is_page_template') && is_page_template('page-products.php')) {
        $is_products_page = true;
    } elseif (function_exists('is_post_type_archive') && is_post_type_archive('product')) {
        $is_products_page = true;
    } elseif (function_exists('is_page') && is_page() && function_exists('get_page_template_slug')) {
        $template = get_page_template_slug();
        if ($template === 'page-products.php') {
            $is_products_page = true;
        }
    }

    if ($is_products_page && function_exists('home_url')) {
        // Check if this menu item links to the products page
        $products_url = home_url('/san-pham/');
        $products_url_alt = home_url('/san-pham/');

        if (isset($item->url) && (
            $item->url === $products_url ||
            $item->url === rtrim($products_url, '/') ||
            $item->url === $products_url_alt ||
            $item->url === rtrim($products_url_alt, '/') ||
            (is_string($item->url) && strpos($item->url, '/products') !== false) ||
            (is_string($item->url) && strpos($item->url, '/san-pham') !== false)
        )) {
            $classes[] = 'current-menu-item';
        }
    }
    return $classes;
}
if (function_exists('add_filter')) {
    add_filter('nav_menu_css_class', 'add_products_menu_active_class', 10, 3);
}

/**
 * Manual permalink flush function
 * Add ?flush_permalinks=1 to any page URL to trigger permalink flush
 */
function manual_permalink_flush()
{
    if (isset($_GET['flush_permalinks']) && $_GET['flush_permalinks'] == '1') {
        if (function_exists('flush_rewrite_rules')) {
            flush_rewrite_rules(true);
            // Redirect to remove the parameter from URL
            if (function_exists('remove_query_arg')) {
                $redirect_url = remove_query_arg('flush_permalinks');
                if (function_exists('wp_redirect') && $redirect_url) {
                    wp_redirect($redirect_url);
                    exit;
                }
            }
        }
    }
}
if (function_exists('add_action')) {
    add_action('init', 'manual_permalink_flush');
}
