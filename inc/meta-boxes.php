<?php

/**
 * Meta Boxes Functionality
 *
 * This file contains all meta box related functions for custom post types.
 *
 * @package WordPress
 * @subpackage Custom_Blue_Orange
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Meta Boxes for Hero Slides
 */
function add_hero_slide_meta_boxes()
{
    add_meta_box(
        'hero_slide_details',
        __('Hero Slide Details', 'custom-blue-orange'),
        'hero_slide_meta_box_callback',
        'hero_slide',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_hero_slide_meta_boxes');

/**
 * Add Meta Boxes for Products
 */
function add_product_meta_boxes()
{
    add_meta_box(
        'product_details',
        __('Product Details', 'custom-blue-orange'),
        'product_meta_box_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_product_meta_boxes');

/**
 * Add Meta Boxes for Quote Articles
 */
function add_quote_article_meta_boxes()
{
    add_meta_box(
        'quote_article_details',
        __('Quote Article Details', 'skylightpoly'),
        'quote_article_meta_box_callback',
        'quote_article',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_quote_article_meta_boxes');

/**
 * Hero Slide Meta Box Callback
 */
function hero_slide_meta_box_callback($post)
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
 * Product Meta Box Callback
 */
function product_meta_box_callback($post)
{
    wp_nonce_field('product_details_nonce', 'product_details_nonce');

    $featured = get_post_meta($post->ID, '_featured_product', true);
    $price = get_post_meta($post->ID, 'product_price', true);
    $discount_price = get_post_meta($post->ID, 'discount_price', true);
    $price_unit = get_post_meta($post->ID, 'price_unit', true);
    $custom_badge = get_post_meta($post->ID, 'custom_badge', true);
    $discount = get_post_meta($post->ID, 'discount', true);
    $hot_tag = get_post_meta($post->ID, 'hot_tag', true);
    $link = get_post_meta($post->ID, 'product_link', true);

    echo '<table class="form-table">';

    echo '<tr>';
    echo '<th><label for="featured_product">' . __('Featured Product', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="checkbox" id="featured_product" name="featured_product" value="yes"' . checked($featured, 'yes', false) . ' /> ' . __('Mark as featured product', 'custom-blue-orange') . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="product_price">' . __('Product Price', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="number" id="product_price" name="product_price" value="' . esc_attr($price) . '" class="regular-text" placeholder="100000" step="1000" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="discount_price">' . __('Discount Price', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="number" id="discount_price" name="discount_price" value="' . esc_attr($discount_price) . '" class="regular-text" placeholder="80000" step="1000" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="price_unit">' . __('Price Unit', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="text" id="price_unit" name="price_unit" value="' . esc_attr($price_unit) . '" class="regular-text" placeholder="đơn vị" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="custom_badge">' . __('Custom Badge', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="text" id="custom_badge" name="custom_badge" value="' . esc_attr($custom_badge) . '" class="regular-text" placeholder="NEW" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="discount">' . __('Discount Percentage', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="number" id="discount" name="discount" value="' . esc_attr($discount) . '" class="regular-text" placeholder="20" min="0" max="100" step="1" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="hot_tag">' . __('Hot Tag', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="checkbox" id="hot_tag" name="hot_tag" value="yes"' . checked($hot_tag, 'yes', false) . ' /> ' . __('Mark as hot product', 'custom-blue-orange') . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="product_link">' . __('Product Link', 'custom-blue-orange') . '</label></th>';
    echo '<td><input type="url" id="product_link" name="product_link" value="' . esc_attr($link) . '" class="regular-text" placeholder="https://example.com/product" /></td>';
    echo '</tr>';

    echo '</table>';

    echo '<div style="margin-top: 20px; padding: 15px; background: #f0f8ff; border-left: 4px solid #0073aa; border-radius: 4px;">';
    echo '<h4 style="margin-top: 0; color: #0073aa;">📦 How to use Products:</h4>';
    echo '<ul style="margin: 10px 0; padding-left: 20px;">';
    echo '<li><strong>Title:</strong> Product name</li>';
    echo '<li><strong>Content:</strong> Product description</li>';
    echo '<li><strong>Featured Image:</strong> Product image (recommended: 400x400px)</li>';
    echo '<li><strong>Product Categories:</strong> Assign categories using the Product Categories panel on the right</li>';
    echo '<li><strong>Featured Product:</strong> Highlight this product on the homepage</li>';
    echo '<li><strong>Price & Discount Price:</strong> Regular and sale prices (numbers only)</li>';
    echo '<li><strong>Price Unit:</strong> Unit of measurement (e.g., "đơn vị", "kg", "piece")</li>';
    echo '<li><strong>Custom Badge:</strong> Custom text badge (e.g., "NEW", "SALE")</li>';
    echo '<li><strong>Discount Percentage:</strong> Discount percentage for automatic badge</li>';
    echo '<li><strong>Hot Tag:</strong> Mark as trending/hot product</li>';
    echo '<li><strong>Product Link:</strong> External link to product page or purchase page</li>';
    echo '</ul>';
    echo '<p style="margin-bottom: 0;"><em>💡 Tip: Badge priority: Custom Badge > Discount % > Hot Tag. Only one badge will be displayed.</em></p>';
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

    // Only save for product post type
    if (get_post_type($post_id) !== 'product') {
        return;
    }

    if (isset($_POST['featured_product'])) {
        update_post_meta($post_id, '_featured_product', 'yes');
    } else {
        update_post_meta($post_id, '_featured_product', 'no');
    }

    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, 'product_price', intval($_POST['product_price']));
    }

    if (isset($_POST['discount_price'])) {
        update_post_meta($post_id, 'discount_price', intval($_POST['discount_price']));
    }

    if (isset($_POST['price_unit'])) {
        update_post_meta($post_id, 'price_unit', sanitize_text_field($_POST['price_unit']));
    }

    if (isset($_POST['custom_badge'])) {
        update_post_meta($post_id, 'custom_badge', sanitize_text_field($_POST['custom_badge']));
    }

    if (isset($_POST['discount'])) {
        update_post_meta($post_id, 'discount', intval($_POST['discount']));
    }

    if (isset($_POST['hot_tag'])) {
        update_post_meta($post_id, 'hot_tag', 'yes');
    } else {
        update_post_meta($post_id, 'hot_tag', 'no');
    }

    if (isset($_POST['product_link'])) {
        update_post_meta($post_id, 'product_link', esc_url_raw($_POST['product_link']));
    }
}
add_action('save_post', 'save_product_meta_data');

/**
 * Quote Article Meta Box Callback
 */
function quote_article_meta_box_callback($post)
{
    wp_nonce_field('quote_article_details_nonce', 'quote_article_details_nonce');

    $author_name = get_post_meta($post->ID, '_quote_author_name', true);
    $author_company = get_post_meta($post->ID, '_quote_author_company', true);
    $author_position = get_post_meta($post->ID, '_quote_author_position', true);
    $quote_date = get_post_meta($post->ID, '_quote_date', true);
    $featured_quote = get_post_meta($post->ID, '_featured_quote', true);
    $quote_rating = get_post_meta($post->ID, '_quote_rating', true);
    
    // Price table fields
    $price_table_data = get_post_meta($post->ID, '_price_table_data', true);
    $currency_symbol = get_post_meta($post->ID, '_currency_symbol', true) ?: 'đ';
    $price_table_title = get_post_meta($post->ID, '_price_table_title', true);

    echo '<table class="form-table">';

    echo '<tr>';
    echo '<th><label for="quote_author_name">' . __('Author Name', 'skylightpoly') . '</label></th>';
    echo '<td><input type="text" id="quote_author_name" name="quote_author_name" value="' . esc_attr($author_name) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="quote_author_company">' . __('Company/Organization', 'skylightpoly') . '</label></th>';
    echo '<td><input type="text" id="quote_author_company" name="quote_author_company" value="' . esc_attr($author_company) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="quote_author_position">' . __('Position/Title', 'skylightpoly') . '</label></th>';
    echo '<td><input type="text" id="quote_author_position" name="quote_author_position" value="' . esc_attr($author_position) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="quote_date">' . __('Quote Date', 'skylightpoly') . '</label></th>';
    echo '<td><input type="date" id="quote_date" name="quote_date" value="' . esc_attr($quote_date) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="quote_rating">' . __('Rating (1-5 stars)', 'skylightpoly') . '</label></th>';
    echo '<td><select id="quote_rating" name="quote_rating">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<option value="' . $i . '"' . selected($quote_rating, $i, false) . '>' . $i . ' ' . ($i == 1 ? 'star' : 'stars') . '</option>';
    }
    echo '</select></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<th><label for="featured_quote">' . __('Featured Quote', 'skylightpoly') . '</label></th>';
    echo '<td><input type="checkbox" id="featured_quote" name="featured_quote" value="yes"' . checked($featured_quote, 'yes', false) . ' /> ' . __('Mark as featured quote', 'skylightpoly') . '</td>';
    echo '</tr>';

    echo '</table>';
    
    // Price Table Section
    echo '<h3 style="margin-top: 30px; margin-bottom: 15px; color: #0073aa;">💰 Price Table Information</h3>';
    echo '<table class="form-table">';
    
    echo '<tr>';
    echo '<th><label for="price_table_title">' . __('Price Table Title', 'skylightpoly') . '</label></th>';
    echo '<td><input type="text" id="price_table_title" name="price_table_title" value="' . esc_attr($price_table_title) . '" class="regular-text" placeholder="e.g., Product Pricing 2024" /></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<th><label for="currency_symbol">' . __('Currency Symbol', 'skylightpoly') . '</label></th>';
    echo '<td><input type="text" id="currency_symbol" name="currency_symbol" value="' . esc_attr($currency_symbol) . '" class="small-text" placeholder="đ" /></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<th><label for="price_table_data">' . __('Price Table Data (JSON)', 'skylightpoly') . '</label></th>';
    echo '<td>';
    echo '<textarea id="price_table_data" name="price_table_data" rows="10" class="large-text code" placeholder="{\n  \"categories\": [\n    {\n      \"name\": \"Category Name\",\n      \"products\": [\n        {\n          \"name\": \"Product Name\",\n          \"price\": \"100,000\",\n          \"unit\": \"per piece\",\n          \"description\": \"Product description\"\n        }\n      ]\n    }\n  ]\n}">' . esc_textarea($price_table_data) . '</textarea>';
    echo '<p class="description">Enter price table data in JSON format. See placeholder for example structure.</p>';
    echo '</td>';
    echo '</tr>';
    
    echo '</table>';

    echo '<div style="margin-top: 20px; padding: 15px; background: #f0f8ff; border-left: 4px solid #0073aa; border-radius: 4px;">';
    echo '<h4 style="margin-top: 0; color: #0073aa;">💬 How to use Quote Articles with Price Tables:</h4>';
    echo '<ul style="margin: 10px 0; padding-left: 20px;">';
    echo '<li><strong>Title:</strong> Quote headline or product pricing announcement</li>';
    echo '<li><strong>Content:</strong> Full quote text, pricing details, and product information</li>';
    echo '<li><strong>Featured Image:</strong> Product image or company logo (recommended: 300x300px)</li>';
    echo '<li><strong>Author Details:</strong> Name, company, and position of the person providing the quote</li>';
    echo '<li><strong>Quote Date:</strong> When the quote/pricing was announced</li>';
    echo '<li><strong>Price Table:</strong> Structured pricing data that will be displayed as a formatted table</li>';
    echo '<li><strong>Featured Quote:</strong> Highlight this pricing quote on the quotes page</li>';
    echo '</ul>';
    echo '<p style="margin-bottom: 0;"><em>💡 Tip: Use the price table to display structured pricing information alongside the quote content.</em></p>';
    echo '</div>';
}

/**
 * Save Quote Article Meta Data
 */
function save_quote_article_meta_data($post_id)
{
    if (!isset($_POST['quote_article_details_nonce']) || !wp_verify_nonce($_POST['quote_article_details_nonce'], 'quote_article_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['quote_author_name'])) {
        update_post_meta($post_id, '_quote_author_name', sanitize_text_field($_POST['quote_author_name']));
    }

    if (isset($_POST['quote_author_company'])) {
        update_post_meta($post_id, '_quote_author_company', sanitize_text_field($_POST['quote_author_company']));
    }

    if (isset($_POST['quote_author_position'])) {
        update_post_meta($post_id, '_quote_author_position', sanitize_text_field($_POST['quote_author_position']));
    }

    if (isset($_POST['quote_date'])) {
        update_post_meta($post_id, '_quote_date', sanitize_text_field($_POST['quote_date']));
    }

    if (isset($_POST['quote_rating'])) {
        update_post_meta($post_id, '_quote_rating', intval($_POST['quote_rating']));
    }

    if (isset($_POST['featured_quote'])) {
        update_post_meta($post_id, '_featured_quote', 'yes');
    } else {
        update_post_meta($post_id, '_featured_quote', 'no');
    }
    
    // Save price table fields
    if (isset($_POST['price_table_title'])) {
        update_post_meta($post_id, '_price_table_title', sanitize_text_field($_POST['price_table_title']));
    }
    
    if (isset($_POST['currency_symbol'])) {
        update_post_meta($post_id, '_currency_symbol', sanitize_text_field($_POST['currency_symbol']));
    }
    
    if (isset($_POST['price_table_data'])) {
        $price_data = sanitize_textarea_field($_POST['price_table_data']);
        // Validate JSON format
        $decoded = json_decode($price_data, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            update_post_meta($post_id, '_price_table_data', $price_data);
        }
    }
}
add_action('save_post', 'save_quote_article_meta_data');

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
