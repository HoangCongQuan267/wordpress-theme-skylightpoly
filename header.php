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
                                $default_phone = get_theme_mod('default_phone', '+84 123 456 789');
                                $phone_href = 'tel:' . preg_replace('/[^0-9+]/', '', $default_phone);
                                ?>
                        <a href="<?php echo esc_attr($phone_href); ?>" id="phone-link"><?php echo esc_html($default_phone); ?></a>
                    </b>
                    <b class="email">
                        <?php $default_email = get_theme_mod('default_email', 'info@yoursite.com'); ?>
                        <a href="mailto:<?php echo esc_attr($default_email); ?>" id="email-link"><?php echo esc_html($default_email); ?></a>
                    </b>
                    <b class="address" id="address-text">
                        <?php echo esc_html(get_theme_mod('default_address', '123 Đường Chính, Thành phố, Việt Nam')); ?>
                    </b>
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
                        $phone = get_theme_mod("region_{$region_key}_phone", '');
                        $email = get_theme_mod("region_{$region_key}_email", '');
                        $address = get_theme_mod("region_{$region_key}_address", '');

                        // Fallback to default values if region-specific customizer is empty
                        if (empty($phone) && empty($email) && empty($address)) {
                            switch ($region_key) {
                                case 'vietnam':
                                    $phone = get_theme_mod('default_phone', '+84 123 456 789');
                                    $email = get_theme_mod('default_email', 'info@yoursite.com');
                                    $address = get_theme_mod('default_address', '123 Đường Chính, Thành phố, Việt Nam');
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
                    ?> '<?php echo esc_attr($region_key); ?>': {
                            phone: '<?php echo esc_attr($phone); ?>',
                            phoneHref: '<?php echo esc_attr($phone_href); ?>',
                            email: '<?php echo esc_attr($email); ?>',
                            address: '<?php echo esc_attr($address); ?>'
                        }
                        <?php echo ($index < count($regions) - 1) ? ',' : ''; ?>
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