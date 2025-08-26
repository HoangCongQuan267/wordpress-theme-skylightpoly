<?php

/**
 * Product Card Template Part
 * 
 * This template displays a single product card with:
 * - Product image on top
 * - Product info below (title, description, price)
 * - Product badges (discount, hot, custom)
 * - Hover overlay with link
 */

// Get product data from WordPress post or from array
if (isset($product) && is_array($product)) {
    // Using array data (for demo/custom products)
    $product_title = $product['title'];
    $product_content = $product['content'];
    $product_image = $product['image_url'] ?? '';
    $product_link = $product['link'] ?? '#';
    $product_price = $product['price'] ?? '';
    $product_discount_price = $product['discount_price'] ?? '';
    $product_unit = $product['unit'] ?? '';
    $product_custom_badge = $product['custom_badge'] ?? '';
    $product_discount = $product['discount'] ?? 0;
    $product_hot_tag = $product['hot_tag'] ?? false;
} else {
    // Using WordPress post data
    $product_title = get_the_title();
    $product_content = get_the_excerpt();
    $product_image = '';
    $product_link = get_permalink();
    $product_price = '';
    $product_discount_price = '';
    $product_unit = '';
    $product_custom_badge = '';
    $product_discount = 0;
    $product_hot_tag = false;

    // Get featured image
    if (function_exists('get_the_post_thumbnail_url')) {
        $product_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    }

    // Get meta fields if they exist
    if (function_exists('get_post_meta')) {
        $product_price = get_post_meta(get_the_ID(), '_product_price', true);
        $product_discount_price = get_post_meta(get_the_ID(), '_product_discount_price', true);
        $product_unit = get_post_meta(get_the_ID(), '_product_unit', true);
        $product_custom_badge = get_post_meta(get_the_ID(), '_product_custom_badge', true);
        $product_discount = get_post_meta(get_the_ID(), '_product_discount', true);
        $product_hot_tag = get_post_meta(get_the_ID(), '_product_hot_tag', true);
    }
}

// Determine which badge to show
$badge_text = '';
$badge_class = '';

if (!empty($product_custom_badge)) {
    $badge_text = $product_custom_badge;
    $badge_class = 'custom-badge';
} elseif (!empty($product_discount) && $product_discount > 0) {
    $badge_text = '-' . $product_discount . '%';
    $badge_class = 'discount-badge';
} elseif (!empty($product_hot_tag)) {
    $badge_text = 'HOT';
    $badge_class = 'hot-badge';
}
?>

<div class="product-card vertical-card">
    <?php if (!empty($badge_text)) : ?>
        <div class="product-badge <?php echo esc_attr($badge_class); ?>">
            <?php echo esc_html($badge_text); ?>
        </div>
    <?php endif; ?>

    <!-- Product Image on Top -->
    <div class="product-image">
        <?php if (!empty($product_image)) : ?>
            <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($product_title); ?>">
        <?php else : ?>
            <div class="product-image-placeholder">
                <span class="dashicons dashicons-format-image"></span>
            </div>
        <?php endif; ?>

        <div class="product-overlay">
            <a href="<?php echo esc_url($product_link); ?>" class="product-link-btn">Tìm Hiểu Thêm</a>
        </div>
    </div>

    <!-- Product Info Below -->
    <div class="product-content">
        <h4 class="product-title"><?php echo esc_html($product_title); ?></h4>
        <p class="product-excerpt"><?php echo esc_html(wp_trim_words($product_content, 15)); ?></p>

        <?php if (!empty($product_price) || !empty($product_discount_price)) : ?>
            <div class="product-pricing">
                <?php
                $unit_text = !empty($product_unit) ? '/' . $product_unit : '/đơn vị';
                $currency_symbol = get_theme_mod('products_currency_symbol', 'đ');
                ?>
                <?php if (!empty($product_discount_price) && !empty($product_price)) : ?>
                    <span class="original-price"><?php echo number_format($product_price, 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                    <span class="discount-price"><?php echo number_format($product_discount_price, 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                <?php elseif (!empty($product_price)) : ?>
                    <span class="current-price"><?php echo number_format($product_price, 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>