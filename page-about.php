<?php

/**
 * Template Name: About Page
 * The template for displaying the About page
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php while (have_posts()) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class('about-page'); ?>>
                    <header class="page-header">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-thumbnail">
                            <?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="page-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">Trang: ',
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (comments_open() || get_comments_number()) : ?>
                        <footer class="page-footer">
                            <?php comments_template(); ?>
                        </footer>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<style>
    .about-page {
        max-width: none;
    }

    .about-page .page-title {
        font-size: 32px;
        line-height: 1.3;
        margin: 25px 0;
        color: var(--primary-blue);
        text-align: center;
        padding-bottom: 15px;
        border-bottom: 3px solid lightgrey;
    }

    .about-page .page-thumbnail {
        margin-bottom: 30px;
        text-align: center;
    }

    .about-page .featured-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .about-page .page-content {
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .about-page .page-content h2,
    .about-page .page-content h3,
    .about-page .page-content h4 {
        color: var(--primary-blue);
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .about-page .page-content h2 {
        font-size: 24px;
        border-bottom: 2px solid var(--primary-orange);
        padding-bottom: 5px;
    }

    .about-page .page-content h3 {
        font-size: 20px;
    }

    .about-page .page-content h4 {
        font-size: 18px;
    }

    .about-page .page-content p {
        margin-bottom: 20px;
    }

    .about-page .page-content blockquote {
        background-color: var(--light-gray);
        border-left: 4px solid var(--primary-orange);
        padding: 20px;
        margin: 25px 0;
        font-style: italic;
        border-radius: 0 5px 5px 0;
    }

    .about-page .page-content ul,
    .about-page .page-content ol {
        margin-bottom: 20px;
        padding-left: 30px;
    }

    .about-page .page-content li {
        margin-bottom: 8px;
    }

    .about-page .page-footer {
        border-top: 2px solid var(--light-gray);
        padding-top: 25px;
        margin-top: 30px;
    }

    /* About page specific styles */
    .about-page .page-content .company-info {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 8px;
        margin: 30px 0;
        border-left: 4px solid var(--primary-orange);
    }

    .about-page .page-content .team-section {
        margin: 40px 0;
    }

    .about-page .page-content .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .about-page .page-content .value-item {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .about-page .page-content .value-item h4 {
        color: var(--primary-blue);
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .about-page .page-title {
            font-size: 24px;
        }

        .about-page .page-content .values-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php get_footer(); ?>