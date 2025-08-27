<?php

/**
 * The template for displaying single manual posts
 */

get_header(); ?>

<!-- Article Schema Markup for Manual -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?php echo esc_js(get_the_title()); ?>",
    "description": "<?php echo esc_js(generate_meta_description()); ?>",
    "image": "<?php echo esc_js(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>",
    "datePublished": "<?php echo esc_js(get_the_date('c')); ?>",
    "dateModified": "<?php echo esc_js(get_the_modified_date('c')); ?>",
    "author": {
        "@type": "Organization",
        "name": "<?php echo esc_js(get_bloginfo('name')); ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo esc_js(get_og_image()); ?>"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo esc_js(get_permalink()); ?>"
    },
    "articleSection": "Hướng dẫn kỹ thuật",
    "keywords": "<?php echo esc_js(generate_meta_keywords()); ?>"
}
</script>

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
                            <h3>Hướng dẫn liên quan</h3>
                            <?php
                            // Get related manuals
                            $related_manuals = new WP_Query(array(
                                'post_type' => 'manual',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));

                            if ($related_manuals->have_posts()) :
                            ?>
                                <ul class="recent-posts-list">
                                    <?php while ($related_manuals->have_posts()) : $related_manuals->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                            <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>



<?php get_footer(); ?>