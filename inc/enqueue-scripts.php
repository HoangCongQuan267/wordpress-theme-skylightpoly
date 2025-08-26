<?php

/**
 * Script and Style Enqueuing Functions
 * 
 * This file contains all functions related to:
 * - Enqueuing stylesheets
 * - Enqueuing JavaScript files
 * - Admin styling
 * - Login page customization
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue scripts and styles
 */
function custom_blue_orange_scripts()
{
    // Enqueue main stylesheet
    wp_enqueue_style('custom-blue-orange-style', get_stylesheet_uri(), array(), '1.0.0');

    // Enqueue Google Fonts
    wp_enqueue_style('custom-blue-orange-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Enqueue custom JavaScript
    wp_enqueue_script('custom-blue-orange-script', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'custom_blue_orange_scripts');

/**
 * Customize login page
 */
function custom_blue_orange_login_styles()
{
?>
    <style type="text/css">
        body.login {
            background-color: #f8f9fa;
        }

        .login h1 a {
            background-color: #2c5aa0;
            color: white;
            width: auto;
            height: auto;
            padding: 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .login form {
            border: 1px solid #2c5aa0;
            box-shadow: 0 2px 10px rgba(44, 90, 160, 0.1);
        }

        .wp-core-ui .button-primary {
            background: #ff6b35;
            border-color: #ff6b35;
            text-shadow: none;
            box-shadow: none;
        }

        .wp-core-ui .button-primary:hover {
            background: #ff8c42;
            border-color: #ff8c42;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'custom_blue_orange_login_styles');

/**
 * Custom logo URL for login page
 */
function custom_blue_orange_login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', 'custom_blue_orange_login_logo_url');

/**
 * Custom logo title for login page
 */
function custom_blue_orange_login_logo_url_title()
{
    $site_name = get_bloginfo('name') ?: '';
    $site_description = get_bloginfo('description') ?: '';
    return $site_name . ($site_description ? ' - ' . $site_description : '');
}
add_filter('login_headertext', 'custom_blue_orange_login_logo_url_title');

/**
 * Customize admin bar
 */
function custom_blue_orange_admin_bar_style()
{
    if (is_admin_bar_showing()) {
    ?>
        <style type="text/css">
            #wpadminbar {
                background: linear-gradient(135deg, #2c5aa0 0%, #ff6b35 100%);
            }

            #wpadminbar .ab-top-menu>li.hover>.ab-item,
            #wpadminbar .ab-top-menu>li:hover>.ab-item,
            #wpadminbar .ab-top-menu>li>.ab-item:focus {
                background: rgba(255, 255, 255, 0.1);
            }
        </style>
    <?php
    }
}
add_action('wp_head', 'custom_blue_orange_admin_bar_style');
add_action('admin_head', 'custom_blue_orange_admin_bar_style');

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Security: Remove WordPress version from RSS feeds
 */
function custom_blue_orange_remove_version()
{
    return '';
}
add_filter('the_generator', 'custom_blue_orange_remove_version');

/**
 * Optimize WordPress head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');