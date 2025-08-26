<?php

/**
 * WordPress Customizer Settings
 *
 * This file contains all WordPress Customizer related functions and settings.
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
        'description' => __('Manage your products section display settings. Products are now organized by categories in the Product Categories section.', 'custom-blue-orange'),
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

    // Default Unit for Demo Products
    $wp_customize->add_setting('products_default_unit', array(
        'default'           => 'đơn vị',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_default_unit', array(
        'label'       => __('Default Unit for Demo Products', 'custom-blue-orange'),
        'section'     => 'products_section',
        'type'        => 'text',
        'description' => __('Unit used for demo products when no custom products are configured', 'custom-blue-orange'),
        'priority'    => 41,
    ));

    // Currency Symbol
    $wp_customize->add_setting('products_currency_symbol', array(
        'default'           => 'đ',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_currency_symbol', array(
        'label'       => __('Currency Symbol', 'custom-blue-orange'),
        'section'     => 'products_section',
        'type'        => 'text',
        'description' => __('Currency symbol to display with prices (e.g., đ, $, €, ¥)', 'custom-blue-orange'),
        'priority'    => 42,
    ));

    // Product Categories Section
    $wp_customize->add_section('product_categories_section', array(
        'title'    => __('Product Categories', 'custom-blue-orange'),
        'panel'    => 'homepage_sections_panel',
        'priority' => 14,
        'description' => __('Manage product categories (up to 20 categories)', 'custom-blue-orange'),
    ));

    // Number of Categories
    $wp_customize->add_setting('product_categories_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('product_categories_count', array(
        'label'       => __('Number of Categories', 'custom-blue-orange'),
        'section'     => 'product_categories_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 20,
        ),
        'description' => __('Set the number of product categories (1-20)', 'custom-blue-orange'),
        'priority'    => 10,
    ));

    // Category Settings Loop - Generate maximum fields for flexibility
    $max_categories = 20;

    for ($i = 1; $i <= $max_categories; $i++) {
        // Category Title
        $wp_customize->add_setting("product_category_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_category_{$i}_title", array(
            'label'       => sprintf(__('Category %d - Title', 'custom-blue-orange'), $i),
            'section'     => 'product_categories_section',
            'type'        => 'text',
            'description' => __('Enter category title', 'custom-blue-orange'),
            'priority'    => 10 + ($i * 5),
            'active_callback' => function () use ($i) {
                return get_theme_mod('product_categories_count', 3) >= $i;
            },
        ));

        // Category Link
        $wp_customize->add_setting("product_category_{$i}_link", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_category_{$i}_link", array(
            'label'       => sprintf(__('Category %d - "See All" Link', 'custom-blue-orange'), $i),
            'section'     => 'product_categories_section',
            'type'        => 'url',
            'description' => __('Enter URL for "Xem tất cả sản phẩm" button', 'custom-blue-orange'),
            'priority'    => 11 + ($i * 5),
            'active_callback' => function () use ($i) {
                return get_theme_mod('product_categories_count', 3) >= $i;
            },
        ));

        // Create individual section for each category's products
        $wp_customize->add_section("product_category_{$i}_products", array(
            'title'    => sprintf(__('Category %d Products', 'custom-blue-orange'), $i),
            'panel'    => 'homepage_sections_panel',
            'priority' => 14 + $i,
            'description' => sprintf(__('Manage products for Category %d (up to 10 products)', 'custom-blue-orange'), $i),
            'active_callback' => function () use ($i) {
                return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", ''));
            },
        ));

        // Number of Products in this Category
        $wp_customize->add_setting("product_category_{$i}_product_count", array(
            'default'           => 3,
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("product_category_{$i}_product_count", array(
            'label'       => sprintf(__('Number of Products in Category %d', 'custom-blue-orange'), $i),
            'section'     => "product_category_{$i}_products",
            'type'        => 'number',
            'input_attrs' => array(
                'min' => 0,
                'max' => 10,
            ),
            'description' => __('Set the number of products in this category (0-10)', 'custom-blue-orange'),
            'priority'    => 10,
            'active_callback' => function () use ($i) {
                return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", ''));
            },
        ));

        // Products for this Category
        $max_products_per_category = 10;
        for ($j = 1; $j <= $max_products_per_category; $j++) {
            $product_priority_base = 20 + ($j * 8);

            // Product Image
            $wp_customize->add_setting("category_{$i}_product_{$j}_image", array(
                'default'           => '',
                'sanitize_callback' => 'absint',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "category_{$i}_product_{$j}_image", array(
                'label'    => sprintf(__('Product %d Image', 'custom-blue-orange'), $j),
                'section'  => "product_category_{$i}_products",
                'mime_type' => 'image',
                'priority' => $product_priority_base,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            )));

            // Product Title
            $wp_customize->add_setting("category_{$i}_product_{$j}_title", array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control("category_{$i}_product_{$j}_title", array(
                'label'    => sprintf(__('Product %d Title', 'custom-blue-orange'), $j),
                'section'  => "product_category_{$i}_products",
                'type'     => 'text',
                'priority' => $product_priority_base + 1,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            ));

            // Product Description
            $wp_customize->add_setting("category_{$i}_product_{$j}_description", array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_textarea_field',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control("category_{$i}_product_{$j}_description", array(
                'label'    => sprintf(__('Product %d Description', 'custom-blue-orange'), $j),
                'section'  => "product_category_{$i}_products",
                'type'     => 'textarea',
                'priority' => $product_priority_base + 2,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            ));

            // Product Link
            $wp_customize->add_setting("category_{$i}_product_{$j}_link", array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control("category_{$i}_product_{$j}_link", array(
                'label'    => sprintf(__('Product %d Link', 'custom-blue-orange'), $j),
                'section'  => "product_category_{$i}_products",
                'type'     => 'url',
                'priority' => $product_priority_base + 3,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            ));

            // Product Price
            $wp_customize->add_setting("category_{$i}_product_{$j}_price", array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control("category_{$i}_product_{$j}_price", array(
                'label'       => sprintf(__('Product %d Price', 'custom-blue-orange'), $j),
                'section'     => "product_category_{$i}_products",
                'type'        => 'number',
                'input_attrs' => array(
                    'min'  => 0,
                    'step' => 1000,
                ),
                'description' => __('Enter price (e.g., 2500000 for 2,500,000)', 'custom-blue-orange'),
                'priority'    => $product_priority_base + 4,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            ));

            // Product Discount Price
            $wp_customize->add_setting("category_{$i}_product_{$j}_discount_price", array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control("category_{$i}_product_{$j}_discount_price", array(
                'label'       => sprintf(__('Product %d Discount Price', 'custom-blue-orange'), $j),
                'section'     => "product_category_{$i}_products",
                'type'        => 'number',
                'input_attrs' => array(
                    'min'  => 0,
                    'step' => 1000,
                ),
                'description' => __('Enter discounted price. Leave empty if no discount.', 'custom-blue-orange'),
                'priority'    => $product_priority_base + 5,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            ));

            // Product Unit
            $wp_customize->add_setting("category_{$i}_product_{$j}_unit", array(
                'default'           => 'đơn vị',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control("category_{$i}_product_{$j}_unit", array(
                'label'       => sprintf(__('Product %d Unit', 'custom-blue-orange'), $j),
                'section'     => "product_category_{$i}_products",
                'type'        => 'text',
                'description' => __('Enter unit type (e.g., "đơn vị", "kg", "m", "bộ", "chiếc")', 'custom-blue-orange'),
                'priority'    => $product_priority_base + 6,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            ));

            // Product Custom Badge
            $wp_customize->add_setting("category_{$i}_product_{$j}_custom_badge", array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ));

            $wp_customize->add_control("category_{$i}_product_{$j}_custom_badge", array(
                'label'       => sprintf(__('Product %d Custom Badge', 'custom-blue-orange'), $j),
                'section'     => "product_category_{$i}_products",
                'type'        => 'text',
                'description' => __('Custom badge text (e.g., "NEW", "SALE", "LIMITED")', 'custom-blue-orange'),
                'priority'    => $product_priority_base + 7,
                'active_callback' => function () use ($i, $j) {
                    return get_theme_mod('product_categories_count', 3) >= $i && !empty(get_theme_mod("product_category_{$i}_title", '')) && get_theme_mod("product_category_{$i}_product_count", 3) >= $j;
                },
            ));
        }
    }

    // Video Section
    $wp_customize->add_section('video_section', array(
        'title'    => __('Video Section', 'custom-blue-orange'),
        'panel'    => 'homepage_sections_panel',
        'priority' => 15,
        'description' => __('Manage your video section settings (supports up to 6 videos)', 'custom-blue-orange'),
    ));

    // Enable/Disable Video Section
    $wp_customize->add_setting('video_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('video_section_enable', array(
        'label'    => __('Enable Video Section', 'custom-blue-orange'),
        'section'  => 'video_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Video Section Title
    $wp_customize->add_setting('video_section_title', array(
        'default'           => __('Video Giới Thiệu', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('video_section_title', array(
        'label'    => __('Section Title', 'custom-blue-orange'),
        'section'  => 'video_section',
        'type'     => 'text',
        'priority' => 20,
    ));

    // Video Section Subtitle
    $wp_customize->add_setting('video_section_subtitle', array(
        'default'           => __('Khám phá thêm về chúng tôi qua video giới thiệu', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('video_section_subtitle', array(
        'label'    => __('Section Subtitle', 'custom-blue-orange'),
        'section'  => 'video_section',
        'type'     => 'text',
        'priority' => 30,
    ));

    // Video Section Background Color
    $wp_customize->add_setting('video_section_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'video_section_bg_color', array(
        'label'    => __('Section Background Color', 'custom-blue-orange'),
        'section'  => 'video_section',
        'priority' => 35,
    )));

    // Video Section Text Color
    $wp_customize->add_setting('video_section_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'video_section_text_color', array(
        'label'    => __('Section Text Color', 'custom-blue-orange'),
        'section'  => 'video_section',
        'priority' => 36,
    )));

    // Video Layout
    $wp_customize->add_setting('video_section_layout', array(
        'default'           => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('video_section_layout', array(
        'label'    => __('Video Layout', 'custom-blue-orange'),
        'section'  => 'video_section',
        'type'     => 'select',
        'choices'  => array(
            'grid'     => __('Grid Layout', 'custom-blue-orange'),
            'centered' => __('Centered', 'custom-blue-orange'),
            'left'     => __('Left Aligned', 'custom-blue-orange'),
            'right'    => __('Right Aligned', 'custom-blue-orange'),
        ),
        'priority' => 37,
    ));

    // Individual Video Controls (up to 6 videos)
    for ($i = 1; $i <= 6; $i++) {
        // Video Title
        $wp_customize->add_setting("video_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("video_{$i}_title", array(
            'label'    => sprintf(__('Video %d Title', 'custom-blue-orange'), $i),
            'section'  => 'video_section',
            'type'     => 'text',
            'priority' => 40 + ($i * 10),
        ));

        // Video Type
        $wp_customize->add_setting("video_{$i}_type", array(
            'default'           => 'youtube',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("video_{$i}_type", array(
            'label'    => sprintf(__('Video %d Type', 'custom-blue-orange'), $i),
            'section'  => 'video_section',
            'type'     => 'select',
            'choices'  => array(
                'youtube' => __('YouTube', 'custom-blue-orange'),
                'vimeo'   => __('Vimeo', 'custom-blue-orange'),
                'mp4'     => __('MP4 File', 'custom-blue-orange'),
            ),
            'priority' => 41 + ($i * 10),
        ));

        // Video URL
        $wp_customize->add_setting("video_{$i}_url", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("video_{$i}_url", array(
            'label'       => sprintf(__('Video %d URL', 'custom-blue-orange'), $i),
            'section'     => 'video_section',
            'type'        => 'url',
            'description' => __('Enter YouTube, Vimeo, or MP4 file URL', 'custom-blue-orange'),
            'priority'    => 42 + ($i * 10),
        ));

        // Video Poster Image (for MP4)
        $wp_customize->add_setting("video_{$i}_poster", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "video_{$i}_poster", array(
            'label'       => sprintf(__('Video %d Poster Image', 'custom-blue-orange'), $i),
            'section'     => 'video_section',
            'mime_type'   => 'image',
            'description' => __('Poster image for MP4 videos (optional)', 'custom-blue-orange'),
            'priority'    => 43 + ($i * 10),
        )));

        // Video Description
        $wp_customize->add_setting("video_{$i}_description", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("video_{$i}_description", array(
            'label'    => sprintf(__('Video %d Description', 'custom-blue-orange'), $i),
            'section'  => 'video_section',
            'type'     => 'textarea',
            'description' => __('Optional description text below the video', 'custom-blue-orange'),
            'priority' => 44 + ($i * 10),
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
 * Footer & Contact Customizer Settings
 */
