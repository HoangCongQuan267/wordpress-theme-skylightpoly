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

// Ensure WordPress functions are available
if (!function_exists('wp_enqueue_script')) {
    require_once(ABSPATH . 'wp-includes/script-loader.php');
}
if (!function_exists('wp_localize_script')) {
    require_once(ABSPATH . 'wp-includes/functions.wp-scripts.php');
}
if (!function_exists('wp_send_json_error')) {
    require_once(ABSPATH . 'wp-includes/functions.php');
}
if (!function_exists('dbDelta')) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
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

    if (!function_exists('site_url')) {
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
    } elseif (function_exists('is_category') && function_exists('get_queried_object_id') && is_category()) {
        echo '<link rel="canonical" href="' . esc_url(get_category_link(get_queried_object_id())) . '" />' . "\n";
    } elseif (function_exists('is_tag') && function_exists('get_queried_object_id') && is_tag()) {
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
 * Add active class to quotes menu item when on quotes archive page
 */
function add_quotes_menu_active_class($classes, $item, $args)
{
    if (function_exists('is_post_type_archive') && function_exists('home_url') && is_post_type_archive('quote_article')) {
        // Check if this menu item links to the quotes page
        $quotes_url = home_url('/bao-gia/');
        $quotes_url_alt = home_url('/quotes/');

        if (isset($item->url) && (
            $item->url === $quotes_url ||
            $item->url === rtrim($quotes_url, '/') ||
            $item->url === $quotes_url_alt ||
            $item->url === rtrim($quotes_url_alt, '/') ||
            (is_string($item->url) && strpos($item->url, '/bao-gia') !== false) ||
            (is_string($item->url) && strpos($item->url, '/quotes') !== false)
        )) {
            $classes[] = 'current-menu-item';
        }
    }
    return $classes;
}
if (function_exists('add_filter')) {
    add_filter('nav_menu_css_class', 'add_quotes_menu_active_class', 10, 3);
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

/**
 * Contact Form Handler
 * Process contact form submissions and save to database
 */
function handle_contact_form_submission()
{
    // Check if this is a contact form submission
    if (!isset($_POST['action']) || $_POST['action'] !== 'submit_contact_form') {
        return;
    }

    // Check if WordPress functions are available
    if (!function_exists('wp_verify_nonce') || !function_exists('sanitize_text_field')) {
        wp_die('WordPress functions not available.');
    }

    // Verify nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'contact_form_nonce')) {
        if (function_exists('wp_send_json_error')) {
            wp_send_json_error(array('message' => 'Security check failed'));
        }
        return;
    }

    // Sanitize and validate form data
    $first_name = function_exists('sanitize_text_field') ? sanitize_text_field($_POST['first_name'] ?? '') : '';
    $last_name = function_exists('sanitize_text_field') ? sanitize_text_field($_POST['last_name'] ?? '') : '';
    $email = function_exists('sanitize_email') ? sanitize_email($_POST['email'] ?? '') : '';
    $phone = function_exists('sanitize_text_field') ? sanitize_text_field($_POST['phone'] ?? '') : '';
    $company = function_exists('sanitize_text_field') ? sanitize_text_field($_POST['company'] ?? '') : '';
    $message = function_exists('sanitize_textarea_field') ? sanitize_textarea_field($_POST['message'] ?? '') : '';

    // Validate required fields
    $errors = array();
    if (empty($first_name)) $errors[] = 'Tên là bắt buộc';
    if (empty($last_name)) $errors[] = 'Họ là bắt buộc';
    if (empty($email) || (function_exists('is_email') && !is_email($email))) $errors[] = 'Email hợp lệ là bắt buộc';
    if (empty($message)) $errors[] = 'Tin nhắn là bắt buộc';

    if (!empty($errors)) {
        if (function_exists('wp_send_json_error')) {
            wp_send_json_error(array('message' => implode(', ', $errors)));
        }
        return;
    }

    // Check if API integration is enabled
    $api_enabled = function_exists('get_theme_mod') ? get_theme_mod('contact_form_api_enable', false) : false;
    $api_url = function_exists('get_theme_mod') ? get_theme_mod('contact_form_api_url', '') : '';

    if ($api_enabled && !empty($api_url)) {
        // Send data to external API
        $current_time_value = function_exists('current_time') ? current_time('Y-m-d H:i:s') : date('Y-m-d H:i:s');
        $api_data = array(
            'name' => $first_name . ' ' . $last_name,
            'email' => $email,
            'phone' => $phone,
            'company' => $company,
            'message' => $message,
            'submitted_at' => $current_time_value,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        );

        // Get API settings
        $api_method = function_exists('get_theme_mod') ? get_theme_mod('contact_form_api_method', 'POST') : 'POST';
        $api_headers_json = function_exists('get_theme_mod') ? get_theme_mod('contact_form_api_headers', '') : '';

        // Parse custom headers
        $headers = array('Content-Type' => 'application/json');
        if (!empty($api_headers_json)) {
            $custom_headers = json_decode($api_headers_json, true);
            if (is_array($custom_headers)) {
                $headers = array_merge($headers, $custom_headers);
            }
        }

        // Send API request
        if (function_exists('wp_remote_request')) {
            $response = wp_remote_request($api_url, array(
                'method' => $api_method,
                'headers' => $headers,
                'body' => json_encode($api_data),
                'timeout' => 30
            ));

            if (is_wp_error($response)) {
                if (function_exists('wp_send_json_error')) {
                    wp_send_json_error(array('message' => 'Có lỗi xảy ra khi gửi dữ liệu đến API: ' . $response->get_error_message()));
                }
                return;
            }

            $response_code = function_exists('wp_remote_retrieve_response_code') ? wp_remote_retrieve_response_code($response) : 0;
            if ($response_code < 200 || $response_code >= 300) {
                if (function_exists('wp_send_json_error')) {
                    wp_send_json_error(array('message' => 'API trả về lỗi: ' . $response_code));
                }
                return;
            }

            // API success - send success response
            if (function_exists('wp_send_json_success')) {
                wp_send_json_success(array('message' => 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.'));
            }
            return;
        }
    }

    // Default behavior: Save to database
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_submissions';

    // Create table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name tinytext NOT NULL,
        last_name tinytext NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20),
        company tinytext,
        message text NOT NULL,
        submission_date datetime DEFAULT CURRENT_TIMESTAMP,
        status varchar(20) DEFAULT 'new',
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    if (function_exists('dbDelta')) {
        dbDelta($sql);
    }

    // Insert the contact submission
    $current_time_mysql = function_exists('current_time') ? current_time('mysql') : date('Y-m-d H:i:s');
    $result = $wpdb->insert(
        $table_name,
        array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'company' => $company,
            'message' => $message,
            'submission_date' => $current_time_mysql,
            'status' => 'new'
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    if ($result === false) {
        if (function_exists('wp_send_json_error')) {
            wp_send_json_error(array('message' => 'Có lỗi xảy ra khi lưu thông tin. Vui lòng thử lại.'));
        }
        return;
    }

    // Send email notification to admin
    if (function_exists('get_option') && function_exists('get_bloginfo') && function_exists('wp_mail')) {
        $admin_email = get_option('admin_email');
        $subject = 'Liên hệ mới từ website ' . get_bloginfo('name');
        $email_message = "Bạn có một liên hệ mới từ website:\n\n";
        $email_message .= "Tên: $first_name $last_name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Điện thoại: $phone\n";
        $email_message .= "Công ty: $company\n";
        $email_message .= "Tin nhắn:\n$message\n\n";
        $current_time_display = function_exists('current_time') ? current_time('d/m/Y H:i:s') : date('d/m/Y H:i:s');
        $email_message .= "Thời gian: " . $current_time_display;

        $headers = array('Content-Type: text/plain; charset=UTF-8');
        wp_mail($admin_email, $subject, $email_message, $headers);
    }

    // Send success response
    if (function_exists('wp_send_json_success')) {
        wp_send_json_success(array('message' => 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.'));
    }
}

// Handle AJAX requests for both logged in and non-logged in users
if (function_exists('add_action')) {
    add_action('wp_ajax_submit_contact_form', 'handle_contact_form_submission');
    add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form_submission');
}

/**
 * Enqueue contact form scripts
 */
function enqueue_contact_form_scripts()
{
    if (function_exists('wp_localize_script') && function_exists('wp_create_nonce') && function_exists('admin_url')) {
        wp_localize_script('custom-blue-orange-script', 'contact_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('contact_form_nonce')
        ));
    }
}
if (function_exists('add_action')) {
    add_action('wp_enqueue_scripts', 'enqueue_contact_form_scripts');
}

/**
 * Add contact submissions admin menu
 */
function add_contact_submissions_menu()
{
    if (function_exists('add_menu_page')) {
        add_menu_page(
            'Liên Hệ',
            'Liên Hệ',
            'manage_options',
            'contact-submissions',
            'display_contact_submissions',
            'dashicons-email-alt',
            30
        );
    }
}
if (function_exists('add_action')) {
    add_action('admin_menu', 'add_contact_submissions_menu');
}

/**
 * Display contact submissions in admin
 */
function display_contact_submissions()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_submissions';

    // Handle status updates
    if (isset($_POST['update_status']) && isset($_POST['submission_id']) && isset($_POST['new_status'])) {
        $submission_id = intval($_POST['submission_id']);
        $new_status = sanitize_text_field($_POST['new_status']);
        $wpdb->update(
            $table_name,
            array('status' => $new_status),
            array('id' => $submission_id),
            array('%s'),
            array('%d')
        );
        echo '<div class="notice notice-success"><p>Trạng thái đã được cập nhật!</p></div>';
    }

    // Get all submissions
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submission_date DESC");

    echo '<div class="wrap">';
    echo '<h1>Liên Hệ Từ Website</h1>';

    if (empty($submissions)) {
        echo '<p>Chưa có liên hệ nào.</p>';
    } else {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr>';
        echo '<th>ID</th><th>Tên</th><th>Email</th><th>Điện thoại</th><th>Công ty</th><th>Tin nhắn</th><th>Ngày gửi</th><th>Trạng thái</th><th>Hành động</th>';
        echo '</tr></thead><tbody>';

        foreach ($submissions as $submission) {
            echo '<tr>';
            echo '<td>' . esc_html($submission->id) . '</td>';
            echo '<td>' . esc_html($submission->first_name . ' ' . $submission->last_name) . '</td>';
            echo '<td><a href="mailto:' . esc_attr($submission->email) . '">' . esc_html($submission->email) . '</a></td>';
            echo '<td>' . esc_html($submission->phone) . '</td>';
            echo '<td>' . esc_html($submission->company) . '</td>';
            echo '<td>' . esc_html(wp_trim_words($submission->message, 10)) . '</td>';
            echo '<td>' . esc_html(date('d/m/Y H:i', strtotime($submission->submission_date))) . '</td>';
            echo '<td>';
            $status_class = $submission->status === 'new' ? 'status-new' : ($submission->status === 'replied' ? 'status-replied' : 'status-closed');
            echo '<span class="' . $status_class . '">' . esc_html(ucfirst($submission->status)) . '</span>';
            echo '</td>';
            echo '<td>';
            echo '<form method="post" style="display:inline;">';
            echo '<input type="hidden" name="submission_id" value="' . esc_attr($submission->id) . '">';
            echo '<select name="new_status">';
            echo '<option value="new"' . selected($submission->status, 'new', false) . '>New</option>';
            echo '<option value="replied"' . selected($submission->status, 'replied', false) . '>Replied</option>';
            echo '<option value="closed"' . selected($submission->status, 'closed', false) . '>Closed</option>';
            echo '</select>';
            echo '<input type="submit" name="update_status" value="Cập nhật" class="button button-small">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    }

    echo '</div>';

    // Add some basic styling
    echo '<style>';
    echo '.status-new { color: #d63384; font-weight: bold; }';
    echo '.status-replied { color: #198754; font-weight: bold; }';
    echo '.status-closed { color: #6c757d; }';
    echo '</style>';
}

if (function_exists('add_action')) {
    add_action('init', 'manual_permalink_flush');
}
