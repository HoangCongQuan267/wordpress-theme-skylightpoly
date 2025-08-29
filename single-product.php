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

                <!-- Two-column layout wrapper -->
                <div class="single-product-layout">
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

                    <!-- Product Gallery Section -->
                    <div class="product-gallery">
                        <?php
                        $product_images = array();

                        // Get featured image
                        if (has_post_thumbnail()) {
                            $product_images[] = array(
                                'id' => get_post_thumbnail_id(),
                                'url' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
                                'thumb' => get_the_post_thumbnail_url(get_the_ID(), 'medium')
                            );
                        }

                        // Get gallery images from custom field or content
                        $gallery_images = get_post_meta(get_the_ID(), 'product_gallery', true);
                        if (!empty($gallery_images)) {
                            $gallery_ids = explode(',', $gallery_images);
                            foreach ($gallery_ids as $img_id) {
                                if (!empty($img_id)) {
                                    $product_images[] = array(
                                        'id' => $img_id,
                                        'url' => wp_get_attachment_image_url($img_id, 'large'),
                                        'thumb' => wp_get_attachment_image_url($img_id, 'medium')
                                    );
                                }
                            }
                        }

                        // Only add placeholder if no images at all
                        if (empty($product_images)) {
                            $placeholder_url = get_template_directory_uri() . '/assets/images/placeholder-product.jpg';
                            $product_images[] = array(
                                'id' => 0,
                                'url' => $placeholder_url,
                                'thumb' => $placeholder_url
                            );
                        }
                        ?>

                        <!-- Main Product Image with Navigation -->
                        <div class="main-product-image-container">
                            <?php if (count($product_images) > 1) : ?>
                                <button class="gallery-nav prev-btn" id="prev-image">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            <?php endif; ?>

                            <div class="main-product-image">
                                <img id="main-product-img" src="<?php echo esc_url($product_images[0]['url']); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </div>

                            <?php if (count($product_images) > 1) : ?>
                                <button class="gallery-nav next-btn" id="next-image">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>

                        <!-- Thumbnail Images -->
                        <?php if (count($product_images) > 1) : ?>
                            <div class="product-thumbnails">
                                <?php foreach ($product_images as $index => $image) : ?>
                                    <div class="thumbnail-item <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" data-image="<?php echo esc_url($image['url']); ?>">
                                        <img src="<?php echo esc_url($image['thumb']); ?>" alt="<?php echo esc_attr(get_the_title()); ?> - Image <?php echo $index + 1; ?>" />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Hidden data for JavaScript -->
                        <script type="application/json" id="gallery-data">
                            <?php echo json_encode($product_images); ?>
                        </script>
                    </div>

                    <!-- Product Details Section -->
                    <div class="product-details">
                        <header class="product-header">
                            <h1 class="product-title"><?php the_title(); ?></h1>
                        </header>

                        <!-- Product Properties -->
                        <div class="product-properties">
                            <?php
                            $product_price = get_post_meta(get_the_ID(), 'product_price', true);
                            $discount_price = get_post_meta(get_the_ID(), 'discount_price', true);
                            $price_unit = get_post_meta(get_the_ID(), 'price_unit', true);
                            $thickness = get_post_meta(get_the_ID(), 'product_thickness', true);
                            $width = get_post_meta(get_the_ID(), 'product_width', true);
                            $height = get_post_meta(get_the_ID(), 'product_height', true);
                            $colors = get_post_meta(get_the_ID(), 'product_colors', true);
                            $currency = get_theme_mod('products_currency_symbol', 'VND');

                            $final_price = !empty($discount_price) ? $discount_price : $product_price;
                            ?>

                            <!-- Price -->
                            <?php if (!empty($final_price)) : ?>
                                <div class="property-item price-item">
                                    <label>Giá:</label>
                                    <div class="price-display">
                                        <?php if (!empty($discount_price) && !empty($product_price)) : ?>
                                            <span class="original-price"><?php echo number_format($product_price); ?> <?php echo esc_html($currency); ?></span>
                                            <span class="discount-price"><?php echo number_format($discount_price); ?> <?php echo esc_html($currency); ?></span>
                                        <?php else : ?>
                                            <span class="current-price"><?php echo number_format($final_price); ?> <?php echo esc_html($currency); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($price_unit)) : ?>
                                            <span class="price-unit">/ <?php echo esc_html($price_unit); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Thickness -->
                            <?php if (!empty($thickness)) : ?>
                                <div class="property-item">
                                    <label>Độ dày:</label>
                                    <span><?php echo esc_html($thickness); ?></span>
                                </div>
                            <?php endif; ?>

                            <!-- Width -->
                            <?php if (!empty($width)) : ?>
                                <div class="property-item">
                                    <label>Chiều rộng:</label>
                                    <span><?php echo esc_html($width); ?></span>
                                </div>
                            <?php endif; ?>

                            <!-- Height -->
                            <?php if (!empty($height)) : ?>
                                <div class="property-item">
                                    <label>Chiều cao:</label>
                                    <span><?php echo esc_html($height); ?></span>
                                </div>
                            <?php endif; ?>

                            <!-- Color Selection -->
                            <?php if (!empty($colors)) : 
                                $color_options = explode(',', $colors);
                                
                                // Default color translation mapping
                                $default_color_translations = array(
                                    'white' => 'Trắng',
                                    'black' => 'Đen', 
                                    'red' => 'Đỏ',
                                    'blue' => 'Xanh dương',
                                    'green' => 'Xanh lá',
                                    'yellow' => 'Vàng',
                                    'orange' => 'Cam',
                                    'purple' => 'Tím',
                                    'pink' => 'Hồng',
                                    'brown' => 'Nâu',
                                    'gray' => 'Xám',
                                    'transparent' => 'Trong suốt',
                                    'White' => 'Trắng',
                                    'Black' => 'Đen',
                                    'Red' => 'Đỏ',
                                    'Blue' => 'Xanh dương',
                                    'Green' => 'Xanh lá',
                                    'Yellow' => 'Vàng',
                                    'Orange' => 'Cam',
                                    'Purple' => 'Tím',
                                    'Pink' => 'Hồng',
                                    'Brown' => 'Nâu',
                                    'Gray' => 'Xám',
                                    'Transparent' => 'Trong suốt'
                                );
                                
                                // Get custom colors from WordPress options
                                $custom_colors = get_option('product_custom_colors', array());
                            ?>
                                <div class="property-item">
                                    <label for="product-color">Màu sắc:</label>
                                    <select id="product-color" name="product_color">
                                        <?php foreach ($color_options as $color) : 
                                            $color = trim($color);
                                            
                                            // Check if it's a custom color
                                            if (isset($custom_colors[$color])) {
                                                $display_name = $custom_colors[$color]['name'];
                                            } elseif (isset($default_color_translations[$color])) {
                                                $display_name = $default_color_translations[$color];
                                            } else {
                                                $display_name = $color;
                                            }
                                        ?>
                                            <option value="<?php echo esc_attr($color); ?>"><?php echo esc_html($display_name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Price Calculator -->
                        <?php if (!empty($final_price)) : ?>
                            <div class="price-calculator">
                                <h3>Tính toán giá</h3>
                                <div class="calculator-row">
                                    <label for="quantity-input">Số lượng:</label>
                                    <input type="number" id="quantity-input" min="1" value="1" />
                                    <?php if (!empty($price_unit)) : ?>
                                        <span class="unit-label"><?php echo esc_html($price_unit); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="total-price">
                                    <strong>Tổng giá: <span id="total-price-display"><?php echo number_format($final_price); ?> <?php echo esc_html($currency); ?></span></strong>
                                </div>
                                <input type="hidden" id="unit-price" value="<?php echo esc_attr($final_price); ?>" />
                                <input type="hidden" id="currency-symbol" value="<?php echo esc_attr($currency); ?>" />
                            </div>
                        <?php endif; ?>

                        <!-- Contact Button -->
                        <div class="contact-section">
                            <?php
                            $zalo_link = get_theme_mod('zalo_contact_link', 'https://zalo.me/0123456789');
                            $product_name = get_the_title();
                            $zalo_message = urlencode("Xin chào! Tôi quan tâm đến sản phẩm: " . $product_name);
                            $zalo_url = $zalo_link . '?text=' . $zalo_message;
                            ?>
                            <a href="<?php echo esc_url($zalo_url); ?>" class="contact-button zalo-contact" target="_blank">
                                <span class="contact-icon">📱</span>
                                Liên hệ ngay qua Zalo
                            </a>
                        </div>

                        <!-- Product Description -->
                        <?php
                        $product_content = get_the_content();
                        if (!empty(trim($product_content))) :
                        ?>
                            <div class="product-description">
                                <h3>Thông tin chi tiết</h3>
                                <div class="description-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar Column -->
                    <div class="single-product-sidebar">
                        <div class="related-products-sidebar">
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

                            // Get all products in order to find adjacent ones
                            $all_products_args = array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'fields' => 'ids',
                                'meta_query' => array(
                                    'relation' => 'OR',
                                    array(
                                        'key' => 'product_price',
                                        'compare' => 'EXISTS'
                                    ),
                                    array(
                                        'key' => 'discount_price',
                                        'compare' => 'EXISTS'
                                    )
                                )
                            );

                            // If product has categories, filter by same category
                            if (!empty($product_categories)) {
                                $all_products_args['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'product_category',
                                        'field' => 'term_id',
                                        'terms' => $product_categories,
                                        'operator' => 'IN'
                                    )
                                );
                            }

                            $all_products = get_posts($all_products_args);
                            $current_product_id = get_the_ID();
                            $current_index = array_search($current_product_id, $all_products);

                            $related_product_ids = array();

                            if ($current_index !== false) {
                                // Get 2 products before current product
                                for ($i = 1; $i <= 2; $i++) {
                                    $prev_index = $current_index - $i;
                                    if ($prev_index >= 0) {
                                        $related_product_ids[] = $all_products[$prev_index];
                                    }
                                }

                                // Get 2 products after current product
                                for ($i = 1; $i <= 2; $i++) {
                                    $next_index = $current_index + $i;
                                    if ($next_index < count($all_products)) {
                                        $related_product_ids[] = $all_products[$next_index];
                                    }
                                }
                            }

                            // If we don't have enough adjacent products, fill with others
                            if (count($related_product_ids) < 4) {
                                $remaining_needed = 4 - count($related_product_ids);
                                $exclude_ids = array_merge(array($current_product_id), $related_product_ids);

                                $additional_args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => $remaining_needed,
                                    'post__not_in' => $exclude_ids,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'fields' => 'ids',
                                    'meta_query' => array(
                                        'relation' => 'OR',
                                        array(
                                            'key' => 'product_price',
                                            'compare' => 'EXISTS'
                                        ),
                                        array(
                                            'key' => 'discount_price',
                                            'compare' => 'EXISTS'
                                        )
                                    )
                                );

                                if (!empty($product_categories)) {
                                    $additional_args['tax_query'] = array(
                                        array(
                                            'taxonomy' => 'product_category',
                                            'field' => 'term_id',
                                            'terms' => $product_categories,
                                            'operator' => 'IN'
                                        )
                                    );
                                }

                                $additional_products = get_posts($additional_args);
                                $related_product_ids = array_merge($related_product_ids, $additional_products);
                            }

                            // Query the related products
                            if (!empty($related_product_ids)) {
                                $query_args = array(
                                    'post_type' => 'product',
                                    'post__in' => $related_product_ids,
                                    'orderby' => 'post__in',
                                    'posts_per_page' => 4
                                );
                                $related_products = new WP_Query($query_args);
                            } else {
                                $related_products = new WP_Query(array('post_type' => 'product', 'posts_per_page' => 0));
                            }

                            if ($related_products->have_posts()) :
                            ?>
                                <div class="related-products-sidebar-grid">
                                    <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
                                        <?php include(get_template_directory() . '/template-parts/product-card.php'); ?>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>

                </div>

            <?php endwhile; ?>
        </div>


    </div>
</main>



<?php get_footer(); ?>