function footer_contact_customizer($wp_customize)
{
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
        'default'           => '#',
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
 * Branding Banner Customizer Settings
 */
function branding_banner_customizer($wp_customize)
{
    // Branding Banner Section
    $wp_customize->add_section('branding_banner_section', array(
        'title'    => __('Branding Banner', 'custom-blue-orange'),
        'priority' => 35,
        'description' => __('Manage your branding banner with company logos (up to 12 logos)', 'custom-blue-orange'),
    ));

    // Enable/Disable Branding Banner
    $wp_customize->add_setting('branding_banner_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('branding_banner_enable', array(
        'label'    => __('Enable Branding Banner', 'custom-blue-orange'),
        'section'  => 'branding_banner_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Branding Banner Title
    $wp_customize->add_setting('branding_banner_title', array(
        'default'           => __('Đối Tác Tin Cậy', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('branding_banner_title', array(
        'label'    => __('Banner Title', 'custom-blue-orange'),
        'section'  => 'branding_banner_section',
        'type'     => 'text',
        'priority' => 20,
    ));

    // Branding Banner Subtitle
    $wp_customize->add_setting('branding_banner_subtitle', array(
        'default'           => __('Chúng tôi tự hào hợp tác với những thương hiệu hàng đầu', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('branding_banner_subtitle', array(
        'label'    => __('Banner Subtitle', 'custom-blue-orange'),
        'section'  => 'branding_banner_section',
        'type'     => 'textarea',
        'priority' => 30,
    ));

    // Branding Banner Background Color
    $wp_customize->add_setting('branding_banner_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'branding_banner_bg_color', array(
        'label'    => __('Banner Background Color', 'custom-blue-orange'),
        'section'  => 'branding_banner_section',
        'priority' => 35,
    )));

    // Branding Banner Text Color
    $wp_customize->add_setting('branding_banner_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'branding_banner_text_color', array(
        'label'    => __('Banner Text Color', 'custom-blue-orange'),
        'section'  => 'branding_banner_section',
        'priority' => 36,
    )));

    // Individual Brand Logo Settings (up to 12)
    for ($i = 1; $i <= 12; $i++) {
        // Brand Logo Image
        $wp_customize->add_setting("brand_logo_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "brand_logo_{$i}_image", array(
            'label'     => sprintf(__('Brand Logo %d - Image', 'custom-blue-orange'), $i),
            'section'   => 'branding_banner_section',
            'mime_type' => 'image',
            'priority'  => 40 + ($i * 5),
        )));

        // Brand Logo Name
        $wp_customize->add_setting("brand_logo_{$i}_name", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("brand_logo_{$i}_name", array(
            'label'    => sprintf(__('Brand Logo %d - Name', 'custom-blue-orange'), $i),
            'section'  => 'branding_banner_section',
            'type'     => 'text',
            'priority' => 41 + ($i * 5),
        ));

        // Brand Logo URL
        $wp_customize->add_setting("brand_logo_{$i}_url", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("brand_logo_{$i}_url", array(
            'label'    => sprintf(__('Brand Logo %d - URL', 'custom-blue-orange'), $i),
            'section'  => 'branding_banner_section',
            'type'     => 'url',
            'priority' => 42 + ($i * 5),
        ));
    }
}
add_action('customize_register', 'branding_banner_customizer');

/**
 * Header Customizer Settings
 */
function header_customizer($wp_customize)
{
    // Header Customizer Panel
    $wp_customize->add_panel('header_customizer_panel', array(
        'title'    => __('Header Customizer Settings', 'custom-blue-orange'),
        'priority' => 20,
        'description' => __('Customize header elements including site branding, region selection, and contact information', 'custom-blue-orange'),
    ));

    // Site Branding Section
    $wp_customize->add_section('site_branding_section', array(
        'title'    => __('Site Branding Section', 'custom-blue-orange'),
        'panel'    => 'header_customizer_panel',
        'priority' => 10,
    ));

    // Site Slogan
    $wp_customize->add_setting('site_slogan', array(
        'default'           => __('Chất lượng - Uy tín - Chuyên nghiệp', 'custom-blue-orange'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('site_slogan', array(
        'label'    => __('Site Slogan', 'custom-blue-orange'),
        'section'  => 'site_branding_section',
        'type'     => 'text',
        'priority' => 10,
    ));

    // Header Layout Section
    $wp_customize->add_section('header_layout_section', array(
        'title'    => __('Header Layout Section', 'custom-blue-orange'),
        'panel'    => 'header_customizer_panel',
        'priority' => 15,
    ));

    // Navigation Position
    $wp_customize->add_setting('navigation_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('navigation_position', array(
        'label'    => __('Navigation Position', 'custom-blue-orange'),
        'section'  => 'header_layout_section',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('Left Side', 'custom-blue-orange'),
            'right'  => __('Right Side', 'custom-blue-orange'),
            'center' => __('Center', 'custom-blue-orange'),
        ),
        'priority' => 10,
    ));

    // Header Layout Style
    $wp_customize->add_setting('header_layout_style', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_layout_style', array(
        'label'    => __('Header Layout Style', 'custom-blue-orange'),
        'section'  => 'header_layout_section',
        'type'     => 'select',
        'choices'  => array(
            'default'  => __('Logo Left, Menu Right', 'custom-blue-orange'),
            'centered' => __('Logo Center, Menu Below', 'custom-blue-orange'),
            'stacked'  => __('Logo Top, Menu Bottom', 'custom-blue-orange'),
        ),
        'priority' => 20,
    ));

    // Region Selection Section
    $wp_customize->add_section('region_selection_section', array(
        'title'    => __('Region Selection Section', 'custom-blue-orange'),
        'panel'    => 'header_customizer_panel',
        'priority' => 20,
    ));

    // Display Region Selection
    $wp_customize->add_setting('display_region_selection', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('display_region_selection', array(
        'label'    => __('Display Region Selection', 'custom-blue-orange'),
        'section'  => 'region_selection_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));

    // Default Region
    $wp_customize->add_setting('default_region', array(
        'default'           => 'vietnam',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('default_region', array(
        'label'    => __('Default Region', 'custom-blue-orange'),
        'section'  => 'region_selection_section',
        'type'     => 'select',
        'choices'  => array(
            'vietnam'   => __('Vietnam', 'custom-blue-orange'),
            'usa'       => __('USA', 'custom-blue-orange'),
            'uk'        => __('UK', 'custom-blue-orange'),
            'singapore' => __('Singapore', 'custom-blue-orange'),
            'japan'     => __('Japan', 'custom-blue-orange'),
        ),
        'priority' => 20,
    ));

    // Region-specific settings
    $regions = array('vietnam', 'usa', 'uk', 'singapore', 'japan');
    $region_names = array(
        'vietnam'   => __('Vietnam', 'custom-blue-orange'),
        'usa'       => __('USA', 'custom-blue-orange'),
        'uk'        => __('UK', 'custom-blue-orange'),
        'singapore' => __('Singapore', 'custom-blue-orange'),
        'japan'     => __('Japan', 'custom-blue-orange'),
    );

    foreach ($regions as $region) {
        $region_name = $region_names[$region];
        $priority_base = 30 + (array_search($region, $regions) * 10);

        // Region Phone
        $wp_customize->add_setting("{$region}_phone", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("{$region}_phone", array(
            'label'    => sprintf(__('%s Phone', 'custom-blue-orange'), $region_name),
            'section'  => 'region_selection_section',
            'type'     => 'text',
            'priority' => $priority_base,
        ));

        // Region Email
        $wp_customize->add_setting("{$region}_email", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("{$region}_email", array(
            'label'    => sprintf(__('%s Email', 'custom-blue-orange'), $region_name),
            'section'  => 'region_selection_section',
            'type'     => 'email',
            'priority' => $priority_base + 1,
        ));

        // Region Address
        $wp_customize->add_setting("{$region}_address", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("{$region}_address", array(
            'label'    => sprintf(__('%s Address', 'custom-blue-orange'), $region_name),
            'section'  => 'region_selection_section',
            'type'     => 'textarea',
            'priority' => $priority_base + 2,
        ));
    }

    // Contact Information Section
    $wp_customize->add_section('contact_information_section', array(
        'title'    => __('Contact Information Section', 'custom-blue-orange'),
        'panel'    => 'header_customizer_panel',
        'priority' => 30,
    ));

    // Default Phone Number
    $wp_customize->add_setting('default_phone_number', array(
        'default'           => '+84 (028) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('default_phone_number', array(
        'label'    => __('Default Phone Number', 'custom-blue-orange'),
        'section'  => 'contact_information_section',
        'type'     => 'text',
        'priority' => 10,
    ));

    // Default Email Address
    $wp_customize->add_setting('default_email_address', array(
        'default'           => 'info@congtyban.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('default_email_address', array(
        'label'    => __('Default Email Address', 'custom-blue-orange'),
        'section'  => 'contact_information_section',
        'type'     => 'email',
        'priority' => 20,
    ));

    // Default Physical Address
    $wp_customize->add_setting('default_physical_address', array(
        'default'           => '123 Đường Kinh Doanh, Thành Phố, Tỉnh 12345',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('default_physical_address', array(
        'label'    => __('Default Physical Address', 'custom-blue-orange'),
        'section'  => 'contact_information_section',
        'type'     => 'textarea',
        'priority' => 30,
    ));
}
add_action('customize_register', 'header_customizer');

/**
 * Helper function to get customizer hero slides
 */
function get_customizer_hero_slides()
{
    $slides = array();

    for ($i = 1; $i <= 5; $i++) {
        $image = get_theme_mod("hero_slide_{$i}_image");
        $title = get_theme_mod("hero_slide_{$i}_title");
        $subtitle = get_theme_mod("hero_slide_{$i}_subtitle");
        $button_text = get_theme_mod("hero_slide_{$i}_button_text");
        $button_url = get_theme_mod("hero_slide_{$i}_button_url");

        if ($image || $title) {
            $slides[] = array(
                'image' => $image && function_exists('wp_get_attachment_url') ? wp_get_attachment_url($image) : '',
                'title' => $title,
                'subtitle' => $subtitle,
                'button_text' => $button_text,
                'button_url' => $button_url,
            );
        }
    }

    return $slides;
}

/**
 * Helper function to get sales contacts
 */
function get_sales_contacts()
{
    $contacts = array();
    $count = get_theme_mod('sales_contacts_count', 3);

    for ($i = 1; $i <= $count; $i++) {
        $name = get_theme_mod("sales_contact_{$i}_name");
        $phone = get_theme_mod("sales_contact_{$i}_phone");
        $avatar = get_theme_mod("sales_contact_{$i}_avatar");
        $position = get_theme_mod("sales_contact_{$i}_position");

        if ($name || $phone) {
            $contacts[] = array(
                'name' => $name,
                'phone' => $phone,
                'avatar' => $avatar && function_exists('wp_get_attachment_url') ? wp_get_attachment_url($avatar) : '',
                'position' => $position,
            );
        }
    }

    return $contacts;
}

/**
 * Helper function to get brand logos
 */
function get_brand_logos()
{
    $logos = array();

    for ($i = 1; $i <= 12; $i++) {
        $image = get_theme_mod("brand_logo_{$i}_image");
        $name = get_theme_mod("brand_logo_{$i}_name");
        $url = get_theme_mod("brand_logo_{$i}_url");

        if ($image || $name) {
            $logos[] = array(
                'image' => $image && function_exists('wp_get_attachment_url') ? wp_get_attachment_url($image) : '',
                'name' => $name,
                'url' => $url,
            );
        }
    }

    return $logos;
}

/**
 * Add Products Management to WordPress Customizer
 */
function products_management_customizer($wp_customize)
{
    // Add Products Section
    $wp_customize->add_section('products_section', array(
        'title' => __('Products Management', 'skylightpoly'),
        'priority' => 50,
        'description' => __('Manage product categories and products for the products page', 'skylightpoly'),
    ));

    // Product Categories
    $wp_customize->add_setting('product_categories', array(
        'default' => json_encode(array(
            array('name' => 'Tấm Lợp Lấy Sáng', 'slug' => 'tam-lop-lay-sang'),
            array('name' => 'Tấm Polycarbonate', 'slug' => 'tam-polycarbonate'),
            array('name' => 'Tấm Nhựa Thông Minh', 'slug' => 'tam-nhua-thong-minh'),
            array('name' => 'Phụ Kiện', 'slug' => 'phu-kien')
        )),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('product_categories', array(
        'label' => __('Product Categories (JSON format)', 'skylightpoly'),
        'description' => __('Format: [{"name":"Category Name","slug":"category-slug"}]', 'skylightpoly'),
        'section' => 'products_section',
        'type' => 'textarea',
        'input_attrs' => array(
            'rows' => 5
        )
    ));

    // Products Data
    $wp_customize->add_setting('products_data', array(
        'default' => json_encode(array(
            array(
                'title' => 'Tấm Lợp Lấy Sáng Polycarbonate',
                'description' => 'Tấm lợp lấy sáng chất lượng cao, chống tia UV, độ bền vượt trội.',
                'price' => '150,000 VNĐ/m²',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-1.jpg' : '',
                'category' => 'tam-lop-lay-sang',
                'badge' => 'Bán Chạy'
            ),
            array(
                'title' => 'Tấm Polycarbonate Rỗng',
                'description' => 'Tấm polycarbonate rỗng cách nhiệt tốt, tiết kiệm năng lượng.',
                'price' => '200,000 VNĐ/m²',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-2.jpg' : '',
                'category' => 'tam-polycarbonate',
                'badge' => 'Mới'
            ),
            array(
                'title' => 'Tấm Nhựa Thông Minh PVC',
                'description' => 'Tấm nhựa thông minh chống thấm, chống mối mọt.',
                'price' => '120,000 VNĐ/m²',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-3.jpg' : '',
                'category' => 'tam-nhua-thong-minh',
                'badge' => 'Khuyến Mãi'
            ),
            array(
                'title' => 'Phụ Kiện Lắp Đặt',
                'description' => 'Bộ phụ kiện lắp đặt hoàn chỉnh cho tấm lợp.',
                'price' => '50,000 VNĐ/bộ',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-4.jpg' : '',
                'category' => 'phu-kien',
                'badge' => ''
            )
        )),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('products_data', array(
        'label' => __('Products Data (JSON format)', 'skylightpoly'),
        'description' => __('Format: [{"title":"","description":"","price":"","image":"","category":"","badge":""}]', 'skylightpoly'),
        'section' => 'products_section',
        'type' => 'textarea',
        'input_attrs' => array(
            'rows' => 15
        )
    ));
}
add_action('customize_register', 'products_management_customizer');

/**
 * Helper function to get product categories
 */
function get_product_categories()
{
    $categories_json = get_theme_mod('product_categories', '');
    if (empty($categories_json)) {
        return array(
            array('name' => 'Tấm Lợp Lấy Sáng', 'slug' => 'tam-lop-lay-sang'),
            array('name' => 'Tấm Polycarbonate', 'slug' => 'tam-polycarbonate'),
            array('name' => 'Tấm Nhựa Thông Minh', 'slug' => 'tam-nhua-thong-minh'),
            array('name' => 'Phụ Kiện', 'slug' => 'phu-kien')
        );
    }
    
    $categories = json_decode($categories_json, true);
    return is_array($categories) ? $categories : array();
}

/**
 * Helper function to get products data
 */
function get_products_data()
{
    $products_json = get_theme_mod('products_data', '');
    if (empty($products_json)) {
        return array(
            array(
                'title' => 'Tấm Lợp Lấy Sáng Polycarbonate',
                'description' => 'Tấm lợp lấy sáng chất lượng cao, chống tia UV, độ bền vượt trội.',
                'price' => '150,000 VNĐ/m²',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-1.jpg' : '',
                'category' => 'tam-lop-lay-sang',
                'badge' => 'Bán Chạy'
            ),
            array(
                'title' => 'Tấm Polycarbonate Rỗng',
                'description' => 'Tấm polycarbonate rỗng cách nhiệt tốt, tiết kiệm năng lượng.',
                'price' => '200,000 VNĐ/m²',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-2.jpg' : '',
                'category' => 'tam-polycarbonate',
                'badge' => 'Mới'
            ),
            array(
                'title' => 'Tấm Nhựa Thông Minh PVC',
                'description' => 'Tấm nhựa thông minh chống thấm, chống mối mọt.',
                'price' => '120,000 VNĐ/m²',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-3.jpg' : '',
                'category' => 'tam-nhua-thong-minh',
                'badge' => 'Khuyến Mãi'
            ),
            array(
                'title' => 'Phụ Kiện Lắp Đặt',
                'description' => 'Bộ phụ kiện lắp đặt hoàn chỉnh cho tấm lợp.',
                'price' => '50,000 VNĐ/bộ',
                'image' => function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/assets/images/product-4.jpg' : '',
                 'category' => 'phu-kien',
                'badge' => ''
            )
        );
    }
    
    $products = json_decode($products_json, true);
    return is_array($products) ? $products : array();
}
