<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php
    // SEO Meta Tags
    $page_title = '';
    $meta_description = '';
    $meta_keywords = '';
    $canonical_url = '';
    $og_image = '';
    
    if (is_front_page()) {
        $page_title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
        $meta_description = get_theme_mod('site_meta_description', 'Skylight Plastic - Chuyên cung cấp sản phẩm nhựa chất lượng cao, giá cả hợp lý, giao hàng nhanh chóng trên toàn quốc.');
        $meta_keywords = get_theme_mod('site_meta_keywords', 'nhựa, sản phẩm nhựa, skylight plastic, chất lượng cao');
        $canonical_url = home_url('/');
        $og_image = get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
    } elseif (is_single()) {
        $page_title = get_the_title() . ' - ' . get_bloginfo('name');
        $meta_description = get_post_meta(get_the_ID(), '_meta_description', true);
        if (empty($meta_description)) {
            $meta_description = wp_trim_words(get_the_excerpt(), 25, '...');
        }
        $meta_keywords = get_post_meta(get_the_ID(), '_meta_keywords', true);
        $canonical_url = get_permalink();
        $og_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (empty($og_image)) {
            $og_image = get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
        }
    } elseif (is_page()) {
        $page_title = get_the_title() . ' - ' . get_bloginfo('name');
        $meta_description = get_post_meta(get_the_ID(), '_meta_description', true);
        if (empty($meta_description)) {
            $meta_description = wp_trim_words(get_the_content(), 25, '...');
        }
        $meta_keywords = get_post_meta(get_the_ID(), '_meta_keywords', true);
        $canonical_url = get_permalink();
        $og_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (empty($og_image)) {
            $og_image = get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
        }
    } elseif (is_category()) {
        $category = get_queried_object();
        $page_title = $category->name . ' - ' . get_bloginfo('name');
        $meta_description = $category->description ? wp_trim_words($category->description, 25, '...') : 'Danh mục ' . $category->name . ' tại ' . get_bloginfo('name');
        $canonical_url = get_category_link($category->term_id);
        $og_image = get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
    } elseif (is_tag()) {
        $tag = get_queried_object();
        $page_title = $tag->name . ' - ' . get_bloginfo('name');
        $meta_description = $tag->description ? wp_trim_words($tag->description, 25, '...') : 'Thẻ ' . $tag->name . ' tại ' . get_bloginfo('name');
        $canonical_url = get_tag_link($tag->term_id);
        $og_image = get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
    } elseif (is_archive()) {
        $page_title = get_the_archive_title() . ' - ' . get_bloginfo('name');
        $meta_description = get_the_archive_description() ? wp_trim_words(get_the_archive_description(), 25, '...') : 'Lưu trữ tại ' . get_bloginfo('name');
        $canonical_url = get_permalink();
        $og_image = get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
    } else {
        $page_title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
        $meta_description = get_bloginfo('description');
        $canonical_url = home_url($_SERVER['REQUEST_URI']);
        $og_image = get_theme_mod('site_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
    }
    
    // Clean up description
    $meta_description = strip_tags($meta_description);
    $meta_description = str_replace(array("\r", "\n", "\t"), ' ', $meta_description);
    $meta_description = trim(preg_replace('/\s+/', ' ', $meta_description));
    ?>
    
    <!-- SEO Meta Tags -->
    <?php if (!empty($meta_description)) : ?>
    <meta name="description" content="<?php echo esc_attr($meta_description); ?>">
    <?php endif; ?>
    
    <?php if (!empty($meta_keywords)) : ?>
    <meta name="keywords" content="<?php echo esc_attr($meta_keywords); ?>">
    <?php endif; ?>
    
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="author" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url($canonical_url); ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
    <meta property="og:title" content="<?php echo esc_attr($page_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta property="og:url" content="<?php echo esc_url($canonical_url); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($page_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#2c5aa0">
    <meta name="msapplication-TileColor" content="#2c5aa0">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <!-- Top Header Row - Contact Information -->
        <div class="header-top">
            <div class="container">
                <div class="header-top-content">
                    <div class="contact-info">
                        <?php if (get_theme_mod('display_region_selection', true)) : ?>
                            <span class="region-selector">
                                <select id="region-select" onchange="updateRegionInfo(this.value)">
                                    <?php
                                    $default_region = get_theme_mod('default_region', 'vietnam');
                                    $regions = array(
                                        'vietnam' => __('Vietnam', 'custom-blue-orange'),
                                        'usa' => __('United States', 'custom-blue-orange'),
                                        'uk' => __('United Kingdom', 'custom-blue-orange'),
                                        'singapore' => __('Singapore', 'custom-blue-orange'),
                                        'japan' => __('Japan', 'custom-blue-orange')
                                    );
                                    foreach ($regions as $value => $label) :
                                        $selected = ($value === $default_region) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo esc_attr($value); ?>" <?php echo $selected; ?>><?php echo esc_html($label); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </span>
                        <?php endif; ?>
                        <b class="phone">
                            SĐT: <?php
                                    $default_phone = get_theme_mod('default_phone_number', '+84 123 456 789');
                                    $phone_href = 'tel:' . preg_replace('/[^0-9+]/', '', $default_phone);
                                    ?>
                            <a href="<?php echo esc_attr($phone_href); ?>" id="phone-link"><?php echo esc_html($default_phone); ?></a>
                        </b>
                        <b class="email">
                            <?php $default_email = get_theme_mod('default_email_address', 'info@yoursite.com'); ?>
                            <a href="mailto:<?php echo esc_attr($default_email); ?>" id="email-link"><?php echo esc_html($default_email); ?></a>
                        </b>
                        <b class="address" id="address-text">
                            <?php echo esc_html(get_theme_mod('default_physical_address', '123 Đường Chính, Thành phố, Việt Nam')); ?>
                        </b>
                    </div>
                    
                    <div class="media-icons">
                        <?php
                        // Get social media links from customizer
                        $facebook_url = get_theme_mod('social_facebook_url', '');
                        $twitter_url = get_theme_mod('social_twitter_url', '');
                        $instagram_url = get_theme_mod('social_instagram_url', '');
                        $linkedin_url = get_theme_mod('social_linkedin_url', '');
                        $youtube_url = get_theme_mod('social_youtube_url', '');
                        $tiktok_url = get_theme_mod('social_tiktok_url', '');
                        ?>
                        
                        <?php if ($facebook_url) : ?>
                            <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon facebook" aria-label="Facebook">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($twitter_url) : ?>
                            <a href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon twitter" aria-label="Twitter">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($instagram_url) : ?>
                            <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon instagram" aria-label="Instagram">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($linkedin_url) : ?>
                            <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon linkedin" aria-label="LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($youtube_url) : ?>
                            <a href="<?php echo esc_url($youtube_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon youtube" aria-label="YouTube">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($tiktok_url) : ?>
                            <a href="<?php echo esc_url($tiktok_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon tiktok" aria-label="TikTok">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header Row - Logo and Navigation -->
        <?php
        $header_layout = get_theme_mod('header_layout_style', 'default');
        $nav_position = get_theme_mod('navigation_position', 'right');
        $header_classes = 'header-main layout-' . $header_layout . ' nav-' . $nav_position;
        ?>
        <!-- Single Mobile Menu Toggle Button -->
        <button class="menu-toggle" aria-controls="side-nav-panel" aria-expanded="false">
            ☰
        </button>

        <div class="<?php echo esc_attr($header_classes); ?>">
            <div class="container">
                <?php if ($header_layout === 'centered') : ?>
                    <!-- Centered Layout: Logo Center, Menu Below -->
                    <div class="header-centered">
                        <div class="site-branding centered">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="site-text">
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                                </h1>
                                <?php
                                $site_slogan = get_theme_mod('site_slogan');
                                if ($site_slogan) : ?>
                                    <p class="site-slogan"><?php echo esc_html($site_slogan); ?></p>
                                <?php elseif (get_bloginfo('description')) : ?>
                                    <p class="site-slogan"><?php bloginfo('description'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <nav class="main-navigation centered" role="navigation" aria-label="Primary Menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'primary-menu',
                                'container'      => false,
                                'fallback_cb'    => 'wp_page_menu',
                            ));
                            ?>
                        </nav>
                    </div>
                <?php elseif ($header_layout === 'stacked') : ?>
                    <!-- Stacked Layout: Logo Top, Menu Bottom -->
                    <div class="header-stacked">
                        <div class="site-branding stacked">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="site-text">
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                                </h1>
                                <?php
                                $site_slogan = get_theme_mod('site_slogan');
                                if ($site_slogan) : ?>
                                    <p class="site-slogan"><?php echo esc_html($site_slogan); ?></p>
                                <?php elseif (get_bloginfo('description')) : ?>
                                    <p class="site-slogan"><?php bloginfo('description'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <nav class="main-navigation stacked" role="navigation" aria-label="Primary Menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'primary-menu',
                                'container'      => false,
                                'fallback_cb'    => 'wp_page_menu',
                            ));
                            ?>
                        </nav>
                    </div>
                <?php else : ?>
                    <!-- Default Layout: Logo Left/Right, Menu Right/Left -->
                    <?php if ($nav_position === 'left') : ?>
                        <nav class="main-navigation" role="navigation" aria-label="Primary Menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'primary-menu',
                                'container'      => false,
                                'fallback_cb'    => 'wp_page_menu',
                            ));
                            ?>
                        </nav>

                        <div class="site-branding">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="site-text">
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                                </h1>
                                <?php
                                $site_slogan = get_theme_mod('site_slogan');
                                if ($site_slogan) : ?>
                                    <p class="site-slogan"><?php echo esc_html($site_slogan); ?></p>
                                <?php elseif (get_bloginfo('description')) : ?>
                                    <p class="site-slogan"><?php bloginfo('description'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Default: Logo Left, Menu Right -->
                        <div class="site-branding">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="site-text">
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                                </h1>
                                <?php
                                $site_slogan = get_theme_mod('site_slogan');
                                if ($site_slogan) : ?>
                                    <p class="site-slogan"><?php echo esc_html($site_slogan); ?></p>
                                <?php elseif (get_bloginfo('description')) : ?>
                                    <p class="site-slogan"><?php bloginfo('description'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <nav class="main-navigation" role="navigation" aria-label="Primary Menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'primary-menu',
                                'container'      => false,
                                'fallback_cb'    => 'wp_page_menu',
                            ));
                            ?>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Side Navigation Panel -->
    <div class="nav-overlay" id="nav-overlay"></div>
    <div class="side-nav-panel" id="side-nav-panel">
        <div class="side-nav-header">
            <h3><?php bloginfo('name'); ?></h3>
            <button class="side-nav-close" id="side-nav-close">&times;</button>
        </div>
        <nav class="side-nav-content">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'side-nav-menu',
                'menu_class'     => 'side-nav-menu',
                'container'      => false,
                'fallback_cb'    => 'wp_page_menu',
            ));
            ?>
        </nav>
    </div>

    <script>
        // Side navigation toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const sideNavPanel = document.getElementById('side-nav-panel');
            const navOverlay = document.getElementById('nav-overlay');
            const sideNavClose = document.getElementById('side-nav-close');

            function openSideNav() {
                sideNavPanel.classList.add('active');
                navOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSideNav() {
                sideNavPanel.classList.remove('active');
                navOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            if (menuToggle) {
                menuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    openSideNav();
                });
            }

            if (sideNavClose) {
                sideNavClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeSideNav();
                });
            }

            if (navOverlay) {
                navOverlay.addEventListener('click', function() {
                    closeSideNav();
                });
            }

            // Close side nav on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSideNav();
                }
            });
        });

        // Region selector functionality
        <?php if (get_theme_mod('display_region_selection', true)) : ?>

            function updateRegionInfo(region) {
                const phoneLink = document.getElementById('phone-link');
                const emailLink = document.getElementById('email-link');
                const addressText = document.getElementById('address-text');

                const regionData = {
                    <?php
                    $regions = array(
                        array('value' => 'vietnam', 'label' => 'Vietnam'),
                        array('value' => 'usa', 'label' => 'USA'),
                        array('value' => 'uk', 'label' => 'UK'),
                        array('value' => 'singapore', 'label' => 'Singapore'),
                        array('value' => 'japan', 'label' => 'Japan')
                    );
                    foreach ($regions as $index => $region_data) :
                        $region_key = $region_data['value'];
                        $phone = get_theme_mod("{$region_key}_phone", '');
                        $email = get_theme_mod("{$region_key}_email", '');
                        $address = get_theme_mod("{$region_key}_address", '');

                        // Fallback to default values if region-specific customizer is empty
                        if (empty($phone) && empty($email) && empty($address)) {
                            switch ($region_key) {
                                case 'vietnam':
                                    $phone = get_theme_mod('default_phone_number', '+84 123 456 789');
                                    $email = get_theme_mod('default_email_address', 'info@yoursite.com');
                                    $address = get_theme_mod('default_physical_address', '123 Đường Chính, Thành phố, Việt Nam');
                                    break;
                                case 'usa':
                                    $phone = '+1 555 123 4567';
                                    $email = 'info@yoursite.com';
                                    $address = '123 Main Street, New York, NY 10001, USA';
                                    break;
                                case 'uk':
                                    $phone = '+44 20 7123 4567';
                                    $email = 'info@yoursite.co.uk';
                                    $address = '123 High Street, London SW1A 1AA, UK';
                                    break;
                                case 'singapore':
                                    $phone = '+65 6123 4567';
                                    $email = 'info@yoursite.sg';
                                    $address = '123 Orchard Road, Singapore 238858';
                                    break;
                                case 'japan':
                                    $phone = '+81 3 1234 5678';
                                    $email = 'info@yoursite.jp';
                                    $address = '123 Shibuya, Tokyo 150-0002, Japan';
                                    break;
                            }
                        }

                        $phone_href = 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
                    ?>
                    '<?php echo esc_js($region_key); ?>': {
                        phone: '<?php echo esc_js($phone); ?>',
                        phoneHref: '<?php echo esc_js($phone_href); ?>',
                        email: '<?php echo esc_js($email); ?>',
                        address: '<?php echo esc_js($address); ?>'
                    }<?php echo ($index < count($regions) - 1) ? ',' : ''; ?>
                    <?php endforeach; ?>
                };

                if (regionData[region]) {
                    phoneLink.textContent = regionData[region].phone;
                    phoneLink.href = regionData[region].phoneHref;
                    emailLink.textContent = regionData[region].email;
                    emailLink.href = 'mailto:' + regionData[region].email;
                    addressText.textContent = regionData[region].address;
                }
            }
        <?php endif; ?>
    </script>