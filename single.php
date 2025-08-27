<?php

/**
 * The template for displaying single posts
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php while (have_posts()) : the_post(); ?>
                <nav class="breadcrumbs">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
                    <span class="breadcrumb-separator">›</span>
                    <?php
                    // Use a simple approach to link to articles page
                    $articles_url = home_url('/bai-viet/');
                    ?>
                    <a href="<?php echo esc_url($articles_url); ?>">Bài viết</a>
                    <span class="breadcrumb-separator">›</span>
                    <span class="current-page"><?php the_title(); ?></span>
                </nav>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post single-post'); ?>>
                    <header class="post-header">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <div class="post-date-minimal">
                            <?php echo get_the_date('F j, Y'); ?>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <?php the_content(); ?>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">Trang: ',
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="post-footer">
                        <div class="related-posts">
                            <h3>Bài viết mới nhất</h3>
                            <?php
                            $current_post_id = get_the_ID();
                            $recent_posts = get_posts(array(
                                'numberposts' => 3,
                                'post_status' => 'publish',
                                'exclude' => array($current_post_id),
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));

                            if ($recent_posts) :
                            ?>
                                <ul class="recent-posts-list">
                                    <?php foreach ($recent_posts as $recent_post) : ?>
                                        <li>
                                            <a href="<?php echo get_permalink($recent_post->ID); ?>">
                                                <?php echo get_the_title($recent_post->ID); ?>
                                            </a>
                                            <span class="post-date"><?php echo get_the_date('F j, Y', $recent_post->ID); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </footer>
                </article>



            <?php endwhile; ?>
        </div>


    </div>
</main>

<style>
    /* Minimal and flat article design */
    .single-post {
        max-width: none;
        margin: 0 auto;
        padding: 0px;
        background: #ffffff;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    .single-post .post-title {
        font-size: 1.25rem;
        line-height: 1.4;
        margin-bottom: 0px;
        color: #1a1a1a;
        font-weight: 600;
        border: none;
        background: none;
    }

    .single-post .post-meta {
        display: none;
    }

    .single-post .post-date-minimal {
        font-size: 0.875rem;
        color: #666666;
        margin-bottom: 20px;
        font-weight: 400;
    }

    .single-post .post-thumbnail {
        display: none;
    }

    .single-post .post-content {
        font-size: 1rem;
        line-height: 1.6;
        color: #333333;
        margin-bottom: 0;
    }

    .single-post .post-content h1,
    .single-post .post-content h2,
    .single-post .post-content h3,
    .single-post .post-content h4,
    .single-post .post-content h5,
    .single-post .post-content h6 {
        color: #1a1a1a;
        margin: 20px 0 10px 0;
        font-weight: 600;
        border: none;
        background: none;
        padding: 0;
    }

    .single-post .post-content h2 {
        font-size: 1.25rem;
    }

    .single-post .post-content h3 {
        font-size: 1.125rem;
    }

    .single-post .post-content h4 {
        font-size: 1rem;
    }

    .single-post .post-content p {
        margin-bottom: 16px;
        color: #333333;
    }

    .single-post .post-content blockquote {
        margin: 20px 0;
        padding: 0 20px;
        color: #666666;
        font-style: italic;
        border: none;
        background: none;
        border-radius: 0;
    }

    .single-post .post-content ul,
    .single-post .post-content ol {
        margin-bottom: 16px;
        padding-left: 20px;
    }

    .single-post .post-content li {
        margin-bottom: 4px;
        color: #333333;
    }

    .single-post .post-content a {
        color: #1a1a1a;
        text-decoration: underline;
    }

    .single-post .post-content a:hover {
        color: #666666;
    }

    .single-post .post-footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .single-post .related-posts h3 {
        font-size: 1.125rem;
        color: #1a1a1a;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .single-post .recent-posts-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .single-post .recent-posts-list li {
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f0f0f0;
    }

    .single-post .recent-posts-list li:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .single-post .recent-posts-list a {
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 500;
        display: block;
        margin-bottom: 4px;
    }

    .single-post .recent-posts-list a:hover {
        color: #666666;
        text-decoration: underline;
    }

    .single-post .recent-posts-list .post-date {
        font-size: 0.875rem;
        color: #888888;
        font-weight: 400;
    }

    .page-links {
        display: none;
    }

    .breadcrumbs {
        margin-bottom: 5px;
        font-size: 0.8rem;
        color: #666666;
        padding: 20px 0px;
    }

    .breadcrumbs a {
        color: #1a1a1a;
        text-decoration: none;
    }

    .breadcrumbs a:hover {
        color: #666666;
        text-decoration: underline;
    }

    .breadcrumb-separator {
        margin: 0 8px;
        color: #999999;
    }

    .breadcrumbs .current-page {
        color: #666666;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .breadcrumbs {
            padding: 10px 15px;
            font-size: 0.8rem;
        }

        .breadcrumb-separator {
            margin: 0 6px;
        }
    }

    @media (max-width: 768px) {
        .single-post {
            padding: 15px;
        }

        .single-post .post-title {
            font-size: 1.25rem;
        }

        .single-post .post-content {
            font-size: 0.95rem;
        }
    }
</style>

<?php get_footer(); ?>