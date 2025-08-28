<!-- Contact Form Section - Global -->
<?php if (get_theme_mod('contact_section_enable', true)) : ?>
    <section class="contact-form-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('contact_section_title', 'Liên Hệ Với Chúng Tôi')); ?></h2>
                <div class="title-ribbon">
                    <div class="ribbon-line"></div>
                    <div class="ribbon-diamond"></div>
                    <div class="ribbon-line"></div>
                </div>
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
                                <p><?php echo nl2br(esc_html(get_theme_mod('company_address', '123 Đường Kinh Doanh\nThành Phố, Tỉnh 12345'))); ?></p>
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
                                <p><?php echo esc_html(get_theme_mod('company_phone', '+84 (028) 123-4567')); ?></p>
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
                                <p><?php echo esc_html(get_theme_mod('company_email', 'info@congtyban.com')); ?></p>
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

<!-- Subfooter Section -->
<section class="subfooter">
    <div class="container">
        <div class="subfooter-content">
            <div class="subfooter-links">
                <h4>Thông tin hữu ích</h4>
                <ul class="info-links">
                    <li><a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh')); ?>">Chính sách bảo hành</a></li>
                    <li><a href="<?php echo esc_url(home_url('/chinh-sach-doi-tra')); ?>">Chính sách đổi trả</a></li>
                    <li><a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat')); ?>">Chính sách bảo mật</a></li>
                    <li><a href="<?php echo esc_url(home_url('/chinh-sach-giao-hang')); ?>">Chính sách giao hàng</a></li>
                    <li><a href="<?php echo esc_url(home_url('/chinh-sach-thanh-toan')); ?>">Chính sách thanh toán</a></li>
                </ul>
            </div>
            <div class="subfooter-links">
                <h4>Hỗ trợ khách hàng</h4>
                <ul class="support-links">
                    <li><a href="<?php echo esc_url(home_url('/huong-dan-su-dung')); ?>">Hướng dẫn sử dụng</a></li>
                    <li><a href="<?php echo esc_url(home_url('/tai-lieu-ky-thuat')); ?>">Tài liệu kỹ thuật</a></li>
                </ul>
            </div>
            <div class="subfooter-links">
                <h4>Về công ty</h4>
                <ul class="company-links">
                    <li><a href="<?php echo esc_url(home_url('/gioi-thieu')); ?>">Giới thiệu</a></li>
                    <li><a href="<?php echo esc_url(home_url('/tin-tuc')); ?>">Tin tức</a></li>
                    <li><a href="<?php echo esc_url(home_url('/tuyen-dung')); ?>">Tuyển dụng</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-info">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>

                <div class="footer-contact">
                    <h3>Thông tin liên hệ</h3>
                    <p>Điện thoại: <?php echo esc_html(get_theme_mod('company_phone', '+84 (028) 123-4567')); ?></p>
                    <p>Email: <?php echo esc_html(get_theme_mod('company_email', 'info@congtyban.com')); ?></p>
                    <p>Địa chỉ: <?php echo nl2br(esc_html(get_theme_mod('company_address', '123 Đường Kinh Doanh\nThành Phố, Tỉnh 12345'))); ?></p>
                </div>

                <div class="footer-social">
                    <h3>Theo dõi chúng tôi</h3>
                    <div class="social-links">
                        <?php
                        // Get social media links from customizer (same as header)
                        $facebook_url = get_theme_mod('social_facebook_url', '');
                        $twitter_url = get_theme_mod('social_twitter_url', '');
                        $instagram_url = get_theme_mod('social_instagram_url', '');
                        $linkedin_url = get_theme_mod('social_linkedin_url', '');
                        $youtube_url = get_theme_mod('social_youtube_url', '');
                        ?>

                        <?php if ($facebook_url) : ?>
                            <a href="<?php echo esc_url($facebook_url); ?>" class="social-link" target="_blank" rel="noopener noreferrer">Facebook</a>
                        <?php endif; ?>

                        <?php if ($twitter_url) : ?>
                            <a href="<?php echo esc_url($twitter_url); ?>" class="social-link" target="_blank" rel="noopener noreferrer">Twitter</a>
                        <?php endif; ?>

                        <?php if ($instagram_url) : ?>
                            <a href="<?php echo esc_url($instagram_url); ?>" class="social-link" target="_blank" rel="noopener noreferrer">Instagram</a>
                        <?php endif; ?>

                        <?php if ($linkedin_url) : ?>
                            <a href="<?php echo esc_url($linkedin_url); ?>" class="social-link" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        <?php endif; ?>

                        <?php if ($youtube_url) : ?>
                            <a href="<?php echo esc_url($youtube_url); ?>" class="social-link" target="_blank" rel="noopener noreferrer">YouTube</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<style>
    /* Subfooter Styles */
    .subfooter {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        padding: 40px 0;
        margin-top: 60px;
    }

    .subfooter-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .subfooter-links h4 {
        color: var(--primary-dark, #2c3e50);
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--gold, #d4af37);
        position: relative;
    }

    .subfooter-links h4::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 30px;
        height: 2px;
        background: var(--primary-sky-blue, #007acc);
    }

    .subfooter-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .subfooter-links ul li {
        margin-bottom: 12px;
    }

    .subfooter-links ul li a {
        color: #6c757d;
        text-decoration: none;
        font-size: 14px;
        line-height: 1.5;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        padding: 5px 0;
    }

    .subfooter-links ul li a:hover {
        color: var(--primary-sky-blue, #007acc);
        padding-left: 10px;
        transform: translateX(5px);
    }

    .subfooter-links ul li a::before {
        content: '▸';
        margin-right: 8px;
        color: var(--gold, #d4af37);
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .subfooter-links ul li a:hover::before {
        color: var(--primary-sky-blue, #007acc);
        transform: translateX(3px);
    }

    @media (max-width: 768px) {
        .subfooter {
            padding: 30px 0;
            margin-top: 40px;
        }

        .subfooter-content {
            grid-template-columns: 1fr;
            gap: 25px;
            padding: 0 20px;
        }

        .subfooter-links h4 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .subfooter-links ul li {
            margin-bottom: 10px;
        }

        .subfooter-links ul li a {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .subfooter {
            padding: 25px 0;
        }

        .subfooter-content {
            padding: 0 15px;
        }
    }

    .footer-content {
        margin-bottom: 20px;
        text-align: left;
    }

    .footer-info h3 {
        color: var(--gold);
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: 400;
    }

    .footer-info p {
        margin-bottom: 8px;
        line-height: 1.5;
        font-size: 14px;
    }

    .footer-contact {
        margin: 15px 0;
    }

    .footer-contact p {
        margin-bottom: 6px;
        font-size: 14px;
    }

    .footer-contact a {
        color: var(--white);
        text-decoration: none;
    }

    .footer-contact a:hover {
        color: var(--gold);
    }

    .footer-social {
        margin-top: 15px;
    }

    .footer-social a {
        color: var(--white);
        font-size: 14px;
        margin-right: 20px;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-social a:hover {
        color: var(--gold);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 15px;
        text-align: left;
    }

    .footer-bottom p {
        margin-bottom: 4px;
        font-size: 12px;
        opacity: 0.7;
    }

    .footer-bottom a {
        color: var(--gold);
        text-decoration: none;
    }

    .footer-bottom a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .footer-info {
            text-align: left;
        }

        .footer-social a {
            margin-right: 15px;
        }
    }
</style>

<!-- Floating Buttons - Global -->
<!-- Phone Number Panel -->
<div class="phone-number-panel" id="phonePanel">
    <div class="panel-header">
        <h4>Liên Hệ Đội Ngũ Bán Hàng</h4>
        <button class="close-panel-btn" onclick="closeContactPanel()">&times;</button>
    </div>
    <div class="contact-list">
        <?php
        $sales_contacts = get_sales_contacts();
        if (!empty($sales_contacts)) :
            foreach ($sales_contacts as $contact) : ?>
                <div class="contact-item">
                    <div class="contact-avatar">
                        <?php if (!empty($contact['avatar_url'])) : ?>
                            <img src="<?php echo esc_url($contact['avatar_url']); ?>" alt="<?php echo esc_attr($contact['name']); ?>" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                        <?php else : ?>
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        <?php endif; ?>
                    </div>
                    <div class="contact-info-2">
                        <div class="contact-name"><?php echo esc_html($contact['name']); ?></div>
                        <?php if (!empty($contact['position'])) : ?>
                            <div class="contact-position" style="font-size: 12px; color: #666; margin-bottom: 2px;"><?php echo esc_html($contact['position']); ?></div>
                        <?php endif; ?>
                        <a href="tel:<?php echo esc_attr(str_replace(' ', '', $contact['phone'])); ?>" class="contact-phone"><?php echo esc_html($contact['phone']); ?></a>
                    </div>
                </div>
            <?php endforeach;
        else : ?>
            <!-- Fallback to default contacts if none configured -->
            <div class="contact-item">
                <div class="contact-avatar">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="contact-info-2">
                    <div class="contact-name">Nguyễn Văn An</div>
                    <div class="contact-position" style="font-size: 12px; color: #666; margin-bottom: 2px;">Sales Manager</div>
                    <a href="tel:+84123456789" class="contact-phone">+84 123 456 789</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Zalo Floating Button -->
<div class="zalo-floating-btn" id="zaloFloatingBtn">
    <a href="<?php echo esc_url(get_theme_mod('social_zalo_url', 'https://zalo.me/')); ?>" target="_blank" class="zalo-btn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.48 2 2 6.48 2 12c0 1.54.36 3.04 1.05 4.36L2 22l5.64-1.05C9.96 21.64 11.46 22 13 22h-1c5.52 0 10-4.48 10-10S17.52 2 12 2z" fill="#0068FF" />
            <path d="M8.5 9.5c0-.28.22-.5.5-.5h6c.28 0 .5.22.5.5s-.22.5-.5.5H9c-.28 0-.5-.22-.5-.5zm0 2c0-.28.22-.5.5-.5h6c.28 0 .5.22.5.5s-.22.5-.5.5H9c-.28 0-.5-.22-.5-.5zm0 2c0-.28.22-.5.5-.5h4c.28 0 .5.22.5.5s-.22.5-.5.5H9c-.28 0-.5-.22-.5-.5z" fill="white" />
        </svg>
        <span class="zalo-text">Zalo</span>
    </a>
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

<!-- Scroll to Top Button -->
<div class="scroll-to-top-btn" id="scrollToTopBtn">
    <button class="scroll-top-btn" onclick="scrollToTop()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 15l-6-6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
</div>

<style>
    /* Scroll to Top Button */
    .scroll-to-top-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        transform: translateY(20px);
    }

    .scroll-to-top-btn.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .scroll-top-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-sky-blue, #007acc);
        border: none;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 122, 204, 0.3);
        transition: all 0.3s ease;
        font-size: 0;
    }

    .scroll-top-btn:hover {
        background: var(--primary-sky-blue-dark, #005a99);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 122, 204, 0.4);
    }

    .scroll-top-btn:active {
        transform: translateY(0);
    }

    .scroll-top-btn svg {
        width: 24px;
        height: 24px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .scroll-to-top-btn {
            bottom: 20px;
            right: 140px;
        }

        .scroll-top-btn {
            width: 45px;
            height: 45px;
        }

        .scroll-top-btn svg {
            width: 20px;
            height: 20px;
        }
    }
</style>

<script>
    // Scroll to Top functionality
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Show/hide scroll to top button based on scroll position
    window.addEventListener('scroll', function() {
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });
</script>

</body>

</html>