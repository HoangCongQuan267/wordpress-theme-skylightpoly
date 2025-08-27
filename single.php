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



<?php get_footer(); ?>