<?php

/**
 * Single Quote Article Template
 * 
 * This template displays individual quote articles with full content
 * and all associated meta information
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <div class="posts-container full-width">
            <?php while (have_posts()) : the_post(); 
                // Get meta data
                $author_name = get_post_meta(get_the_ID(), '_quote_author_name', true);
                $author_company = get_post_meta(get_the_ID(), '_quote_author_company', true);
                $author_position = get_post_meta(get_the_ID(), '_quote_author_position', true);
                $quote_date = get_post_meta(get_the_ID(), '_quote_date', true);
                $quote_rating = get_post_meta(get_the_ID(), '_quote_rating', true);
                $featured_quote = get_post_meta(get_the_ID(), '_featured_quote', true);
                
                // Get price table data
                $price_table_data = get_post_meta(get_the_ID(), '_price_table_data', true);
                $currency_symbol = get_post_meta(get_the_ID(), '_currency_symbol', true) ?: 'đ';
                $price_table_title = get_post_meta(get_the_ID(), '_price_table_title', true);
                
                // Format date
                $formatted_date = $quote_date ? date('F j, Y', strtotime($quote_date)) : get_the_date('F j, Y');
                
                // Breadcrumb navigation
                $quotes_url = home_url('/quotes/');
            ?>
                <nav class="breadcrumbs">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
                    <span class="breadcrumb-separator">›</span>
                    <a href="<?php echo esc_url($quotes_url); ?>">Báo Giá</a>
                    <span class="breadcrumb-separator">›</span>
                    <span class="current-page"><?php the_title(); ?></span>
                </nav>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post single-quote'); ?>>
            
                    <header class="post-header">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <div class="post-date-minimal">
                            <?php echo esc_html($formatted_date); ?>
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
            
            <!-- Price Table Section -->
            <?php if ($price_table_data) : 
                $price_data = json_decode($price_table_data, true);
                if ($price_data && isset($price_data['categories'])) :
            ?>
                <div class="price-table-section">
                    <?php if ($price_table_title) : ?>
                        <h2 class="price-table-title"><?php echo esc_html($price_table_title); ?></h2>
                    <?php endif; ?>
                    
                    <div class="price-table-container">
                        <?php foreach ($price_data['categories'] as $category) : ?>
                            <div class="price-category">
                                <h3 class="category-title"><?php echo esc_html($category['name']); ?></h3>
                                
                                <?php if (isset($category['products']) && is_array($category['products'])) : ?>
                                    <div class="price-table">
                                        <table class="pricing-table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Unit</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($category['products'] as $product) : ?>
                                                    <tr>
                                                        <td class="product-name"><?php echo esc_html($product['name'] ?? ''); ?></td>
                                                        <td class="product-price">
                                                            <?php if (isset($product['price']) && $product['price'] !== null) : ?>
                                                                <span class="price-amount"><?php echo esc_html((string)$product['price']); ?></span>
                                                                <span class="currency"><?php echo esc_html($currency_symbol); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="product-unit"><?php echo esc_html((string)($product['unit'] ?? '')); ?></td>
                                                        <td class="product-description"><?php echo esc_html((string)($product['description'] ?? '')); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; endif; ?>
            
                    <footer class="post-footer">
                        <div class="related-posts">
                            <h3>Quotes mới nhất</h3>
                            <?php
                            $current_post_id = get_the_ID();
                            $recent_quotes = get_posts(array(
                                'numberposts' => 3,
                                'post_type' => 'quote_article',
                                'post_status' => 'publish',
                                'exclude' => array($current_post_id),
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));

                            if ($recent_quotes) :
                            ?>
                                <ul class="recent-posts-list">
                                    <?php foreach ($recent_quotes as $recent_quote) : ?>
                                        <li>
                                            <a href="<?php echo get_permalink($recent_quote->ID); ?>">
                                                <?php echo get_the_title($recent_quote->ID); ?>
                                            </a>
                                            <span class="post-date"><?php echo get_the_date('F j, Y', $recent_quote->ID); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<style>
    /* Minimal and flat quote design */
    .single-quote {
        max-width: none;
        margin: 0 auto;
        padding: 0px;
        background: #ffffff;
        font-family: 'Helvetica Neue', 'Arial', sans-serif;
    }

    .single-quote .post-title {
        font-size: 1.25rem;
        line-height: 1.4;
        margin-bottom: 0px;
        color: #1a1a1a;
        font-weight: 600;
        border: none;
        background: none;
    }

    .single-quote .post-meta {
        display: none;
    }

    .single-quote .post-date-minimal {
        font-size: 0.875rem;
        color: #666666;
        margin-bottom: 20px;
        font-weight: 400;
    }

    .single-quote .post-thumbnail {
        margin-bottom: 20px;
    }

    .single-quote .post-thumbnail img {
        width: 100%;
        height: auto;
        display: block;
    }

    .single-quote .post-content {
        font-size: 1rem;
        line-height: 1.6;
        color: #333333;
        margin-bottom: 0;
    }

    .single-quote .post-content h1,
    .single-quote .post-content h2,
    .single-quote .post-content h3,
    .single-quote .post-content h4,
    .single-quote .post-content h5,
    .single-quote .post-content h6 {
        color: #1a1a1a;
        margin: 20px 0 10px 0;
        font-weight: 600;
        border: none;
        background: none;
        padding: 0;
    }

    .single-quote .post-content h2 {
        font-size: 1.25rem;
    }

    .single-quote .post-content h3 {
        font-size: 1.125rem;
    }

    .single-quote .post-content h4 {
        font-size: 1rem;
    }

    .single-quote .post-content p {
        margin-bottom: 16px;
        color: #333333;
    }

    .single-quote .post-content blockquote {
        margin: 20px 0;
        padding: 0 20px;
        color: #666666;
        font-style: italic;
        border: none;
        background: none;
        border-radius: 0;
    }

    .single-quote .post-content ul,
    .single-quote .post-content ol {
        margin-bottom: 16px;
        padding-left: 20px;
    }

    .single-quote .post-content li {
        margin-bottom: 4px;
        color: #333333;
    }

    .single-quote .post-content a {
        color: #1a1a1a;
        text-decoration: underline;
    }

    .single-quote .post-content a:hover {
        color: #666666;
    }

    .single-quote .post-footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .single-quote .related-posts h3 {
        font-size: 1.125rem;
        color: #1a1a1a;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .single-quote .recent-posts-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .single-quote .recent-posts-list li {
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f0f0f0;
    }

    .single-quote .recent-posts-list li:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .single-quote .recent-posts-list a {
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 500;
        display: block;
        margin-bottom: 4px;
    }

    .single-quote .recent-posts-list a:hover {
        color: #666666;
        text-decoration: underline;
    }

    .single-quote .recent-posts-list .post-date {
        font-size: 0.875rem;
        color: #888888;
        font-weight: 400;
    }

    .page-links {
        display: none;
    }

    .breadcrumbs {
        margin-bottom: 5px;
        font-size: 0.8rem;
        color: #666666;
        padding: 20px 0px;
    }

    .breadcrumbs a {
        color: #1a1a1a;
        text-decoration: none;
    }

    .breadcrumbs a:hover {
        color: #666666;
        text-decoration: underline;
    }

    .breadcrumb-separator {
        margin: 0 8px;
        color: #999999;
    }

    .breadcrumbs .current-page {
        color: #666666;
        font-weight: 500;
    }

