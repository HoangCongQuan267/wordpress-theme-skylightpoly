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

</body>

</html>