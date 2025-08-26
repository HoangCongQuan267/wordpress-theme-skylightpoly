<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
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
                    <span class="phone">
                        <?php
                        $default_phone = get_theme_mod('default_phone', '+84 123 456 789');
                        $phone_href = 'tel:' . preg_replace('/[^0-9+]/', '', $default_phone);
                        ?>
                        <a href="<?php echo esc_attr($phone_href); ?>" id="phone-link"><?php echo esc_html($default_phone); ?></a>
                    </span>
                    <span class="email">
                        <?php $default_email = get_theme_mod('default_email', 'info@yoursite.com'); ?>
                        <a href="mailto:<?php echo esc_attr($default_email); ?>" id="email-link"><?php echo esc_html($default_email); ?></a>
                    </span>
                    <span class="address" id="address-text">
                        <?php echo esc_html(get_theme_mod('default_address', '123 Đường Chính, Thành phố, Việt Nam')); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Header Row - Logo and Navigation -->
        <?php
        $header_layout = get_theme_mod('header_layout_style', 'default');
        $nav_position = get_theme_mod('navigation_position', 'right');
        $header_classes = 'header-main layout-' . $header_layout . ' nav-' . $nav_position;
        ?>
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
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                ☰
                            </button>

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
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                ☰
                            </button>

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
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                ☰
                            </button>

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
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                ☰
                            </button>

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

    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navigation = document.querySelector('.main-navigation ul');

            if (menuToggle && navigation) {
                menuToggle.addEventListener('click', function() {
                    const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';

                    menuToggle.setAttribute('aria-expanded', !isExpanded);
                    navigation.style.display = isExpanded ? 'none' : 'flex';

                    if (window.innerWidth <= 768) {
                        navigation.style.flexDirection = 'column';
                    }
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!menuToggle.contains(event.target) && !navigation.contains(event.target)) {
                        menuToggle.setAttribute('aria-expanded', 'false');
                        if (window.innerWidth <= 768) {
                            navigation.style.display = 'none';
                        }
                    }
                });

                // Handle window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 768) {
                        navigation.style.display = 'flex';
                        navigation.style.flexDirection = 'row';
                        menuToggle.setAttribute('aria-expanded', 'false');
                    } else {
                        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
                        navigation.style.display = isExpanded ? 'flex' : 'none';
                        navigation.style.flexDirection = 'column';
                    }
                });
            }
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
        });
    </script>