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
<section class="products-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Sản Phẩm Mới Nhất</h2>
            <p class="section-subtitle">Khám phá những đổi mới và giải pháp tiên tiến nhất của chúng tôi</p>
        </div>

        <div class="products-grid">
            <?php
            // Get latest products (you can customize this query)
            $products_query = new WP_Query(array(
                'post_type' => 'product', // Change to your product post type
                'posts_per_page' => 6,
                'meta_key' => '_featured_product',
                'meta_value' => 'yes',
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($products_query->have_posts()) :
                while ($products_query->have_posts()) : $products_query->the_post();
            ?>
                    <div class="product-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="product-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="product-content">
                            <h4 class="product-title"><?php the_title(); ?></h4>
                            <p class="product-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <a href="<?php the_permalink(); ?>" class="product-link">Tìm Hiểu Thêm</a>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <!-- Demo products when no products are available -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 1">
                    </div>
                    <div class="product-content">
                        <h4 class="product-title">Sản Phẩm Cao Cấp A</h4>
                        <p class="product-excerpt">Giải pháp chất lượng cao được thiết kế cho các doanh nghiệp hiện đại với tính năng tiên tiến.</p>
                        <a href="#" class="product-link">Tìm Hiểu Thêm</a>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://images.unsplash.com/photo-1560472355-536de3962603?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 2">
                    </div>
                    <div class="product-content">
                        <h4 class="product-title">Dòng Sản Phẩm Đổi Mới B</h4>
                        <p class="product-excerpt">Công nghệ tiên tiến mang lại hiệu suất và độ tin cậy vượt trội.</p>
                        <a href="#" class="product-link">Tìm Hiểu Thêm</a>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://images.unsplash.com/photo-1560472354-981537c68e96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Product 3">
                    </div>
                    <div class="product-content">
                        <h4 class="product-title">Bộ Giải Pháp Chuyên Nghiệp C</h4>
                        <p class="product-excerpt">Giải pháp toàn diện cho các yêu cầu cấp doanh nghiệp và khả năng mở rộng.</p>
                        <a href="#" class="product-link">Tìm Hiểu Thêm</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Certificates Section -->
<section class="certificates-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Chứng Nhận Của Chúng Tôi</h2>
            <p class="section-subtitle">Chứng nhận chất lượng và sự công nhận trong ngành</p>
        </div>

        <div class="certificates-grid">
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
        </div>
    </div>
</section>

<!-- Customer Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Khách Hàng Nói Gì Về Chúng Tôi</h2>
            <p class="section-subtitle">Những câu chuyện thật từ khách hàng hài lòng tin tưởng sản phẩm của chúng tôi</p>
        </div>

        <div class="testimonials-grid">
            <?php
            // Get testimonials (you can customize this query)
            $testimonials_query = new WP_Query(array(
                'post_type' => 'testimonial', // Change to your testimonial post type
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($testimonials_query->have_posts()) :
                while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                    $customer_name = get_post_meta(get_the_ID(), '_customer_name', true);
                    $customer_company = get_post_meta(get_the_ID(), '_customer_company', true);
                    $customer_rating = get_post_meta(get_the_ID(), '_customer_rating', true);
            ?>
                    <div class="testimonial-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="testimonial-image">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="testimonial-content">
                            <div class="testimonial-rating">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <span class="star <?php echo ($i <= $customer_rating) ? 'filled' : ''; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <blockquote class="testimonial-text">
                                "<?php echo wp_trim_words(get_the_content(), 30); ?>"
                            </blockquote>
                            <div class="testimonial-author">
                                <strong><?php echo esc_html($customer_name ?: get_the_title()); ?></strong>
                                <?php if ($customer_company) : ?>
                                    <span class="company"><?php echo esc_html($customer_company); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
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

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Liên Hệ Với Chúng Tôi</h2>
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

<?php get_footer(); ?>