/* Price Table Section */
.price-table-section {
    background: #ffffff;
    border-radius: 12px;
    padding: 30px;
    margin: 30px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    border: 1px solid #e9ecef;
}

.price-table-title {
    color: #2c3e50;
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0 0 25px 0;
    text-align: center;
    border-bottom: 2px solid #007cba;
    padding-bottom: 15px;
}

.price-table-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.price-category {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    border: 1px solid #e9ecef;
}

.category-title {
    color: #495057;
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0 0 20px 0;
    padding: 10px 15px;
    background: #007cba;
    color: white;
    border-radius: 6px;
    text-align: center;
}

.pricing-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.pricing-table thead {
    background: #343a40;
    color: white;
}

.pricing-table th,
.pricing-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.pricing-table th {
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.pricing-table tbody tr:hover {
    background: #f8f9fa;
}

.pricing-table tbody tr:last-child td {
    border-bottom: none;
}

.product-name {
    font-weight: 600;
    color: #2c3e50;
}

.product-price {
    font-weight: 600;
    color: #28a745;
    white-space: nowrap;
}

.price-amount {
    font-size: 1.1rem;
}

.currency {
    margin-left: 2px;
    font-size: 0.9rem;
    opacity: 0.8;
}

.product-unit {
    color: #6c757d;
    font-style: italic;
}

.product-description {
    color: #495057;
    line-height: 1.4;
}

/* Quote Footer */
.quote-footer {
    background: #ffffff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    border: 1px solid #e9ecef;
}

.quote-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid #e9ecef;
}

.back-to-quotes {
    display: inline-flex;
    align-items: center;
    background: #007cba;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: background 0.3s ease;
}

.back-to-quotes:hover {
    background: #005a87;
    color: white;
}

.share-quote {
    display: flex;
    align-items: center;
    gap: 15px;
}

.share-label {
    color: #495057;
    font-weight: 500;
    font-size: 0.9rem;
}

.share-quote a {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    background: #f8f9fa;
    color: #495057;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    border: 1px solid #dee2e6;
}

.share-quote a:hover {
    background: #e9ecef;
    transform: translateY(-1px);
}

/* Related Quotes */
.related-quotes {
    margin-top: 40px;
}

.related-quotes h3 {
    color: #2c3e50;
    margin-bottom: 25px;
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
}

.related-quotes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.related-quote-card {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.related-quote-card:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.related-quote-card h4 {
    color: #2c3e50;
    margin: 0 0 10px 0;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.3;
}

.related-excerpt {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0 0 10px 0;
    font-style: italic;
}

.related-author {
    color: #495057;
    font-size: 0.85rem;
    margin: 0;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .single-quote-article {
        padding: 20px 0 40px;
    }
    
    .quote-article-content {
        padding: 0 15px;
    }
    
    .quote-header {
        padding: 25px 20px;
    }
    
    .quote-title {
        font-size: 1.8rem;
    }
    
    .quote-author-section {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .quote-content-wrapper {
        padding: 25px 20px;
    }
    
    .quote-content {
        font-size: 1.1rem;
    }
    
    .price-table-section {
        padding: 20px 15px;
        margin: 20px 0;
    }
    
    .price-table-title {
        font-size: 1.5rem;
    }
    
    .pricing-table {
        font-size: 0.85rem;
    }
    
    .pricing-table th,
    .pricing-table td {
        padding: 8px 10px;
    }
    
    .product-description {
        display: none;
    }
    
    .quote-actions {
        flex-direction: column;
        gap: 20px;
        align-items: stretch;
    }
    
    .share-quote {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .related-quotes-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .quote-header {
        padding: 20px 15px;
    }
    
    .quote-title {
        font-size: 1.5rem;
    }
    
    .quote-content-wrapper {
        padding: 20px 15px;
    }
    
    .quote-icon {
        font-size: 3rem;
        left: 20px;
    }
    
    .quote-footer {
        padding: 20px 15px;
    }
}
</style>

<?php get_footer(); ?>