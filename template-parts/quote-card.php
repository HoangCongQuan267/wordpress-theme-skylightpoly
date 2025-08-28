<?php
/**
 * Quote Card Template Part
 * 
 * This template displays a single quote card matching the style used in page-quotes.php
 */

// Get post data
$post_title = get_the_title();
$post_content = get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30, '...');
$post_link = get_permalink();
$post_date = get_the_date('d/m/Y');

// Check for price table (custom field)
$price_table_data = get_post_meta(get_the_ID(), 'price_table', true);
$has_price_table = !empty($price_table_data);
?>

<article class="quote-card" onclick="window.location.href='<?php echo esc_url($post_link); ?>'">
    <?php if ($has_price_table) : ?>
        <div class="price-indicator">
            <span>💰 Bảng Giá</span>
        </div>
    <?php endif; ?>

    <div class="quote-card-header">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium', array('alt' => $post_title)); ?>
        <?php else : ?>
            <div class="placeholder-image">
                <span class="placeholder-text">💬</span>
            </div>
        <?php endif; ?>
    </div>

    <div class="quote-meta">
        <div class="article-meta">
            <div class="article-date"><?php echo esc_html($post_date); ?></div>
            <?php if ($has_price_table) : ?>
                <div class="article-category">Bảng Giá</div>
            <?php endif; ?>
        </div>

        <h3 class="quote-title">
            <a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a>
        </h3>

        <div class="quote-content">
            <p class="quote-excerpt"><?php echo esc_html($post_content); ?></p>
        </div>
    </div>
</article>