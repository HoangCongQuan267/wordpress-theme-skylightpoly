<?php

/**
 * WordPress Functions Stub File
 * This file contains function declarations to resolve linter errors
 * These functions are provided by WordPress core and should not be redefined in production
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Core WordPress functions
if (!function_exists('get_header')) {
    function get_header($name = null) {}
}

if (!function_exists('get_footer')) {
    function get_footer($name = null) {}
}

if (!function_exists('get_sidebar')) {
    function get_sidebar($name = null) {}
}

if (!function_exists('wp_head')) {
    function wp_head() {}
}

if (!function_exists('wp_footer')) {
    function wp_footer() {}
}

if (!function_exists('wp_body_open')) {
    function wp_body_open() {}
}

if (!function_exists('bloginfo')) {
    function bloginfo($show = '') {}
}

if (!function_exists('get_bloginfo')) {
    function get_bloginfo($show = '', $filter = 'raw') {}
}

if (!function_exists('language_attributes')) {
    function language_attributes($doctype = 'html') {}
}

if (!function_exists('body_class')) {
    function body_class($class = '') {}
}

if (!function_exists('post_class')) {
    function post_class($class = '', $post_id = null) {}
}

if (!function_exists('have_posts')) {
    function have_posts() {}
}

if (!function_exists('the_post')) {
    function the_post() {}
}

if (!function_exists('the_ID')) {
    function the_ID() {}
}

if (!function_exists('the_title')) {
    function the_title($before = '', $after = '', $echo = true) {}
}

if (!function_exists('the_content')) {
    function the_content($more_link_text = null, $strip_teaser = false) {}
}

if (!function_exists('the_excerpt')) {
    function the_excerpt() {}
}

if (!function_exists('the_permalink')) {
    function the_permalink($post = 0) {}
}

if (!function_exists('get_permalink')) {
    function get_permalink($post = 0, $leavename = false) {}
}

if (!function_exists('the_author')) {
    function the_author() {}
}

if (!function_exists('the_date')) {
    function the_date($d = '', $before = '', $after = '', $echo = true) {}
}

if (!function_exists('get_the_date')) {
    function get_the_date($d = '', $post = null) {}
}

// Additional WordPress core functions
if (!function_exists('site_url')) {
    function site_url($path = '', $scheme = null) {}
}

if (!function_exists('is_front_page')) {
    function is_front_page() {}
}

if (!function_exists('is_category')) {
    function is_category($category = '') {}
}

if (!function_exists('get_queried_object_id')) {
    function get_queried_object_id() {}
}

if (!function_exists('is_tag')) {
    function is_tag($tag = '') {}
}

if (!function_exists('is_admin')) {
    function is_admin() {}
}

if (!function_exists('is_feed')) {
    function is_feed() {}
}

if (!function_exists('is_preview')) {
    function is_preview() {}
}

if (!function_exists('is_single')) {
    function is_single($post = '') {}
}

if (!function_exists('is_page_template')) {
    function is_page_template($template = '') {}
}

if (!function_exists('is_page')) {
    function is_page($page = '') {}
}

if (!function_exists('get_page_template_slug')) {
    function get_page_template_slug($post = null) {}
}

if (!function_exists('wp_nonce_url')) {
    function wp_nonce_url($actionurl, $action = -1, $name = '_wpnonce') {}
}

if (!function_exists('get_post')) {
    function get_post($post = null, $output = OBJECT, $filter = 'raw') {}
}

if (!function_exists('get_current_user_id')) {
    function get_current_user_id() {}
}

if (!function_exists('wp_insert_post')) {
    function wp_insert_post($postarr, $wp_error = false) {}
}

if (!function_exists('add_post_meta')) {
    function add_post_meta($post_id, $meta_key, $meta_value, $unique = false) {}
}

if (!function_exists('maybe_unserialize')) {
    function maybe_unserialize($original) {}
}

if (!function_exists('get_object_taxonomies')) {
    function get_object_taxonomies($object, $output = 'names') {}
}

if (!function_exists('wp_get_post_terms')) {
    function wp_get_post_terms($post_id, $taxonomy, $args = array()) {}
}

if (!function_exists('wp_set_post_terms')) {
    function wp_set_post_terms($post_id, $terms, $taxonomy, $append = false) {}
}

if (!function_exists('set_post_thumbnail')) {
    function set_post_thumbnail($post, $thumbnail_id) {}
}

if (!function_exists('add_submenu_page')) {
    function add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '') {}
}

if (!function_exists('delete_post_meta')) {
    function delete_post_meta($post_id, $meta_key, $meta_value = '') {}
}

if (!function_exists('wp_send_json_error')) {
    function wp_send_json_error($data = null, $status_code = null) {}
}

if (!function_exists('wp_send_json_success')) {
    function wp_send_json_success($data = null, $status_code = null) {}
}

if (!function_exists('sanitize_email')) {
    function sanitize_email($email) {}
}

if (!function_exists('is_email')) {
    function is_email($email, $deprecated = false) {}
}

if (!function_exists('current_time')) {
    function current_time($type, $gmt = 0) {}
}

if (!function_exists('wp_remote_request')) {
    function wp_remote_request($url, $args = array()) {}
}

if (!function_exists('wp_remote_retrieve_response_code')) {
    function wp_remote_retrieve_response_code($response) {}
}

if (!function_exists('dbDelta')) {
    function dbDelta($queries = '', $execute = true) {}
}

if (!function_exists('wp_mail')) {
    function wp_mail($to, $subject, $message, $headers = '', $attachments = array()) {}
}

if (!function_exists('wp_localize_script')) {
    function wp_localize_script($handle, $object_name, $l10n) {}
}

if (!function_exists('wp_create_nonce')) {
    function wp_create_nonce($action = -1) {}
}

if (!function_exists('add_menu_page')) {
    function add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null) {}
}

// WordPress classes
if (!class_exists('WP_Customize_Image_Control')) {
    class WP_Customize_Image_Control {}
}

if (!function_exists('the_category')) {
    function the_category($separator = '', $parents = '', $post_id = false) {}
}

if (!function_exists('get_the_category')) {
    function get_the_category($id = false) {}
}

if (!function_exists('the_tags')) {
    function the_tags($before = null, $sep = ', ', $after = '') {}
}

if (!function_exists('get_the_tags')) {
    function get_the_tags($id = 0) {}
}

if (!function_exists('has_post_thumbnail')) {
    function has_post_thumbnail($post = null) {}
}

if (!function_exists('the_post_thumbnail')) {
    function the_post_thumbnail($size = 'post-thumbnail', $attr = '') {}
}

if (!function_exists('wp_nav_menu')) {
    function wp_nav_menu($args = array()) {}
}

if (!function_exists('has_custom_logo')) {
    function has_custom_logo($blog_id = 0) {}
}

if (!function_exists('the_custom_logo')) {
    function the_custom_logo($blog_id = 0) {}
}

if (!function_exists('home_url')) {
    function home_url($path = '', $scheme = null) {}
}

if (!function_exists('esc_url')) {
    function esc_url($url, $protocols = null, $_context = 'display') {}
}

if (!function_exists('esc_attr')) {
    function esc_attr($text) {}
}

if (!function_exists('esc_html__')) {
    function esc_html__($text, $domain = 'default') {}
}

if (!function_exists('is_home')) {
    function is_home() {}
}

if (!function_exists('is_archive')) {
    function is_archive() {}
}

if (!function_exists('is_singular')) {
    function is_singular($post_types = '') {}
}

if (!function_exists('get_search_form')) {
    function get_search_form($echo = true) {}
}

if (!function_exists('get_search_query')) {
    function get_search_query($escaped = true) {}
}

if (!function_exists('the_posts_pagination')) {
    function the_posts_pagination($args = array()) {}
}

if (!function_exists('wp_link_pages')) {
    function wp_link_pages($args = '') {}
}

if (!function_exists('paginate_links')) {
    function paginate_links($args = '') {}
}

if (!function_exists('get_pagenum_link')) {
    function get_pagenum_link($pagenum = 1, $escape = true) {}
}

if (!function_exists('get_query_var')) {
    function get_query_var($var, $default = '') {}
}

if (!function_exists('previous_post_link')) {
    function previous_post_link($format = '&laquo; %link', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category') {}
}

if (!function_exists('next_post_link')) {
    function next_post_link($format = '%link &raquo;', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category') {}
}

// Comments functions
if (!function_exists('comments_open')) {
    function comments_open($post_id = null) {}
}

if (!function_exists('get_comments_number')) {
    function get_comments_number($post_id = 0) {}
}

if (!function_exists('comments_number')) {
    function comments_number($zero = false, $one = false, $more = false, $deprecated = '') {}
}

if (!function_exists('comments_template')) {
    function comments_template($file = '/comments.php', $separate_comments = false) {}
}

if (!function_exists('have_comments')) {
    function have_comments() {}
}

if (!function_exists('wp_list_comments')) {
    function wp_list_comments($args = array(), $comments = null) {}
}

if (!function_exists('the_comments_pagination')) {
    function the_comments_pagination($args = array()) {}
}

if (!function_exists('comment_form')) {
    function comment_form($args = array(), $post_id = null) {}
}

if (!function_exists('post_password_required')) {
    function post_password_required($post = null) {}
}

if (!function_exists('comment_ID')) {
    function comment_ID() {}
}

if (!function_exists('comment_class')) {
    function comment_class($class = '', $comment_id = null, $post_id = null, $echo = true) {}
}

if (!function_exists('get_avatar')) {
    function get_avatar($id_or_email, $size = 96, $default = '', $alt = '', $args = null) {}
}

if (!function_exists('comment_author_link')) {
    function comment_author_link($comment_ID = 0) {}
}

if (!function_exists('get_comment_link')) {
    function get_comment_link($comment = null, $args = array()) {}
}

if (!function_exists('comment_time')) {
    function comment_time($d = '', $gmt = false, $translate = true) {}
}

if (!function_exists('get_comment_date')) {
    function get_comment_date($d = '', $comment_ID = 0) {}
}

if (!function_exists('get_comment_time')) {
    function get_comment_time($d = '', $gmt = false, $translate = true) {}
}

if (!function_exists('edit_comment_link')) {
    function edit_comment_link($text = null, $before = '', $after = '') {}
}

if (!function_exists('comment_text')) {
    function comment_text($comment_ID = 0, $args = array()) {}
}

if (!function_exists('comment_reply_link')) {
    function comment_reply_link($args = array(), $comment = null, $post = null) {}
}

// Theme functions
if (!function_exists('add_theme_support')) {
    function add_theme_support($feature) {}
}

if (!function_exists('add_image_size')) {
    function add_image_size($name, $width = 0, $height = 0, $crop = false) {}
}

if (!function_exists('register_nav_menus')) {
    function register_nav_menus($locations = array()) {}
}

if (!function_exists('add_editor_style')) {
    function add_editor_style($stylesheet = 'editor-style.css') {}
}

if (!function_exists('add_action')) {
    function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {}
}

if (!function_exists('add_filter')) {
    function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1) {}
}

if (!function_exists('remove_action')) {
    function remove_action($tag, $function_to_remove, $priority = 10) {}
}

if (!function_exists('remove_filter')) {
    function remove_filter($tag, $function_to_remove, $priority = 10) {}
}

if (!function_exists('esc_js')) {
    function esc_js($text) { return $text; }
}

if (!function_exists('wp_enqueue_style')) {
    function wp_enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {}
}

if (!function_exists('wp_enqueue_script')) {
    function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {}
}

if (!function_exists('get_stylesheet_uri')) {
    function get_stylesheet_uri() {}
}

if (!function_exists('get_template_directory_uri')) {
    function get_template_directory_uri() {}
}

if (!function_exists('get_option')) {
    function get_option($option, $default = false) {}
}

if (!function_exists('register_sidebar')) {
    function register_sidebar($args = array()) {}
}

if (!function_exists('is_active_sidebar')) {
    function is_active_sidebar($index) {}
}

if (!function_exists('dynamic_sidebar')) {
    function dynamic_sidebar($index = 1) {}
}

if (!function_exists('wp_get_recent_posts')) {
    function wp_get_recent_posts($args = array(), $output = ARRAY_A) {}
}

if (!function_exists('wp_reset_query')) {
    function wp_reset_query() {}
}

if (!function_exists('wp_list_categories')) {
    function wp_list_categories($args = '') {}
}

if (!function_exists('is_post_type_archive')) {
    function is_post_type_archive($post_types = '') {
        return false;
    }
}

if (!function_exists('get_post_type_archive_link')) {
    function get_post_type_archive_link($post_type) {
        return '#';
    }
}

if (!function_exists('get_the_terms')) {
    function get_the_terms($post_id, $taxonomy) {
        return false;
    }
}

if (!function_exists('get_term_by')) {
    function get_term_by($field, $value, $taxonomy) {
        // Stub for get_term_by function
        return (object) array(
            'term_id' => 1,
            'name' => 'Sample Term',
            'slug' => 'sample-term',
            'term_group' => 0,
            'term_taxonomy_id' => 1,
            'taxonomy' => $taxonomy,
            'description' => '',
            'parent' => 0,
            'count' => 1
        );
    }
}

if (!function_exists('the_title_attribute')) {
    function the_title_attribute($args = '') {
        // Stub for the_title_attribute function
        echo esc_attr(get_the_title());
    }
}

if (!function_exists('has_excerpt')) {
    function has_excerpt($post = null) {
        // Stub for has_excerpt function
        return false;
    }
}

if (!function_exists('wp_die')) {
    function wp_die($message = '', $title = '', $args = array()) {
        die($message);
    }
}

if (!function_exists('term_exists')) {
    function term_exists($term, $taxonomy = '', $parent = null) {
        // Stub function - returns false for non-existing terms
        return false;
    }
}

if (!function_exists('wp_insert_term')) {
    function wp_insert_term($term, $taxonomy, $args = array()) {
        // Stub function - returns success array
         return array('term_id' => 1, 'term_taxonomy_id' => 1);
     }
 }
 
 if (!function_exists('get_page_by_path')) {
    function get_page_by_path($page_path, $output = OBJECT, $post_type = 'page') {
        // Stub function - returns mock page object
        $page = new stdClass();
        $page->ID = 1;
        return $page;
    }
}

if (!function_exists('add_meta_box')) {
    function add_meta_box($id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null) {
        return true;
    }
}

if (!function_exists('esc_textarea')) {
    function esc_textarea($text) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('get_current_screen')) {
    function get_current_screen() {
        return (object) array('id' => 'edit-product', 'post_type' => 'product');
    }
}

if (!function_exists('flush_rewrite_rules')) {
    function flush_rewrite_rules($hard = true) {
        // Stub function for development
    }
}

if (!function_exists('wp_redirect')) {
    function wp_redirect($location, $status = 302, $x_redirect_by = 'WordPress') {
        return false;
    }
}

// WordPress translation functions
if (!function_exists('__')) {
    function __($text, $domain = 'default') {
        return $text;
    }
}

if (!function_exists('_e')) {
    function _e($text, $domain = 'default') {
        echo $text;
    }
}

// WordPress sanitization functions
if (!function_exists('sanitize_text_field')) {
    function sanitize_text_field($str) {
        return $str;
    }
}

if (!function_exists('sanitize_textarea_field')) {
    function sanitize_textarea_field($str) {
        return $str;
    }
}

if (!function_exists('esc_url_raw')) {
    function esc_url_raw($url, $protocols = null) {
        return $url;
    }
}

if (!function_exists('absint')) {
    function absint($maybeint) {
        return abs(intval($maybeint));
    }
}

// WordPress post functions
if (!function_exists('register_post_type')) {
    function register_post_type($post_type, $args = array()) {
        return true;
    }
}

// add_meta_box() function removed - WordPress core function should not be redeclared

if (!function_exists('wp_nonce_field')) {
    function wp_nonce_field($action = -1, $name = '_wpnonce', $referer = true, $echo = true) {
        return '';
    }
}

if (!function_exists('wp_verify_nonce')) {
    function wp_verify_nonce($nonce, $action = -1) {
        return true;
    }
}

if (!function_exists('current_user_can')) {
    function current_user_can($capability, $object_id = null) {
        return true;
    }
}

if (!function_exists('update_post_meta')) {
    function update_post_meta($post_id, $meta_key, $meta_value, $prev_value = '') {
        return true;
    }
}

if (!function_exists('get_posts')) {
    function get_posts($args = null) {
        // Only return mock data if WordPress is not loaded (for linting/development)
        if (!defined('WP_DEBUG') && isset($args['post_type']) && $args['post_type'] === 'product') {
            $mock_products = array();
            for ($i = 1; $i <= 3; $i++) {
                $product = new stdClass();
                $product->ID = $i;
                $product->post_title = 'Sản phẩm mẫu ' . $i;
                $product->post_content = 'Nội dung chi tiết cho sản phẩm mẫu ' . $i . '. Đây là một sản phẩm chất lượng cao với nhiều tính năng ưu việt.';
                $product->post_excerpt = 'Mô tả ngắn gọn về sản phẩm mẫu ' . $i;
                $mock_products[] = $product;
            }
            return $mock_products;
        }
        return array();
    }
}

if (!function_exists('get_the_post_thumbnail')) {
    function get_the_post_thumbnail($post = null, $size = 'post-thumbnail', $attr = '') {
        return '';
    }
}

if (!function_exists('wp_get_attachment_image_url')) {
    function wp_get_attachment_image_url($attachment_id, $size = 'thumbnail', $icon = false) {
        return '';
    }
}

if (!function_exists('wp_get_attachment_image')) {
    function wp_get_attachment_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
        // Mock function - returns a placeholder image HTML
        $url = wp_get_attachment_image_url($attachment_id, $size, $icon);
        $alt = is_array($attr) && isset($attr['alt']) ? $attr['alt'] : 'Image';
        return '<img src="' . esc_url($url) . '" alt="' . esc_attr($alt) . '" />';
    }
}

if (!function_exists('wp_get_attachment_url')) {
    function wp_get_attachment_url($attachment_id) {
        return 'https://via.placeholder.com/800x400';
    }
}

if (!function_exists('get_terms')) {
    function get_terms($args = array()) {
        // Only return mock data if WordPress is not loaded (for linting/development)
        if (!defined('WP_DEBUG') && isset($args['taxonomy']) && $args['taxonomy'] === 'product_category') {
            if (isset($args['fields']) && $args['fields'] === 'ids') {
                return array(1, 2);
            }
            $mock_categories = array();
            for ($i = 1; $i <= 2; $i++) {
                $category = new stdClass();
                $category->term_id = $i;
                $category->name = 'Danh mục ' . $i;
                $category->slug = 'danh-muc-' . $i;
                $category->taxonomy = 'product_category';
                $mock_categories[] = $category;
            }
            return $mock_categories;
        }
        return array();
    }
}

if (!function_exists('get_term')) {
    function get_term($term, $taxonomy = '', $output = OBJECT, $filter = 'raw') {
        // Only return mock data if WordPress is not loaded (for linting/development)
        if (!defined('WP_DEBUG') && $taxonomy === 'product_category') {
            $category = new stdClass();
            $category->term_id = $term;
            $category->name = 'Danh mục ' . $term;
            $category->slug = 'danh-muc-' . $term;
            $category->taxonomy = 'product_category';
            return $category;
        }
        return null;
    }
}

if (!function_exists('get_term_link')) {
    function get_term_link($term, $taxonomy = '') {
        return '#';
    }
}

if (!function_exists('get_template_directory')) {
    function get_template_directory() {
        return dirname(__FILE__);
    }
}

if (!function_exists('get_template_directory_uri')) {
    function get_template_directory_uri() {
        return 'http://localhost/wp-content/themes/wordpress-theme-skylightpoly';
    }
}

if (!function_exists('register_taxonomy')) {
    function register_taxonomy($taxonomy, $object_type, $args = array()) {
        // Stub function for register_taxonomy
        return true;
    }
}

// Define WP_DEBUG if not already defined
if (!defined('WP_DEBUG')) {
    define('WP_DEBUG', false);
}

if (!function_exists('locate_template')) {
    function locate_template($template_names, $load = false, $require_once = true) {
        return '';
    }
}

if (!function_exists('remove_query_arg')) {
    function remove_query_arg($key, $query = false) {
        return '';
    }
}

if (!function_exists('is_wp_error')) {
    function is_wp_error($thing) {
        return false;
    }
}

if (!function_exists('wp_kses')) {
    function wp_kses($string, $allowed_html, $allowed_protocols = array()) {
        return strip_tags($string);
    }
}

if (!function_exists('get_post_thumbnail_id')) {
    function get_post_thumbnail_id($post = null) {
        return 0;
    }
}

// get_current_screen() function removed - WordPress core function should not be redeclared

if (!function_exists('checked')) {
    function checked($checked, $current = true, $echo = true) {
        return '';
    }
}

if (!function_exists('selected')) {
    function selected($selected, $current = true, $echo = true) {
        return '';
    }
}

if (!function_exists('wp_validate_boolean')) {
    function wp_validate_boolean($var) {
        return (bool) $var;
    }
}

// WordPress constants
if (!defined('DOING_AUTOSAVE')) {
    define('DOING_AUTOSAVE', false);
}

// WordPress Customizer classes
if (!class_exists('WP_Customize_Media_Control')) {
    class WP_Customize_Media_Control {
        public function __construct($manager, $id, $args = array()) {}
    }
}

if (!class_exists('WP_Customize_Color_Control')) {
    class WP_Customize_Color_Control {
        public function __construct($manager, $id, $args = array()) {}
    }
}

if (!function_exists('wp_get_archives')) {
    function wp_get_archives($args = '') {}
}

if (!function_exists('wp_tag_cloud')) {
    function wp_tag_cloud($args = '') {}
}

if (!function_exists('get_category_link')) {
    function get_category_link($category_id) {}
}

if (!function_exists('get_tag_link')) {
    function get_tag_link($tag_id) {}
}

if (!function_exists('is_admin_bar_showing')) {
    function is_admin_bar_showing() {}
}

if (!function_exists('post_type_supports')) {
    function post_type_supports($post_type, $feature) {}
}

if (!function_exists('get_post_type')) {
    function get_post_type($post = null) {}
}

if (!function_exists('number_format_i18n')) {
    function number_format_i18n($number, $decimals = 0) {}
}

if (!function_exists('get_the_title')) {
    function get_the_title($post = 0) {}
}

if (!function_exists('_x')) {
    function _x($text, $context, $domain = 'default') {}
}

if (!function_exists('_nx')) {
    function _nx($single, $plural, $number, $context, $domain = 'default') {}
}

// Define constants if not defined
if (!defined('ARRAY_A')) {
    define('ARRAY_A', 'ARRAY_A');
}

if (!defined('OBJECT')) {
    define('OBJECT', 'OBJECT');
}

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

// Additional WordPress functions for front-page.php
if (!function_exists('admin_url')) {
    function admin_url($path = '', $scheme = 'admin')
    {
        return 'http://localhost/wp-admin/' . ltrim($path, '/');
    }
}

if (!function_exists('wp_trim_words')) {
    function wp_trim_words($text, $num_words = 55, $more = null)
    {
        if (null === $more) {
            $more = '...';
        }
        $words = explode(' ', $text);
        if (count($words) > $num_words) {
            $words = array_slice($words, 0, $num_words);
            return implode(' ', $words) . $more;
        }
        return $text;
    }
}

if (!function_exists('get_the_excerpt')) {
    function get_the_excerpt($post = null)
    {
        return 'Sample excerpt text for the post.';
    }
}

if (!function_exists('get_the_content')) {
    function get_the_content($more_link_text = null, $strip_teaser = false)
    {
        return 'Sample content for the post.';
    }
}

if (!function_exists('get_the_post_thumbnail_url')) {
    function get_the_post_thumbnail_url($post = null, $size = 'post-thumbnail')
    {
        return 'https://via.placeholder.com/400x300';
    }
}

if (!function_exists('get_the_ID')) {
    function get_the_ID()
    {
        return 1;
    }
}

if (!function_exists('wp_reset_postdata')) {
    function wp_reset_postdata()
    {
        // Reset global post data
    }
}

if (!class_exists('WP_Query')) {
    class WP_Query
    {
        public $posts = array();

        public function __construct($args = array())
        {
            // Mock some sample posts
            $this->posts = array(
                (object) array(
                    'ID' => 1,
                    'post_title' => 'Sample Product 1',
                    'post_content' => 'This is a sample product description.',
                    'post_excerpt' => 'Sample excerpt'
                ),
                (object) array(
                    'ID' => 2,
                    'post_title' => 'Sample Product 2',
                    'post_content' => 'This is another sample product description.',
                    'post_excerpt' => 'Another sample excerpt'
                )
            );
        }

        public function have_posts()
        {
            return !empty($this->posts);
        }

        public function the_post()
        {
            global $post;
            if (!empty($this->posts)) {
                $post = array_shift($this->posts);
            }
        }
    }
}

// Additional WordPress functions for theme customization and meta data
if (!function_exists('get_theme_mod')) {
    function get_theme_mod($name, $default = false)
    {
        // Mock theme customizer values
        $theme_mods = array(
            'hero_slideshow_enable' => true,
            'hero_slideshow_autoplay' => true,
            'hero_slideshow_speed' => 5000,
            'hero_slideshow_panel_bg_color' => 'rgba(0, 0, 0, 0.5)',
            'hero_slideshow_panel_opacity' => '0.8',
            'hero_slideshow_title_font' => 'inherit',
            'hero_slideshow_title_size' => '1.2',
            'hero_slideshow_title_color' => '#ffffff',
            'hero_slideshow_subtitle_size' => '0.7',
            'hero_slideshow_subtitle_color' => '#ffffff',
            'hero_slideshow_content_position' => 'center',
            'hero_slideshow_content_align' => 'center',
            'hero_slideshow_button_bg_color' => '#2154fe',
            'hero_slideshow_button_text_color' => '#ffffff'
        );

        return isset($theme_mods[$name]) ? $theme_mods[$name] : $default;
    }
}

if (!function_exists('get_post_meta')) {
    function get_post_meta($post_id, $key = '', $single = false)
    {
        // Only return mock data if WordPress is not loaded (for linting/development)
        if (!defined('WP_DEBUG')) {
            // Mock post meta values
            $meta_values = array(
                '_hero_slide_subtitle' => 'Sample slide subtitle',
                '_hero_slide_button_text' => 'Learn More',
                '_hero_slide_button_url' => '#',
                '_customer_name' => 'John Doe',
                '_customer_company' => 'Sample Company',
                '_customer_rating' => 5,
                '_featured_product' => 'yes',
                // Product meta fields
                'featured_product' => ($post_id % 2 == 0) ? 'yes' : 'no',
                'product_price' => 1000000 + ($post_id * 500000),
                'product_discount_price' => 800000 + ($post_id * 400000),
                'product_discount' => 10 + ($post_id * 5),
                'product_unit' => 'bộ',
                'product_custom_badge' => ($post_id == 1) ? 'MỚI' : '',
                'product_hot_tag' => ($post_id == 2) ? 'yes' : 'no',
                'product_link' => '#product-' . $post_id
            );

            if ($key && isset($meta_values[$key])) {
                return $single ? $meta_values[$key] : array($meta_values[$key]);
            }
        }

        return $single ? '' : array();
    }
}

if (!function_exists('esc_html')) {
    function esc_html($text)
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

// Helper functions for slideshow functionality

// get_products function removed to avoid redeclaration with helper-functions.php



// get_testimonials function removed to avoid redeclaration with helper-functions.php

// Additional WordPress functions can be added here as needed
