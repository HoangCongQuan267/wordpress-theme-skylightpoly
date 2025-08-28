<?php

/**
 * Custom Home Page Template
 * 
 * This template displays the custom home page with:
 * - Hero slideshow section
 * - New products and certificates section
 * - Customer testimonials section
 * - Contact form section
 */

get_header(); ?>

<?php
// Get homepage customizer settings
$homepage_layout = get_theme_mod('homepage_layout_style', 'default');
$homepage_bg_color = get_theme_mod('homepage_bg_color', '#ffffff');
$section_spacing = get_theme_mod('homepage_section_spacing', 'normal');

// Apply homepage styles
$homepage_classes = array('site-main');
if ($homepage_layout !== 'default') {
    $homepage_classes[] = 'layout-' . $homepage_layout;
}
if ($section_spacing !== 'normal') {
    $homepage_classes[] = 'spacing-' . $section_spacing;
}
?>

<main id="main" class="<?php echo implode(' ', $homepage_classes); ?>" style="background-color: <?php echo esc_attr($homepage_bg_color); ?>;">

    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "<?php echo esc_html(get_bloginfo('name')); ?>",
            "url": "<?php echo esc_url(home_url('/')); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo esc_url(get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/logo.png')); ?>"
            },
            "description": "<?php echo esc_html(get_theme_mod('site_meta_description', 'Skylight Plastic - Chuyên cung cấp sản phẩm nhựa chất lượng cao, giá cả hợp lý, giao hàng nhanh chóng trên toàn quốc.')); ?>",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "<?php echo esc_html(get_theme_mod('default_phone_number', '+84 123 456 789')); ?>",
                "contactType": "customer service",
                "email": "<?php echo esc_html(get_theme_mod('default_email_address', 'info@yoursite.com')); ?>"
            },
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "<?php echo esc_html(get_theme_mod('default_physical_address', '123 Đường Chính, Thành phố, Việt Nam')); ?>",
                "addressCountry": "VN"
            },
            "sameAs": [
                "<?php echo esc_url(get_theme_mod('social_facebook', '#')); ?>",
                "<?php echo esc_url(get_theme_mod('social_twitter', '#')); ?>",
                "<?php echo esc_url(get_theme_mod('social_linkedin', '#')); ?>"
            ]
        }
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "<?php echo esc_html(get_bloginfo('name')); ?>",
            "url": "<?php echo esc_url(home_url('/')); ?>",
            "description": "<?php echo esc_html(get_bloginfo('description')); ?>",
            "potentialAction": {
                "@type": "SearchAction",
                "target": {
                    "@type": "EntryPoint",
                    "urlTemplate": "<?php echo esc_url(home_url('/')); ?>?s={search_term_string}"
                },
                "query-input": "required name=search_term_string"
            }
        }
    </script>
    <?php
    // Check if slideshow is enabled in customizer
    $slideshow_enabled = get_theme_mod('hero_slideshow_enable', true);
    if ($slideshow_enabled) :
        // Try customizer slides first, then fallback to custom post type
        $customizer_slides = get_customizer_hero_slides();
        $hero_slides = !empty($customizer_slides) ? $customizer_slides : get_hero_slides();
        $is_customizer = !empty($customizer_slides);

        if (!empty($hero_slides)) :
    ?>
            <!-- Dynamic slides from WordPress Customizer or Admin -->
            <?php
            $autoplay = get_theme_mod('hero_slideshow_autoplay', true);
            $speed = get_theme_mod('hero_slideshow_speed', 5000);

            // Get styling options
            $panel_bg_color = get_theme_mod('hero_slideshow_panel_bg_color', 'rgba(0, 0, 0, 0.5)');
            $panel_opacity = get_theme_mod('hero_slideshow_panel_opacity', '0.8');
            $title_font = get_theme_mod('hero_slideshow_title_font', 'inherit');
            $title_size = get_theme_mod('hero_slideshow_title_size', '3');
            $title_color = get_theme_mod('hero_slideshow_title_color', '#ffffff');
            $subtitle_size = get_theme_mod('hero_slideshow_subtitle_size', '1.5');
            $subtitle_color = get_theme_mod('hero_slideshow_subtitle_color', '#ffffff');
            $content_position = get_theme_mod('hero_slideshow_content_position', 'center');
            $content_align = get_theme_mod('hero_slideshow_content_align', 'center');
            $button_bg_color = get_theme_mod('hero_slideshow_button_bg_color', '#2154fe');
            $button_text_color = get_theme_mod('hero_slideshow_button_text_color', '#ffffff');

            // Convert rgba if needed
            if (strpos($panel_bg_color, '#') === 0) {
                $hex = str_replace('#', '', $panel_bg_color);
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                $panel_bg_color = "rgba($r, $g, $b, $panel_opacity)";
            }
            ?>
            <section class="hero-section" data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>" data-duration="<?php echo $speed; ?>">
                <style>
                    .hero-section .slide {
                        align-items: <?php echo $content_position; ?>;
                    }

                    .hero-section .slide-content {
                        background: <?php echo $panel_bg_color; ?>;
                        text-align: <?php echo $content_align; ?>;
                    }

                    .hero-section .slide-title {
                        font-family: <?php echo $title_font !== 'inherit' ? $title_font : 'inherit'; ?>;
                        font-size: <?php echo $title_size; ?>rem;
                        color: <?php echo $title_color; ?>;
                    }

                    .hero-section .slide-subtitle {
                        font-size: <?php echo $subtitle_size; ?>rem;
                        color: <?php echo $subtitle_color; ?>;
                    }

                    .hero-section .slide-button {
                        background: <?php echo $button_bg_color; ?>;
                        color: <?php echo $button_text_color; ?>;
                    }

                    .hero-section .slide-button:hover {
                        background: <?php echo $button_bg_color; ?>;
                        opacity: 0.9;
                    }
                </style>
                <div class="hero-slideshow">
                    <?php foreach ($hero_slides as $index => $slide) :
                        if ($is_customizer) {
                            // Customizer slide data
                            $slide_image = $slide['image_url'];
                            $slide_title = $slide['title'];
                            $slide_subtitle = $slide['subtitle'];
                            $button_text = $slide['button_text'];
                            $button_url = $slide['button_url'];
                        } else {
                            // Custom post type slide data
                            $slide_image = get_the_post_thumbnail_url($slide->ID, 'full');
                            $slide_title = get_the_title($slide->ID);
                            $slide_subtitle = get_post_meta($slide->ID, '_hero_slide_subtitle', true);
                            $button_text = get_post_meta($slide->ID, '_hero_slide_button_text', true);
                            $button_url = get_post_meta($slide->ID, '_hero_slide_button_url', true);
                        }
                        $active_class = ($index === 0) ? ' active' : '';
                    ?>
                        <div class="slide<?php echo $active_class; ?>" style="background-image: url('<?php echo esc_url($slide_image); ?>')">
                            <div class="slide-content">
                                <h1 class="slide-title"><?php echo esc_html($slide_title); ?></h1>
                                <?php if ($slide_subtitle) : ?>
                                    <p class="slide-subtitle"><?php echo esc_html($slide_subtitle); ?></p>
                                <?php endif; ?>
                                <?php if ($button_text && $button_url) : ?>
                                    <a href="<?php echo esc_url($button_url); ?>" class="slide-button"><?php echo esc_html($button_text); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Navigation Arrows -->
                    <button class="slideshow-arrows prev-arrow">‹</button>
                    <button class="slideshow-arrows next-arrow">›</button>

                    <!-- Slide Indicators -->
                    <div class="slideshow-nav">
                        <?php foreach ($hero_slides as $index => $slide) :
                            $active_class = ($index === 0) ? ' active' : '';
                        ?>
                            <span class="nav-dot<?php echo $active_class; ?>" data-slide="<?php echo $index; ?>"></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <!-- Fallback: Default hero section when no slides are configured -->
            <section class="hero-section">
                <div class="hero-slideshow">
                    <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                        <div class="slide-overlay"></div>
                        <div class="slide-content">
                            <h1 class="hero-title">Chào Mừng Đến Với Website Của Chúng Tôi</h1>
                            <p class="hero-subtitle">Tạo các slide hero tùy chỉnh trong WordPress admin</p>
                            <a href="<?php echo admin_url('edit.php?post_type=hero_slide'); ?>" class="hero-btn">Quản Lý Slides</a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Commitments Section -->
    <section class="commitments-section">
        <div class="container">
            <div class="commitments-grid">
                <div class="commitment-item">
                    <div class="commitment-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.09 8.26L22 9L17 14L18.18 21L12 17.77L5.82 21L7 14L2 9L8.91 8.26L12 2Z" stroke="#007cba" stroke-width="2" fill="none" />
                        </svg>
                    </div>
                    <h3 class="commitment-title">Chất Lượng Cao</h3>
                    <p class="commitment-description">Cam kết cung cấp sản phẩm chất lượng cao với tiêu chuẩn quốc tế</p>
                </div>
                <div class="commitment-item">
                    <div class="commitment-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2V22M17 5H9.5C8.11929 5 7 6.11929 7 7.5C7 8.88071 8.11929 10 9.5 10H14.5C15.8807 10 17 11.1193 17 12.5C17 13.8807 15.8807 15 14.5 15H7" stroke="#007cba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="commitment-title">Giá Cả Hợp Lý</h3>
                    <p class="commitment-description">Mức giá cạnh tranh và phù hợp với mọi ngân sách</p>
                </div>
                <div class="commitment-item">
                    <div class="commitment-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 3H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="#007cba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="9" cy="20" r="1" stroke="#007cba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="20" cy="20" r="1" stroke="#007cba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="commitment-title">Giao Hàng Nhanh</h3>
                    <p class="commitment-description">Hệ thống logistics hiện đại, giao hàng nhanh chóng</p>
                </div>
                <div class="commitment-item">
                    <div class="commitment-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#007cba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="7" r="4" stroke="#007cba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="commitment-title">Hỗ Trợ Tận Tâm</h3>
                    <p class="commitment-description">Đội ngũ chăm sóc khách hàng chuyên nghiệp 24/7</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Commitments Section Styles */
        .commitments-section {
            padding: 40px 0;
            background: var(--pure-white);
            border-bottom: 1px solid #f0f0f0;
        }

        .commitments-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .commitment-item {
            text-align: center;
            padding: 20px 15px;
        }

        .commitment-icon {
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .commitment-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin: 0 0 10px 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .commitment-description {
            font-size: 0.8rem;
            color: var(--medium-gray);
            line-height: 1.5;
            margin: 0;
        }

        @media (max-width: 1024px) {
            .commitments-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
        }

        @media (max-width: 768px) {
            .commitments-section {
                padding: 30px 0;
            }

            .commitments-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .commitment-item {
                padding: 15px 10px;
            }

            .commitment-title {
                font-size: 0.9rem;
            }

            .commitment-description {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .commitments-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .commitment-item {
                padding: 20px 15px;
            }
        }

        /* Brand Banner Height Adjustment */
        .branding-banner-thin {
            height: 160px !important;
            flex-direction: column;
            justify-content: center;
            padding: 0 0 30px 0;
        }

        .branding-banner-thin .section-header {
            margin-bottom: 25px;
        }

        .branding-banner-thin .section-title {
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .branding-banner-thin .title-ribbon {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .branding-banner-thin {
                height: 120px !important;
                padding: 20px 15px 25px 15px;
            }

            .branding-banner-thin .container {
                max-width: 100%;
                padding: 0 10px;
            }

            .branding-banner-thin .section-header {
                margin-bottom: 25px;
                text-align: center;
            }

            .branding-banner-thin .section-title {
                font-size: 0.85rem;
                line-height: 1.3;
                margin-top: 10px;
                margin-bottom: 8px;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .branding-banner-thin {
                height: 130px !important;
                padding: 0px 10px 30px 10px;
            }

            .branding-banner-thin .container {
                max-width: 100%;
                padding: 0 5px;
            }

            .branding-banner-thin .section-header {
                margin-bottom: 25px;
                text-align: center;
            }

            .branding-banner-thin .section-title {
                font-size: 0.75rem;
                margin-top: 8px;
                margin-bottom: 8px;
                line-height: 1.4;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
                max-width: 100%;
                white-space: normal;
            }

            .branding-banner-thin .title-ribbon {
                transform: scale(0.8);
                margin-bottom: 5px;
            }
        }
    </style>

    <!-- Thin Branding Banner Section -->
    <?php if (get_theme_mod('branding_banner_enable', true)) :
        // Get branding banner styling options
        $branding_bg_color = get_theme_mod('branding_banner_bg_color', '#ffffff');
        $branding_text_color = get_theme_mod('branding_banner_text_color', '#333333');
    ?>
        <section class="branding-banner-thin" style="background-color: <?php echo esc_attr($branding_bg_color); ?>; color: <?php echo esc_attr($branding_text_color); ?>;">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Đối Tác Kinh Doanh Của Chúng Tôi</h2>
                </div>
                <div class="brand-logos-horizontal">
                    <?php
                    $brand_logos = get_brand_logos();
                    $logos_to_display = array();

                    if (!empty($brand_logos)) :
                        $logos_to_display = $brand_logos;
                    else :
                        // Demo brand logos when no logos are configured
                        $logos_to_display = array(
                            array('name' => 'Microsoft', 'image' => 'https://img.icons8.com/color/96/microsoft.png'),
                            array('name' => 'Google', 'image' => 'https://img.icons8.com/color/96/google-logo.png'),
                            array('name' => 'Apple', 'image' => 'https://img.icons8.com/ios-filled/96/mac-os.png'),
                            array('name' => 'Amazon', 'image' => 'https://img.icons8.com/color/96/amazon.png'),
                            array('name' => 'Samsung', 'image' => 'https://img.icons8.com/color/96/samsung.png'),
                            array('name' => 'Intel', 'image' => 'https://img.icons8.com/color/96/intel.png'),
                        );
                    endif;

                    // Display logos many times to ensure full width coverage
                    for ($i = 0; $i < 8; $i++) :
                        foreach ($logos_to_display as $logo) :
                    ?>
                            <div class="brand-logo-item">
                                <?php if (!empty($logo['url'])) : ?>
                                    <a href="<?php echo esc_url($logo['url']); ?>" target="_blank" rel="noopener">
                                        <img src="<?php echo esc_url($logo['image']); ?>" alt="<?php echo esc_attr($logo['name']); ?>" class="brand-logo">
                                    </a>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($logo['image']); ?>" alt="<?php echo esc_attr($logo['name']); ?>" class="brand-logo">
                                <?php endif; ?>
                            </div>
                    <?php
                        endforeach;
                    endfor;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- New Products Section -->
    <?php if (get_theme_mod('products_section_enable', true)) :
        // Get products section styling options
        $products_bg_color = get_theme_mod('products_section_bg_color', '#ffffff');
        $products_text_color = get_theme_mod('products_section_text_color', '#333333');
        $products_layout = get_theme_mod('products_grid_layout', 'grid');
    ?>
        <section class="products-section layout-<?php echo esc_attr($products_layout); ?>" style="background-color: <?php echo esc_attr($products_bg_color); ?>; color: <?php echo esc_attr($products_text_color); ?>;">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('products_section_title', 'Sản Phẩm Mới Nhất')); ?></h2>
                    <div class="title-ribbon">
                        <div class="ribbon-line"></div>
                        <div class="ribbon-diamond"></div>
                        <div class="ribbon-line"></div>
                    </div>
                    <p class="section-subtitle"><?php echo esc_html(get_theme_mod('products_section_subtitle', 'Khám phá những đổi mới và giải pháp tiên tiến nhất của chúng tôi')); ?></p>
                </div>

                <?php
                // Get products grouped by categories
                $grouped_products = get_products_by_categories();

                // Products are now loading from customizer data

                if (!empty($grouped_products)) :
                    foreach ($grouped_products as $category_data) :
                ?>
                        <div class="product-category-section">
                            <!-- Category Header with Title and Line -->
                            <div class="category-header">
                                <h3 class="category-title"><?php echo esc_html($category_data['category']->name); ?></h3>
                                <div class="category-line"></div>
                            </div>

                            <!-- Products Grid for this Category -->
                            <div class="products-grid">
                                <?php foreach ($category_data['products'] as $product) : ?>
                                    <div class="product-card vertical-card">
                                        <?php
                                        // Determine which badge to show (priority: custom_badge > discount > hot_tag)
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
                                        <?php if (!empty($product['image'])) : ?>
                                            <div class="product-image">
                                                <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="product-content">
                                            <h4 class="product-title"><?php echo esc_html($product['title']); ?></h4>
                                            <p class="product-excerpt"><?php echo esc_html(wp_trim_words($product['content'], 15)); ?></p>

                                            <?php if (!empty($product['price']) || !empty($product['discount_price'])) : ?>
                                                <div class="product-pricing">
                                                    <?php
                                                    $unit_text = !empty($product['unit']) ? '/' . $product['unit'] : '/đơn vị';
                                                    $currency_symbol = get_theme_mod('products_currency_symbol', 'đ');
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

                            <!-- See All Products Button for this Category -->
                            <div class="category-footer">
                                <?php
                                // Link to products page with Vietnamese category parameter
                                $products_page_url = home_url('/san-pham/');
                                $category_link = $products_page_url . '?danh-muc=' . $category_data['category']->slug;
                                ?>
                                <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary btn-see-all">
                                    <?php _e('Xem tất cả sản phẩm', 'custom-blue-orange'); ?>
                                </a>
                            </div>
                        </div>
                    <?php
                    endforeach;
                else :
                    // Get default unit and currency for demo products
                    $default_unit = get_theme_mod('products_default_unit', 'đơn vị');
                    $demo_unit_text = '/' . $default_unit;
                    $currency_symbol = get_theme_mod('products_currency_symbol', 'đ');
                    ?>
                    <!-- Demo products when no products are available -->
                    <div class="products-grid">
                        <div class="product-card vertical-card">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 1">
                                <div class="product-overlay">
                                    <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4 class="product-title">Sản Phẩm Cao Cấp A</h4>
                                <p class="product-excerpt">Giải pháp chất lượng cao được thiết kế cho các doanh nghiệp hiện đại với tính năng tiên tiến.</p>
                                <div class="product-pricing">
                                    <span class="original-price">2.500.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                    <span class="discount-price">1.999.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-card vertical-card">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1560472355-536de3962603?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 2">
                                <div class="product-overlay">
                                    <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4 class="product-title">Dòng Sản Phẩm Đổi Mới B</h4>
                                <p class="product-excerpt">Công nghệ tiên tiến mang lại hiệu suất và độ tin cậy vượt trội.</p>
                                <div class="product-pricing">
                                    <span class="current-price">3.200.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-card vertical-card">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1560472354-981537c68e96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 3">
                                <div class="product-overlay">
                                    <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4 class="product-title">Bộ Giải Pháp Chuyên Nghiệp C</h4>
                                <p class="product-excerpt">Giải pháp toàn diện cho các yêu cầu cấp doanh nghiệp và khả năng mở rộng.</p>
                                <div class="product-pricing">
                                    <span class="original-price">5.000.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                    <span class="discount-price">4.200.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-card vertical-card">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 4">
                                <div class="product-overlay">
                                    <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4 class="product-title">Giải Pháp Thông Minh D</h4>
                                <p class="product-excerpt">Công nghệ AI tiên tiến giúp tối ưu hóa quy trình làm việc và nâng cao hiệu quả.</p>
                                <div class="product-pricing">
                                    <span class="current-price">7.500.000<?php echo esc_html($currency_symbol); ?><?php echo esc_html($demo_unit_text); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Show All Products Button -->
                    <div class="section-footer">
                        <?php
                        // Link to products page with first category
                        $products_page_url = home_url('/san-pham/');
                        $product_categories = get_terms(array(
                            'taxonomy' => 'product_category',
                            'hide_empty' => false,
                            'number' => 1
                        ));
                        $first_category_link = $products_page_url;
                        if (!empty($product_categories) && !is_wp_error($product_categories)) {
                            $first_category_link = $products_page_url . '?danh-muc=' . $product_categories[0]->slug;
                        }
                        ?>
                        <a href="<?php echo esc_url($first_category_link); ?>" class="show-all-btn">Xem Tất Cả Sản Phẩm</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Video Section -->
    <?php if (get_theme_mod('video_section_enable', true)) :
        // Get video section styling options
        $video_bg_color = get_theme_mod('video_section_bg_color', '#ffffff');
        $video_text_color = get_theme_mod('video_section_text_color', '#333333');
        $video_layout = get_theme_mod('video_section_layout', 'grid');
    ?>
        <section class="video-section layout-<?php echo esc_attr($video_layout); ?>" style="background-color: <?php echo esc_attr($video_bg_color); ?>; color: <?php echo esc_attr($video_text_color); ?>;">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('video_section_title', 'Video Giới Thiệu')); ?></h2>
                    <div class="title-ribbon">
                        <div class="ribbon-line"></div>
                        <div class="ribbon-diamond"></div>
                        <div class="ribbon-line"></div>
                    </div>
                    <p class="section-subtitle"><?php echo esc_html(get_theme_mod('video_section_subtitle', 'Khám phá thêm về chúng tôi qua video giới thiệu')); ?></p>
                </div>

                <div class="videos-grid">
                    <?php
                    // Get videos from Customizer (support for multiple videos)
                    $videos = [];
                    for ($i = 1; $i <= 6; $i++) {
                        $video_url = get_theme_mod("video_{$i}_url", '');
                        $video_title = get_theme_mod("video_{$i}_title", '');
                        $video_description = get_theme_mod("video_{$i}_description", '');
                        $video_type = get_theme_mod("video_{$i}_type", 'youtube');
                        $video_poster = get_theme_mod("video_{$i}_poster", '');

                        if (!empty($video_url) || !empty($video_title)) {
                            $videos[] = [
                                'url' => $video_url,
                                'title' => $video_title,
                                'description' => $video_description,
                                'type' => $video_type,
                                'poster' => $video_poster
                            ];
                        }
                    }

                    if (!empty($videos)) :
                        foreach ($videos as $video) :
                    ?>
                            <div class="video-card">
                                <?php if (!empty($video['title'])) : ?>
                                    <h4 class="video-title"><?php echo esc_html($video['title']); ?></h4>
                                <?php endif; ?>

                                <div class="video-content">
                                    <?php if (!empty($video['url'])) :
                                        if ($video['type'] === 'youtube') :
                                            // Extract YouTube video ID
                                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video['url'], $matches);
                                            $youtube_id = isset($matches[1]) ? $matches[1] : '';
                                            if ($youtube_id) :
                                                $thumbnail_url = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
                                    ?>
                                                <div class="video-wrapper youtube-video">
                                                    <a href="<?php echo esc_url($video['url']); ?>" target="_blank" class="video-thumbnail-link">
                                                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($video['title']); ?>" class="video-thumbnail">
                                                        <div class="video-play-overlay">
                                                            <div class="play-button">
                                                                <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                                                                    <path d="M8 5v14l11-7z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php
                                            endif;
                                        elseif ($video['type'] === 'vimeo') :
                                            // Extract Vimeo video ID
                                            preg_match('/vimeo\.com\/(\d+)/', $video['url'], $matches);
                                            $vimeo_id = isset($matches[1]) ? $matches[1] : '';
                                            if ($vimeo_id) :
                                            ?>
                                                <div class="video-wrapper vimeo-video">
                                                    <a href="<?php echo esc_url($video['url']); ?>" target="_blank" class="video-thumbnail-link">
                                                        <div class="vimeo-thumbnail-placeholder">
                                                            <div class="video-play-overlay">
                                                                <div class="play-button">
                                                                    <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                                                                        <path d="M8 5v14l11-7z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php
                                            endif;
                                        elseif ($video['type'] === 'mp4') :
                                            ?>
                                            <div class="video-wrapper mp4-video">
                                                <video controls <?php echo !empty($video['poster']) ? 'poster="' . esc_url($video['poster']) . '"' : ''; ?>>
                                                    <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                                                    <p>Trình duyệt của bạn không hỗ trợ video HTML5.</p>
                                                </video>
                                            </div>
                                        <?php endif;
                                    else : ?>
                                        <div class="video-wrapper demo-video">
                                            <div class="demo-video-placeholder">
                                                <div class="demo-video-icon">
                                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                                <h3>Video Demo</h3>
                                                <p>Thêm URL video trong WordPress Customizer</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($video['description'])) : ?>
                                    <div class="video-description">
                                        <p><?php echo esc_html($video['description']); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php
                        endforeach;
                    else :
                        // Demo videos when no videos are configured
                        for ($i = 1; $i <= 3; $i++) :
                        ?>
                            <div class="video-card">
                                <h4 class="video-title">Video Demo <?php echo $i; ?></h4>
                                <div class="video-content">
                                    <div class="video-wrapper demo-video">
                                        <div class="demo-video-placeholder">
                                            <div class="demo-video-icon">
                                                <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                            </div>
                                            <h3>Video Demo <?php echo $i; ?></h3>
                                            <p>Thêm URL video trong WordPress Customizer để hiển thị video thực tế</p>
                                            <a href="<?php echo admin_url('customize.php'); ?>" class="demo-video-btn">Cấu Hình Video</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-description">
                                    <p>Mô tả cho video demo số <?php echo $i; ?>. Bạn có thể thay đổi nội dung này trong WordPress Customizer.</p>
                                </div>
                            </div>
                    <?php
                        endfor;
                    endif;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Articles Section -->
    <?php if (get_theme_mod('articles_section_enable', true)) :
        // Get articles section styling options
        $articles_bg_color = get_theme_mod('articles_section_bg_color', '#ffffff');
        $articles_text_color = get_theme_mod('articles_section_text_color', '#333333');
        $articles_layout = get_theme_mod('articles_grid_layout', 'grid');
    ?>
        <section class="articles-section layout-<?php echo esc_attr($articles_layout); ?>" style="background-color: <?php echo esc_attr($articles_bg_color); ?>; color: <?php echo esc_attr($articles_text_color); ?>;">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('articles_section_title', 'Bài Viết Mới Nhất')); ?></h2>
                    <div class="title-ribbon">
                        <div class="ribbon-line"></div>
                        <div class="ribbon-diamond"></div>
                        <div class="ribbon-line"></div>
                    </div>
                    <p class="section-subtitle"><?php echo esc_html(get_theme_mod('articles_section_subtitle', 'Khám phá những thông tin và kiến thức hữu ích từ chúng tôi')); ?></p>
                </div>

                <?php
                // Get recent articles/posts
                $articles_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => get_theme_mod('articles_posts_per_page', 6),
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                if ($articles_query->have_posts()) :
                ?>
                    <div class="articles-grid">
                        <?php while ($articles_query->have_posts()) : $articles_query->the_post(); ?>
                            <article class="article-card vertical-card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="article-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                        </a>
                                        <div class="article-overlay">
                                            <a href="<?php the_permalink(); ?>" class="article-link-btn">Đọc Bài Viết</a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="article-content">
                                    <div class="article-meta">
                                        <span class="article-date"><?php echo get_the_date('d/m/Y'); ?></span>
                                        <?php if (get_the_category()) : ?>
                                            <span class="article-category">
                                                <?php echo get_the_category()[0]->name; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <h4 class="article-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <p class="article-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- See All Articles Button -->
                    <div class="section-footer">
                        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="btn btn-outline-primary btn-see-all">
                            <?php _e('Xem Tất Cả Bài Viết', 'custom-blue-orange'); ?>
                        </a>
                    </div>
                <?php
                    wp_reset_postdata();
                else :
                ?>
                    <!-- Demo articles when no articles are available -->
                    <div class="articles-grid">
                        <article class="article-card vertical-card">
                            <div class="article-image">
                                <a href="#">
                                    <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Demo Article 1">
                                </a>
                                <div class="article-overlay">
                                    <a href="#" class="article-link-btn">Đọc Bài Viết</a>
                                </div>
                            </div>
                            <div class="article-content">
                                <div class="article-meta">
                                    <span class="article-date"><?php echo date('d/m/Y'); ?></span>
                                    <span class="article-category">Công nghệ</span>
                                </div>
                                <h4 class="article-title">
                                    <a href="#">Xu Hướng Công Nghệ Mới Trong Năm 2024</a>
                                </h4>
                                <p class="article-excerpt">Khám phá những xu hướng công nghệ đột phá sẽ định hình tương lai và tác động đến cuộc sống hàng ngày của chúng ta.</p>
                            </div>
                        </article>
                        <article class="article-card vertical-card">
                            <div class="article-image">
                                <a href="#">
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Demo Article 2">
                                </a>
                                <div class="article-overlay">
                                    <a href="#" class="article-link-btn">Đọc Bài Viết</a>
                                </div>
                            </div>
                            <div class="article-content">
                                <div class="article-meta">
                                    <span class="article-date"><?php echo date('d/m/Y', strtotime('-2 days')); ?></span>
                                    <span class="article-category">Kinh doanh</span>
                                </div>
                                <h4 class="article-title">
                                    <a href="#">Chiến Lược Phát Triển Doanh Nghiệp Bền Vững</a>
                                </h4>
                                <p class="article-excerpt">Tìm hiểu các phương pháp và chiến lược giúp doanh nghiệp phát triển bền vững trong thời đại số hóa hiện nay.</p>
                            </div>
                        </article>
                        <article class="article-card vertical-card">
                            <div class="article-image">
                                <a href="#">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Demo Article 3">
                                </a>
                                <div class="article-overlay">
                                    <a href="#" class="article-link-btn">Đọc Bài Viết</a>
                                </div>
                            </div>
                            <div class="article-content">
                                <div class="article-meta">
                                    <span class="article-date"><?php echo date('d/m/Y', strtotime('-5 days')); ?></span>
                                    <span class="article-category">Đổi mới</span>
                                </div>
                                <h4 class="article-title">
                                    <a href="#">Đổi Mới Sáng Tạo Trong Thời Đại Số</a>
                                </h4>
                                <p class="article-excerpt">Khám phá cách các doanh nghiệp có thể tận dụng công nghệ để tạo ra những giải pháp sáng tạo và hiệu quả.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Show All Articles Button -->
                    <div class="section-footer">
                        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="btn btn-outline-primary btn-see-all">Xem Tất Cả Bài Viết</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- FAQ Section -->
    <?php if (get_theme_mod('faq_section_enable', true)) : ?>
        <section class="faq-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('faq_section_title', 'Câu Hỏi Thường Gặp')); ?></h2>
                    <div class="title-ribbon">
                        <div class="ribbon-line"></div>
                        <div class="ribbon-diamond"></div>
                        <div class="ribbon-line"></div>
                    </div>
                    <p class="section-subtitle"><?php echo esc_html(get_theme_mod('faq_section_subtitle', 'Tìm câu trả lời cho những thắc mắc phổ biến')); ?></p>
                </div>

                <div class="faq-container">
                    <?php
                    // Get FAQ items from customizer
                    $faq_items = array();
                    for ($i = 1; $i <= 10; $i++) {
                        $question = get_theme_mod("faq_question_{$i}", '');
                        $answer = get_theme_mod("faq_answer_{$i}", '');
                        if (!empty($question) && !empty($answer)) {
                            $faq_items[] = array(
                                'question' => $question,
                                'answer' => $answer
                            );
                        }
                    }

                    if (!empty($faq_items)) :
                        foreach ($faq_items as $index => $faq) :
                    ?>
                            <div class="faq-item">
                                <div class="faq-question" data-faq="<?php echo $index; ?>">
                                    <h4><?php echo esc_html($faq['question']); ?></h4>
                                    <span class="faq-toggle">+</span>
                                </div>
                                <div class="faq-answer" id="faq-answer-<?php echo $index; ?>">
                                    <div class="faq-answer-content">
                                        <p><?php echo nl2br(esc_html($faq['answer'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        // Demo FAQ items when no FAQs are configured
                        $demo_faqs = array(
                            array(
                                'question' => 'Sản phẩm của bạn có chất lượng như thế nào?',
                                'answer' => 'Chúng tôi cam kết cung cấp sản phẩm chất lượng cao với tiêu chuẩn quốc tế. Tất cả sản phẩm đều được kiểm tra nghiêm ngặt trước khi xuất xưởng và có chế độ bảo hành đầy đủ.'
                            ),
                            array(
                                'question' => 'Thời gian giao hàng là bao lâu?',
                                'answer' => 'Thời gian giao hàng thông thường là 3-5 ngày làm việc đối với khu vực nội thành và 5-7 ngày làm việc đối với các tỉnh thành khác. Chúng tôi sẽ thông báo cụ thể khi xác nhận đơn hàng.'
                            ),
                            array(
                                'question' => 'Tôi có thể đổi trả sản phẩm không?',
                                'answer' => 'Có, chúng tôi hỗ trợ đổi trả sản phẩm trong vòng 30 ngày kể từ ngày mua hàng. Sản phẩm cần còn nguyên vẹn, chưa sử dụng và có đầy đủ hóa đơn, phụ kiện đi kèm.'
                            ),
                            array(
                                'question' => 'Làm thế nào để liên hệ hỗ trợ khách hàng?',
                                'answer' => 'Bạn có thể liên hệ với chúng tôi qua hotline, email hoặc chat trực tuyến trên website. Đội ngũ hỗ trợ khách hàng của chúng tôi sẵn sàng phục vụ từ 8:00 - 18:00 hàng ngày.'
                            ),
                            array(
                                'question' => 'Có những hình thức thanh toán nào?',
                                'answer' => 'Chúng tôi hỗ trợ nhiều hình thức thanh toán: tiền mặt khi nhận hàng (COD), chuyển khoản ngân hàng, thanh toán qua ví điện tử và thẻ tín dụng/ghi nợ.'
                            )
                        );

                        foreach ($demo_faqs as $index => $faq) :
                        ?>
                            <div class="faq-item">
                                <div class="faq-question" data-faq="<?php echo $index; ?>">
                                    <h4><?php echo esc_html($faq['question']); ?></h4>
                                    <span class="faq-toggle">+</span>
                                </div>
                                <div class="faq-answer" id="faq-answer-<?php echo $index; ?>">
                                    <div class="faq-answer-content">
                                        <p><?php echo nl2br(esc_html($faq['answer'])); ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const faqQuestions = document.querySelectorAll('.faq-question');

                faqQuestions.forEach(function(question) {
                    question.addEventListener('click', function() {
                        const faqIndex = this.getAttribute('data-faq');
                        const answer = document.getElementById('faq-answer-' + faqIndex);
                        const toggle = this.querySelector('.faq-toggle');

                        // Close all other FAQ items
                        faqQuestions.forEach(function(otherQuestion) {
                            if (otherQuestion !== question) {
                                const otherIndex = otherQuestion.getAttribute('data-faq');
                                const otherAnswer = document.getElementById('faq-answer-' + otherIndex);
                                const otherToggle = otherQuestion.querySelector('.faq-toggle');

                                otherAnswer.classList.remove('active');
                                otherQuestion.classList.remove('active');
                                otherToggle.textContent = '+';
                            }
                        });

                        // Toggle current FAQ item
                        if (answer.classList.contains('active')) {
                            answer.classList.remove('active');
                            question.classList.remove('active');
                            toggle.textContent = '+';
                        } else {
                            answer.classList.add('active');
                            question.classList.add('active');
                            toggle.textContent = '−';
                        }
                    });
                });
            });
        </script>
    <?php endif; ?>

    <?php get_footer(); ?>