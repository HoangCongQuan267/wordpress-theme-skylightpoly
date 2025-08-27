<?php

/**
 * The template for displaying single manual posts
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php while (have_posts()) : the_post(); ?>
                <nav class="breadcrumbs">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
                    <span class="breadcrumb-separator">›</span>
                    <a href="<?php echo esc_url(home_url('/manual/')); ?>">Hướng dẫn</a>
                    <span class="breadcrumb-separator">›</span>
                    <span class="current-page"><?php the_title(); ?></span>
                </nav>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post single-manual'); ?>>
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
                    </div>

                    <footer class="post-footer">
                        <div class="related-posts">
                            <?php
                            // Get related manuals
                            $related_manuals = new WP_Query(array(
                                'post_type' => 'manual',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));

                            if ($related_manuals->have_posts()) : ?>
                                <h3>Hướng dẫn liên quan</h3>
                                <ul class="related-posts-list">
                                    <?php while ($related_manuals->have_posts()) : $related_manuals->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                            <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<style>
    /* Minimal and flat manual design */
    .single-manual {
        max-width: none;
        margin: 0 auto;
        padding: 0px;
        background: #ffffff;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    .single-manual .post-title {
        font-size: 1.25rem;
        line-height: 1.4;
        margin-bottom: 0px;
        color: #1a1a1a;
        font-weight: 600;
        border: none;
        background: none;
    }

    .single-manual .post-meta {
        display: none;
    }

    .single-manual .post-date-minimal {
        font-size: 0.875rem;
        color: #666666;
        margin-bottom: 20px;
        font-weight: 400;
    }

    .single-manual .post-thumbnail {
        margin-bottom: 20px;
    }

    .single-manual .post-thumbnail img {
        width: 100%;
        height: auto;
        display: block;
    }

    .single-manual .post-content {
        font-size: 1rem;
        line-height: 1.6;
        color: #333333;
        margin-bottom: 0;
    }

    .single-manual .post-content h1,
    .single-manual .post-content h2,
    .single-manual .post-content h3,
    .single-manual .post-content h4,
    .single-manual .post-content h5,
    .single-manual .post-content h6 {
        color: #1a1a1a;
        margin: 20px 0 10px 0;
        font-weight: 600;
        border: none;
        background: none;
        padding: 0;
    }

    .single-manual .post-content h2 {
        font-size: 1.25rem;
    }

    .single-manual .post-content h3 {
        font-size: 1.125rem;
    }

    .single-manual .post-content h4 {
        font-size: 1rem;
    }

    .single-manual .post-content p {
        margin-bottom: 16px;
        color: #333333;
    }

    .single-manual .post-content blockquote {
        margin: 20px 0;
        padding: 0 20px;
        color: #666666;
        font-style: italic;
        border: none;
        background: none;
        border-radius: 0;
    }

    .single-manual .post-content ul,
    .single-manual .post-content ol {
        margin-bottom: 16px;
        padding-left: 20px;
    }

    .single-manual .post-content li {
        margin-bottom: 4px;
        color: #333333;
    }

    .single-manual .post-content a {
        color: #1a1a1a;
        text-decoration: underline;
    }

    .single-manual .post-content a:hover {
        color: #666666;
    }

    .single-manual .post-footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .single-manual .related-posts h3 {
        font-size: 1.125rem;
        color: #1a1a1a;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .single-manual .related-posts-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .single-manual .related-posts-list li {
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f0f0f0;
    }

    .single-manual .related-posts-list li:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .single-manual .related-posts-list a {
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 500;
        display: block;
        margin-bottom: 4px;
    }

    .single-manual .related-posts-list a:hover {
        color: #666666;
    }

    .single-manual .related-posts-list .post-date {
        font-size: 0.875rem;
        color: #888888;
        font-weight: 400;
    }

    /* Breadcrumbs styling */
    .breadcrumbs {
        margin: 20px 0;
        font-size: 0.875rem;
        color: #666666;
    }

    .breadcrumbs a {
        color: #666666;
        text-decoration: none;
    }

    .breadcrumbs a:hover {
        color: #1a1a1a;
    }

    .breadcrumb-separator {
        margin: 0 8px;
        color: #cccccc;
    }

    .current-page {
        color: #1a1a1a;
        font-weight: 500;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .single-manual .post-title {
            font-size: 1.125rem;
        }

        .single-manual .post-content h2 {
            font-size: 1.125rem;
        }

        .single-manual .post-content h3 {
            font-size: 1rem;
        }

        .breadcrumbs {
            font-size: 0.8rem;
        }
    }
</style>

<?php get_footer(); ?>