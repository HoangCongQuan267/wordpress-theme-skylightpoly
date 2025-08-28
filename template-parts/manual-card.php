<?php
/**
 * Manual Card Template Part
 * 
 * This template displays a single manual card matching the style used in archive-manual.php
 */

// Get post data
$post_title = get_the_title();
$post_content = get_the_excerpt();
$post_link = get_permalink();
$post_date = get_the_date('d/m/Y');
?>

<article class="manual-card regular-manual">
    <?php if (has_post_thumbnail()) : ?>
        <div class="manual-image">
            <a href="<?php echo esc_url($post_link); ?>">
                <?php the_post_thumbnail('medium', array('alt' => $post_title)); ?>
            </a>
            <div class="manual-overlay">
                <a href="<?php echo esc_url($post_link); ?>" class="manual-link-btn">Xem Hướng Dẫn</a>
            </div>
        </div>
    <?php else : ?>
        <div class="manual-image no-image">
            <a href="<?php echo esc_url($post_link); ?>">
                <div class="placeholder-image">
                    <span class="placeholder-text">📖</span>
                </div>
            </a>
            <div class="manual-overlay">
                <a href="<?php echo esc_url($post_link); ?>" class="manual-link-btn">Xem Hướng Dẫn</a>
            </div>
        </div>
    <?php endif; ?>

    <div class="manual-content">
        <div class="manual-meta">
            <span class="manual-date"><?php echo esc_html($post_date); ?></span>
            <span class="manual-type">Hướng dẫn</span>
        </div>

        <h3 class="manual-title">
            <a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a>
        </h3>

        <p class="manual-excerpt">
            <?php echo wp_trim_words($post_content, 20); ?>
        </p>
    </div>
</article>