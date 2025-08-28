<?php

/**
 * Quote Articles Archive Template
 * 
 * This template displays the archive for quote_article custom post type
 * Accessible at /bao-gia/ URL
 */

get_header(); ?>

<main id="main" class="site-main quotes-page">
    <div class="container">
        <div class="quotes-content">
            <?php
            // Get customizable page title and subtitle
            $page_title = get_theme_mod('quotes_page_title', 'Báo Giá & Thông Tin Sản Phẩm');
            $page_subtitle = get_theme_mod('quotes_page_subtitle', 'Thông tin giá cả và thông số kỹ thuật chi tiết');
            $posts_per_page = get_theme_mod('quotes_posts_per_page', 12);
            ?>

            <div class="quotes-header">
                <h1 class="page-title"><?php echo esc_html($page_title); ?></h1>
                <?php if ($page_subtitle) : ?>
                    <p class="page-subtitle"><?php echo esc_html($page_subtitle); ?></p>
                <?php endif; ?>
            </div>

            <div class="quotes-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        // Lấy dữ liệu meta
                        $quote_date = get_post_meta(get_the_ID(), '_quote_date', true);
                        $quote_rating = get_post_meta(get_the_ID(), '_quote_rating', true);
                        $featured_quote = get_post_meta(get_the_ID(), '_featured_quote', true);

                        // Lấy dữ liệu bảng giá
                        $price_table_data = get_post_meta(get_the_ID(), '_price_table_data', true);
                        $has_price_table = !empty($price_table_data);

                        // Format date same as article page
                        $formatted_date = $quote_date ? date('d/m/Y', strtotime($quote_date)) : get_the_date('d/m/Y');

                        // Lấy đoạn trích hoặc xem trước nội dung
                        $quote_excerpt = get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30, '...');
                ?>

                        <article class="quote-card <?php echo ($featured_quote === 'yes') ? 'featured-quote' : ''; ?>" onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                            <?php if ($featured_quote === 'yes') : ?>
                                <div class="featured-badge">
                                    <span>Nổi Bật</span>
                                </div>
                            <?php endif; ?>

                            <?php if ($has_price_table) : ?>
                                <div class="price-indicator">
                                    <span>💰 Bảng Giá</span>
                                </div>
                            <?php endif; ?>

                            <div class="quote-card-header">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                <?php else : ?>
                                    <div class="placeholder-image">
                                        <span class="placeholder-text">💬</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="quote-meta">
                                <div class="article-meta">
                                    <div class="article-date"><?php echo esc_html($formatted_date); ?></div>
                                    <?php if ($has_price_table) : ?>
                                        <div class="article-category">Bảng Giá</div>
                                    <?php endif; ?>
                                </div>

                                <h3 class="quote-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <div class="quote-content">
                                    <p class="quote-excerpt"><?php echo esc_html($quote_excerpt); ?></p>
                                </div>
                            </div>
                        </article>

                    <?php
                    endwhile;

                    // Phân trang
                    if (function_exists('the_posts_pagination')) :
                        the_posts_pagination(array(
                            'prev_text' => '← Trước',
                            'next_text' => 'Tiếp →',
                        ));
                    endif;
                else :
                    ?>
                    <div class="no-quotes-message">
                        <div class="empty-state">
                            <div class="empty-icon">💬</div>
                            <h3>Không Tìm Thấy Bài Viết Báo Giá</h3>
                            <p>Hiện tại chưa có bài viết báo giá nào được xuất bản. Hãy quay lại sau để xem thông tin giá cả và sản phẩm.</p>
                            <?php if (current_user_can('edit_posts')) : ?>
                                <p><a href="<?php echo esc_url(admin_url('post-new.php?post_type=quote_article')); ?>" class="add-quote-btn">Thêm Bài Viết Báo Giá Đầu Tiên</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<style>
    /* Minimal Header */
    .quotes-page {
        padding: 0px 0;
        background: transparent;
        min-height: 70vh;
    }

    .quotes-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .quotes-header {
        text-align: left;
        margin-bottom: 0px;
        padding: 10px 0;
        background: transparent;
        color: #333333;
    }

    .page-title {
        font-size: 1rem;
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.02em;
        text-transform: none;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
        color: #333333;
    }

    .page-subtitle {
        display: none;
    }

    /* 3-Column Grid Layout */
    .quotes-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 60px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Quote Cards - Article Card Style */
    .quote-card {
        background: white;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        position: relative;
    }

    .quote-card.featured-quote {
        grid-column: span 2;
        grid-row: span 2;
        background: white;
    }

    .featured-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #1a1a1a;
        color: #ffffff;
        padding: 4px 8px;
        font-size: 0.7rem;
        font-weight: 400;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
        z-index: 2;
    }

    .price-indicator {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #28a745;
        color: #ffffff;
        padding: 4px 8px;
        font-size: 0.7rem;
        font-weight: 400;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
        z-index: 2;
    }

    .quote-card-header {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quote-card-header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .quote-card:hover .quote-card-header img {
        transform: scale(1.05);
    }

    .placeholder-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .placeholder-text {
        font-size: 3rem;
        color: white;
        opacity: 0.8;
    }

    .quote-meta {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .article-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 0.8rem;
        color: #666;
    }

    .article-date {
        font-weight: 500;
    }

    .article-category {
        background: #28a745;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 500;
    }

    .quote-title {
        margin: 0 0 12px 0;
        font-size: 1.1rem;
        line-height: 1.4;
        font-weight: 600;
    }

    .quote-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .quote-title a:hover {
        color: #007cba;
    }

    .quote-content {
        flex: 1;
    }

    .quote-excerpt {
        color: #666;
        line-height: 1.6;
        margin: 0;
        font-size: 0.9rem;
    }

    /* No quotes message */
    .no-quotes-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state {
        max-width: 400px;
        margin: 0 auto;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #333;
        margin-bottom: 16px;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .add-quote-btn {
        display: inline-block;
        background: #007cba;
        color: white;
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .add-quote-btn:hover {
        background: #005a87;
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .quotes-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .quote-card.featured-quote {
            grid-column: span 1;
            grid-row: span 1;
        }

        .quotes-content {
            padding: 0 16px;
        }

        .quote-card-header {
            height: 160px;
        }

        .quote-meta {
            padding: 16px;
        }
    }

    @media (max-width: 1024px) and (min-width: 769px) {
        .quotes-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .quote-card.featured-quote {
            grid-column: span 2;
            grid-row: span 1;
        }
    }
</style>

<?php get_footer(); ?>