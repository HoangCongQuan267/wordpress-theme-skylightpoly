<?php

/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside class="sidebar widget-area" role="complementary" aria-label="Primary Sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>

    <!-- Default widgets if no widgets are added -->
    <?php if (!dynamic_sidebar('sidebar-1')) : ?>

        <!-- Search Widget -->
        <section class="widget widget_search">
            <h3 class="widget-title">Search</h3>
            <?php get_search_form(); ?>
        </section>

        <!-- Recent Posts Widget -->
        <section class="widget widget_recent_entries">
            <h3 class="widget-title">Recent Posts</h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));

                foreach ($recent_posts as $post) :
                ?>
                    <li>
                        <a href="<?php echo get_permalink($post['ID']); ?>">
                            <?php echo $post['post_title']; ?>
                        </a>
                        <span class="post-date"><?php echo get_the_date('M j, Y', $post['ID']); ?></span>
                    </li>
                <?php endforeach;
                wp_reset_query(); ?>
            </ul>
        </section>

        <!-- Categories Widget -->
        <section class="widget widget_categories">
            <h3 class="widget-title">Categories</h3>
            <ul>
                <?php wp_list_categories(array(
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'show_count' => 1,
                    'title_li'   => '',
                    'number'     => 10,
                )); ?>
            </ul>
        </section>

        <!-- Archives Widget -->
        <section class="widget widget_archive">
            <h3 class="widget-title">Archives</h3>
            <ul>
                <?php wp_get_archives(array(
                    'type'  => 'monthly',
                    'limit' => 12,
                )); ?>
            </ul>
        </section>

        <!-- Tag Cloud Widget -->
        <section class="widget widget_tag_cloud">
            <h3 class="widget-title">Tags</h3>
            <div class="tagcloud">
                <?php wp_tag_cloud(array(
                    'smallest' => 12,
                    'largest'  => 18,
                    'unit'     => 'px',
                    'number'   => 20,
                )); ?>
            </div>
        </section>

        <!-- Custom About Widget -->
        <section class="widget widget_text">
            <h3 class="widget-title">About This Site</h3>
            <div class="textwidget">
                <p>Welcome to our website! We're dedicated to providing you with the best content and user experience. Feel free to explore our posts and get in touch with us.</p>
                <p><strong>Contact Information:</strong></p>
                <ul class="contact-list">
                    <li>📞 <a href="tel:+1234567890">+1 (234) 567-890</a></li>
                    <li>✉️ <a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
                    <li>📍 123 Main Street, City, State 12345</li>
                </ul>
            </div>
        </section>

    <?php endif; ?>
</aside>

<style>
    /* Sidebar Specific Styles */
    .sidebar .widget {
        background-color: var(--white);
        padding: 25px;
        margin-bottom: 25px;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--primary-orange);
    }

    .sidebar .widget-title {
        color: var(--primary-blue);
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--primary-orange);
        position: relative;
    }

    .sidebar .widget-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 30px;
        height: 2px;
        background-color: var(--primary-blue);
    }

    .sidebar .widget ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar .widget ul li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
        transition: padding-left 0.3s ease;
    }

    .sidebar .widget ul li:last-child {
        border-bottom: none;
    }

    .sidebar .widget ul li:hover {
        padding-left: 10px;
    }

    .sidebar .widget ul li a {
        color: var(--dark-gray);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .sidebar .widget ul li a:hover {
        color: var(--primary-orange);
    }

    .sidebar .widget .post-date {
        display: block;
        font-size: 12px;
        color: var(--medium-gray);
        margin-top: 3px;
    }

    .sidebar .widget_categories .cat-item {
        position: relative;
    }

    .sidebar .widget_categories .cat-item .count {
        background-color: var(--primary-orange);
        color: var(--white);
        font-size: 11px;
        padding: 2px 6px;
        border-radius: 10px;
        margin-left: 8px;
    }

    .sidebar .tagcloud a {
        display: inline-block;
        background-color: var(--light-gray);
        color: var(--dark-gray);
        padding: 5px 10px;
        margin: 3px;
        border-radius: 15px;
        text-decoration: none;
        font-size: 12px !important;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .sidebar .tagcloud a:hover {
        background-color: var(--primary-orange);
        color: var(--white);
        transform: translateY(-2px);
    }

    .sidebar .search-form {
        position: relative;
    }

    .sidebar .search-field {
        width: 100%;
        padding: 12px 45px 12px 15px;
        border: 2px solid #ddd;
        border-radius: 25px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .sidebar .search-field:focus {
        outline: none;
        border-color: var(--primary-blue);
    }

    .sidebar .search-submit {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background-color: var(--primary-orange);
        color: var(--white);
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 12px;
        transition: background-color 0.3s ease;
    }

    .sidebar .search-submit:hover {
        background-color: var(--light-orange);
    }

    .sidebar .contact-list {
        list-style: none;
        padding: 0;
    }

    .sidebar .contact-list li {
        padding: 5px 0;
        border-bottom: none;
    }

    .sidebar .contact-list li a {
        color: var(--primary-blue);
    }

    .sidebar .contact-list li a:hover {
        color: var(--primary-orange);
    }

    .sidebar .textwidget p {
        line-height: 1.6;
        margin-bottom: 15px;
        color: var(--medium-gray);
    }

    /* Responsive Design for Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            margin-top: 30px;
        }

        .sidebar .widget {
            padding: 20px;
            margin-bottom: 20px;
        }
    }
</style>