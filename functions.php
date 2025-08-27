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
 * Manual permalink flush function
 * Add ?flush_permalinks=1 to any page URL to trigger permalink flush
 */
function manual_permalink_flush() {
    if (isset($_GET['flush_permalinks']) && $_GET['flush_permalinks'] == '1') {
        if (function_exists('flush_rewrite_rules')) {
            flush_rewrite_rules(true);
            // Redirect to remove the parameter from URL
            if (function_exists('remove_query_arg')) {
                $redirect_url = remove_query_arg('flush_permalinks');
                if (function_exists('wp_redirect')) {
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