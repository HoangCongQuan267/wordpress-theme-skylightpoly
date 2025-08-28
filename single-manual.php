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
    "headline": "<?php echo esc_attr(get_the_title()); ?>",
    "description": "<?php echo esc_attr(wp_trim_words(get_the_excerpt() ? get_the_excerpt() : get_the_content(), 25)); ?>",
    "image": "<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>",
    "datePublished": "<?php echo esc_attr(get_the_date('c')); ?>",
    "author": {
        "@type": "Organization",
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
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo esc_url(get_permalink()); ?>"
    },
    "articleSection": "Hướng dẫn kỹ thuật"
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
                                <div class="manuals-page-grid">
                                    <?php 
                                    while ($related_manuals->have_posts()) : 
                                        $related_manuals->the_post();
                                        include(get_template_directory() . '/template-parts/manual-card.php');
                                    endwhile;
                                    ?>
                                </div>
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