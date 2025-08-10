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
                    <span class="region-selector">
                        <select id="region-select" onchange="updateRegionInfo(this.value)">
                            <option value="vietnam" selected>Vietnam</option>
                            <option value="usa">United States</option>
                            <option value="uk">United Kingdom</option>
                            <option value="singapore">Singapore</option>
                            <option value="japan">Japan</option>
                        </select>
                    </span>
                    <span class="phone">
                        <a href="tel:+84123456789" id="phone-link">+84 123 456 789</a>
                    </span>
                    <span class="email">
                        <a href="mailto:info@yoursite.com" id="email-link">info@yoursite.com</a>
                    </span>
                    <span class="address" id="address-text">
                        123 Đường Chính, Thành phố, Việt Nam
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Header Row - Logo and Navigation -->
        <div class="header-main">
            <div class="container">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>

                    <?php if (get_bloginfo('description')) : ?>
                        <p class="site-description"><?php bloginfo('description'); ?></p>
                    <?php endif; ?>
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
        function updateRegionInfo(region) {
            const phoneLink = document.getElementById('phone-link');
            const emailLink = document.getElementById('email-link');
            const addressText = document.getElementById('address-text');

            const regionData = {
                vietnam: {
                    phone: '+84 123 456 789',
                    phoneHref: 'tel:+84123456789',
                    email: 'info@yoursite.com',
                    address: '123 Đường Chính, Thành phố, Việt Nam'
                },
                usa: {
                    phone: '+1 555 123 4567',
                    phoneHref: 'tel:+15551234567',
                    email: 'info@yoursite.com',
                    address: '123 Main Street, New York, NY 10001, USA'
                },
                uk: {
                    phone: '+44 20 7123 4567',
                    phoneHref: 'tel:+442071234567',
                    email: 'info@yoursite.co.uk',
                    address: '123 High Street, London SW1A 1AA, UK'
                },
                singapore: {
                    phone: '+65 6123 4567',
                    phoneHref: 'tel:+6561234567',
                    email: 'info@yoursite.sg',
                    address: '123 Orchard Road, Singapore 238858'
                },
                japan: {
                    phone: '+81 3 1234 5678',
                    phoneHref: 'tel:+81312345678',
                    email: 'info@yoursite.jp',
                    address: '123 Shibuya, Tokyo 150-0002, Japan'
                }
            };

            if (regionData[region]) {
                phoneLink.textContent = regionData[region].phone;
                phoneLink.href = regionData[region].phoneHref;
                emailLink.textContent = regionData[region].email;
                emailLink.href = 'mailto:' + regionData[region].email;
                addressText.textContent = regionData[region].address;
            }
        }
    </script>