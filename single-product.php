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



<?php get_footer(); ?>