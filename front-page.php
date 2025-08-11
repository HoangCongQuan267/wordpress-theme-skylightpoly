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

<!-- Hero Section with Dynamic Slideshow -->
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
    <?php
    else :
    ?>
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
<?php
    endif; // End slideshow enabled check
endif; // End hero slides check
?>

<!-- New Products Section -->
<?php if (get_theme_mod('products_section_enable', true)) : ?>
    <section class="products-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('products_section_title', 'Sản Phẩm Mới Nhất')); ?></h2>
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
<?php if (get_theme_mod('certificates_section_enable', true)) : ?>
    <section class="certificates-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('certificates_section_title', 'Chứng Nhận Của Chúng Tôi')); ?></h2>
                <p class="section-subtitle"><?php echo esc_html(get_theme_mod('certificates_section_subtitle', 'Chứng nhận chất lượng và sự công nhận trong ngành')); ?></p>
            </div>

            <div class="certificates-grid">
                <?php
                $certificates = get_certificates();
                if (!empty($certificates)) :
                    foreach ($certificates as $certificate) : ?>
                        <div class="certificate-card">
                            <?php if ($certificate['image_url']) : ?>
                                <div class="certificate-icon">
                                    <img src="<?php echo esc_url($certificate['image_url']); ?>" alt="<?php echo esc_attr($certificate['title']); ?>" width="60" height="60">
                                </div>
                            <?php else : ?>
                                <div class="certificate-icon">
                                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L15.09 8.26L22 9L17 14L18.18 21L12 17.77L5.82 21L7 14L2 9L8.91 8.26L12 2Z" fill="#FFD700" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <h4 class="certificate-title"><?php echo esc_html($certificate['title']); ?></h4>
                            <p class="certificate-description"><?php echo esc_html($certificate['content']); ?></p>
                        </div>
                    <?php endforeach;
                else : ?>
                    <!-- Fallback content when no certificates are available -->
                    <div class="certificate-card">
                        <div class="certificate-icon">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L15.09 8.26L22 9L17 14L18.18 21L12 17.77L5.82 21L7 14L2 9L8.91 8.26L12 2Z" fill="#FFD700" />
                            </svg>
                        </div>
                        <h4 class="certificate-title">ISO 9001:2015</h4>
                        <p class="certificate-description">Chứng nhận Hệ thống Quản lý Chất lượng đảm bảo tiêu chuẩn chất lượng nhất quán.</p>
                    </div>
                    <div class="certificate-card">
                        <div class="certificate-icon">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h4 class="certificate-title">Chứng Nhận CE</h4>
                        <p class="certificate-description">Dấu hiệu Tuân thủ Châu Âu cho thấy sự tuân thủ các tiêu chuẩn an toàn của EU.</p>
                    </div>
                    <div class="certificate-card">
                        <div class="certificate-icon">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L13.09 8.26L20 9L14 14L16.18 21L12 17.77L7.82 21L10 14L4 9L10.91 8.26L12 2Z" fill="#2196F3" />
                            </svg>
                        </div>
                        <h4 class="certificate-title">Xuất Sắc Ngành</h4>
                        <p class="certificate-description">Được công nhận về hiệu suất xuất sắc và đổi mới trong lĩnh vực ngành của chúng tôi.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Customer Testimonials Section -->
<?php if (get_theme_mod('testimonials_section_enable', true)) : ?>
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('testimonials_section_title', 'Khách Hàng Nói Gì Về Chúng Tôi')); ?></h2>
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

