<?php

/**
 * The template for displaying pages
 */

get_header(); ?>

<!-- WebPage Schema Markup -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "<?php echo esc_js(get_the_title()); ?>",
        "description": "<?php echo esc_js(generate_meta_description()); ?>",
        "url": "<?php echo esc_js(get_permalink()); ?>",
        "mainEntity": {
            "@type": "Article",
            "headline": "<?php echo esc_js(get_the_title()); ?>",
            "description": "<?php echo esc_js(generate_meta_description()); ?>",
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
            }
        },
        "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Trang chủ",
                    "item": "<?php echo esc_js(home_url('/')); ?>"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "<?php echo esc_js(get_the_title()); ?>",
                    "item": "<?php echo esc_js(get_permalink()); ?>"
                }
            ]
        }
    }
</script>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php while (have_posts()) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class('page'); ?>>
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
    .page {
        max-width: none;
    }

    .page .page-title {
        font-size: 1.3rem;
        line-height: 1.3;
        margin-bottom: 25px;
        color: var(--primary-blue);
        text-align: center;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--primary-orange);
    }

    .page .page-thumbnail {
        margin-bottom: 30px;
        text-align: center;
    }

    .page .featured-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .page .page-content {
        font-size: 1.2rem;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .page .page-content h2,
    .page .page-content h3,
    .page .page-content h4 {
        color: var(--primary-blue);
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .page .page-content h2 {
        font-size: 1.2rem;
        border-bottom: 2px solid var(--primary-orange);
        padding-bottom: 5px;
    }

    .page .page-content h3 {
        font-size: 20px;
    }

    .page .page-content h4 {
        font-size: 1rem;
    }

    .page .page-content p {
        margin-bottom: 20px;
    }

    .page .page-content blockquote {
        background-color: var(--light-gray);
        border-left: 4px solid var(--primary-orange);
        padding: 20px;
        font-style: italic;
        border-radius: 0 5px 5px 0;
    }

    .page .page-content ul,
    .page .page-content ol {
        margin-bottom: 20px;
        padding-left: 30px;
    }

    .page .page-content li {
        margin-bottom: 8px;
    }

    .page .page-footer {
        border-top: 2px solid var(--light-gray);
        padding-top: 25px;
        margin-top: 30px;
    }

    @media (max-width: 768px) {
        .page .page-title {
            font-size: 1.2rem;
        }
    }
</style>

<?php get_footer(); ?>