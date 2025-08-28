<?php

/**
 * Quote Articles Page Template
 * 
 * This template displays a time-ordered list of quote articles
 * Each quote article contains pricing information and price tables
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
                // Truy vấn các bài viết trích dẫn theo thứ tự ngày (mới nhất trước)
                $quote_args = array(
                    'post_type' => 'quote_article',
                    'posts_per_page' => $posts_per_page,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => '_featured_quote',
                            'value' => 'yes',
                            'compare' => '='
                        ),
                        array(
                            'key' => '_featured_quote',
                            'value' => 'no',
                            'compare' => '='
                        ),
                        array(
                            'key' => '_featured_quote',
                            'compare' => 'NOT EXISTS'
                        )
                    )
                );

                $quote_query = new WP_Query($quote_args);

                if ($quote_query->have_posts()) :
                    while ($quote_query->have_posts()) : $quote_query->the_post();
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

                    // Lưu thông tin phân trang trước khi reset
                    $max_pages = 1;
                    if ($quote_query instanceof WP_Query && isset($quote_query->max_num_pages)) {
                        $max_pages = $quote_query->max_num_pages;
                    }
                    wp_reset_postdata();

                    // Phân trang
                    if ($max_pages > 1) :
                    ?>
                        <div class="quotes-pagination">
                            <?php
                            echo paginate_links(array(
                                'total' => $max_pages,
                                'current' => max(1, get_query_var('paged')),
                                'format' => '?paged=%#%',
                                'show_all' => false,
                                'end_size' => 1,
                                'mid_size' => 2,
                                'prev_next' => true,
                                'prev_text' => '← Trước',
                                'next_text' => 'Tiếp →',
                                'type' => 'list'
                            ));
                            ?>
                        </div>
                    <?php
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

    .quote-card.featured-quote .price-indicator {
        top: 40px;
    }

    .quote-card-header {
        height: 200px;
        overflow: hidden;
        background: #f5f5f5;
        flex-shrink: 0;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0;
    }

    .quote-card-header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .featured-quote .quote-card-header {
        height: 300px;
    }

    .quote-thumbnail {
        display: none;
    }

    .quote-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0;
        border: none;
    }

    .quote-meta {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .quote-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 12px;
        line-height: 1.4;
        letter-spacing: 0.2px;
    }

    .quote-title a {
        color: inherit;
        text-decoration: none;
    }

    .quote-title a:hover {
        color: #666666;
    }

    .featured-quote .quote-title {
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 15px;
    }

    .quote-author {
        margin-bottom: 8px;
    }

    .quote-author strong {
        color: #888888;
        font-size: 0.75rem;
        display: block;
        margin-bottom: 3px;
        font-weight: 400;
        letter-spacing: 0.05em;
    }

    .author-details {
        color: #888888;
        font-size: 0.75rem;
        font-style: normal;
        font-weight: 400;
        letter-spacing: 0.05em;
    }

    .author-details::before {
        content: '•';
        margin-right: 6px;
        color: #cccccc;
    }

    .quote-rating {
        display: none;
    }

    .quote-content {
        flex: 1;
        margin-bottom: 12px;
    }

    .quote-excerpt {
        color: #666;
        font-size: 0.75rem;
        line-height: 1.6;
        margin-bottom: 15px;
        flex: 1;
    }

    .featured-quote .quote-excerpt {
        font-size: 0.85rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .quote-card-footer {
        display: none;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 0.7rem;
        color: #666;
    }

    .article-date {
        color: var(--primary-sky-blue);
        font-weight: 500;
    }

    .article-category {
        font-size: 0.65rem;
        font-weight: 500;
        color: #888888;
    }

    .article-category::before {
        content: '•';
        margin-right: 6px;
        color: #cccccc;
    }

    .read-more {
        display: none;
    }

    /* Empty State */
    .no-quotes-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 40px;
    }

    .empty-state {
        max-width: 400px;
        margin: 0 auto;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #1a1a1a;
        margin-bottom: 16px;
        font-size: 1.5rem;
        font-weight: 500;
    }

    .empty-state p {
        color: #666666;
        margin-bottom: 24px;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.6;
    }

    .add-quote-btn {
        display: inline-block;
        padding: 12px 24px;
        background: #1a1a1a;
        color: #ffffff;
        text-decoration: none;
        font-weight: 400;
        font-size: 0.9rem;
    }

    .add-quote-btn:hover {
        background: #333333;
        color: #ffffff;
        text-decoration: none;
    }

    /* Clean Pagination */
    .quotes-pagination {
        grid-column: 1 / -1;
        text-align: center;
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid #e0e0e0;
    }

    .quotes-pagination .page-numbers {
        display: inline-block;
        padding: 12px 16px;
        margin: 0 4px;
        background: #ffffff;
        color: #666666;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 400;
    }

    .quotes-pagination .page-numbers:hover,
    .quotes-pagination .page-numbers.current {
        background: #1a1a1a;
        color: #ffffff;
    }

    /* 3-Column Responsive Design */
    @media (max-width: 1024px) {
        .quotes-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .featured-quote {
            grid-column: span 2;
            grid-row: span 2;
        }
    }

    @media (max-width: 768px) {
        .quotes-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .featured-quote {
            grid-column: span 2;
            grid-row: span 1;
        }

        .featured-quote .quote-card-header {
            height: 200px;
        }

        .featured-quote .quote-title {
            font-size: 1.4rem;
        }

        .quote-card-header {
            height: 140px;
        }

        .quote-title {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .quotes-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .featured-quote {
            grid-column: span 1;
            grid-row: span 1;
        }

        .featured-quote .quote-card-header {
            height: 180px;
        }

        .featured-quote .quote-title {
            font-size: 1.2rem;
        }

        .quote-card-header {
            height: 160px;
        }

        .quote-title {
            font-size: 1rem;
        }

        .quotes-pagination .page-numbers {
            padding: 10px 12px;
            margin: 0 2px;
            font-size: 0.8rem;
        }

        .no-quotes-message {
            padding: 60px 20px;
        }
    }
</style>

<?php get_footer(); ?>