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
 * Add custom post meta
 */
function custom_blue_orange_post_meta()
{
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
        'has_archive'        => false,
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
        'rewrite'            => array('slug' => 'product'),
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
 * Register Certificate Custom Post Type
 */
function register_certificate_post_type()
{
    $labels = array(
        'name'                  => _x('Certificates', 'Post type general name', 'custom-blue-orange'),
        'singular_name'         => _x('Certificate', 'Post type singular name', 'custom-blue-orange'),
        'menu_name'             => _x('Certificates', 'Admin Menu text', 'custom-blue-orange'),
        'name_admin_bar'        => _x('Certificate', 'Add New on Toolbar', 'custom-blue-orange'),
        'add_new'               => __('Add New', 'custom-blue-orange'),
        'add_new_item'          => __('Add New Certificate', 'custom-blue-orange'),
        'new_item'              => __('New Certificate', 'custom-blue-orange'),
        'edit_item'             => __('Edit Certificate', 'custom-blue-orange'),
        'view_item'             => __('View Certificate', 'custom-blue-orange'),
        'all_items'             => __('All Certificates', 'custom-blue-orange'),
        'search_items'          => __('Search Certificates', 'custom-blue-orange'),
        'parent_item_colon'     => __('Parent Certificates:', 'custom-blue-orange'),
        'not_found'             => __('No certificates found.', 'custom-blue-orange'),
        'not_found_in_trash'    => __('No certificates found in Trash.', 'custom-blue-orange'),
        'featured_image'        => _x('Certificate Icon', 'Overrides the "Featured Image" phrase', 'custom-blue-orange'),
        'set_featured_image'    => _x('Set certificate icon', 'Overrides the "Set featured image" phrase', 'custom-blue-orange'),
        'remove_featured_image' => _x('Remove certificate icon', 'Overrides the "Remove featured image" phrase', 'custom-blue-orange'),
        'use_featured_image'    => _x('Use as certificate icon', 'Overrides the "Use as featured image" phrase', 'custom-blue-orange'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'certificate'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 22,
        'menu_icon'          => 'dashicons-awards',
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('certificate', $args);
}
add_action('init', 'register_certificate_post_type');

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
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 23,
        'menu_icon'          => 'dashicons-testimonial',
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_post_type');

/**
 * Add Hero Slide Meta Boxes
 */
function add_hero_slide_meta_boxes()
{
    add_meta_box(
        'hero_slide_details',
        __('Hero Slide Details', 'custom-blue-orange'),
        'hero_slide_details_callback',
        'hero_slide',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_hero_slide_meta_boxes');

/**
 * Add Product Meta Boxes
 */
function add_product_meta_boxes()
{
    add_meta_box(
        'product_details',
        __('Product Details', 'custom-blue-orange'),
        'product_details_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_product_meta_boxes');

/**
 * Product Meta Box Callback
 */
function product_details_callback($post)
{
    wp_nonce_field('product_details_nonce', 'product_details_nonce');

    $featured_product = get_post_meta($post->ID, '_featured_product', true);
    $product_price = get_post_meta($post->ID, '_product_price', true);
    $product_link = get_post_meta($post->ID, '_product_link', true);

    echo '<table class="form-table">';

    echo '<tr>';
    echo '<th><label for="featured_product">' . __('Featured Product', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="checkbox" id="featured_product" name="featured_product" value="yes" ' . checked($featured_product, 'yes', false) . ' /> ' . __('Mark as featured product', 'custom-blue-orange') . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="product_price">' . __('Price', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="text" id="product_price" name="product_price" value="' . esc_attr($product_price) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="product_link">' . __('External Link', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="url" id="product_link" name="product_link" value="' . esc_attr($product_link) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '</table>';
}

/**
 * Add Testimonial Meta Boxes
 */
function add_testimonial_meta_boxes()
{
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'custom-blue-orange'),
        'testimonial_details_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

/**
 * Testimonial Meta Box Callback
 */
function testimonial_details_callback($post)
{
    wp_nonce_field('testimonial_details_nonce', 'testimonial_details_nonce');

    $customer_name = get_post_meta($post->ID, '_customer_name', true);
    $customer_company = get_post_meta($post->ID, '_customer_company', true);
    $customer_rating = get_post_meta($post->ID, '_customer_rating', true);

    echo '<table class="form-table">';

    echo '<tr>';
    echo '<th><label for="customer_name">' . __('Customer Name', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="text" id="customer_name" name="customer_name" value="' . esc_attr($customer_name) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="customer_company">' . __('Company', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="text" id="customer_company" name="customer_company" value="' . esc_attr($customer_company) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="customer_rating">' . __('Rating', 'custom-blue-orange') . '</label></th>';
    echo '<td><select id="customer_rating" name="customer_rating">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<option value="' . $i . '"' . selected($customer_rating, $i, false) . '>' . $i . ' Star' . ($i > 1 ? 's' : '') . '</option>';
    }
    echo '</select></td>';
    echo '</tr>';

    echo '</table>';
}

/**
 * Hero Slide Meta Box Callback
 */
function hero_slide_details_callback($post)
{
    wp_nonce_field('hero_slide_details_nonce', 'hero_slide_details_nonce');

    $subtitle = get_post_meta($post->ID, '_hero_slide_subtitle', true);
    $button_text = get_post_meta($post->ID, '_hero_slide_button_text', true);
    $button_url = get_post_meta($post->ID, '_hero_slide_button_url', true);
    $slide_order = get_post_meta($post->ID, '_hero_slide_order', true);

    echo '<table class="form-table">';

    echo '<tr>';
    echo '<th><label for="hero_slide_subtitle">' . __('Subtitle', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="text" id="hero_slide_subtitle" name="hero_slide_subtitle" value="' . esc_attr($subtitle) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="hero_slide_button_text">' . __('Button Text', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="text" id="hero_slide_button_text" name="hero_slide_button_text" value="' . esc_attr($button_text) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="hero_slide_button_url">' . __('Button URL', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="url" id="hero_slide_button_url" name="hero_slide_button_url" value="' . esc_attr($button_url) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="hero_slide_order">' . __('Slide Order', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="number" id="hero_slide_order" name="hero_slide_order" value="' . esc_attr($slide_order) . '" min="0" step="1" /></td>';
    echo '</tr>';

    echo '</table>';

    echo '<div style="margin-top: 20px; padding: 15px; background: #f0f8ff; border-left: 4px solid #0073aa; border-radius: 4px;">';
    echo '<h4 style="margin-top: 0; color: #0073aa;">📝 How to use Hero Slides:</h4>';
    echo '<ul style="margin: 10px 0; padding-left: 20px;">';
    echo '<li><strong>Title:</strong> Main headline displayed on the slide</li>';
    echo '<li><strong>Featured Image:</strong> Background image for the slide (recommended: 1920x1080px)</li>';
    echo '<li><strong>Subtitle:</strong> Secondary text below the title</li>';
    echo '<li><strong>Button Text & URL:</strong> Call-to-action button (optional)</li>';
    echo '<li><strong>Slide Order:</strong> Number to control slide sequence (0 = first)</li>';
    echo '</ul>';
    echo '<p style="margin-bottom: 0;"><em>💡 Tip: Set the featured image first, then fill in the content fields.</em></p>';
    echo '</div>';
}

/**
 * Save Hero Slide Meta Data
 */
function save_hero_slide_meta_data($post_id)
{
    if (!isset($_POST['hero_slide_details_nonce']) || !wp_verify_nonce($_POST['hero_slide_details_nonce'], 'hero_slide_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['hero_slide_subtitle'])) {
        update_post_meta($post_id, '_hero_slide_subtitle', sanitize_text_field($_POST['hero_slide_subtitle']));
    }

    if (isset($_POST['hero_slide_button_text'])) {
        update_post_meta($post_id, '_hero_slide_button_text', sanitize_text_field($_POST['hero_slide_button_text']));
    }

    if (isset($_POST['hero_slide_button_url'])) {
        update_post_meta($post_id, '_hero_slide_button_url', esc_url_raw($_POST['hero_slide_button_url']));
    }

    if (isset($_POST['hero_slide_order'])) {
        update_post_meta($post_id, '_hero_slide_order', intval($_POST['hero_slide_order']));
    }
}
add_action('save_post', 'save_hero_slide_meta_data');

/**
 * Save Product Meta Data
 */
function save_product_meta_data($post_id)
{
    if (!isset($_POST['product_details_nonce']) || !wp_verify_nonce($_POST['product_details_nonce'], 'product_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['featured_product'])) {
        update_post_meta($post_id, '_featured_product', 'yes');
    } else {
        update_post_meta($post_id, '_featured_product', 'no');
    }

    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
    }

    if (isset($_POST['product_link'])) {
        update_post_meta($post_id, '_product_link', esc_url_raw($_POST['product_link']));
    }
}
add_action('save_post', 'save_product_meta_data');

/**
 * Save Testimonial Meta Data
 */
function save_testimonial_meta_data($post_id)
{
    if (!isset($_POST['testimonial_details_nonce']) || !wp_verify_nonce($_POST['testimonial_details_nonce'], 'testimonial_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['customer_name'])) {
        update_post_meta($post_id, '_customer_name', sanitize_text_field($_POST['customer_name']));
    }

    if (isset($_POST['customer_company'])) {
        update_post_meta($post_id, '_customer_company', sanitize_text_field($_POST['customer_company']));
    }

    if (isset($_POST['customer_rating'])) {
        update_post_meta($post_id, '_customer_rating', intval($_POST['customer_rating']));
    }
}
add_action('save_post', 'save_testimonial_meta_data');

/**
 * Get Hero Slides for Frontend Display
 */
function get_hero_slides()
{
    $args = array(
        'post_type'      => 'hero_slide',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => '_hero_slide_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    );

    return get_posts($args);
}

/**
 * Get Products for Frontend Display from Customizer
 */
function get_products()
{
    $count = get_theme_mod('products_section_count', 6);
    $product_list = array();

    for ($i = 1; $i <= $count; $i++) {
        $image_id = get_theme_mod("product_{$i}_image", '');
        $title = get_theme_mod("product_{$i}_title", '');
        $description = get_theme_mod("product_{$i}_description", '');
        $link = get_theme_mod("product_{$i}_link", '');
        $hot_tag = get_theme_mod("product_{$i}_hot_tag", false);
        $discount = get_theme_mod("product_{$i}_discount", '');
        $custom_badge = get_theme_mod("product_{$i}_custom_badge", '');

        if (!empty($title) || !empty($image_id)) {
            $product_list[] = array(
                'id' => $i,
                'title' => $title,
                'content' => $description,
                'image' => $image_id ? wp_get_attachment_image($image_id, 'medium') : '',
                'image_url' => $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '',
                'featured' => false,
                'price' => '',
                'link' => $link,
                'hot_tag' => $hot_tag,
                'discount' => $discount,
                'custom_badge' => $custom_badge
            );
        }
    }

    return $product_list;
}

/**
 * Get Certificates for Frontend Display from Customizer
 */
function get_certificates()
{
    $count = get_theme_mod('certificates_section_count', 4);
    $certificate_list = array();

    for ($i = 1; $i <= $count; $i++) {
        $image_id = get_theme_mod("certificate_{$i}_image", '');
        $title = get_theme_mod("certificate_{$i}_title", '');
        $description = get_theme_mod("certificate_{$i}_description", '');

        if (!empty($title) || !empty($image_id)) {
            $certificate_list[] = array(
                'id' => $i,
                'title' => $title,
                'content' => $description,
                'image' => $image_id ? wp_get_attachment_image($image_id, 'medium') : '',
                'image_url' => $image_id ? wp_get_attachment_image_url($image_id, 'medium') : ''
            );
        }
    }

    return $certificate_list;
}

/**
 * Get Testimonials for Frontend Display from Customizer
 */
function get_testimonials()
{
    $count = get_theme_mod('testimonials_section_count', 6);
    $testimonial_list = array();

    for ($i = 1; $i <= $count; $i++) {
        $image_id = get_theme_mod("testimonial_{$i}_image", '');
        $name = get_theme_mod("testimonial_{$i}_name", '');
        $position = get_theme_mod("testimonial_{$i}_position", '');
        $content = get_theme_mod("testimonial_{$i}_content", '');

        if (!empty($name) || !empty($content)) {
            $testimonial_list[] = array(
                'id' => $i,
                'content' => $content,
                'customer_name' => $name,
                'customer_company' => $position,
                'rating' => 5,
                'image_id' => $image_id,
                'image_url' => $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : ''
            );
        }
    }

    return $testimonial_list;
}

/**
 * Add admin notice for Hero Slideshow feature
 */
function hero_slideshow_admin_notice()
{
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'hero_slide') {
        echo '<div class="notice notice-info is-dismissible">';
        echo '<p><strong>🎯 Hero Slideshow Feature:</strong> Create engaging hero slides for your homepage. Each slide can have a background image, title, subtitle, and call-to-action button.</p>';
        echo '</div>';
    }
}
add_action('admin_notices', 'hero_slideshow_admin_notice');

/**
 * Add custom columns to Hero Slides admin list
 */
function hero_slide_custom_columns($columns)
{
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['hero_image'] = __('Image', 'custom-blue-orange');
    $new_columns['hero_subtitle'] = __('Subtitle', 'custom-blue-orange');
    $new_columns['hero_button'] = __('Button', 'custom-blue-orange');
    $new_columns['hero_order'] = __('Order', 'custom-blue-orange');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_hero_slide_posts_columns', 'hero_slide_custom_columns');

/**
 * Display custom column content
 */
function hero_slide_custom_column_content($column, $post_id)
{
    switch ($column) {
        case 'hero_image':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(60, 60));
            } else {
                echo '<span style="color: #999;">No image</span>';
            }
            break;
        case 'hero_subtitle':
            $subtitle = get_post_meta($post_id, '_hero_slide_subtitle', true);
            echo $subtitle ? esc_html($subtitle) : '<span style="color: #999;">—</span>';
            break;
        case 'hero_button':
            $button_text = get_post_meta($post_id, '_hero_slide_button_text', true);
            $button_url = get_post_meta($post_id, '_hero_slide_button_url', true);
            if ($button_text && $button_url) {
                echo '<a href="' . esc_url($button_url) . '" target="_blank">' . esc_html($button_text) . '</a>';
            } else {
                echo '<span style="color: #999;">—</span>';
            }
            break;
        case 'hero_order':
            $order = get_post_meta($post_id, '_hero_slide_order', true);
            echo $order !== '' ? intval($order) : '<span style="color: #999;">—</span>';
            break;
    }
}
add_action('manage_hero_slide_posts_custom_column', 'hero_slide_custom_column_content', 10, 2);

/**
 * Add Hero Slideshow to WordPress Customizer
 */
function hero_slideshow_customizer($wp_customize)
{
    // Add Hero Slideshow Section
    $wp_customize->add_section('hero_slideshow_section', array(
        'title'    => __('Hero Slideshow', 'custom-blue-orange'),
        'priority' => 30,
        'description' => __('Manage your homepage hero slideshow settings', 'custom-blue-orange'),
    ));

    // Enable/Disable Slideshow
    $wp_customize->add_setting('hero_slideshow_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_enable', array(
        'label'    => __('Enable Hero Slideshow', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Slideshow Auto-play
    $wp_customize->add_setting('hero_slideshow_autoplay', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_autoplay', array(
        'label'    => __('Auto-play Slides', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'type'     => 'checkbox',
        'priority' => 20,
    ));

    // Slideshow Speed
    $wp_customize->add_setting('hero_slideshow_speed', array(
        'default'           => 5000,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_speed', array(
        'label'       => __('Slide Duration (milliseconds)', 'custom-blue-orange'),
        'description' => __('How long each slide is displayed (5000 = 5 seconds)', 'custom-blue-orange'),
        'section'     => 'hero_slideshow_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1000,
            'max'  => 10000,
            'step' => 500,
        ),
        'priority'    => 30,
    ));

    // Add up to 5 slides
    for ($i = 1; $i <= 5; $i++) {
        // Slide Image
        $wp_customize->add_setting("hero_slide_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "hero_slide_{$i}_image", array(
            'label'     => sprintf(__('Slide %d Image', 'custom-blue-orange'), $i),
            'section'   => 'hero_slideshow_section',
            'mime_type' => 'image',
            'priority'  => 40 + ($i * 10),
        )));

        // Slide Title
        $wp_customize->add_setting("hero_slide_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("hero_slide_{$i}_title", array(
            'label'    => sprintf(__('Slide %d Title', 'custom-blue-orange'), $i),
            'section'  => 'hero_slideshow_section',
            'type'     => 'text',
            'priority' => 41 + ($i * 10),
        ));

        // Slide Subtitle
        $wp_customize->add_setting("hero_slide_{$i}_subtitle", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("hero_slide_{$i}_subtitle", array(
            'label'    => sprintf(__('Slide %d Subtitle', 'custom-blue-orange'), $i),
            'section'  => 'hero_slideshow_section',
            'type'     => 'textarea',
            'priority' => 42 + ($i * 10),
        ));

        // Slide Button Text
        $wp_customize->add_setting("hero_slide_{$i}_button_text", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("hero_slide_{$i}_button_text", array(
            'label'    => sprintf(__('Slide %d Button Text', 'custom-blue-orange'), $i),
            'section'  => 'hero_slideshow_section',
            'type'     => 'text',
            'priority' => 43 + ($i * 10),
        ));

        // Slide Button URL
        $wp_customize->add_setting("hero_slide_{$i}_button_url", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("hero_slide_{$i}_button_url", array(
            'label'    => sprintf(__('Slide %d Button URL', 'custom-blue-orange'), $i),
            'section'  => 'hero_slideshow_section',
            'type'     => 'url',
            'priority' => 44 + ($i * 10),
        ));
    }

    // Slideshow Styling Options

    // Content Panel Background Color
    $wp_customize->add_setting('hero_slideshow_panel_bg_color', array(
        'default'           => 'rgba(0, 0, 0, 0.5)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_slideshow_panel_bg_color', array(
        'label'    => __('Content Panel Background Color', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'priority' => 100,
    )));

    // Content Panel Opacity
    $wp_customize->add_setting('hero_slideshow_panel_opacity', array(
        'default'           => '0.8',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_panel_opacity', array(
        'label'       => __('Content Panel Opacity', 'custom-blue-orange'),
        'section'     => 'hero_slideshow_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 1,
            'step' => 0.1,
        ),
        'priority'    => 101,
    ));

    // Title Font Family
    $wp_customize->add_setting('hero_slideshow_title_font', array(
        'default'           => 'inherit',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_title_font', array(
        'label'    => __('Title Font Family', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'type'     => 'select',
        'choices'  => array(
            'inherit'     => 'Default Theme Font',
            'Arial'       => 'Arial',
            'Helvetica'   => 'Helvetica',
            'Georgia'     => 'Georgia',
            'Times'       => 'Times New Roman',
            'Courier'     => 'Courier New',
            'Verdana'     => 'Verdana',
            'Trebuchet'   => 'Trebuchet MS',
            'Impact'      => 'Impact',
        ),
        'priority' => 102,
    ));

    // Title Font Size
    $wp_customize->add_setting('hero_slideshow_title_size', array(
        'default'           => '1.2',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_title_size', array(
        'label'       => __('Title Font Size (rem)', 'custom-blue-orange'),
        'section'     => 'hero_slideshow_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 6,
            'step' => 0.1,
        ),
        'priority'    => 103,
    ));

    // Title Color
    $wp_customize->add_setting('hero_slideshow_title_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_slideshow_title_color', array(
        'label'    => __('Title Color', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'priority' => 104,
    )));

    // Subtitle Font Size
    $wp_customize->add_setting('hero_slideshow_subtitle_size', array(
        'default'           => '0.7',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_subtitle_size', array(
        'label'       => __('Subtitle Font Size (rem)', 'custom-blue-orange'),
        'section'     => 'hero_slideshow_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0.8,
            'max'  => 3,
            'step' => 0.1,
        ),
        'priority'    => 105,
    ));

    // Subtitle Color
    $wp_customize->add_setting('hero_slideshow_subtitle_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_slideshow_subtitle_color', array(
        'label'    => __('Subtitle Color', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'priority' => 106,
    )));

    // Content Position
    $wp_customize->add_setting('hero_slideshow_content_position', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_content_position', array(
        'label'    => __('Content Position', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'type'     => 'select',
        'choices'  => array(
            'flex-start' => 'Top',
            'center'     => 'Center',
            'flex-end'   => 'Bottom',
        ),
        'priority' => 107,
    ));

    // Content Alignment
    $wp_customize->add_setting('hero_slideshow_content_align', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('hero_slideshow_content_align', array(
        'label'    => __('Content Text Alignment', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'type'     => 'select',
        'choices'  => array(
            'left'   => 'Left',
            'center' => 'Center',
            'right'  => 'Right',
        ),
        'priority' => 108,
    ));

    // Button Background Color
    $wp_customize->add_setting('hero_slideshow_button_bg_color', array(
        'default'           => '#2154fe',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_slideshow_button_bg_color', array(
        'label'    => __('Button Background Color', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'priority' => 109,
    )));

    // Button Text Color
    $wp_customize->add_setting('hero_slideshow_button_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_slideshow_button_text_color', array(
        'label'    => __('Button Text Color', 'custom-blue-orange'),
        'section'  => 'hero_slideshow_section',
        'priority' => 110,
    )));
}
add_action('customize_register', 'hero_slideshow_customizer');

/**
 * Add Homepage Sections to WordPress Customizer
 */
function homepage_sections_customizer($wp_customize)
{
    // Add Homepage Sections Panel
    $wp_customize->add_panel('homepage_sections_panel', array(
        'title'    => __('Homepage Sections', 'custom-blue-orange'),
        'priority' => 25,
        'description' => __('Manage your homepage sections visibility and settings', 'custom-blue-orange'),
    ));

    // Add General Homepage Settings Section
    $wp_customize->add_section('homepage_general_section', array(
        'title'    => __('General Homepage Settings', 'custom-blue-orange'),
        'panel'    => 'homepage_sections_panel',
        'priority' => 5,
        'description' => __('General settings for the homepage layout and appearance', 'custom-blue-orange'),
    ));

    // Homepage Layout Style
    $wp_customize->add_setting('homepage_layout_style', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('homepage_layout_style', array(
        'label'    => __('Homepage Layout Style', 'custom-blue-orange'),
        'section'  => 'homepage_general_section',
        'type'     => 'select',
        'choices'  => array(
            'default'   => __('Default Layout', 'custom-blue-orange'),
            'boxed'     => __('Boxed Layout', 'custom-blue-orange'),
            'fullwidth' => __('Full Width Layout', 'custom-blue-orange'),
        ),
        'priority' => 10,
    ));

    // Homepage Background Color
    $wp_customize->add_setting('homepage_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'homepage_bg_color', array(
        'label'    => __('Homepage Background Color', 'custom-blue-orange'),
        'section'  => 'homepage_general_section',
        'priority' => 20,
    )));

    // Section Spacing
    $wp_customize->add_setting('homepage_section_spacing', array(
        'default'           => '80',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('homepage_section_spacing', array(
        'label'       => __('Section Spacing (px)', 'custom-blue-orange'),
        'description' => __('Space between homepage sections', 'custom-blue-orange'),
        'section'     => 'homepage_general_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 40,
            'max'  => 120,
            'step' => 10,
        ),
        'priority'    => 30,
    ));

    // Products Section
    $wp_customize->add_section('products_section', array(
        'title'    => __('Products Section', 'custom-blue-orange'),
        'panel'    => 'homepage_sections_panel',
        'priority' => 10,
        'description' => __('Manage your products section settings', 'custom-blue-orange'),
    ));

    // Enable/Disable Products Section
    $wp_customize->add_setting('products_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_section_enable', array(
        'label'    => __('Enable Products Section', 'custom-blue-orange'),
        'section'  => 'products_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Products Section Title
    $wp_customize->add_setting('products_section_title', array(
        'default'           => __('Sản Phẩm Mới', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_section_title', array(
        'label'    => __('Section Title', 'custom-blue-orange'),
        'section'  => 'products_section',
        'type'     => 'text',
        'priority' => 20,
    ));

    // Products Section Background Color
    $wp_customize->add_setting('products_section_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'products_section_bg_color', array(
        'label'    => __('Section Background Color', 'custom-blue-orange'),
        'section'  => 'products_section',
        'priority' => 25,
    )));

    // Products Section Text Color
    $wp_customize->add_setting('products_section_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'products_section_text_color', array(
        'label'    => __('Section Text Color', 'custom-blue-orange'),
        'section'  => 'products_section',
        'priority' => 26,
    )));

    // Products Grid Layout
    $wp_customize->add_setting('products_grid_layout', array(
        'default'           => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_grid_layout', array(
        'label'    => __('Products Layout', 'custom-blue-orange'),
        'section'  => 'products_section',
        'type'     => 'select',
        'choices'  => array(
            'grid'     => __('Grid Layout', 'custom-blue-orange'),
            'list'     => __('List Layout', 'custom-blue-orange'),
            'carousel' => __('Carousel Layout', 'custom-blue-orange'),
        ),
        'priority' => 27,
    ));

    // Products Section Subtitle
    $wp_customize->add_setting('products_section_subtitle', array(
        'default'           => __('Khám phá những sản phẩm mới nhất và chất lượng cao từ chúng tôi', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_section_subtitle', array(
        'label'    => __('Section Subtitle', 'custom-blue-orange'),
        'section'  => 'products_section',
        'type'     => 'textarea',
        'priority' => 30,
    ));

    // Number of Products to Display
    $wp_customize->add_setting('products_section_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_section_count', array(
        'label'       => __('Number of Products to Display', 'custom-blue-orange'),
        'section'     => 'products_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 6,
            'step' => 1,
        ),
        'priority'    => 40,
    ));

    // Individual Products
    for ($i = 1; $i <= 6; $i++) {
        // Product Image
        $wp_customize->add_setting("product_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "product_{$i}_image", array(
            'label'    => sprintf(__('Product %d Image', 'custom-blue-orange'), $i),
            'section'  => 'products_section',
            'mime_type' => 'image',
            'priority' => 40 + ($i * 10),
        )));

        // Product Title
        $wp_customize->add_setting("product_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_{$i}_title", array(
            'label'    => sprintf(__('Product %d Title', 'custom-blue-orange'), $i),
            'section'  => 'products_section',
            'type'     => 'text',
            'priority' => 41 + ($i * 10),
        ));

        // Product Description
        $wp_customize->add_setting("product_{$i}_description", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_{$i}_description", array(
            'label'    => sprintf(__('Product %d Description', 'custom-blue-orange'), $i),
            'section'  => 'products_section',
            'type'     => 'textarea',
            'priority' => 42 + ($i * 10),
        ));

        // Product Link
        $wp_customize->add_setting("product_{$i}_link", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_{$i}_link", array(
            'label'    => sprintf(__('Product %d Link', 'custom-blue-orange'), $i),
            'section'  => 'products_section',
            'type'     => 'url',
            'priority' => 43 + ($i * 10),
        ));

        // Product Hot Tag
        $wp_customize->add_setting("product_{$i}_hot_tag", array(
            'default'           => false,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_{$i}_hot_tag", array(
            'label'    => sprintf(__('Product %d - Show Hot Tag', 'custom-blue-orange'), $i),
            'section'  => 'products_section',
            'type'     => 'checkbox',
            'priority' => 44 + ($i * 10),
        ));

        // Product Discount Percentage
        $wp_customize->add_setting("product_{$i}_discount", array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_{$i}_discount", array(
            'label'       => sprintf(__('Product %d - Discount Percentage', 'custom-blue-orange'), $i),
            'section'     => 'products_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 99,
                'step' => 1,
            ),
            'description' => __('Enter discount percentage (0-99). Leave empty for no discount.', 'custom-blue-orange'),
            'priority'    => 45 + ($i * 10),
        ));

        // Product Custom Badge Text
        $wp_customize->add_setting("product_{$i}_custom_badge", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_{$i}_custom_badge", array(
            'label'       => sprintf(__('Product %d - Custom Badge Text', 'custom-blue-orange'), $i),
            'section'     => 'products_section',
            'type'        => 'text',
            'description' => __('Custom badge text (e.g., "NEW", "SALE", "LIMITED"). Overrides hot tag and discount.', 'custom-blue-orange'),
            'priority'    => 46 + ($i * 10),
        ));
    }

    // Certificates Section
    $wp_customize->add_section('certificates_section', array(
        'title'    => __('Certificates Section', 'custom-blue-orange'),
        'panel'    => 'homepage_sections_panel',
        'priority' => 20,
        'description' => __('Manage your certificates section settings', 'custom-blue-orange'),
    ));

    // Enable/Disable Certificates Section
    $wp_customize->add_setting('certificates_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('certificates_section_enable', array(
        'label'    => __('Enable Certificates Section', 'custom-blue-orange'),
        'section'  => 'certificates_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Certificates Section Title
    $wp_customize->add_setting('certificates_section_title', array(
        'default'           => __('Chứng Nhận & Giải Thưởng', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('certificates_section_title', array(
        'label'    => __('Section Title', 'custom-blue-orange'),
        'section'  => 'certificates_section',
        'type'     => 'text',
        'priority' => 20,
    ));

    // Certificates Section Background Color
    $wp_customize->add_setting('certificates_section_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'certificates_section_bg_color', array(
        'label'    => __('Section Background Color', 'custom-blue-orange'),
        'section'  => 'certificates_section',
        'priority' => 25,
    )));

    // Certificates Section Text Color
    $wp_customize->add_setting('certificates_section_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'certificates_section_text_color', array(
        'label'    => __('Section Text Color', 'custom-blue-orange'),
        'section'  => 'certificates_section',
        'priority' => 26,
    )));

    // Certificates Display Style
    $wp_customize->add_setting('certificates_display_style', array(
        'default'           => 'cards',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('certificates_display_style', array(
        'label'    => __('Display Style', 'custom-blue-orange'),
        'section'  => 'certificates_section',
        'type'     => 'select',
        'choices'  => array(
            'cards'    => __('Card Style', 'custom-blue-orange'),
            'badges'   => __('Badge Style', 'custom-blue-orange'),
            'minimal'  => __('Minimal Style', 'custom-blue-orange'),
        ),
        'priority' => 27,
    ));

    // Certificates Section Subtitle
    $wp_customize->add_setting('certificates_section_subtitle', array(
        'default'           => __('Những chứng nhận uy tín và giải thưởng danh giá khẳng định chất lượng dịch vụ', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('certificates_section_subtitle', array(
        'label'    => __('Section Subtitle', 'custom-blue-orange'),
        'section'  => 'certificates_section',
        'type'     => 'textarea',
        'priority' => 30,
    ));

    // Number of Certificates to Display
    $wp_customize->add_setting('certificates_section_count', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('certificates_section_count', array(
        'label'       => __('Number of Certificates to Display', 'custom-blue-orange'),
        'section'     => 'certificates_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 4,
            'step' => 1,
        ),
        'priority'    => 40,
    ));

    // Individual Certificates
    for ($i = 1; $i <= 4; $i++) {
        // Certificate Image
        $wp_customize->add_setting("certificate_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "certificate_{$i}_image", array(
            'label'    => sprintf(__('Certificate %d Image', 'custom-blue-orange'), $i),
            'section'  => 'certificates_section',
            'mime_type' => 'image',
            'priority' => 40 + ($i * 10),
        )));

        // Certificate Title
        $wp_customize->add_setting("certificate_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("certificate_{$i}_title", array(
            'label'    => sprintf(__('Certificate %d Title', 'custom-blue-orange'), $i),
            'section'  => 'certificates_section',
            'type'     => 'text',
            'priority' => 41 + ($i * 10),
        ));

        // Certificate Description
        $wp_customize->add_setting("certificate_{$i}_description", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("certificate_{$i}_description", array(
            'label'    => sprintf(__('Certificate %d Description', 'custom-blue-orange'), $i),
            'section'  => 'certificates_section',
            'type'     => 'textarea',
            'priority' => 42 + ($i * 10),
        ));
    }

    // Testimonials Section
    $wp_customize->add_section('testimonials_section', array(
        'title'    => __('Testimonials Section', 'custom-blue-orange'),
        'panel'    => 'homepage_sections_panel',
        'priority' => 30,
        'description' => __('Manage your testimonials section settings', 'custom-blue-orange'),
    ));

    // Enable/Disable Testimonials Section
    $wp_customize->add_setting('testimonials_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('testimonials_section_enable', array(
        'label'    => __('Enable Testimonials Section', 'custom-blue-orange'),
        'section'  => 'testimonials_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Testimonials Section Title
    $wp_customize->add_setting('testimonials_section_title', array(
        'default'           => __('Khách Hàng Nói Gì Về Chúng Tôi', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('testimonials_section_title', array(
        'label'    => __('Section Title', 'custom-blue-orange'),
        'section'  => 'testimonials_section',
        'type'     => 'text',
        'priority' => 20,
    ));

    // Testimonials Section Background Color
    $wp_customize->add_setting('testimonials_section_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'testimonials_section_bg_color', array(
        'label'    => __('Section Background Color', 'custom-blue-orange'),
        'section'  => 'testimonials_section',
        'priority' => 25,
    )));

    // Testimonials Section Text Color
    $wp_customize->add_setting('testimonials_section_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'testimonials_section_text_color', array(
        'label'    => __('Section Text Color', 'custom-blue-orange'),
        'section'  => 'testimonials_section',
        'priority' => 26,
    )));

    // Testimonials Layout Style
    $wp_customize->add_setting('testimonials_layout_style', array(
        'default'           => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('testimonials_layout_style', array(
        'label'    => __('Layout Style', 'custom-blue-orange'),
        'section'  => 'testimonials_section',
        'type'     => 'select',
        'choices'  => array(
            'grid'     => __('Grid Layout', 'custom-blue-orange'),
            'slider'   => __('Slider Layout', 'custom-blue-orange'),
            'masonry'  => __('Masonry Layout', 'custom-blue-orange'),
        ),
        'priority' => 27,
    ));

    // Testimonials Section Subtitle
    $wp_customize->add_setting('testimonials_section_subtitle', array(
        'default'           => __('Những câu chuyện thật từ khách hàng hài lòng tin tưởng sản phẩm của chúng tôi', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('testimonials_section_subtitle', array(
        'label'    => __('Section Subtitle', 'custom-blue-orange'),
        'section'  => 'testimonials_section',
        'type'     => 'textarea',
        'priority' => 30,
    ));

    // Number of Testimonials to Display
    $wp_customize->add_setting('testimonials_section_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('testimonials_section_count', array(
        'label'       => __('Number of Testimonials to Display', 'custom-blue-orange'),
        'section'     => 'testimonials_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 6,
            'step' => 1,
        ),
        'priority'    => 40,
    ));

    // Individual Testimonials
    for ($i = 1; $i <= 6; $i++) {
        // Testimonial Image
        $wp_customize->add_setting("testimonial_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "testimonial_{$i}_image", array(
            'label'    => sprintf(__('Testimonial %d Image', 'custom-blue-orange'), $i),
            'section'  => 'testimonials_section',
            'mime_type' => 'image',
            'priority' => 40 + ($i * 10),
        )));

        // Testimonial Name
        $wp_customize->add_setting("testimonial_{$i}_name", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("testimonial_{$i}_name", array(
            'label'    => sprintf(__('Testimonial %d Name', 'custom-blue-orange'), $i),
            'section'  => 'testimonials_section',
            'type'     => 'text',
            'priority' => 41 + ($i * 10),
        ));

        // Testimonial Position
        $wp_customize->add_setting("testimonial_{$i}_position", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("testimonial_{$i}_position", array(
            'label'    => sprintf(__('Testimonial %d Position', 'custom-blue-orange'), $i),
            'section'  => 'testimonials_section',
            'type'     => 'text',
            'priority' => 42 + ($i * 10),
        ));

        // Testimonial Content
        $wp_customize->add_setting("testimonial_{$i}_content", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("testimonial_{$i}_content", array(
            'label'    => sprintf(__('Testimonial %d Content', 'custom-blue-orange'), $i),
            'section'  => 'testimonials_section',
            'type'     => 'textarea',
            'priority' => 43 + ($i * 10),
        ));
    }

    // Contact Section
    $wp_customize->add_section('contact_section', array(
        'title'    => __('Contact Section', 'custom-blue-orange'),
        'panel'    => 'homepage_sections_panel',
        'priority' => 40,
        'description' => __('Manage your contact section settings', 'custom-blue-orange'),
    ));

    // Enable/Disable Contact Section
    $wp_customize->add_setting('contact_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('contact_section_enable', array(
        'label'    => __('Enable Contact Section', 'custom-blue-orange'),
        'section'  => 'contact_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Contact Section Title
    $wp_customize->add_setting('contact_section_title', array(
        'default'           => __('Liên Hệ Với Chúng Tôi', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('contact_section_title', array(
        'label'    => __('Section Title', 'custom-blue-orange'),
        'section'  => 'contact_section',
        'type'     => 'text',
        'priority' => 20,
    ));

    // Contact Section Subtitle
    $wp_customize->add_setting('contact_section_subtitle', array(
        'default'           => __('Hãy liên hệ với chúng tôi để được tư vấn và hỗ trợ tốt nhất', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('contact_section_subtitle', array(
        'label'    => __('Section Subtitle', 'custom-blue-orange'),
        'section'  => 'contact_section',
        'type'     => 'textarea',
        'priority' => 30,
    ));
}
add_action('customize_register', 'homepage_sections_customizer');

/**
 * Get Hero Slides from Customizer
 */
function get_customizer_hero_slides()
{
    $slides = array();

    for ($i = 1; $i <= 5; $i++) {
        $image_id = get_theme_mod("hero_slide_{$i}_image");
        $title = get_theme_mod("hero_slide_{$i}_title");

        if ($image_id && $title) {
            $slides[] = array(
                'image_id' => $image_id,
                'image_url' => wp_get_attachment_image_url($image_id, 'full'),
                'title' => $title,
                'subtitle' => get_theme_mod("hero_slide_{$i}_subtitle"),
                'button_text' => get_theme_mod("hero_slide_{$i}_button_text"),
                'button_url' => get_theme_mod("hero_slide_{$i}_button_url"),
            );
        }
    }

    return $slides;
}

/**
 * Footer & Contact Customizer Settings
 * Add customizer support for footer contact information and sales team
 */
function footer_contact_customizer($wp_customize) {
    // Footer Contact Panel
    $wp_customize->add_panel('footer_contact_panel', array(
        'title'       => __('Footer & Contact Settings', 'custom-blue-orange'),
        'description' => __('Customize footer contact information and sales team', 'custom-blue-orange'),
        'priority'    => 160,
    ));

    // Company Information Section
    $wp_customize->add_section('company_info_section', array(
        'title'    => __('Company Information', 'custom-blue-orange'),
        'panel'    => 'footer_contact_panel',
        'priority' => 10,
    ));

    // Company Address
    $wp_customize->add_setting('company_address', array(
        'default'           => '123 Đường Kinh Doanh\nThành Phố, Tỉnh 12345',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('company_address', array(
        'label'    => __('Company Address', 'custom-blue-orange'),
        'section'  => 'company_info_section',
        'type'     => 'textarea',
        'priority' => 10,
    ));

    // Company Phone
    $wp_customize->add_setting('company_phone', array(
        'default'           => '+84 (028) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('company_phone', array(
        'label'    => __('Company Phone', 'custom-blue-orange'),
        'section'  => 'company_info_section',
        'type'     => 'text',
        'priority' => 20,
    ));

    // Company Email
    $wp_customize->add_setting('company_email', array(
        'default'           => 'info@congtyban.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('company_email', array(
        'label'    => __('Company Email', 'custom-blue-orange'),
        'section'  => 'company_info_section',
        'type'     => 'email',
        'priority' => 30,
    ));

    // Sales Team Section
    $wp_customize->add_section('sales_team_section', array(
        'title'    => __('Sales Team Contacts', 'custom-blue-orange'),
        'panel'    => 'footer_contact_panel',
        'priority' => 20,
    ));

    // Number of Sales Contacts
    $wp_customize->add_setting('sales_contacts_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('sales_contacts_count', array(
        'label'       => __('Number of Sales Contacts', 'custom-blue-orange'),
        'section'     => 'sales_team_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
        ),
        'priority'    => 10,
    ));

    // Individual Sales Contact Settings (up to 10)
    for ($i = 1; $i <= 10; $i++) {
        // Sales Contact Name
        $wp_customize->add_setting("sales_contact_{$i}_name", array(
            'default'           => $i <= 3 ? 
                ($i == 1 ? 'Nguyễn Văn An' : ($i == 2 ? 'Trần Thị Bình' : 'Lê Minh Cường')) : '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control("sales_contact_{$i}_name", array(
            'label'    => sprintf(__('Contact %d - Name', 'custom-blue-orange'), $i),
            'section'  => 'sales_team_section',
            'type'     => 'text',
            'priority' => 10 + ($i * 10),
        ));

        // Sales Contact Phone
        $wp_customize->add_setting("sales_contact_{$i}_phone", array(
            'default'           => $i <= 3 ? 
                ($i == 1 ? '+84 123 456 789' : ($i == 2 ? '+84 987 654 321' : '+84 555 123 456')) : '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control("sales_contact_{$i}_phone", array(
            'label'    => sprintf(__('Contact %d - Phone', 'custom-blue-orange'), $i),
            'section'  => 'sales_team_section',
            'type'     => 'tel',
            'priority' => 11 + ($i * 10),
        ));

        // Sales Contact Avatar
        $wp_customize->add_setting("sales_contact_{$i}_avatar", array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "sales_contact_{$i}_avatar", array(
            'label'     => sprintf(__('Contact %d - Avatar Image', 'custom-blue-orange'), $i),
            'section'   => 'sales_team_section',
            'mime_type' => 'image',
            'priority'  => 12 + ($i * 10),
        )));

        // Sales Contact Position/Title
        $wp_customize->add_setting("sales_contact_{$i}_position", array(
            'default'           => $i <= 3 ? 
                ($i == 1 ? 'Sales Manager' : ($i == 2 ? 'Senior Sales Executive' : 'Sales Representative')) : '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control("sales_contact_{$i}_position", array(
            'label'    => sprintf(__('Contact %d - Position/Title', 'custom-blue-orange'), $i),
            'section'  => 'sales_team_section',
            'type'     => 'text',
            'priority' => 13 + ($i * 10),
        ));
    }

    // Social Media Section
    $wp_customize->add_section('social_media_section', array(
        'title'    => __('Social Media Links', 'custom-blue-orange'),
        'panel'    => 'footer_contact_panel',
        'priority' => 30,
    ));

    // Facebook URL
    $wp_customize->add_setting('social_facebook_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('social_facebook_url', array(
        'label'    => __('Facebook URL', 'custom-blue-orange'),
        'section'  => 'social_media_section',
        'type'     => 'url',
        'priority' => 10,
    ));

    // Twitter URL
    $wp_customize->add_setting('social_twitter_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('social_twitter_url', array(
        'label'    => __('Twitter URL', 'custom-blue-orange'),
        'section'  => 'social_media_section',
        'type'     => 'url',
        'priority' => 20,
    ));

    // Instagram URL
    $wp_customize->add_setting('social_instagram_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('social_instagram_url', array(
        'label'    => __('Instagram URL', 'custom-blue-orange'),
        'section'  => 'social_media_section',
        'type'     => 'url',
        'priority' => 30,
    ));

    // LinkedIn URL
    $wp_customize->add_setting('social_linkedin_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('social_linkedin_url', array(
        'label'    => __('LinkedIn URL', 'custom-blue-orange'),
        'section'  => 'social_media_section',
        'type'     => 'url',
        'priority' => 40,
    ));

    // Zalo URL
    $wp_customize->add_setting('social_zalo_url', array(
        'default'           => 'https://zalo.me/',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('social_zalo_url', array(
        'label'    => __('Zalo URL', 'custom-blue-orange'),
        'section'  => 'social_media_section',
        'type'     => 'url',
        'priority' => 50,
    ));
}
add_action('customize_register', 'footer_contact_customizer');

/**
 * Get Sales Contacts for Frontend Display
 */
function get_sales_contacts() {
    $contacts = array();
    $count = get_theme_mod('sales_contacts_count', 3);
    
    for ($i = 1; $i <= $count; $i++) {
        $name = get_theme_mod("sales_contact_{$i}_name");
        $phone = get_theme_mod("sales_contact_{$i}_phone");
        $avatar_id = get_theme_mod("sales_contact_{$i}_avatar");
        $position = get_theme_mod("sales_contact_{$i}_position");
        
        if ($name && $phone) {
            $contacts[] = array(
                'name' => $name,
                'phone' => $phone,
                'avatar_id' => $avatar_id,
                'avatar_url' => $avatar_id ? wp_get_attachment_image_url($avatar_id, 'thumbnail') : '',
                'position' => $position,
            );
        }
    }
    
    return $contacts;
}

/**
 * Branding Banner Customizer Settings
 */
function branding_banner_customizer($wp_customize) {
    // Branding Banner Panel
    $wp_customize->add_panel('branding_banner_panel', array(
        'title' => 'Branding Banner Settings',
        'description' => 'Configure brand logos and branding banner display',
        'priority' => 160,
    ));

    // Branding Banner General Settings
    $wp_customize->add_section('branding_banner_general', array(
        'title' => 'General Settings',
        'panel' => 'branding_banner_panel',
        'priority' => 10,
    ));

    // Enable/Disable Branding Banner
    $wp_customize->add_setting('branding_banner_enable', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('branding_banner_enable', array(
        'label' => 'Enable Branding Banner',
        'section' => 'branding_banner_general',
        'type' => 'checkbox',
    ));

    // Branding Banner Title
    $wp_customize->add_setting('branding_banner_title', array(
        'default' => 'Trusted by Leading Brands',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('branding_banner_title', array(
        'label' => 'Banner Title',
        'section' => 'branding_banner_general',
        'type' => 'text',
    ));

    // Branding Banner Subtitle
    $wp_customize->add_setting('branding_banner_subtitle', array(
        'default' => 'Companies worldwide trust our products and solutions',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('branding_banner_subtitle', array(
        'label' => 'Banner Subtitle',
        'section' => 'branding_banner_general',
        'type' => 'textarea',
    ));

    // Branding Banner Background Color
    $wp_customize->add_setting('branding_banner_bg_color', array(
        'default' => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'branding_banner_bg_color', array(
        'label' => 'Background Color',
        'section' => 'branding_banner_general',
    )));

    // Branding Banner Text Color
    $wp_customize->add_setting('branding_banner_text_color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'branding_banner_text_color', array(
        'label' => 'Text Color',
        'section' => 'branding_banner_general',
    )));

    // Brand Logos Section
    $wp_customize->add_section('branding_banner_logos', array(
        'title' => 'Brand Logos',
        'panel' => 'branding_banner_panel',
        'priority' => 20,
    ));

    // Add up to 12 brand logo settings
    for ($i = 1; $i <= 12; $i++) {
        // Brand Logo Image
        $wp_customize->add_setting("brand_logo_{$i}_image", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "brand_logo_{$i}_image", array(
            'label' => "Brand Logo {$i} - Image",
            'section' => 'branding_banner_logos',
            'mime_type' => 'image',
        )));

        // Brand Logo Name
        $wp_customize->add_setting("brand_logo_{$i}_name", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("brand_logo_{$i}_name", array(
            'label' => "Brand Logo {$i} - Name",
            'section' => 'branding_banner_logos',
            'type' => 'text',
        ));

        // Brand Logo URL
        $wp_customize->add_setting("brand_logo_{$i}_url", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("brand_logo_{$i}_url", array(
            'label' => "Brand Logo {$i} - URL",
            'section' => 'branding_banner_logos',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'branding_banner_customizer');

/**
 * Get Brand Logos for Frontend Display
 */
function get_brand_logos() {
    $logos = array();
    
    for ($i = 1; $i <= 12; $i++) {
        $image = get_theme_mod("brand_logo_{$i}_image");
        $name = get_theme_mod("brand_logo_{$i}_name");
        $url = get_theme_mod("brand_logo_{$i}_url");
        
        if ($image) {
            $logos[] = array(
                'image' => $image,
                'name' => $name ?: "Brand {$i}",
                'url' => $url,
            );
        }
    }
    
    return $logos;
}
 
 ?>