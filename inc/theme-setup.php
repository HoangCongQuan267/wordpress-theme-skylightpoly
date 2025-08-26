<?php

/**
 * Theme Setup and Configuration Functions
 * 
 * This file contains all theme setup related functions including:
 * - Theme support features
 * - Widget areas registration
 * - Navigation menus
 * - Custom classes and filters
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function custom_blue_orange_setup()
{
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
 * Register widget areas
 */
function custom_blue_orange_widgets_init()
{
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
function custom_blue_orange_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'custom_blue_orange_excerpt_length');

/**
 * Custom excerpt more
 */
function custom_blue_orange_excerpt_more($more)
{
    return '... <a href="' . get_permalink() . '" class="read-more">Đọc thêm</a>';
}
add_filter('excerpt_more', 'custom_blue_orange_excerpt_more');

/**
 * Add custom classes to body
 */
function custom_blue_orange_body_classes($classes)
{
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
 * Custom search form
 */
function custom_blue_orange_search_form($form)
{
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
 * Custom pagination
 */
function custom_blue_orange_pagination()
{
    global $wp_query;

    if (!isset($wp_query) || !$wp_query->max_num_pages || $wp_query->max_num_pages <= 1) {
        return;
    }

    $big = 999999999;
    $pagenum_link = get_pagenum_link($big);

    if ($pagenum_link) {
        $escaped_url = esc_url($pagenum_link);
        if ($escaped_url) {
            $pagination = paginate_links(array(
                'base' => str_replace($big, '%#%', $escaped_url),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_text' => '← Trước',
                'next_text' => 'Tiếp →',
                'type' => 'list',
                'end_size' => 3,
                'mid_size' => 3
            ));

            if (!empty($pagination) && (is_string($pagination) || is_array($pagination))) {
                if (is_string($pagination)) {
                    echo $pagination;
                } elseif (is_array($pagination)) {
                    echo implode('', $pagination);
                }
            }
        }
    }
}

/**
 * Custom Menu Order Support
 * Add support for custom menu item ordering
 */
function custom_menu_order_support()
{
    // Add custom menu order field to menu items
    add_action('wp_nav_menu_item_custom_fields', 'custom_menu_order_field', 10, 4);
    add_action('wp_update_nav_menu_item', 'custom_menu_order_save', 10, 3);
}
add_action('init', 'custom_menu_order_support');

/**
 * Add custom order field to menu items
 */
function custom_menu_order_field($item_id, $item, $depth, $args)
{
    $menu_order = get_post_meta($item_id, '_menu_item_custom_order', true);
    ?>
    <p class="field-custom-order description description-wide">
        <label for="edit-menu-item-custom-order-<?php echo $item_id; ?>">
            <?php _e('Custom Order'); ?><br />
            <input type="number" id="edit-menu-item-custom-order-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom-order" name="menu-item-custom-order[<?php echo $item_id; ?>]" value="<?php echo esc_attr($menu_order); ?>" />
            <span class="description"><?php _e('Enter a number to set custom order (lower numbers appear first)'); ?></span>
        </label>
    </p>
<?php
}

/**
 * Save custom order field
 */
function custom_menu_order_save($menu_id, $menu_item_db_id, $args)
{
    if (isset($_REQUEST['menu-item-custom-order'][$menu_item_db_id])) {
        $custom_order = sanitize_text_field($_REQUEST['menu-item-custom-order'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_custom_order', $custom_order);
    }
}

/**
 * Apply custom menu ordering
 */
function apply_custom_menu_order($items, $args)
{
    if (isset($args->theme_location) && $args->theme_location == 'primary') {
        // Sort items by custom order
        usort($items, function ($a, $b) {
            $order_a = get_post_meta($a->ID, '_menu_item_custom_order', true);
            $order_b = get_post_meta($b->ID, '_menu_item_custom_order', true);

            $order_a = $order_a ? intval($order_a) : 999;
            $order_b = $order_b ? intval($order_b) : 999;

            return $order_a - $order_b;
        });
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'apply_custom_menu_order', 10, 2);