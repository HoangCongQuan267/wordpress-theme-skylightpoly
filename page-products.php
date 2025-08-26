<?php

/**
 * Products Page Template
 * 
 * This template displays all products organized by categories with:
 * - Category filtering
 * - Product grid layout
 * - Search functionality
 * - Pagination
 */

get_header(); ?>

<?php
// Get products page customizer settings
$products_bg_color = get_theme_mod('products_page_bg_color', '#ffffff');
$products_text_color = get_theme_mod('products_page_text_color', '#333333');
$products_layout = get_theme_mod('products_page_layout', 'grid');
$products_per_page = get_theme_mod('products_per_page', 12);

// Get current category filter
$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$search_query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
?>

<main id="main" class="site-main products-page" style="background-color: <?php echo esc_attr($products_bg_color); ?>; color: <?php echo esc_attr($products_text_color); ?>;">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title"><?php echo esc_html(get_theme_mod('products_page_title', 'Tất Cả Sản Phẩm')); ?></h1>
            <div class="title-ribbon">
                <div class="ribbon-line"></div>
                <div class="ribbon-diamond"></div>
                <div class="ribbon-line"></div>
            </div>
            <p class="page-subtitle"><?php echo esc_html(get_theme_mod('products_page_subtitle', 'Khám phá toàn bộ danh mục sản phẩm và dịch vụ của chúng tôi')); ?></p>
        </div>

        <!-- Products Layout with Sidebar -->
        <div class="products-layout">
            <!-- Left Sidebar - Categories -->
            <aside class="products-sidebar">
                <div class="sidebar-content">
                    <!-- Search Filter -->
                    <div class="search-filter">
                        <h3>Tìm kiếm</h3>
                        <input type="text" id="product-search" placeholder="Tìm kiếm sản phẩm..." value="<?php echo esc_attr($search_query); ?>" onkeyup="searchProducts(event)">
                    </div>

                    <!-- Categories Filter -->
                    <div class="categories-filter">
                        <h3>Danh mục sản phẩm</h3>
                        <ul class="category-list">
                            <li class="category-item <?php echo empty($current_category) ? 'active' : ''; ?>">
                                <a href="?" class="category-link">Tất cả sản phẩm</a>
                            </li>
                            <?php
                            // Get all product categories
                            $categories = array();
                            if (function_exists('get_terms') && function_exists('is_wp_error')) {
                                $categories = get_terms(array(
                                    'taxonomy' => 'product_category',
                                    'hide_empty' => false,
                                ));

                                // Check for errors
                                if (is_wp_error($categories)) {
                                    $categories = array();
                                }
                            }

                            if (!empty($categories)) :
                                foreach ($categories as $category) :
                            ?>
                                    <li class="category-item <?php echo ($current_category === $category->slug) ? 'active' : ''; ?>">
                                        <a href="?category=<?php echo esc_attr($category->slug); ?>" class="category-link">
                                            <?php echo esc_html($category->name); ?>
                                            <span class="category-count">(<?php echo $category->count; ?>)</span>
                                        </a>
                                    </li>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>

                    <!-- Layout Toggle -->
                    <div class="layout-toggle">
                        <h3>Hiển thị</h3>
                        <div class="toggle-buttons">
                            <button class="layout-btn grid-btn active" onclick="toggleLayout('grid')" title="Lưới">
                                <span class="dashicons dashicons-grid-view"></span>
                                Lưới
                            </button>
                            <button class="layout-btn list-btn" onclick="toggleLayout('list')" title="Danh sách">
                                <span class="dashicons dashicons-list-view"></span>
                                Danh sách
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Panel - Products -->
            <div class="products-main">

                <!-- Products Display -->
                <div class="products-container layout-<?php echo esc_attr($products_layout); ?>" id="products-container">
                    <?php
                    // Get products grouped by categories or filtered
                    if (!empty($current_category) || !empty($search_query)) :
                        // Filtered products
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => $products_per_page,
                            'post_status' => 'publish',
                        );

                        if (!empty($current_category)) {
                            $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'product_category',
                                    'field' => 'slug',
                                    'terms' => $current_category,
                                ),
                            );
                        }

                        if (!empty($search_query)) {
                            $args['s'] = $search_query;
                        }

                        $products_query = new WP_Query($args);

                        if ($products_query->have_posts()) :
                    ?>
                            <div class="products-grid">
                                <?php while ($products_query->have_posts()) : $products_query->the_post(); ?>
                                    <?php
                                    $template_path = 'template-parts/product-card.php';
                                    $template_file = '';

                                    if (function_exists('locate_template')) {
                                        $template_file = locate_template($template_path);
                                    }
                                    if (empty($template_file) && function_exists('get_template_directory')) {
                                        $template_file = get_template_directory() . '/' . $template_path;
                                    }
                                    if (empty($template_file)) {
                                        // Final fallback: construct path manually
                                        $template_file = dirname(__FILE__) . '/' . $template_path;
                                    }

                                    if ($template_file && file_exists($template_file)) {
                                        include($template_file);
                                    } else {
                                        // Inline fallback if template not found
                                        $title = function_exists('get_the_title') ? get_the_title() : 'Product';
                                        $excerpt = function_exists('get_the_excerpt') ? get_the_excerpt() : 'Product description';
                                        echo '<div class="product-card"><h4>' . esc_html($title) . '</h4><p>' . esc_html($excerpt) . '</p></div>';
                                    }
                                    ?>
                                <?php endwhile; ?>
                            </div>

                            <!-- Pagination -->
                            <div class="products-pagination">
                                <?php
                                $max_pages = 1;
                                if (isset($products_query) && is_object($products_query) && property_exists($products_query, 'max_num_pages')) {
                                    $max_pages = $products_query->max_num_pages;
                                }

                                if (function_exists('paginate_links') && $max_pages > 1) {
                                    $current_page = 1;
                                    if (function_exists('get_query_var')) {
                                        $current_page = max(1, get_query_var('paged'));
                                    } elseif (isset($_GET['paged'])) {
                                        $current_page = max(1, intval($_GET['paged']));
                                    }

                                    $pagination_args = array(
                                        'total' => $max_pages,
                                        'current' => $current_page,
                                        'format' => '?paged=%#%',
                                        'show_all' => false,
                                        'end_size' => 1,
                                        'mid_size' => 2,
                                        'prev_next' => true,
                                        'prev_text' => '« Trước',
                                        'next_text' => 'Sau »',
                                        'add_args' => array(
                                            'category' => $current_category,
                                            'search' => $search_query,
                                        ),
                                    );

                                    $pagination_links = paginate_links($pagination_args);
                                    if ($pagination_links) {
                                        echo $pagination_links;
                                    }
                                }
                                ?>
                            </div>
                        <?php
                        else :
                        ?>
                            <div class="no-products-found">
                                <h3>Không tìm thấy sản phẩm</h3>
                                <p>Không có sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.</p>
                                <?php
                                $all_products_url = '#';
                                if (function_exists('remove_query_arg')) {
                                    $all_products_url = remove_query_arg(array('category', 'search'));
                                } elseif (isset($_SERVER['REQUEST_URI'])) {
                                    // Fallback: remove query parameters manually
                                    $all_products_url = strtok($_SERVER['REQUEST_URI'], '?');
                                }
                                ?>
                                <a href="<?php echo esc_url($all_products_url); ?>" class="btn btn-primary">Xem tất cả sản phẩm</a>
                            </div>
                            <?php
                        endif;
                        wp_reset_postdata();
                    else :
                        // All products grouped by categories
                        $grouped_products = function_exists('get_products_by_categories') ? get_products_by_categories() : array();

                        if (!empty($grouped_products)) :
                            foreach ($grouped_products as $category_data) :
                            ?>
                                <div class="product-category-section">
                                    <!-- Category Header -->
                                    <div class="category-header">
                                        <h2 class="category-title"><?php echo esc_html($category_data['category']['title']); ?></h2>
                                        <div class="category-line"></div>
                                        <a href="?category=<?php echo esc_attr($category_data['category']['slug']); ?>" class="view-category-link">Xem tất cả</a>
                                    </div>

                                    <!-- Products Grid for this Category -->
                                    <div class="products-grid">
                                        <?php foreach (array_slice($category_data['products'], 0, 6) as $product) : ?>
                                            <div class="product-card horizontal-card">
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

                                                <?php if (!empty($badge_text)) : ?>
                                                    <div class="product-badge <?php echo esc_attr($badge_class); ?>">
                                                        <?php echo esc_html($badge_text); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="product-content">
                                                    <h4 class="product-title"><?php echo esc_html($product['title']); ?></h4>
                                                    <p class="product-excerpt"><?php echo esc_html(wp_trim_words($product['content'], 15)); ?></p>

                                                    <?php if (!empty($product['price']) || !empty($product['discount_price'])) : ?>
                                                        <div class="product-pricing">
                                                            <?php
                                                            $unit_text = !empty($product['unit']) ? '/' . $product['unit'] : '/đơn vị';
                                                            $currency_symbol = function_exists('get_theme_mod') ? get_theme_mod('products_currency_symbol', 'đ') : 'đ';
                                                            ?>
                                                            <?php if (!empty($product['discount_price']) && !empty($product['price'])) : ?>
                                                                <span class="original-price"><?php echo number_format($product['price'], 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                                                                <span class="discount-price"><?php echo number_format($product['discount_price'], 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                                                            <?php elseif (!empty($product['price'])) : ?>
                                                                <span class="current-price"><?php echo number_format($product['price'], 0, ',', '.'); ?><?php echo esc_html($currency_symbol); ?><?php echo esc_html($unit_text); ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if (!empty($product['image_url'])) : ?>
                                                    <div class="product-image">
                                                        <img src="<?php echo esc_url($product['image_url']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="product-overlay">
                                                    <?php if (!empty($product['link'])) : ?>
                                                        <a href="<?php echo esc_url($product['link']); ?>" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                    <?php else : ?>
                                                        <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Show More Button -->
                                    <?php if (count($category_data['products']) > 6) : ?>
                                        <div class="category-footer">
                                            <a href="?category=<?php echo esc_attr($category_data['category']['slug']); ?>" class="btn btn-outline-primary btn-see-all">
                                                Xem thêm <?php echo count($category_data['products']) - 6; ?> sản phẩm
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php
                            endforeach;
                        else :
                            // Get categories and products from customizer
                            $categories = function_exists('get_product_categories') ? get_product_categories() : array();
                            $products = function_exists('get_products_data') ? get_products_data() : array();

                            // Add count to categories
                            $demo_categories = array();
                            foreach ($categories as $category) {
                                $count = 0;
                                foreach ($products as $product) {
                                    if (isset($product['category']) && $product['category'] === $category['slug']) {
                                        $count++;
                                    }
                                }
                                $demo_categories[] = array(
                                    'name' => $category['name'],
                                    'slug' => $category['slug'],
                                    'count' => $count
                                );
                            }

                            // Prepare products data
                            $demo_products = array();
                            foreach ($products as $product) {
                                $demo_products[] = array(
                                    'title' => isset($product['title']) ? $product['title'] : '',
                                    'excerpt' => isset($product['description']) ? $product['description'] : '',
                                    'price' => isset($product['price']) ? $product['price'] : '',
                                    'image' => isset($product['image']) ? $product['image'] : '',
                                    'category' => isset($product['category']) ? $product['category'] : '',
                                    'badge' => isset($product['badge']) ? $product['badge'] : ''
                                );
                            }

                            // Demo products when no products are available
                            $currency_symbol = function_exists('get_theme_mod') ? get_theme_mod('products_currency_symbol', 'đ') : 'đ';
                            $default_unit = function_exists('get_theme_mod') ? get_theme_mod('products_default_unit', 'đơn vị') : 'đơn vị';
                            $demo_unit_text = '/' . $default_unit;
                            ?>
                            <div class="no-products-message">
                                <h3>Chưa có sản phẩm nào</h3>
                                <p>Hiện tại chưa có sản phẩm nào được thêm vào hệ thống.</p>
                                <a href="<?php echo function_exists('admin_url') ? admin_url('post-new.php?post_type=product') : '#'; ?>" class="btn btn-primary">Thêm sản phẩm đầu tiên</a>
                            </div>

                            <!-- Demo Products Grid -->
                            <div class="products-grid demo-products">
                                <div class="product-card horizontal-card">
                                    <div class="product-badge discount-badge">-20%</div>
                                    <div class="product-content">
                                        <h4 class="product-title">Sản Phẩm Demo A</h4>
                                        <p class="product-excerpt">Đây là mô tả ngắn cho sản phẩm demo. Sản phẩm chất lượng cao với tính năng ưu việt.</p>
                                        <div class="product-pricing">
                                            <span class="original-price">2.500.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                            <span class="discount-price">1.999.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Demo Product A">
                                    </div>
                                    <div class="product-overlay">
                                        <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                    </div>
                                </div>

                                <div class="product-card horizontal-card">
                                    <div class="product-badge hot-badge">HOT</div>
                                    <div class="product-content">
                                        <h4 class="product-title">Sản Phẩm Demo B</h4>
                                        <p class="product-excerpt">Sản phẩm bán chạy nhất với công nghệ tiên tiến và thiết kế hiện đại.</p>
                                        <div class="product-pricing">
                                            <span class="current-price">3.200.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Demo Product B">
                                    </div>
                                    <div class="product-overlay">
                                        <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                    </div>
                                </div>

                                <div class="product-card horizontal-card">
                                    <div class="product-content">
                                        <h4 class="product-title">Sản Phẩm Demo C</h4>
                                        <p class="product-excerpt">Giải pháp tối ưu cho doanh nghiệp với hiệu suất cao và độ bền vượt trội.</p>
                                        <div class="product-pricing">
                                            <span class="current-price">1.850.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Demo Product C">
                                    </div>
                                    <div class="product-overlay">
                                        <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
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
    </div>
</main>

<script>
    function filterProducts() {
        const categorySelect = document.getElementById('category-select');
        const searchInput = document.getElementById('product-search');
        const category = categorySelect.value;
        const search = searchInput.value;

        let url = new URL(window.location);

        if (category) {
            url.searchParams.set('category', category);
        } else {
            url.searchParams.delete('category');
        }

        if (search) {
            url.searchParams.set('search', search);
        } else {
            url.searchParams.delete('search');
        }

        window.location.href = url.toString();
    }

    function searchProducts(event) {
        if (event.key === 'Enter') {
            filterProducts();
        }
    }

    function toggleLayout(layout) {
        const container = document.getElementById('products-container');
        const gridBtn = document.querySelector('.grid-btn');
        const listBtn = document.querySelector('.list-btn');

        container.className = container.className.replace(/layout-\w+/, 'layout-' + layout);

        if (layout === 'grid') {
            gridBtn.classList.add('active');
            listBtn.classList.remove('active');
        } else {
            listBtn.classList.add('active');
            gridBtn.classList.remove('active');
        }
    }
</script>

<style>
    .products-page {
        padding: 2rem 0;
    }

    .page-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .page-title {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #2154fe;
    }

    .title-ribbon {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1rem 0;
    }

    .ribbon-line {
        width: 50px;
        height: 2px;
        background: #2154fe;
    }

    .ribbon-diamond {
        width: 12px;
        height: 12px;
        background: #2154fe;
        transform: rotate(45deg);
        margin: 0 1rem;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .products-filters {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .filters-row {
        display: flex;
        gap: 2rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .category-filter,
    .search-filter {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .category-filter label,
    .search-filter label {
        font-weight: 600;
        color: #333;
    }

    .category-filter select,
    .search-filter input {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        min-width: 200px;
    }

    .layout-toggle {
        margin-left: auto;
        display: flex;
        gap: 0.5rem;
    }

    .layout-btn {
        padding: 0.5rem;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .layout-btn.active {
        background: #2154fe;
        color: white;
        border-color: #2154fe;
    }

    .layout-btn:hover {
        background: #f0f0f0;
    }

    .layout-btn.active:hover {
        background: #1a44d1;
    }

    .products-container.layout-list .products-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .products-container.layout-list .product-card {
        display: flex;
        max-width: none;
        width: 100%;
    }

    .category-header {
        display: flex;
        align-items: center;
        margin: 2rem 0 1rem 0;
        gap: 1rem;
    }

    .category-title {
        font-size: 1.5rem;
        color: #2154fe;
        margin: 0;
        white-space: nowrap;
    }

    .category-line {
        flex: 1;
        height: 2px;
        background: linear-gradient(to right, #2154fe, transparent);
    }

    .view-category-link {
        color: #2154fe;
        text-decoration: none;
        font-weight: 600;
        white-space: nowrap;
    }

    .view-category-link:hover {
        text-decoration: underline;
    }

    .no-products-found,
    .no-products-message {
        text-align: center;
        padding: 3rem;
        background: #f8f9fa;
        border-radius: 8px;
        margin: 2rem 0;
    }

    .no-products-found h3,
    .no-products-message h3 {
        color: #666;
        margin-bottom: 1rem;
    }

    .products-pagination {
        margin-top: 3rem;
        text-align: center;
    }

    .products-pagination .page-numbers {
        display: inline-block;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border: 1px solid #ddd;
        color: #2154fe;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .products-pagination .page-numbers:hover,
    .products-pagination .page-numbers.current {
        background: #2154fe;
        color: white;
        border-color: #2154fe;
    }

    @media (max-width: 768px) {
        .filters-row {
            flex-direction: column;
            align-items: stretch;
        }

        .layout-toggle {
            margin-left: 0;
            justify-content: center;
        }

        .category-filter select,
        .search-filter input {
            min-width: auto;
            width: 100%;
        }

        .category-header {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }

        .category-line {
            width: 100px;
            margin: 0 auto;
        }
    }
</style>

<?php get_footer(); ?>