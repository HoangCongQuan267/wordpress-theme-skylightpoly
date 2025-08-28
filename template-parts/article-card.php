<?php
/**
 * Article Card Template Part
 * 
 * This template displays a single article card matching the style used in page-articles.php
 */

// Get post data
$post_title = get_the_title();
$post_content = get_the_excerpt();
$post_link = get_permalink();
$post_date = get_the_date('d/m/Y');
$categories = get_the_category();
?>

<article class="article-card regular-article">
    <?php if (has_post_thumbnail()) : ?>
        <div class="article-image">
            <a href="<?php echo esc_url($post_link); ?>">
                <?php the_post_thumbnail('medium', array('alt' => $post_title)); ?>
            </a>
            <div class="article-overlay">
                <a href="<?php echo esc_url($post_link); ?>" class="article-link-btn">Đọc Bài Viết</a>
            </div>
        </div>
    <?php else : ?>
        <div class="article-image no-image">
            <a href="<?php echo esc_url($post_link); ?>">
                <div class="placeholder-image">
                    <span class="placeholder-text">Không có hình ảnh</span>
                </div>
            </a>
            <div class="article-overlay">
                <a href="<?php echo esc_url($post_link); ?>" class="article-link-btn">Đọc Bài Viết</a>
            </div>
        </div>
    <?php endif; ?>

    <div class="article-content">
        <div class="article-meta">
            <span class="article-date"><?php echo esc_html($post_date); ?></span>
            <?php if (!empty($categories)) : ?>
                <span class="article-category"><?php echo esc_html($categories[0]->name); ?></span>
            <?php endif; ?>
        </div>

        <h3 class="article-title">
            <a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a>
        </h3>

        <p class="article-excerpt">
            <?php echo wp_trim_words($post_content, 20); ?>
        </p>
    </div>
</article>