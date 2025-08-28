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

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php while (have_posts()) : the_post(); ?>
                <nav class="breadcrumbs">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
                    <span class="breadcrumb-separator">›</span>
                    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Sản phẩm</a>
                    <span class="breadcrumb-separator">›</span>
                    <?php
                    // Get the first product category for breadcrumb
                    $product_categories = get_the_terms(get_the_ID(), 'product_category');
                    if ($product_categories && !is_wp_error($product_categories)) :
                        $first_category = $product_categories[0];
                        // Link to products page with category filter
                        $products_page_url = get_post_type_archive_link('product');
                        if (!$products_page_url) {
                            // Fallback to products page if archive link doesn't work
                            $products_page = get_page_by_path('products');
                            if ($products_page) {
                                $products_page_url = get_permalink($products_page->ID);
                            }
                        }
                        $category_url = $products_page_url . '?category=' . urlencode($first_category->slug);
                    ?>
                        <a href="<?php echo esc_url($category_url); ?>"><?php echo esc_html($first_category->name); ?></a>
                        <span class="breadcrumb-separator">›</span>
                    <?php endif; ?>
                    <span class="current-page"><?php the_title(); ?></span>
                </nav>
                <!-- Structured Data for Product -->
                <script type="application/ld+json">
                    {
                        "@context": "https://schema.org",
                        "@type": "Product",
                        "name": "<?php echo esc_attr(get_the_title()); ?>",
                        "description": "<?php echo esc_attr(wp_trim_words(get_the_excerpt() ? get_the_excerpt() : get_the_content(), 25)); ?>",
                        "image": {
                            "@type": "ImageObject",
                            "url": "<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : get_template_directory_uri() . '/assets/images/placeholder-product.jpg'); ?>"
                        },
                        "brand": {
                            "@type": "Brand",
                            "name": "<?php echo esc_attr(get_bloginfo('name')); ?>"
                        },
                        "manufacturer": {
                            "@type": "Organization",
                            "name": "<?php echo esc_attr(get_bloginfo('name')); ?>"
                        },
                        "url": "<?php echo esc_url(get_permalink()); ?>",
                        "datePublished": "<?php echo esc_attr(get_the_date('c')); ?>"
                        <?php
                        $product_price = get_post_meta(get_the_ID(), 'product_price', true);
                        $discount_price = get_post_meta(get_the_ID(), 'discount_price', true);
                        $price_unit = get_post_meta(get_the_ID(), 'price_unit', true);
                        $currency = get_theme_mod('products_currency_symbol', 'VND');

                        if (!empty($discount_price) || !empty($product_price)) :
                            $final_price = !empty($discount_price) ? $discount_price : $product_price;
                        ?>,
                            "offers": {
                                "@type": "Offer",
                                "price": "<?php echo esc_attr($final_price); ?>",
                                "priceCurrency": "<?php echo esc_attr($currency === 'đ' ? 'VND' : $currency); ?>",
                                "availability": "https://schema.org/InStock",
                                "url": "<?php echo esc_url(get_permalink()); ?>"
                            }
                        <?php endif; ?>
                    }
                </script>

                <article id="post-<?php the_ID(); ?>" <?php post_class('post single-product'); ?>>
                    <header class="post-header">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <?php the_content(); ?>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">Trang: ',
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="post-footer">
                        <div class="related-posts">
                            <h3>Sản phẩm liên quan</h3>
                            <?php
                            // Get current product categories
                            $product_terms = get_the_terms(get_the_ID(), 'product_category');
                            $product_categories = array();
                            if ($product_terms && !is_wp_error($product_terms)) {
                                foreach ($product_terms as $term) {
                                    $product_categories[] = $term->term_id;
                                }
                            }
                            
                            $query_args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
                                'orderby' => 'date',
                                'order' => 'DESC'
                            );
                            
                            // If product has categories, filter by them
                            if (!empty($product_categories)) {
                                $query_args['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'product_category',
                                        'field' => 'term_id',
                                        'terms' => $product_categories,
                                        'operator' => 'IN'
                                    )
                                );
                            }
                            
                            $related_products = new WP_Query($query_args);

                            if ($related_products->have_posts()) :
                            ?>
                                <div class="related-products-grid">
                                    <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
                                        <?php include(get_template_directory() . '/template-parts/product-card.php'); ?>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </footer>
                </article>



            <?php endwhile; ?>
        </div>


    </div>
</main>



<?php get_footer(); ?>