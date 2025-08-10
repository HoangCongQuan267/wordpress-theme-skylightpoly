<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                        <header class="post-header">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
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
                            </div>
                        </header>

                        <div class="post-content">
                            <?php
                            if (is_home() || is_archive()) {
                                the_excerpt();
                                echo '<a href="' . get_permalink() . '" class="read-more">Đọc thêm →</a>';
                            } else {
                                the_content();
                            }
                            ?>
                        </div>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => '← Trước',
                        'next_text' => 'Sau →',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">Trang </span>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <article class="post">
                    <header class="post-header">
                        <h2 class="post-title">Không tìm thấy</h2>
                    </header>
                    <div class="post-content">
                        <p>Có vẻ như không tìm thấy gì tại vị trí này. Có thể thử tìm kiếm?</p>
                        <?php get_search_form(); ?>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>