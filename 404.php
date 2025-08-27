<?php

/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<!-- WebPage Schema Markup for 404 Page -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Trang không tìm thấy - 404",
    "description": "Trang bạn đang tìm kiếm không tồn tại. Vui lòng kiểm tra lại đường dẫn hoặc quay về trang chủ.",
    "url": "<?php echo esc_js(home_url($_SERVER['REQUEST_URI'])); ?>",
    "mainEntity": {
        "@type": "WebPage",
        "@id": "<?php echo esc_js(home_url($_SERVER['REQUEST_URI'])); ?>"
    },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Trang chủ",
                "item": "<?php echo esc_js(home_url('/')); ?>"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "404 - Trang không tìm thấy"
            }
        ]
    }
}
</script>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container">
            <article class="post error-404">
                <header class="page-header">
                    <h1 class="page-title">Không tìm thấy trang</h1>
                </header>

                <div class="page-content">
                    <div class="error-404-content">
                        <div class="error-number">404</div>
                        <p class="error-message">Rất tiếc, trang bạn đang tìm kiếm không tồn tại.</p>
                        <p>Dưới đây là một số liên kết hữu ích:</p>

                        <div class="error-actions">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Về trang chủ</a>
                            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại</a>
                        </div>

                        <div class="search-section">
                            <h3>Thử tìm kiếm những gì bạn cần:</h3>
                            <?php get_search_form(); ?>
                        </div>

                        <div class="helpful-links">
                            <h3>Trang phổ biến:</h3>
                            <ul>
                                <li><a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a></li>
                                <li><a href="<?php echo esc_url(home_url('/about')); ?>">Giới thiệu</a></li>
                                <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Liên hệ</a></li>
                                <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                            </ul>
                        </div>

                        <div class="recent-posts-section">
                            <h3>Bài viết gần đây:</h3>
                            <ul>
                                <?php
                                $recent_posts = wp_get_recent_posts(array(
                                    'numberposts' => 5,
                                    'post_status' => 'publish'
                                ));

                                if ($recent_posts) :
                                    foreach ($recent_posts as $post) :
                                ?>
                                        <li>
                                            <a href="<?php echo get_permalink($post['ID']); ?>">
                                                <?php echo $post['post_title']; ?>
                                            </a>
                                        </li>
                                <?php
                                    endforeach;
                                endif;
                                wp_reset_query();
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</main>

<style>
    .error-404 {
        text-align: center;
        padding: 40px 20px;
    }

    .error-404 .page-title {
        font-size: 32px;
        color: var(--primary-blue);
        margin-bottom: 30px;
    }

    .error-404-content {
        max-width: 600px;
        margin: 0 auto;
    }

    .error-number {
        font-size: 120px;
        font-weight: bold;
        color: var(--primary-orange);
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .error-message {
        font-size: 18px;
        color: var(--medium-gray);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .error-actions {
        margin: 30px 0;
    }

    .error-actions .btn {
        margin: 0 10px 10px 10px;
        display: inline-block;
    }

    .search-section {
        margin: 40px 0;
        padding: 30px;
        background-color: var(--light-gray);
        border-radius: 4px;
        border-left: 4px solid var(--primary-orange);
    }

    .search-section h3 {
        color: var(--primary-blue);
        margin-bottom: 20px;
        font-size: 20px;
    }

    .search-section .search-form {
        max-width: 400px;
        margin: 0 auto;
    }

    .helpful-links,
    .recent-posts-section {
        margin: 30px 0;
        text-align: left;
        background-color: var(--white);
        padding: 25px;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .helpful-links h3,
    .recent-posts-section h3 {
        color: var(--primary-blue);
        margin-bottom: 15px;
        font-size: 18px;
        text-align: center;
        border-bottom: 2px solid var(--primary-orange);
        padding-bottom: 10px;
    }

    .helpful-links ul,
    .recent-posts-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .helpful-links li,
    .recent-posts-section li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .helpful-links li:last-child,
    .recent-posts-section li:last-child {
        border-bottom: none;
    }

    .helpful-links a,
    .recent-posts-section a {
        color: var(--dark-gray);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .helpful-links a:hover,
    .recent-posts-section a:hover {
        color: var(--primary-orange);
    }

    @media (max-width: 768px) {
        .error-404 {
            padding: 20px 10px;
        }

        .error-404 .page-title {
            font-size: 24px;
        }

        .error-number {
            font-size: 80px;
        }

        .error-actions .btn {
            display: block;
            margin: 10px auto;
            max-width: 200px;
        }

        .search-section {
            padding: 20px;
        }

        .helpful-links,
        .recent-posts-section {
            padding: 20px;
        }
    }
</style>

<?php get_footer(); ?>