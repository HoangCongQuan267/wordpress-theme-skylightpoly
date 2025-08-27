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
                    "datePublished": "<?php echo esc_attr(get_the_date('c')); ?>",
                    "dateModified": "<?php echo esc_attr(get_the_modified_date('c')); ?>"
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
                        <div class="post-date-minimal">
                            <?php echo get_the_date('F j, Y'); ?>
                        </div>
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
                            $related_products = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
                                'orderby' => 'rand'
                            ));

                            if ($related_products->have_posts()) :
                            ?>
                                <ul class="recent-posts-list">
                                    <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                            <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
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