<!-- Contact Form Section -->
<?php if (get_theme_mod('contact_section_enable', true)) : ?>
    <section class="contact-form-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('contact_section_title', 'Liên Hệ Với Chúng Tôi')); ?></h2>
                <p class="section-subtitle"><?php echo esc_html(get_theme_mod('contact_section_subtitle', 'Hãy liên hệ với chúng tôi để được tư vấn và hỗ trợ tốt nhất')); ?></p>
            </div>

            <div class="contact-form-wrapper">
                <div class="contact-info">
                    <div class="contact-items-wrapper">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 16.5C21 16.88 20.79 17.21 20.47 17.38L12.57 21.82C12.41 21.94 12.21 22 12 22C11.79 22 11.59 21.94 11.43 21.82L3.53 17.38C3.21 17.21 3 16.88 3 16.5V7.5C3 7.12 3.21 6.79 3.53 6.62L11.43 2.18C11.59 2.06 11.79 2 12 2C12.21 2 12.41 2.06 12.57 2.18L20.47 6.62C20.79 6.79 21 7.12 21 7.5V16.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="contact-details">
                                <strong>Địa Chỉ</strong>
                                <p>123 Đường Kinh Doanh<br>Thành Phố, Tỉnh 12345</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 16.92V19.92C22 20.52 21.52 21 20.92 21C9.4 21 0 11.6 0 0.08C0 -0.52 0.48 -1 1.08 -1H4.08C4.68 -1 5.16 -0.52 5.16 0.08C5.16 2.08 5.44 4.04 6 5.92C6.18 6.4 6.04 6.94 5.64 7.34L4.12 8.86C5.84 12.48 8.52 15.16 12.14 16.88L13.66 15.36C14.06 14.96 14.6 14.82 15.08 15C16.96 15.56 18.92 15.84 20.92 15.84C21.52 15.84 22 16.32 22 16.92Z" fill="currentColor" />
                                </svg>
                            </div>
                            <div class="contact-details">
                                <strong>Điện Thoại</strong>
                                <p>+84 (028) 123-4567</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="contact-details">
                                <strong>Email</strong>
                                <p>info@congtyban.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <form id="contact-form" method="post" action="#">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first-name">Tên *</label>
                                <input type="text" id="first-name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Họ *</label>
                                <input type="text" id="last-name" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Địa Chỉ Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số Điện Thoại</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="company">Công Ty</label>
                            <input type="text" id="company" name="company">
                        </div>
                        <div class="form-group">
                            <label for="message">Tin Nhắn *</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Hãy cho chúng tôi biết về dự án hoặc yêu cầu của bạn..."></textarea>
                        </div>
                        <button type="submit" class="submit-btn">
                            <span>Gửi Tin Nhắn</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <polygon points="22,2 15,22 11,13 2,9 22,2" fill="currentColor" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Floating Contact Button -->
<div class="phone-number-panel" id="phonePanel">
    <div class="panel-header">
        <h4>Liên Hệ Đội Ngũ Bán Hàng</h4>
        <button class="close-panel-btn" onclick="closeContactPanel()">&times;</button>
    </div>
    <div class="contact-list">
        <div class="contact-item">
            <div class="contact-avatar">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="contact-info-2">
                <div class="contact-name">Nguyễn Văn An</div>
                <a href="tel:+84123456789" class="contact-phone">+84 123 456 789</a>
            </div>
        </div>
        <div class="contact-item">
            <div class="contact-avatar">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="contact-info-2">
                <div class="contact-name">Trần Thị Bình</div>
                <a href="tel:+84987654321" class="contact-phone">+84 987 654 321</a>
            </div>
        </div>
        <div class="contact-item">
            <div class="contact-avatar">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="contact-info-2">
                <div class="contact-name">Lê Minh Cường</div>
                <a href="tel:+84555123456" class="contact-phone">+84 555 123 456</a>
            </div>
        </div>
    </div>
</div>

<!-- Zalo Floating Button -->
<div class="zalo-floating-btn" id="zaloFloatingBtn">
    <a href="https://zalo.me/" target="_blank" class="zalo-btn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.48 2 2 6.48 2 12c0 1.54.36 3.04 1.05 4.36L2 22l5.64-1.05C9.96 21.64 11.46 22 13 22h-1c5.52 0 10-4.48 10-10S17.52 2 12 2z" fill="#0068FF" />
            <path d="M8.5 9.5c0-.28.22-.5.5-.5h6c.28 0 .5.22.5.5s-.22.5-.5.5H9c-.28 0-.5-.22-.5-.5zm0 2c0-.28.22-.5.5-.5h6c.28 0 .5.22.5.5s-.22.5-.5.5H9c-.28 0-.5-.22-.5-.5zm0 2c0-.28.22-.5.5-.5h4c.28 0 .5.22.5.5s-.22.5-.5.5H9c-.28 0-.5-.22-.5-.5z" fill="white" />
        </svg>
        <span class="zalo-text">Zalo</span>
    </a>
</div>
</div>

<!-- Floating Message Button -->
<div class="floating-message-btn" id="floatingMessageBtn">
    <button class="message-btn" onclick="scrollToContact()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M8 9h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M8 13h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
</div>

<div class="floating-contact-btn" id="floatingContactBtn">
    <div class="contact-btn-container" id="contactBtnContainer">
        <div class="ring-animation"></div>
        <div class="ring-animation ring-delay-1"></div>
        <div class="ring-animation ring-delay-2"></div>
        <button class="contact-btn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.59531 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5865 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</div>

<?php get_footer(); ?>