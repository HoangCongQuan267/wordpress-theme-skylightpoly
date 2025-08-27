<?php

/**
 * Single Product Template
 * 
 * This template displays individual product posts with:
 * - Clean, minimal design similar to single.php
 * - Product image, title, content
 * - Product meta information (price, category)
 * - Related products section
 */

get_header(); ?>

<main id="main" class="site-main single-product">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <!-- Breadcrumbs -->
            <nav class="breadcrumbs">
                <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
                <span class="breadcrumb-separator">›</span>
                <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Sản phẩm</a>
                <span class="breadcrumb-separator">›</span>
                <span class="current-page"><?php the_title(); ?></span>
            </nav>

            <article id="post-<?php the_ID(); ?>" <?php post_class('product-article'); ?>>
                
                <!-- Product Header -->
                <header class="product-header">
                    <h1 class="product-title"><?php the_title(); ?></h1>
                    <div class="product-meta">
                        <span class="product-date"><?php echo get_the_date(); ?></span>
                        <?php
                        $product_categories = get_the_terms(get_the_ID(), 'product_category');
                        if ($product_categories && !is_wp_error($product_categories)) :
                        ?>
                            <span class="meta-separator">•</span>
                            <span class="product-category">
                                <?php
                                $category_names = array();
                                foreach ($product_categories as $category) {
                                    $category_names[] = $category->name;
                                }
                                echo esc_html(implode(', ', $category_names));
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- Product Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="product-featured-image">
                        <?php the_post_thumbnail('large', array('class' => 'product-image')); ?>
                    </div>
                <?php endif; ?>

                <!-- Product Content -->
                <div class="product-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'skylightpoly'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <!-- Product Meta Information -->
                <div class="product-meta-info">
                    <?php
                    $product_price = get_post_meta(get_the_ID(), 'product_price', true);
                    $product_unit = get_post_meta(get_the_ID(), 'product_unit', true);
                    $product_link = get_post_meta(get_the_ID(), 'product_link', true);
                    
                    if ($product_price) :
                    ?>
                        <div class="product-pricing">
                            <span class="price-label">Giá:</span>
                            <span class="product-price"><?php echo esc_html($product_price); ?></span>
                            <?php if ($product_unit) : ?>
                                <span class="price-unit">/ <?php echo esc_html($product_unit); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($product_link) : ?>
                        <div class="product-link">
                            <a href="<?php echo esc_url($product_link); ?>" class="product-external-link" target="_blank" rel="noopener">
                                Xem thêm thông tin
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Footer -->
                <footer class="product-footer">
                    <div class="related-products">
                        <h3>Sản phẩm liên quan</h3>
                        <?php
                        $related_products = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 3,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'rand'
                        ));
                        
                        if ($related_products->have_posts()) :
                        ?>
                            <ul class="related-products-list">
                                <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <span class="product-date"><?php echo get_the_date(); ?></span>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php
                        else :
                        ?>
                            <p>Không có sản phẩm liên quan.</p>
                        <?php
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </footer>

            </article>

        <?php endwhile; ?>
    </div>
</main>

<style>
    /* Single Product Styling - Based on single.php */
    .single-product {
        padding: 40px 0;
        background-color: #ffffff;
    }

    .single-product .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .single-product .product-article {
        background: #ffffff;
        border-radius: 0;
        box-shadow: none;
        border: none;
        padding: 0;
    }

    .single-product .product-header {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .single-product .product-title {
        font-size: 1.5rem;
        color: #1a1a1a;
        margin: 0 0 10px 0;
        font-weight: 600;
        line-height: 1.3;
    }

    .single-product .product-meta {
        font-size: 0.875rem;
        color: #888888;
        margin: 0;
    }

    .single-product .meta-separator {
        margin: 0 8px;
        color: #cccccc;
    }

    .single-product .product-featured-image {
        margin: 20px 0;
        text-align: center;
    }

    .single-product .product-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .single-product .product-content {
        margin: 30px 0;
        line-height: 1.6;
        font-size: 1rem;
    }

    .single-product .product-content h1,
    .single-product .product-content h2,
    .single-product .product-content h3,
    .single-product .product-content h4,
    .single-product .product-content h5,
    .single-product .product-content h6 {
        color: #1a1a1a;
        margin: 20px 0 10px 0;
        font-weight: 600;
        border: none;
        background: none;
        padding: 0;
    }

    .single-product .product-content h2 {
        font-size: 1.25rem;
    }

    .single-product .product-content h3 {
        font-size: 1.125rem;
    }

    .single-product .product-content h4 {
        font-size: 1rem;
    }

    .single-product .product-content p {
        margin-bottom: 16px;
        color: #333333;
    }

    .single-product .product-content blockquote {
        margin: 20px 0;
        padding: 0 20px;
        color: #666666;
        font-style: italic;
        border: none;
        background: none;
        border-radius: 0;
    }

    .single-product .product-content ul,
    .single-product .product-content ol {
        margin-bottom: 16px;
        padding-left: 20px;
    }

    .single-product .product-content li {
        margin-bottom: 4px;
        color: #333333;
    }

    .single-product .product-content a {
        color: #1a1a1a;
        text-decoration: underline;
    }

    .single-product .product-content a:hover {
        color: #666666;
    }

    /* Product Meta Information */
    .single-product .product-meta-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 4px;
        margin: 30px 0;
        border: 1px solid #e9ecef;
    }

    .single-product .product-pricing {
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .single-product .price-label {
        color: #666666;
        font-weight: 500;
    }

    .single-product .product-price {
        color: #007cba;
        font-weight: 600;
        font-size: 1.2rem;
        margin-left: 8px;
    }

    .single-product .price-unit {
        color: #888888;
        font-size: 0.9rem;
    }

    .single-product .product-external-link {
        display: inline-block;
        background: #007cba;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .single-product .product-external-link:hover {
        background: #005a87;
        color: white;
    }

    .single-product .product-footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .single-product .related-products h3 {
        font-size: 1.125rem;
        color: #1a1a1a;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .single-product .related-products-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .single-product .related-products-list li {
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f0f0f0;
    }

    .single-product .related-products-list li:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .single-product .related-products-list a {
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 500;
        display: block;
        margin-bottom: 4px;
    }

    .single-product .related-products-list a:hover {
        color: #666666;
    }

    .single-product .related-products-list .product-date {
        font-size: 0.875rem;
        color: #888888;
        font-weight: 400;
    }

    /* Breadcrumbs styling */
    .breadcrumbs {
        margin: 20px 0;
        font-size: 0.875rem;
        color: #666666;
    }

    .breadcrumbs a {
        color: #666666;
        text-decoration: none;
    }

    .breadcrumbs a:hover {
        color: #666666;
        text-decoration: underline;
    }

    .breadcrumb-separator {
        margin: 0 8px;
        color: #999999;
    }

    .breadcrumbs .current-page {
        color: #666666;
        font-weight: 500;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .single-product .product-title {
            font-size: 1.25rem;
        }

        .single-product .product-content h2 {
            font-size: 1.125rem;
        }

        .single-product .product-content h3 {
            font-size: 1rem;
        }

        .breadcrumbs {
            font-size: 0.8rem;
        }

        .single-product .product-meta-info {
            padding: 15px;
        }

        .single-product .product-price {
            font-size: 1.1rem;
        }
    }
</style>

<?php get_footer(); ?>