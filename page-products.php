<?php

/**
 * Products Page Template - WordPress Product Posts
 * 
 * This template displays products from WordPress product post type with:
 * - Left panel: Product category list
 * - Right panel: Products of selected category
 * - Single product page styling
 * - Based on published product posts
 */

get_header(); ?>

<?php
// Get products page customizer settings
$products_bg_color = get_theme_mod('products_section_bg_color', '#ffffff');
$products_text_color = get_theme_mod('products_section_text_color', '#333333');
$products_layout = get_theme_mod('products_grid_layout', 'grid');

// Get current category filter
$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// Get product categories
$product_categories = get_terms(array(
    'taxonomy' => 'product_category',
    'hide_empty' => false, // Show all categories, even empty ones
));

// Debug: Check if categories exist
// Uncomment the line below to debug
// var_dump($product_categories);

// Get products query
$products_args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
);

// Filter by category if selected
if (!empty($current_category)) {
    $products_args['tax_query'] = array(
        array(
            'taxonomy' => 'product_category',
            'field'    => 'slug',
            'terms'    => $current_category,
        ),
    );
}

$products_query = new WP_Query($products_args);
?>

<main id="main" class="site-main products-page" style="background-color: <?php echo esc_attr($products_bg_color); ?>; color: <?php echo esc_attr($products_text_color); ?>;">
    <div class="container">

        <!-- Products Layout -->
        <div class="products-layout-wrapper">
            <!-- Left Panel - Categories -->
            <aside class="categories-panel">
                <h3 class="panel-title">Danh Mục Sản Phẩm</h3>
                <ul class="category-list">
                    <!-- All Products Link -->
                    <li class="category-item <?php echo empty($current_category) ? 'active' : ''; ?>">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="category-link">
                            Tất cả sản phẩm
                        </a>
                    </li>
                    
                    <?php
                    // Debug: Show category information
                    // echo '<!-- Categories found: ' . count($product_categories) . ' -->';
                    
                    if (!empty($product_categories) && !is_wp_error($product_categories)) :
                        foreach ($product_categories as $category) :
                    ?>
                            <li class="category-item <?php echo ($current_category === $category->slug) ? 'active' : ''; ?>">
                                <a href="?category=<?php echo esc_attr($category->slug); ?>" class="category-link">
                                    <?php echo esc_html($category->name); ?>
                                    <span class="category-count">(<?php echo $category->count; ?>)</span>
                                </a>
                            </li>
                    <?php
                        endforeach;
                    else :
                        // Show message when no categories found
                        echo '<!-- No product categories found or error occurred -->';
                    endif;
                    ?>
                </ul>
            </aside>

            <!-- Right Panel - Products -->
            <div class="products-panel">
                <?php
                if ($products_query->have_posts()) :
                    // Get category name for display
                    $category_name = 'Tất cả sản phẩm';
                    if (!empty($current_category)) {
                        $current_term = get_term_by('slug', $current_category, 'product_category');
                        if ($current_term && !is_wp_error($current_term)) {
                            $category_name = $current_term->name;
                        }
                    }
                ?>
                        <div class="category-products-section">
                            <div class="category-header">
                                <h3 class="category-title"><?php echo esc_html($category_name); ?></h3>
                                <div class="category-line"></div>
                            </div>

                            <div class="products-grid layout-<?php echo esc_attr($products_layout); ?>">
                                <?php while ($products_query->have_posts()) : $products_query->the_post(); ?>
                                    <div class="product-card vertical-card">
                                        <?php
                                        // Get product meta data
                                        $custom_badge = get_post_meta(get_the_ID(), 'custom_badge', true);
                                        $discount = get_post_meta(get_the_ID(), 'discount', true);
                                        $hot_tag = get_post_meta(get_the_ID(), 'hot_tag', true);
                                        $product_price = get_post_meta(get_the_ID(), 'product_price', true);
                                        $discount_price = get_post_meta(get_the_ID(), 'discount_price', true);
                                        $price_unit = get_post_meta(get_the_ID(), 'price_unit', true);
                                        $product_link = get_post_meta(get_the_ID(), 'product_link', true);
                                        
                                        // Determine which badge to show
                                        $badge_text = '';
                                        $badge_class = '';

                                        if (!empty($custom_badge)) {
                                            $badge_text = $custom_badge;
                                            $badge_class = 'custom-badge';
                                        } elseif (!empty($discount) && $discount > 0) {
                                            $badge_text = '-' . $discount . '%';
                                            $badge_class = 'discount-badge';
                                        } elseif (!empty($hot_tag)) {
                                            $badge_text = 'HOT';
                                            $badge_class = 'hot-badge';
                                        }
                                        ?>

                                        <div class="product-image">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                                            <?php else : ?>
                                                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="<?php the_title_attribute(); ?>">
                                            <?php endif; ?>

                                            <?php if (!empty($badge_text)) : ?>
                                                <span class="product-badge <?php echo esc_attr($badge_class); ?>"><?php echo esc_html($badge_text); ?></span>
                                            <?php endif; ?>

                                            <div class="product-overlay">
                                                <?php if (!empty($product_link)) : ?>
                                                    <a href="<?php echo esc_url($product_link); ?>" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                <?php else : ?>
                                                    <a href="<?php the_permalink(); ?>" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="product-content">
                                            <h4 class="product-title"><?php the_title(); ?></h4>
                                            <p class="product-excerpt"><?php echo has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20); ?></p>

                                            <?php if (!empty($product_price) || !empty($discount_price)) : ?>
                                                <div class="product-pricing">
                                                    <?php if (!empty($discount_price)) : ?>
                                                        <span class="original-price"><?php echo esc_html($product_price); ?></span>
                                                        <span class="current-price"><?php echo esc_html($discount_price); ?></span>
                                                    <?php else : ?>
                                                        <span class="current-price"><?php echo esc_html($product_price); ?></span>
                                                    <?php endif; ?>
                                                    <?php if (!empty($price_unit)) : ?>
                                                        <span class="price-unit">/<?php echo esc_html($price_unit); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
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