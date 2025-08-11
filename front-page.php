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

    <!-- Thin Branding Banner Section -->
    <?php if (get_theme_mod('branding_banner_enable', true)) :
        // Get branding banner styling options
        $branding_bg_color = get_theme_mod('branding_banner_bg_color', '#f8f9fa');
        $branding_text_color = get_theme_mod('branding_banner_text_color', '#333333');
    ?>
        <section class="branding-banner-thin" style="background-color: <?php echo esc_attr($branding_bg_color); ?>; color: <?php echo esc_attr($branding_text_color); ?>;">
            <div class="container">
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
        $products_layout = get_theme_mod('products_section_layout', 'grid');
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

                <div class="products-grid">
                    <?php
                    // Get products from Customizer
                    $products = get_products();

                    if (!empty($products)) :
                        foreach ($products as $product) :
                    ?>
                            <div class="product-card horizontal-card">
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

                                <div class="product-content">
                                    <h4 class="product-title"><?php echo esc_html($product['title']); ?></h4>
                                    <p class="product-excerpt"><?php echo esc_html(wp_trim_words($product['content'], 15)); ?></p>
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
                        <?php
                        endforeach;
                    else :
                        ?>
                        <!-- Demo products when no products are available -->
                        <div class="product-card horizontal-card">
                            <div class="product-content">
                                <h4 class="product-title">Sản Phẩm Cao Cấp A</h4>
                                <p class="product-excerpt">Giải pháp chất lượng cao được thiết kế cho các doanh nghiệp hiện đại với tính năng tiên tiến.</p>
                            </div>
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 1">
                            </div>
                            <div class="product-overlay">
                                <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                            </div>
                        </div>
                        <div class="product-card horizontal-card">
                            <div class="product-content">
                                <h4 class="product-title">Dòng Sản Phẩm Đổi Mới B</h4>
                                <p class="product-excerpt">Công nghệ tiên tiến mang lại hiệu suất và độ tin cậy vượt trội.</p>
                            </div>
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1560472355-536de3962603?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 2">
                            </div>
                            <div class="product-overlay">
                                <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                            </div>
                        </div>
                        <div class="product-card horizontal-card">
                            <div class="product-content">
                                <h4 class="product-title">Bộ Giải Pháp Chuyên Nghiệp C</h4>
                                <p class="product-excerpt">Giải pháp toàn diện cho các yêu cầu cấp doanh nghiệp và khả năng mở rộng.</p>
                            </div>
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1560472354-981537c68e96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 3">
                            </div>
                            <div class="product-overlay">
                                <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                            </div>
                        </div>
                        <div class="product-card horizontal-card">
                            <div class="product-content">
                                <h4 class="product-title">Giải Pháp Thông Minh D</h4>
                                <p class="product-excerpt">Công nghệ AI tiên tiến giúp tối ưu hóa quy trình làm việc và nâng cao hiệu quả.</p>
                            </div>
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 4">
                            </div>
                            <div class="product-overlay">
                                <a href="#" class="product-link-btn">Tìm Hiểu Thêm</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Show All Products Button -->
                <div class="section-footer">
                    <a href="#" class="show-all-btn">Xem Tất Cả Sản Phẩm</a>
                </div>
            </div>
        </section>
    <?php endif; ?>



    <!-- Certificates Section -->
    <?php if (get_theme_mod('certificates_section_enable', true)) :
        // Get certificates section styling options
        $certificates_bg_color = get_theme_mod('certificates_section_bg_color', 'var(--primary-sky-blue)');
        $certificates_text_color = get_theme_mod('certificates_section_text_color', 'var(--off-white)');
        $certificates_style = get_theme_mod('certificates_display_style', 'cards');
    ?>
        <section class="certificates-section style-<?php echo esc_attr($certificates_style); ?>" style="background-color: <?php echo esc_attr($certificates_bg_color); ?>; color: <?php echo esc_attr($certificates_text_color); ?>;">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('certificates_section_title', 'Chứng Nhận & Giải Thưởng')); ?></h2>
                    <div class="title-ribbon">
                        <div class="ribbon-line"></div>
                        <div class="ribbon-diamond"></div>
                        <div class="ribbon-line"></div>
                    </div>
                    <p class="section-subtitle"><?php echo esc_html(get_theme_mod('certificates_section_subtitle', 'Chứng nhận chất lượng và sự công nhận trong ngành')); ?></p>
                </div>

                <div class="certificates-carousel">
                    <?php
                    $certificates = get_certificates();
                    $certificates_to_display = array();

                    if (!empty($certificates)) :
                        $certificates_to_display = $certificates;
                    else :
                        // Fallback content when no certificates are available
                        $certificates_to_display = array(
                            array(
                                'title' => 'ISO 9001:2015',
                                'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                            ),
                            array(
                                'title' => 'Chứng Nhận CE',
                                'image_url' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                            ),
                            array(
                                'title' => 'Xuất Sắc Ngành',
                                'image_url' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                            ),
                            array(
                                'title' => 'Chứng Nhận An Toàn',
                                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                            ),
                            array(
                                'title' => 'Chứng Nhận Chất Lượng',
                                'image_url' => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                            )
                        );
                    endif;
                    ?>

                    <div class="certificates-container" data-current="0">
                        <!-- Chevron Navigation Buttons -->
                        <?php if (count($certificates_to_display) > 1) : ?>
                            <button class="carousel-nav carousel-nav-prev" aria-label="Previous certificate">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="carousel-nav carousel-nav-next" aria-label="Next certificate">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        <?php endif; ?>

                        <div class="certificates-track">
                            <?php foreach ($certificates_to_display as $index => $certificate) :
                                $active_class = ($index === 0) ? ' active' : '';
                            ?>
                                <div class="certificate-slide<?php echo $active_class; ?>" data-index="<?php echo $index; ?>" data-title="<?php echo esc_attr($certificate['title']); ?>">
                                    <?php if ($certificate['image_url']) : ?>
                                        <div class="certificate-image">
                                            <img src="<?php echo esc_url($certificate['image_url']); ?>" alt="<?php echo esc_attr($certificate['title']); ?>">
                                            <!-- Tooltip -->
                                            <div class="certificate-tooltip"><?php echo esc_html($certificate['title']); ?></div>
                                        </div>
                                        <?php if ($certificate['title']) : ?>
                                            <div class="certificate-overlay">
                                                <h4 class="certificate-title"><?php echo esc_html($certificate['title']); ?></h4>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Navigation Indicators -->
                        <?php if (count($certificates_to_display) > 1) : ?>
                            <div class="certificate-indicators">
                                <?php foreach ($certificates_to_display as $index => $certificate) :
                                    $active_class = ($index === 0) ? ' active' : '';
                                ?>
                                    <button class="indicator-dot<?php echo $active_class; ?>" data-slide="<?php echo $index; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Customer Testimonials Section -->
    <?php if (get_theme_mod('testimonials_section_enable', true)) :
        // Get testimonials section styling options
        $testimonials_bg_color = get_theme_mod('testimonials_section_bg_color', '#ffffff');
        $testimonials_text_color = get_theme_mod('testimonials_section_text_color', '#333333');
        $testimonials_layout = get_theme_mod('testimonials_layout_style', 'grid');
    ?>
        <section class="testimonials-section layout-<?php echo esc_attr($testimonials_layout); ?>" style="background-color: <?php echo esc_attr($testimonials_bg_color); ?>; color: <?php echo esc_attr($testimonials_text_color); ?>;">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('testimonials_section_title', 'Khách Hàng Nói Gì Về Chúng Tôi')); ?></h2>
                    <div class="title-ribbon">
                        <div class="ribbon-line"></div>
                        <div class="ribbon-diamond"></div>
                        <div class="ribbon-line"></div>
                    </div>
                    <p class="section-subtitle"><?php echo esc_html(get_theme_mod('testimonials_section_subtitle', 'Những câu chuyện thật từ khách hàng hài lòng tin tưởng sản phẩm của chúng tôi')); ?></p>
                </div>

                <div class="testimonials-grid">
                    <?php
                    // Get testimonials from Customizer
                    $testimonials = get_testimonials();

                    if (!empty($testimonials)) :
                        foreach ($testimonials as $testimonial) :
                    ?>
                            <div class="testimonial-card">
                                <?php if (!empty($testimonial['image_url'])) : ?>
                                    <div class="testimonial-image">
                                        <img src="<?php echo esc_url($testimonial['image_url']); ?>" alt="<?php echo esc_attr($testimonial['customer_name']); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="testimonial-content">
                                    <div class="testimonial-rating">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <span class="star <?php echo ($i <= $testimonial['rating']) ? 'filled' : ''; ?>">★</span>
                                        <?php endfor; ?>
                                    </div>
                                    <blockquote class="testimonial-text">
                                        "<?php echo esc_html(wp_trim_words($testimonial['content'], 30)); ?>"
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <strong><?php echo esc_html($testimonial['customer_name']); ?></strong>
                                        <?php if (!empty($testimonial['customer_company'])) : ?>
                                            <span class="company"><?php echo esc_html($testimonial['customer_company']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <!-- Demo testimonials when no testimonials are available -->
                        <div class="testimonial-card">
                            <div class="testimonial-image">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Customer 1">
                            </div>
                            <div class="testimonial-content">
                                <div class="testimonial-rating">
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                </div>
                                <blockquote class="testimonial-text">
                                    "Chất lượng xuất sắc và dịch vụ đặc biệt. Sản phẩm này đã thay đổi hoạt động kinh doanh của chúng tôi và vượt quá mọi mong đợi."
                                </blockquote>
                                <div class="testimonial-author">
                                    <strong>Nguyễn Văn An</strong>
                                    <span class="company">Công ty Giải Pháp Công Nghệ</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card">
                            <div class="testimonial-image">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Customer 2">
                            </div>
                            <div class="testimonial-content">
                                <div class="testimonial-rating">
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                </div>
                                <blockquote class="testimonial-text">
                                    "Đáng tin cậy, hiệu quả và thân thiện với người dùng. Đội ngũ hỗ trợ cực kỳ nhanh chóng và hữu ích. Rất khuyến khích!"
                                </blockquote>
                                <div class="testimonial-author">
                                    <strong>Trần Thị Bình</strong>
                                    <span class="company">Tập Đoàn Toàn Cầu</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card">
                            <div class="testimonial-image">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Customer 3">
                            </div>
                            <div class="testimonial-content">
                                <div class="testimonial-rating">
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                </div>
                                <blockquote class="testimonial-text">
                                    "Đầu tư tốt nhất mà chúng tôi đã thực hiện cho công ty. Dịch vụ chuyên nghiệp và giải pháp đổi mới mang lại kết quả thực tế."
                                </blockquote>
                                <div class="testimonial-author">
                                    <strong>Lê Minh Cường</strong>
                                    <span class="company">Phòng Thí Nghiệm Đổi Mới</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php get_footer(); ?>