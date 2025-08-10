<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 */

get_header(); ?>

<!-- Hero Section with Dynamic Slideshow -->
<?php
// Check if slideshow is enabled in customizer
$slideshow_enabled = get_theme_mod('hero_slideshow_enable', true);
if ($slideshow_enabled) :
    // Try customizer slides first, then fallback to custom post type
    $customizer_slides = get_customizer_hero_slides();
    $hero_slides = !empty($customizer_slides) ? $customizer_slides : get_hero_slides();
    $is_customizer = !empty($customizer_slides);
    
    // Debug: Show slide count (remove this in production)
    // echo '<!-- Debug: Customizer slides: ' . count($customizer_slides) . ', Total slides: ' . count($hero_slides) . ' -->';
    
    if (!empty($hero_slides)) :
?>
<!-- Dynamic slides from WordPress Customizer or Admin -->
<?php
$autoplay = get_theme_mod('hero_slideshow_autoplay', true);
$speed = get_theme_mod('hero_slideshow_speed', 5000);
?>
<section class="hero-section" data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>" data-duration="<?php echo $speed; ?>">
    <div class="hero-slideshow">
        <?php foreach ($hero_slides as $index => $slide) : 
            if ($is_customizer) {
                // Customizer slide data
                $slide_image = $slide['image_url'];
                $slide_title = $slide['title'];
                $slide_subtitle = $slide['subtitle'];
                $button_text = $slide['button_text'];
                $button_url = $slide['button_url'];
            } else {
                // Custom post type slide data
                $slide_image = get_the_post_thumbnail_url($slide->ID, 'full');
                $slide_title = get_the_title($slide->ID);
                $slide_subtitle = get_post_meta($slide->ID, '_hero_slide_subtitle', true);
                $button_text = get_post_meta($slide->ID, '_hero_slide_button_text', true);
                $button_url = get_post_meta($slide->ID, '_hero_slide_button_url', true);
            }
            $active_class = ($index === 0) ? ' active' : '';
        ?>
        <div class="slide<?php echo $active_class; ?>" style="background-image: url('<?php echo esc_url($slide_image); ?>')">            <div class="slide-content">
                <h1 class="slide-title"><?php echo esc_html($slide_title); ?></h1>
                <?php if ($slide_subtitle) : ?>
                    <p class="slide-subtitle"><?php echo esc_html($slide_subtitle); ?></p>
                <?php endif; ?>
                <?php if ($button_text && $button_url) : ?>
                    <a href="<?php echo esc_url($button_url); ?>" class="slide-button"><?php echo esc_html($button_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        
        <!-- Navigation Arrows -->
        <button class="slideshow-arrows prev-arrow">‹</button>
        <button class="slideshow-arrows next-arrow">›</button>
        
        <!-- Slide Indicators -->
        <div class="slideshow-nav">
            <?php foreach ($hero_slides as $index => $slide) : 
                $active_class = ($index === 0) ? ' active' : '';
            ?>
            <span class="nav-dot<?php echo $active_class; ?>" data-slide="<?php echo $index; ?>"></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php 
    else : 
?>
<!-- Fallback: Default hero section when no slides are configured -->
<section class="hero-section">
    <div class="hero-slideshow">
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
            <div class="slide-overlay"></div>
            <div class="slide-content">
                <h1 class="hero-title">Welcome to Our Website</h1>
                <p class="hero-subtitle">Create your custom hero slides in WordPress admin</p>
                <a href="<?php echo admin_url('edit.php?post_type=hero_slide'); ?>" class="hero-btn">Manage Slides</a>
            </div>
        </div>
    </div>
</section>
<?php 
    endif; // End slideshow enabled check
endif; // End hero slides check
?>

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