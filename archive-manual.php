<?php

/**
 * The template for displaying manual post type archive
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <header class="page-header manuals-page-header">
                <h1 class="page-title">Hướng Dẫn Sử Dụng</h1>
                <p class="page-subtitle">Tài liệu hướng dẫn chi tiết giúp bạn sử dụng sản phẩm một cách hiệu quả và an toàn</p>
            </header>

            <?php
            if (have_posts()) :
                $post_count = 0;
            ?>
                <div class="manuals-page-grid">
                    <?php while (have_posts()) : the_post();
                        $post_count++;
                        $is_featured = ($post_count === 1); // First post is featured
                    ?>
                        <article class="manual-card <?php echo $is_featured ? 'featured-manual' : 'regular-manual'; ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="manual-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        if ($is_featured) {
                                            the_post_thumbnail('large', array('alt' => get_the_title()));
                                        } else {
                                            the_post_thumbnail('medium', array('alt' => get_the_title()));
                                        }
                                        ?>
                                    </a>
                                    <div class="manual-overlay">
                                        <a href="<?php the_permalink(); ?>" class="manual-link-btn">Xem Hướng Dẫn</a>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="manual-image no-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="placeholder-image">
                                            <span class="placeholder-text">📖</span>
                                        </div>
                                    </a>
                                    <div class="manual-overlay">
                                        <a href="<?php the_permalink(); ?>" class="manual-link-btn">Xem Hướng Dẫn</a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="manual-content">
                                <div class="manual-meta">
                                    <span class="manual-date"><?php echo get_the_date('d/m/Y'); ?></span>
                                    <span class="manual-type">Hướng dẫn</span>
                                </div>

                                <h3 class="manual-title <?php echo $is_featured ? 'featured-title' : ''; ?>">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <p class="manual-excerpt">
                                    <?php
                                    if ($is_featured) {
                                        echo wp_trim_words(get_the_excerpt(), 30);
                                    } else {
                                        echo wp_trim_words(get_the_excerpt(), 20);
                                    }
                                    ?>
                                </p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="manuals-pagination">
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => '← Trước',
                        'next_text' => 'Sau →',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">Trang </span>',
                    ));
                    ?>
                </div>

            <?php
            else :
                // Mock data with 5 manuals
                $mock_manuals = array(
                    array(
                        'title' => 'Hướng dẫn lắp đặt tấm nhựa cách nhiệt',
                        'excerpt' => 'Hướng dẫn chi tiết từng bước để lắp đặt tấm nhựa cách nhiệt một cách chính xác và an toàn cho ngôi nhà của bạn.',
                        'date' => '15/01/2024',
                        'type' => 'Lắp đặt',
                        'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=800&h=600&fit=crop'
                    ),
                    array(
                        'title' => 'Bảo dưỡng sản phẩm nhựa định kỳ',
                        'excerpt' => 'Cách bảo dưỡng và vệ sinh sản phẩm nhựa để đảm bảo độ bền và chất lượng.',
                        'date' => '12/01/2024',
                        'type' => 'Bảo dưỡng',
                        'image' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=600&h=400&fit=crop'
                    ),
                    array(
                        'title' => 'An toàn khi sử dụng sản phẩm nhựa',
                        'excerpt' => 'Những lưu ý quan trọng về an toàn khi sử dụng các sản phẩm nhựa.',
                        'date' => '10/01/2024',
                        'type' => 'An toàn',
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=600&h=400&fit=crop'
                    ),
                    array(
                        'title' => 'Xử lý sự cố thường gặp',
                        'excerpt' => 'Hướng dẫn xử lý các sự cố thường gặp khi sử dụng sản phẩm nhựa.',
                        'date' => '08/01/2024',
                        'type' => 'Sự cố',
                        'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop'
                    ),
                    array(
                        'title' => 'Tối ưu hóa hiệu suất sản phẩm',
                        'excerpt' => 'Cách tối ưu hóa hiệu suất và tuổi thọ của sản phẩm nhựa.',
                        'date' => '05/01/2024',
                        'type' => 'Tối ưu',
                        'image' => 'https://images.unsplash.com/photo-1581833971358-2c8b550f87b3?w=600&h=400&fit=crop'
                    )
                );
            ?>
                <div class="manuals-page-grid">
                    <?php foreach ($mock_manuals as $index => $manual) :
                        $is_featured = ($index === 0); // First manual is featured
                    ?>
                        <article class="manual-card <?php echo $is_featured ? 'featured-manual' : 'regular-manual'; ?>">
                            <div class="manual-image">
                                <a href="#">
                                    <img src="<?php echo $manual['image']; ?>" alt="<?php echo $manual['title']; ?>" />
                                </a>
                                <div class="manual-overlay">
                                    <a href="#" class="manual-link-btn">Xem Hướng Dẫn</a>
                                </div>
                            </div>

                            <div class="manual-content">
                                <div class="manual-meta">
                                    <span class="manual-date"><?php echo $manual['date']; ?></span>
                                    <span class="manual-type"><?php echo $manual['type']; ?></span>
                                </div>

                                <h3 class="manual-title <?php echo $is_featured ? 'featured-title' : ''; ?>">
                                    <a href="#"><?php echo $manual['title']; ?></a>
                                </h3>

                                <p class="manual-excerpt">
                                    <?php echo $manual['excerpt']; ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
    /* Minimal Header */
    .manuals-page-header {
        text-align: left;
        margin-bottom: 0px;
        padding: 10px 0;
        background: transparent;
        color: #333333;
    }

    .manuals-page-header .page-title {
        font-size: 1rem;
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.02em;
        text-transform: none;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    .manuals-page-header .page-subtitle {
        display: none;
    }

    /* 3-Column Grid Layout */
    .manuals-page-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 60px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Featured Manual - Flat Style */
    .featured-manual {
        grid-column: span 2;
        grid-row: span 2;
        background: #ffffff;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .featured-manual .manual-image {
        height: 300px;
        overflow: hidden;
        background: #f5f5f5;
        flex-shrink: 0;
    }

    .featured-manual .manual-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .featured-manual .featured-title {
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 12px;
        color: #1a1a1a;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    .featured-manual .manual-excerpt {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #666666;
        margin-bottom: 16px;
        font-weight: 400;
        flex: 1;
    }

    .featured-manual .manual-meta {
        margin-bottom: 12px;
        justify-content: flex-start;
    }

    .featured-manual .manual-meta span {
        font-size: 0.75rem;
        font-weight: 400;
        letter-spacing: 0.05em;
        color: #888888;
    }

    /* Regular Manuals - Flat Style */
    .regular-manual {
        grid-column: span 1;
        background: #ffffff;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .regular-manual .manual-image {
        height: 160px;
        overflow: hidden;
        background: #f5f5f5;
        flex-shrink: 0;
    }

    .regular-manual .manual-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .regular-manual .manual-title {
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.4;
        margin-bottom: 8px;
        color: #1a1a1a;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    /* Clean Image Styles */
    .manual-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .placeholder-image {
        width: 100%;
        height: 100%;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cccccc;
        font-size: 0.8rem;
        font-weight: 400;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    .manual-overlay {
        display: none;
    }

    .manual-link-btn {
        display: none;
    }

    .manual-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
        font-size: 0.75rem;
        color: #888888;
        font-weight: 400;
    }

    .manual-date {
        color: #888888;
    }

    .manual-type {
        color: #888888;
    }

    .manual-type::before {
        content: '•';
        margin-right: 6px;
        color: #cccccc;
    }

    .manual-title a {
        color: #1a1a1a;
        text-decoration: none;
    }

    .manual-title a:hover {
        color: #666666;
    }

    .manual-excerpt {
        color: #666666;
        line-height: 1.5;
        margin-bottom: 12px;
        flex: 1;
        font-weight: 400;
        font-size: 0.85rem;
    }

    /* Clean Pagination */
    .manuals-pagination {
        text-align: center;
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid #e0e0e0;
    }

    .manuals-pagination .page-numbers {
        display: inline-block;
        padding: 12px 16px;
        margin: 0 4px;
        background: #ffffff;
        border: 1px solid #e0e0e0;
        color: #666666;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 400;
        border-radius: 4px;
    }

    .manuals-pagination .page-numbers:hover,
    .manuals-pagination .page-numbers.current {
        background: #1a1a1a;
        color: #ffffff;
        border-color: #1a1a1a;
    }

    /* 3-Column Responsive Design */
    @media (max-width: 1024px) {
        .manuals-page-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .featured-manual {
            grid-column: span 2;
            grid-row: span 2;
        }

        .regular-manual {
            grid-column: span 1;
        }
    }

    @media (max-width: 768px) {
        .manuals-page-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .featured-manual {
            grid-column: span 2;
            grid-row: span 1;
        }

        .featured-manual .manual-image {
            height: 200px;
        }

        .featured-manual .featured-title {
            font-size: 1.4rem;
        }

        .regular-manual .manual-image {
            height: 140px;
        }

        .regular-manual .manual-title {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .manuals-page-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .featured-manual {
            grid-column: span 1;
            grid-row: span 1;
        }

        .featured-manual .manual-image {
            height: 180px;
        }

        .featured-manual .featured-title {
            font-size: 1.2rem;
        }

        .regular-manual .manual-image {
            height: 160px;
        }

        .regular-manual .manual-title {
            font-size: 1rem;
        }

        .manuals-pagination .page-numbers {
            padding: 10px 12px;
            margin: 0 2px;
            font-size: 0.8rem;
        }
    }
</style>

<?php get_footer(); ?>