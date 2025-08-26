<?php

/**
 * Products Page Template - Simplified
 * 
 * This template displays products with:
 * - Left panel: Category list
 * - Right panel: Products of selected category
 * - Same styling as home page products section
 * - Customizer options support
 */

get_header(); ?>

<?php
// Get products page customizer settings (same as home page)
$products_bg_color = get_theme_mod('products_section_bg_color', '#ffffff');
$products_text_color = get_theme_mod('products_section_text_color', '#333333');
$products_layout = get_theme_mod('products_grid_layout', 'grid');

// Get current category filter
$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
?>

<main id="main" class="site-main products-page" style="background-color: <?php echo esc_attr($products_bg_color); ?>; color: <?php echo esc_attr($products_text_color); ?>;">
    <div class="container">

        <!-- Products Layout -->
        <div class="products-layout-wrapper">
            <!-- Left Panel - Categories -->
            <aside class="categories-panel">
                <h3 class="panel-title">Danh Mục Sản Phẩm</h3>
                <ul class="category-list">
                    <?php
                    // Get categories from customizer
                    $categories = function_exists('get_product_categories') ? get_product_categories() : array();

                    if (!empty($categories)) :
                        foreach ($categories as $category) :
                    ?>
                            <li class="category-item <?php echo ($current_category === $category['slug']) ? 'active' : ''; ?>">
                                <a href="?category=<?php echo esc_attr($category['slug']); ?>" class="category-link">
                                    <?php echo esc_html($category['name']); ?>
                                </a>
                            </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </aside>

            <!-- Right Panel - Products -->
            <div class="products-panel">
                <?php
                // Get products data
                $grouped_products = function_exists('get_products_by_categories') ? get_products_by_categories() : array();

                if (!empty($current_category)) :
                    // Show products for selected category
                    $category_products = array();
                    $category_name = '';

                    foreach ($grouped_products as $category_data) {
                        if ($category_data['category']->slug === $current_category) {
                            $category_products = $category_data['products'];
                            $category_name = $category_data['category']->name;
                            break;
                        }
                    }

                    if (!empty($category_products)) :
                ?>
                        <div class="category-products-section">
                            <div class="category-header">
                                <h3 class="category-title"><?php echo esc_html($category_name); ?></h3>
                                <div class="category-line"></div>
                            </div>

                            <div class="products-grid layout-<?php echo esc_attr($products_layout); ?>">
                                <?php foreach ($category_products as $product) : ?>
                                    <div class="product-card vertical-card">
                                        <?php
                                        // Determine which badge to show
                                        $badge_text = '';
                                        $badge_class = '';

                                        if (!empty($product['custom_badge'])) {
                                            $badge_text = $product['custom_badge'];
                                            $badge_class = 'custom-badge';
                                        } elseif (!empty($product['discount']) && $product['discount'] > 0) {
                                            $badge_text = '-' . $product['discount'] . '%';
                                            $badge_class = 'discount-badge';
                                        } elseif (!empty($product['hot_tag'])) {
                                            $badge_text = 'HOT';
                                            $badge_class = 'hot-badge';
                                        }
                                        ?>

                                        <div class="product-image">
                                            <?php if (!empty($product['image_url'])) : ?>
                                                <img src="<?php echo esc_url($product['image_url']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                                            <?php else : ?>
                                                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="<?php echo esc_attr($product['title']); ?>">
                                            <?php endif; ?>

                                            <?php if (!empty($badge_text)) : ?>
                                                <span class="product-badge <?php echo esc_attr($badge_class); ?>"><?php echo esc_html($badge_text); ?></span>
                                            <?php endif; ?>

                                            <div class="product-overlay">
                                                <?php if (!empty($product['link'])) : ?>
                                                    <a href="<?php echo esc_url($product['link']); ?>" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                <?php else : ?>
                                                    <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="product-content">
                                            <h4 class="product-title"><?php echo esc_html($product['title']); ?></h4>
                                            <p class="product-excerpt"><?php echo esc_html($product['content']); ?></p>

                                            <?php if (!empty($product['price']) || !empty($product['discount_price'])) : ?>
                                                <div class="product-pricing">
                                                    <?php if (!empty($product['discount_price'])) : ?>
                                                        <span class="original-price"><?php echo esc_html($product['price']); ?></span>
                                                        <span class="current-price"><?php echo esc_html($product['discount_price']); ?></span>
                                                    <?php else : ?>
                                                        <span class="current-price"><?php echo esc_html($product['price']); ?></span>
                                                    <?php endif; ?>
                                                    <?php if (!empty($product['unit'])) : ?>
                                                        <span class="price-unit">/<?php echo esc_html($product['unit']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php
                    else :
                    ?>
                        <div class="no-products-found">
                            <h3>Không có sản phẩm</h3>
                            <p>Danh mục này hiện chưa có sản phẩm nào.</p>
                        </div>
                        <?php
                    endif;
                else :
                    // Show all products grouped by categories
                    if (!empty($grouped_products)) :
                        foreach ($grouped_products as $category_data) :
                        ?>
                            <div class="product-category-section">
                                <div class="category-header">
                                    <h3 class="category-title"><?php echo esc_html($category_data['category']->name); ?></h3>
                                    <div class="category-line"></div>
                                </div>

                                <div class="products-grid layout-<?php echo esc_attr($products_layout); ?>">
                                    <?php foreach (array_slice($category_data['products'], 0, 6) as $product) : ?>
                                        <div class="product-card vertical-card">
                                            <?php
                                            // Determine which badge to show
                                            $badge_text = '';
                                            $badge_class = '';

                                            if (!empty($product['custom_badge'])) {
                                                $badge_text = $product['custom_badge'];
                                                $badge_class = 'custom-badge';
                                            } elseif (!empty($product['discount']) && $product['discount'] > 0) {
                                                $badge_text = '-' . $product['discount'] . '%';
                                                $badge_class = 'discount-badge';
                                            } elseif (!empty($product['hot_tag'])) {
                                                $badge_text = 'HOT';
                                                $badge_class = 'hot-badge';
                                            }
                                            ?>

                                            <div class="product-image">
                                                <?php if (!empty($product['image_url'])) : ?>
                                                    <img src="<?php echo esc_url($product['image_url']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                                                <?php else : ?>
                                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="<?php echo esc_attr($product['title']); ?>">
                                                <?php endif; ?>

                                                <?php if (!empty($badge_text)) : ?>
                                                    <span class="product-badge <?php echo esc_attr($badge_class); ?>"><?php echo esc_html($badge_text); ?></span>
                                                <?php endif; ?>

                                                <div class="product-overlay">
                                                    <?php if (!empty($product['link'])) : ?>
                                                        <a href="<?php echo esc_url($product['link']); ?>" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                    <?php else : ?>
                                                        <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="product-content">
                                                <h4 class="product-title"><?php echo esc_html($product['title']); ?></h4>
                                                <p class="product-excerpt"><?php echo esc_html($product['content']); ?></p>

                                                <?php if (!empty($product['price']) || !empty($product['discount_price'])) : ?>
                                                    <div class="product-pricing">
                                                        <?php if (!empty($product['discount_price'])) : ?>
                                                            <span class="original-price"><?php echo esc_html($product['price']); ?></span>
                                                            <span class="current-price"><?php echo esc_html($product['discount_price']); ?></span>
                                                        <?php else : ?>
                                                            <span class="current-price"><?php echo esc_html($product['price']); ?></span>
                                                        <?php endif; ?>
                                                        <?php if (!empty($product['unit'])) : ?>
                                                            <span class="price-unit">/<?php echo esc_html($product['unit']); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="category-footer">
                                    <a href="?category=<?php echo esc_attr($category_data['category']->slug); ?>" class="btn btn-outline-primary btn-see-all">
                                        <?php _e('Xem tất cả sản phẩm', 'custom-blue-orange'); ?>
                                    </a>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        // Demo products when no data available
                        $default_unit = get_theme_mod('products_default_unit', 'đơn vị');
                        $demo_unit_text = '/' . $default_unit;
                        $currency_symbol = get_theme_mod('products_currency_symbol', 'đ');
                        ?>
                        <div class="products-grid layout-<?php echo esc_attr($products_layout); ?>">
                            <div class="product-card vertical-card">
                                <div class="product-image">
                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 1">
                                    <div class="product-overlay">
                                        <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h4 class="product-title">Sản Phẩm Demo 1</h4>
                                    <p class="product-excerpt">Mô tả sản phẩm demo để hiển thị khi chưa có dữ liệu từ customizer.</p>
                                    <div class="product-pricing">
                                        <span class="current-price">1.500.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
</main>

<style>
    /* Products Page Layout */
    .products-layout-wrapper {
        display: flex;
        gap: 30px;
        margin-top: 40px;
    }

    /* Left Panel - Categories */
    .categories-panel {
        flex: 0 0 250px;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 4px;
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .categories-panel .panel-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
        border-bottom: 2px solid #007cba;
        padding-bottom: 8px;
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-item {
        margin-bottom: 8px;
    }

    .category-link {
        display: block;
        padding: 10px 15px;
        color: #666;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .category-link:hover,
    .category-item.active .category-link {
        background: #007cba;
        color: white;
        text-decoration: none;
    }

    /* Right Panel - Products */
    .products-panel {
        flex: 1;
    }

    /* No products found */
    .no-products-found {
        text-align: center;
        padding: 60px 20px;
        background: #f8f9fa;
        border-radius: 4px;
    }

    .no-products-found h3 {
        color: #666;
        margin-bottom: 10px;
    }

    .no-products-found p {
        color: #888;
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .products-layout-wrapper {
            flex-direction: column;
            gap: 20px;
        }

        .categories-panel {
            flex: none;
            position: static;
        }

        .categories-panel .panel-title {
            font-size: 16px;
        }

        .category-link {
            font-size: 13px;
            padding: 8px 12px;
        }
    }
</style>

<?php get_footer(); ?>