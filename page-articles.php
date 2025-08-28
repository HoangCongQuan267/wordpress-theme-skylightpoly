<?php

/**
 * Template Name: Articles Page
 * The template for displaying all articles with grid layout
 */

get_header(); ?>

<main class="site-main">
    <!-- Structured Data for Articles Page -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "CollectionPage",
            "name": "Bài Viết",
            "description": "Khám phá những thông tin và kiến thức hữu ích từ chúng tôi",
            "url": "<?php echo esc_url(get_permalink()); ?>",
            "mainEntity": {
                "@type": "ItemList",
                "name": "Danh sách bài viết",
                "description": "Tổng hợp các bài viết về nhựa và sản phẩm nhựa"
            },
            "breadcrumb": {
                "@type": "BreadcrumbList",
                "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Trang chủ",
                        "item": "<?php echo esc_url(home_url('/')); ?>"
                    },
                    {
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Bài Viết",
                        "item": "<?php echo esc_url(get_permalink()); ?>"
                    }
                ]
            }
        }
    </script>

    <div class="content-area">
        <div class="posts-container full-width">
            <header class="page-header articles-page-header">
                <h1 class="page-title">TIN TỨC</h1>
                <p class="page-subtitle">Khám phá những thông tin và kiến thức hữu ích từ chúng tôi</p>
            </header>

            <?php
            // Get all published posts
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $articles_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => $paged
            ));

            if ($articles_query->have_posts()) :
                $post_count = 0;
            ?>
                <div class="articles-page-grid">
                    <?php while ($articles_query->have_posts()) : $articles_query->the_post();
                        $post_count++;
                        $is_featured = ($post_count === 1); // First post is featured
                    ?>
                        <article class="article-card <?php echo $is_featured ? 'featured-article' : 'regular-article'; ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="article-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        if ($is_featured) {
                                            the_post_thumbnail('large', array('alt' => get_the_title()));
                                        } else {
                                            the_post_thumbnail('medium', array('alt' => get_the_title()));
                                        }
                                        ?>
                                    </a>
                                    <div class="article-overlay">
                                        <a href="<?php the_permalink(); ?>" class="article-link-btn">Đọc Bài Viết</a>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="article-image no-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="placeholder-image">
                                            <span class="placeholder-text">Không có hình ảnh</span>
                                        </div>
                                    </a>
                                    <div class="article-overlay">
                                        <a href="<?php the_permalink(); ?>" class="article-link-btn">Đọc Bài Viết</a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="article-content">
                                <div class="article-meta">
                                    <span class="article-date"><?php echo get_the_date('d/m/Y'); ?></span>
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) :
                                    ?>
                                        <span class="article-category"><?php echo esc_html($categories[0]->name); ?></span>
                                    <?php endif; ?>
                                </div>

                                <h3 class="article-title <?php echo $is_featured ? 'featured-title' : ''; ?>">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <p class="article-excerpt">
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
                <div class="articles-pagination">
                    <?php
                    // Simple pagination using WordPress built-in function
                    global $wp_query;
                    $temp_query = $wp_query;
                    $wp_query = $articles_query;

                    the_posts_pagination(array(
                        'prev_text' => '← Trước',
                        'next_text' => 'Sau →',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">Trang </span>',
                    ));

                    $wp_query = $temp_query;
                    ?>
                </div>

            <?php
                wp_reset_postdata();
            else :
                // Mock data with 5 articles
                $mock_articles = array(
                    array(
                        'title' => 'Xu hướng nhựa tái chế trong ngành xây dựng 2024',
                        'excerpt' => 'Khám phá những xu hướng mới nhất về việc sử dụng nhựa tái chế trong ngành xây dựng, từ vật liệu cách nhiệt đến các sản phẩm nội thất bền vững.',
                        'date' => '15/01/2024',
                        'category' => 'Xu hướng',
                        'author' => 'Nguyễn Văn A',
                        'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=800&h=600&fit=crop'
                    ),
                    array(
                        'title' => 'Quy trình sản xuất nhựa chất lượng cao',
                        'excerpt' => 'Tìm hiểu về quy trình sản xuất nhựa hiện đại với công nghệ tiên tiến.',
                        'date' => '12/01/2024',
                        'category' => 'Sản xuất',
                        'author' => 'Trần Thị B',
                        'image' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=600&h=400&fit=crop'
                    ),
                    array(
                        'title' => 'Ứng dụng nhựa trong y tế',
                        'excerpt' => 'Những ứng dụng quan trọng của nhựa trong ngành y tế hiện đại.',
                        'date' => '10/01/2024',
                        'category' => 'Y tế',
                        'author' => 'Lê Văn C',
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=600&h=400&fit=crop'
                    ),
                    array(
                        'title' => 'Bảo vệ môi trường với nhựa sinh học',
                        'excerpt' => 'Giải pháp nhựa sinh học thân thiện với môi trường.',
                        'date' => '08/01/2024',
                        'category' => 'Môi trường',
                        'author' => 'Phạm Thị D',
                        'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop'
                    ),
                    array(
                        'title' => 'Công nghệ in 3D với vật liệu nhựa',
                        'excerpt' => 'Khám phá công nghệ in 3D sử dụng vật liệu nhựa tiên tiến.',
                        'date' => '05/01/2024',
                        'category' => 'Công nghệ',
                        'author' => 'Hoàng Văn E',
                        'image' => 'https://images.unsplash.com/photo-1581833971358-2c8b550f87b3?w=600&h=400&fit=crop'
                    )
                );
            ?>
                <div class="articles-page-grid">
                    <?php foreach ($mock_articles as $index => $article) :
                        $is_featured = ($index === 0); // First article is featured
                    ?>
                        <article class="article-card <?php echo $is_featured ? 'featured-article' : 'regular-article'; ?>">
                            <div class="article-image">
                                <a href="#">
                                    <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" />
                                </a>
                            </div>

                            <div class="article-content">
                                <div class="article-meta">
                                    <span class="article-date"><?php echo $article['date']; ?></span>
                                    <span class="article-category"><?php echo $article['category']; ?></span>
                                </div>

                                <h3 class="article-title <?php echo $is_featured ? 'featured-title' : ''; ?>">
                                    <a href="#"><?php echo $article['title']; ?></a>
                                </h3>

                                <p class="article-excerpt">
                                    <?php echo $article['excerpt']; ?>
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
    .articles-page-header {
        text-align: left;
        margin-bottom: 0px;
        padding: 10px 0;
        background: transparent;
        color: #333333;
    }

    .articles-page-header .page-title {
        font-size: 1.3rem;
        line-height: 1.3;
        color: var(--primary-blue);
        text-align: center;
        padding-bottom: 15px;
        margin-bottom: 25px;
        border-bottom: 2px solid lightgrey;
    }

    .articles-page-header .page-subtitle {
        display: none;
    }

    /* 3-Column Grid Layout */
    .articles-page-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 60px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Featured Article - Flat Style */
    .featured-article {
        grid-column: span 2;
        grid-row: span 2;
        background: #ffffff;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .featured-article .article-image {
        height: 300px;
        overflow: hidden;
        background: #f5f5f5;
        flex-shrink: 0;
    }

    .featured-article .article-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .featured-article .featured-title {
        font-size: 0.8rem;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 12px;
        color: #1a1a1a;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    .featured-article .article-excerpt {
        font-size: 0.8rem;
        line-height: 1.6;
        color: #666666;
        margin-bottom: 16px;
        font-weight: 400;
        flex: 1;
    }

    .featured-article .article-meta {
        margin-bottom: 12px;
        justify-content: flex-start;
    }

    .featured-article .article-meta span {
        font-size: 0.8rem;
        font-weight: 400;
        letter-spacing: 0.05em;
        color: #888888;
    }

    /* Regular Articles - Flat Style */
    .regular-article {
        grid-column: span 1;
        background: #ffffff;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .regular-article .article-image {
        height: 160px;
        overflow: hidden;
        background: #f5f5f5;
        flex-shrink: 0;
    }

    .regular-article .article-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .regular-article .article-title {
        font-size: 0.8rem;
        font-weight: 500;
        line-height: 1.4;
        margin-bottom: 8px;
        color: #1a1a1a;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    /* Clean Image Styles */
    .article-image img {
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

    .article-overlay {
        display: none;
    }

    .article-link-btn {
        display: none;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
        font-size: 0.8rem;
        color: #888888;
        font-weight: 400;
    }

    .article-date {
        color: #888888;
    }

    .article-category {
        color: #888888;
    }

    .article-category::before {
        content: '•';
        margin-right: 6px;
        color: #cccccc;
    }

    .article-title a {
        color: #1a1a1a;
        text-decoration: none;
    }

    .article-title a:hover {
        color: #666666;
    }

    .article-excerpt {
        color: #666666;
        line-height: 1.5;
        margin-bottom: 12px;
        flex: 1;
        font-weight: 400;
        font-size: 0.85rem;
    }



    /* Clean Pagination */
    .articles-pagination {
        text-align: center;
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid #e0e0e0;
    }

    .articles-pagination .page-numbers {
        display: inline-block;
        padding: 12px 16px;
        margin: 0 4px;
        background: #ffffff;
        color: #666666;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 400;
    }

    .articles-pagination .page-numbers:hover,
    .articles-pagination .page-numbers.current {
        background: #1a1a1a;
        color: #ffffff;
    }

    /* Clean No Articles */
    .no-articles {
        text-align: center;
        padding: 80px 40px;
    }

    .no-articles h3 {
        color: #1a1a1a;
        margin-bottom: 16px;
        font-size: 1.5rem;
        font-weight: 500;
    }

    .no-articles p {
        color: #666666;
        margin-bottom: 24px;
        font-size: 0.8rem;
        font-weight: 400;
        line-height: 1.6;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        background: #1a1a1a;
        color: #ffffff;
        text-decoration: none;
        font-weight: 400;
        font-size: 0.9rem;
    }

    .btn:hover {
        background: #333333;
        text-decoration: none;
    }

    /* 3-Column Responsive Design */
    @media (max-width: 1024px) {
        .articles-page-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .featured-article {
            grid-column: span 2;
            grid-row: span 2;
        }

        .regular-article {
            grid-column: span 1;
        }
    }

    @media (max-width: 768px) {
        .articles-page-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .featured-article {
            grid-column: span 2;
            grid-row: span 1;
        }

        .featured-article .article-image {
            height: 200px;
        }

        .featured-article .featured-title {
            font-size: 1.2rem;
        }

        .regular-article .article-image {
            height: 140px;
        }

        .regular-article .article-title {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .articles-page-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .featured-article {
            grid-column: span 1;
            grid-row: span 1;
        }

        .featured-article .article-image {
            height: 180px;
        }

        .featured-article .featured-title {
            font-size: 1.2rem;
        }

        .regular-article .article-image {
            height: 160px;
        }

        .regular-article .article-title {
            font-size: 0.8rem;
        }

        .articles-pagination .page-numbers {
            padding: 10px 12px;
            margin: 0 2px;
            font-size: 0.8rem;
        }

        .no-articles {
            padding: 60px 20px;
        }
    }
</style>

<?php get_footer(); ?>