<?php

/**
 * The template for displaying single posts
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post single-post'); ?>>
                    <header class="post-header">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <div class="post-meta">
                            <span class="post-date">
                                📅 <?php echo get_the_date(); ?>
                            </span>
                            <span class="post-author">
                                👤 Bởi <?php the_author(); ?>
                            </span>
                            <span class="post-category">
                                🏷️ <?php the_category(', '); ?>
                            </span>
                            <?php if (get_comments_number() > 0) : ?>
                                <span class="post-comments">
                                    💬 <a href="#comments"><?php comments_number('0 Bình luận', '1 Bình luận', '% Bình luận'); ?></a>
                                </span>
                            <?php endif; ?>
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
                        <?php if (get_the_tags()) : ?>
                            <div class="post-tags">
                                <strong>Thẻ:</strong> <?php the_tags('', ', ', ''); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-navigation">
                            <div class="nav-previous">
                                <?php previous_post_link('%link', '← Bài trước'); ?>
                            </div>
                            <div class="nav-next">
                                <?php next_post_link('%link', 'Bài tiếp →'); ?>
                            </div>
                        </div>
                    </footer>
                </article>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </div>


    </div>
</main>

<style>
    .single-post {
        max-width: none;
    }

    .single-post .post-title {
        font-size: 32px;
        line-height: 1.3;
        margin-bottom: 20px;
        color: var(--primary-blue);
    }

    .single-post .post-meta {
        background-color: var(--light-gray);
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 25px;
        border-left: 4px solid var(--primary-orange);
    }

    .single-post .post-meta span {
        margin-right: 20px;
        display: inline-block;
    }

    .single-post .post-thumbnail {
        margin-bottom: 25px;
        text-align: center;
    }

    .single-post .featured-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .single-post .post-content {
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .single-post .post-content h2,
    .single-post .post-content h3,
    .single-post .post-content h4 {
        color: var(--primary-blue);
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .single-post .post-content h2 {
        font-size: 24px;
        border-bottom: 2px solid var(--primary-orange);
        padding-bottom: 5px;
    }

    .single-post .post-content h3 {
        font-size: 20px;
    }

    .single-post .post-content h4 {
        font-size: 18px;
    }

    .single-post .post-content p {
        margin-bottom: 20px;
    }

    .single-post .post-content blockquote {
        background-color: var(--light-gray);
        border-left: 4px solid var(--primary-orange);
        padding: 20px;
        margin: 25px 0;
        font-style: italic;
        border-radius: 0 5px 5px 0;
    }

    .single-post .post-content ul,
    .single-post .post-content ol {
        margin-bottom: 20px;
        padding-left: 30px;
    }

    .single-post .post-content li {
        margin-bottom: 8px;
    }

    .single-post .post-footer {
        border-top: 2px solid var(--light-gray);
        padding-top: 25px;
        margin-top: 30px;
    }

    .single-post .post-tags {
        margin-bottom: 25px;
        padding: 15px;
        background-color: var(--light-gray);
        border-radius: 5px;
    }

    .single-post .post-tags a {
        display: inline-block;
        background-color: var(--primary-orange);
        color: var(--white);
        padding: 5px 10px;
        margin: 3px;
        border-radius: 15px;
        text-decoration: none;
        font-size: 12px;
        transition: background-color 0.3s ease;
    }

    .single-post .post-tags a:hover {
        background-color: var(--light-orange);
    }

    .post-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .post-navigation a {
        display: inline-block;
        padding: 12px 20px;
        background-color: var(--primary-blue);
        color: var(--white);
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-weight: 500;
    }

    .post-navigation a:hover {
        background-color: var(--light-blue);
    }

    .nav-previous {
        text-align: left;
    }

    .nav-next {
        text-align: right;
    }

    .page-links {
        margin: 25px 0;
        padding: 15px;
        background-color: var(--light-gray);
        border-radius: 5px;
        text-align: center;
    }

    .page-links a {
        display: inline-block;
        padding: 8px 12px;
        margin: 0 3px;
        background-color: var(--primary-blue);
        color: var(--white);
        text-decoration: none;
        border-radius: 3px;
        transition: background-color 0.3s ease;
    }

    .page-links a:hover {
        background-color: var(--primary-orange);
    }

    @media (max-width: 768px) {
        .single-post .post-title {
            font-size: 24px;
        }

        .single-post .post-meta span {
            display: block;
            margin-bottom: 8px;
            margin-right: 0;
        }

        .post-navigation {
            flex-direction: column;
            gap: 15px;
        }

        .nav-previous,
        .nav-next {
            text-align: center;
        }
    }
</style>

<?php get_footer(); ?>