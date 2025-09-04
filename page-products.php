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

// Get current category filter (Vietnamese slug)
$current_category = isset($_GET['danh-muc']) ? sanitize_text_field($_GET['danh-muc']) : '';

// If no category is selected, auto-select the first category
if (empty($current_category)) {
    $product_categories = get_terms(array(
        'taxonomy' => 'product_category',
        'hide_empty' => false,
        'number' => 1,
        'orderby' => 'name',
        'order' => 'ASC'
    ));

    if (!empty($product_categories) && !is_wp_error($product_categories)) {
        $current_category = $product_categories[0]->slug;
    }
}

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
    'meta_query' => array(
        'relation' => 'OR',
        'order_clause' => array(
            'key' => 'product_order',
            'compare' => 'EXISTS',
            'type' => 'NUMERIC'
        ),
        'no_order_clause' => array(
            'key' => 'product_order',
            'compare' => 'NOT EXISTS'
        )
    ),
    'orderby' => array(
        'order_clause' => 'ASC',
        'no_order_clause' => 'ASC',
        'date' => 'DESC'
    )
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

    <!-- Structured Data for Products Page -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "CollectionPage",
            "name": "Sản Phẩm",
            "description": "Danh sách sản phẩm nhựa chất lượng cao từ Skylight Plastic",
            "url": "<?php echo esc_url(get_permalink()); ?>",
            "mainEntity": {
                "@type": "ItemList",
                "name": "Danh sách sản phẩm",
                "description": "Tổng hợp các sản phẩm nhựa chất lượng cao"
            },
            "breadcrumb": {
                "@type": "BreadcrumbList",
                "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Trang chủ",
                        "item": "<?php echo esc_url(home_url('/')); ?>"
                    },
                    {
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Sản Phẩm",
                        "item": "<?php echo esc_url(get_permalink()); ?>"
                    }
                ]
            }
        }
    </script>
    <div class="container">

        <!-- Products Layout -->
        <div class="products-layout-wrapper">
            <!-- Left Panel - Categories -->
            <aside class="categories-panel">
                <h3 class="panel-title">Danh Mục Sản Phẩm</h3>
                <ul class="category-list">
                    <?php
                    // Debug: Show category information
                    // echo '<!-- Categories found: ' . count($product_categories) . ' -->';

                    if (!empty($product_categories) && !is_wp_error($product_categories)) :
                        foreach ($product_categories as $category) :
                    ?>
                            <li class="category-item <?php echo ($current_category === $category->slug) ? 'active' : ''; ?>">
                                <a href="?danh-muc=<?php echo esc_attr($category->slug); ?>" class="category-link">
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
                    $category_name = 'TẤT CẢ SẢN PHẨM';
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

                        <div class="archive-products-grid layout-<?php echo esc_attr($products_layout); ?>">
                            <?php while ($products_query->have_posts()) : $products_query->the_post(); ?>
                                <?php
                                // Get product meta data
                                $custom_badge = get_post_meta(get_the_ID(), 'custom_badge', true);
                                $discount = get_post_meta(get_the_ID(), 'discount', true);
                                $hot_tag = get_post_meta(get_the_ID(), 'hot_tag', true);
                                $product_price = get_post_meta(get_the_ID(), 'product_price', true);
                                $discount_price = get_post_meta(get_the_ID(), 'discount_price', true);
                                $price_unit = get_post_meta(get_the_ID(), 'price_unit', true);
                                $product_link = get_post_meta(get_the_ID(), 'product_link', true);
                                $final_link = !empty($product_link) ? $product_link : get_permalink();

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
                                <a href="<?php echo esc_url($final_link); ?>" class="product-card-link">
                                    <div class="product-card vertical-card">
                                        <?php if (!empty($badge_text)) : ?>
                                            <div class="product-badge <?php echo esc_attr($badge_class); ?>">
                                                <?php echo esc_html($badge_text); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="product-image">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                                            <?php else : ?>
                                                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="<?php the_title_attribute(); ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="product-content">
                                            <h4 class="product-title"><?php the_title(); ?></h4>


                                            <?php if (!empty($product_price) || !empty($discount_price)) : ?>
                                                <div class="product-pricing">
                                                    <?php
                                                    $unit_text = !empty($price_unit) ? '/' . $price_unit : '/đơn vị';
                                                    $currency_symbol = get_theme_mod('products_currency_symbol', 'đ');
                                                    ?>
                                                    <?php if (!empty($discount_price) && !empty($product_price)) : ?>
                                                        <span class="original-price"><?php echo number_format($product_price, 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                                                        <span class="discount-price"><?php echo number_format($discount_price, 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                                                    <?php elseif (!empty($product_price)) : ?>
                                                        <span class="current-price"><?php echo number_format($product_price, 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
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



<?php get_footer(); ?>