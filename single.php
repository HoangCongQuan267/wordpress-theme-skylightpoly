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
                    $articles_url = home_url('/articles/');
                    ?>
                    <a href="<?php echo esc_url($articles_url); ?>">Bài viết</a>
                    <span class="breadcrumb-separator">›</span>
                    <span class="current-page"><?php the_title(); ?></span>
                </nav>
                <!-- Structured Data for Article -->
                <script type="application/ld+json">
                    {
                        "@context": "https://schema.org",
                        "@type": "Article",
                        "headline": "<?php echo esc_attr(get_the_title()); ?>",
                        "description": "<?php echo esc_attr(wp_trim_words(get_the_excerpt() ? get_the_excerpt() : get_the_content(), 25)); ?>",
                        "image": {
                            "@type": "ImageObject",
                            "url": "<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                        },
                        "author": {
                            "@type": "Person",
                            "name": "<?php echo esc_attr(get_bloginfo('name')); ?>"
                        },
                        "publisher": {
                            "@type": "Organization",
                            "name": "<?php echo esc_attr(get_bloginfo('name')); ?>",
                            "logo": {
                                "@type": "ImageObject",
                                "url": "<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                            }
                        },
                        "datePublished": "<?php echo esc_attr(get_the_date('c')); ?>",
                        "mainEntityOfPage": {
                            "@type": "WebPage",
                            "@id": "<?php echo esc_url(get_permalink()); ?>"
                        }
                    }
                </script>

                <article id="post-<?php the_ID(); ?>" <?php post_class('post single-post'); ?>>
                    <header class="post-header">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <div class="post-date-minimal">
                            <?php echo get_the_date('d/m/Y'); ?>
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
                                <div class="articles-page-grid">
                                    <?php 
                                    global $post;
                                    foreach ($recent_posts as $recent_post) :
                                        $post = $recent_post;
                                        include(get_template_directory() . '/template-parts/article-card.php');
                                    endforeach;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </footer>
                </article>



            <?php endwhile; ?>
        </div>


    </div>
</main>



<?php get_footer(); ?>