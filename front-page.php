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
                                $category_link = '#';
                                if (function_exists('get_term_link') && isset($category_data['category']->taxonomy)) {
                                    $term_link = get_term_link($category_data['category']);
                                    if (!is_wp_error($term_link)) {
                                        $category_link = $term_link;
                                    }
                                }
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
                        <a href="#" class="show-all-btn">Xem Tất Cả Sản Phẩm</a>
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
                                    ?>
                                                <div class="video-wrapper youtube-video">
                                                    <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>?rel=0&showinfo=0"
                                                        frameborder="0"
                                                        allowfullscreen
                                                        title="<?php echo esc_attr($video['title']); ?>">
                                                    </iframe>
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
                                                    <iframe src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>"
                                                        frameborder="0"
                                                        allowfullscreen
                                                        title="<?php echo esc_attr($video['title']); ?>">
                                                    </iframe>
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
                                    <div class="article-author">
                                        <span class="author-name">Bởi <?php the_author(); ?></span>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- See All Articles Button -->
                    <div class="section-footer">
                        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-outline-primary btn-see-all">
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
                                <div class="article-author">
                                    <span class="author-name">Bởi Admin</span>
                                </div>
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
                                <div class="article-author">
                                    <span class="author-name">Bởi Admin</span>
                                </div>
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
                                <div class="article-author">
                                    <span class="author-name">Bởi Admin</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Show All Articles Button -->
                    <div class="section-footer">
                        <a href="#" class="btn btn-outline-primary btn-see-all">Xem Tất Cả Bài Viết</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php get_footer(); ?>