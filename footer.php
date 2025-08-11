<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-info">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>

                <div class="footer-contact">
                    <h3>Thông tin liên hệ</h3>
                    <p>Điện thoại: +84 123 456 789</p>
                    <p>Email: info@<?php bloginfo('name'); ?>.com</p>
                    <p>Địa chỉ: 123 Đường Chính, Thành phố, Việt Nam</p>
                </div>

                <div class="footer-social">
                    <h3>Theo dõi chúng tôi</h3>
                    <div class="social-links">
                        <a href="#" class="social-link">Facebook</a>
                        <a href="#" class="social-link">Twitter</a>
                        <a href="#" class="social-link">Instagram</a>
                        <a href="#" class="social-link">LinkedIn</a>
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

</body>

</html>