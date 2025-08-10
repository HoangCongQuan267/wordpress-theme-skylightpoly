<?php
/**
 * Custom Blue Orange Theme functions and definitions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function custom_blue_orange_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Add custom image sizes
    add_image_size('custom-large', 800, 400, true);
    add_image_size('custom-medium', 400, 300, true);
    add_image_size('custom-small', 200, 150, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Menu chính', 'custom-blue-orange'),
        'footer'  => esc_html__('Menu footer', 'custom-blue-orange'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-color' => '2c5aa0',
        'width'         => 1200,
        'height'        => 300,
        'flex-width'    => true,
        'flex-height'   => true,
    ));

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'f8f9fa',
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'custom_blue_orange_setup');

/**
 * Enqueue scripts and styles
 */
function custom_blue_orange_scripts() {
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
 * Register widget areas
 */
function custom_blue_orange_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Thanh bên', 'custom-blue-orange'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Thêm widget vào đây để hiển thị trong thanh bên.', 'custom-blue-orange'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'custom-blue-orange'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'custom-blue-orange'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'custom_blue_orange_widgets_init');

/**
 * Custom excerpt length
 */
function custom_blue_orange_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'custom_blue_orange_excerpt_length');

/**
 * Custom excerpt more
 */
function custom_blue_orange_excerpt_more($more) {
    return '... <a href="' . get_permalink() . '" class="read-more">Đọc thêm</a>';
}
add_filter('excerpt_more', 'custom_blue_orange_excerpt_more');

/**
 * Add custom classes to body
 */
function custom_blue_orange_body_classes($classes) {
    // Add class for custom theme
    $classes[] = 'custom-blue-orange-theme';
    
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'custom_blue_orange_body_classes');

/**
 * Customize login page
 */
function custom_blue_orange_login_styles() {
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
function custom_blue_orange_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'custom_blue_orange_login_logo_url');

/**
 * Custom logo title for login page
 */
function custom_blue_orange_login_logo_url_title() {
    $site_name = get_bloginfo('name') ?: '';
    $site_description = get_bloginfo('description') ?: '';
    return $site_name . ($site_description ? ' - ' . $site_description : '');
}
add_filter('login_headertext', 'custom_blue_orange_login_logo_url_title');

/**
 * Add custom post meta
 */
function custom_blue_orange_post_meta() {
    $categories = get_the_category();
    $tags = get_the_tags();
    
    echo '<div class="post-meta-extended">';
    
    if ($categories) {
        echo '<span class="post-categories">Categories: ';
        foreach ($categories as $category) {
            echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a> ';
        }
        echo '</span>';
    }
    
    if ($tags) {
        echo '<span class="post-tags">Tags: ';
        foreach ($tags as $tag) {
            echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a> ';
        }
        echo '</span>';
    }
    
    echo '</div>';
}

/**
 * Custom search form
 */
function custom_blue_orange_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="' . home_url('/') . '">
        <label>
            <span class="screen-reader-text">Tìm kiếm:</span>
            <input type="search" class="search-field" placeholder="Tìm kiếm..." value="' . get_search_query() . '" name="s" />
        </label>
        <input type="submit" class="search-submit" value="Tìm kiếm" />
    </form>';
    
    return $form;
}
add_filter('get_search_form', 'custom_blue_orange_search_form');

/**
 * Customize admin bar
 */
function custom_blue_orange_admin_bar_style() {
    if (is_admin_bar_showing()) {
        ?>
        <style type="text/css">
            #wpadminbar {
                background: linear-gradient(135deg, #2c5aa0 0%, #ff6b35 100%);
            }
            #wpadminbar .ab-top-menu > li.hover > .ab-item,
            #wpadminbar .ab-top-menu > li:hover > .ab-item,
            #wpadminbar .ab-top-menu > li > .ab-item:focus {
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
function custom_blue_orange_remove_version() {
    return '';
}
add_filter('the_generator', 'custom_blue_orange_remove_version');

/**
 * Optimize WordPress head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Custom pagination
 */
function custom_blue_orange_pagination() {
    global $wp_query;
    
    if (!isset($wp_query) || !$wp_query->max_num_pages || $wp_query->max_num_pages <= 1) {
        return;
    }
    
    $big = 999999999;
    $pagenum_link = get_pagenum_link($big);
    
    if ($pagenum_link) {
        $pagination = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url($pagenum_link)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '← Trước',
            'next_text' => 'Tiếp →',
            'type' => 'list',
            'end_size' => 3,
            'mid_size' => 3
        ));
        
        if ($pagination) {
            echo $pagination;
        }
    }
}

?>