<?php

/**
 * Single Quote Article Template
 * 
 * This template displays individual quote articles with full content
 * and all associated meta information
 */

get_header(); ?>

<main id="main" class="site-main single-quote-article">
    <div class="container">
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
        
        <article class="quote-article-content">
            <!-- Breadcrumb Navigation -->
            <nav class="quote-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="separator">→</span>
                <a href="<?php echo esc_url($quotes_url); ?>">Quotes</a>
                <span class="separator">→</span>
                <span class="current"><?php the_title(); ?></span>
            </nav>
            
            <!-- Quote Header -->
            <header class="quote-header">
                <?php if ($featured_quote === 'yes') : ?>
                    <div class="featured-badge">
                        <span>⭐ Featured Quote</span>
                    </div>
                <?php endif; ?>
                
                <h1 class="quote-title"><?php the_title(); ?></h1>
                
                <div class="quote-meta-info">
                    <div class="quote-author-section">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="author-photo">
                                <?php the_post_thumbnail('medium', array('alt' => $author_name ? $author_name : get_the_title())); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="author-details">
                            <?php if ($author_name) : ?>
                                <h3 class="author-name"><?php echo esc_html($author_name); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ($author_position || $author_company) : ?>
                                <p class="author-position">
                                    <?php if ($author_position && $author_company) : ?>
                                        <?php echo esc_html($author_position); ?> at <strong><?php echo esc_html($author_company); ?></strong>
                                    <?php elseif ($author_position) : ?>
                                        <?php echo esc_html($author_position); ?>
                                    <?php elseif ($author_company) : ?>
                                        <strong><?php echo esc_html($author_company); ?></strong>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if ($quote_rating && $quote_rating > 0) : ?>
                                <div class="quote-rating">
                                    <span class="rating-label">Rating:</span>
                                    <div class="stars">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <span class="star <?php echo ($i <= $quote_rating) ? 'filled' : 'empty'; ?>">★</span>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="rating-text">(<?php echo esc_html($quote_rating); ?>/5)</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="quote-date-info">
                        <span class="date-label">Quote Date:</span>
                        <time datetime="<?php echo esc_attr($quote_date ? $quote_date : get_the_date('Y-m-d')); ?>">
                            <?php echo esc_html($formatted_date); ?>
                        </time>
                    </div>
                </div>
            </header>
            
            <!-- Quote Content -->
            <div class="quote-content-wrapper">
                <div class="quote-icon">"</div>
                <div class="quote-content">
                    <?php the_content(); ?>
                </div>
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
            
            <!-- Quote Footer -->
            <footer class="quote-footer">
                <div class="quote-actions">
                    <a href="<?php echo esc_url($quotes_url); ?>" class="back-to-quotes">
                        ← Back to All Quotes
                    </a>
                    
                    <div class="share-quote">
                        <span class="share-label">Share:</span>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode('"' . wp_trim_words(get_the_content(), 20) . '" - ' . $author_name); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-twitter" title="Share on Twitter">
                            🐦 Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-linkedin" title="Share on LinkedIn">
                            💼 LinkedIn
                        </a>
                        <a href="mailto:?subject=<?php echo urlencode('Great Quote: ' . get_the_title()); ?>&body=<?php echo urlencode('I thought you might find this quote interesting: ' . get_permalink()); ?>" class="share-email" title="Share via Email">
                            ✉️ Email
                        </a>
                    </div>
                </div>
                
                <!-- Related Quotes -->
                <?php
                $related_quotes = new WP_Query(array(
                    'post_type' => 'quote_article',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                    'post_status' => 'publish'
                ));
                
                if ($related_quotes->have_posts()) :
                ?>
                    <div class="related-quotes">
                        <h3>More Customer Quotes</h3>
                        <div class="related-quotes-grid">
                            <?php while ($related_quotes->have_posts()) : $related_quotes->the_post(); 
                                $rel_author = get_post_meta(get_the_ID(), '_quote_author_name', true);
                                $rel_company = get_post_meta(get_the_ID(), '_quote_author_company', true);
                            ?>
                                <div class="related-quote-card" onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                                    <h4><?php the_title(); ?></h4>
                                    <p class="related-excerpt"><?php echo esc_html(wp_trim_words(get_the_content(), 15, '...')); ?></p>
                                    <?php if ($rel_author) : ?>
                                        <p class="related-author">— <?php echo esc_html($rel_author); ?><?php echo $rel_company ? ', ' . esc_html($rel_company) : ''; ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php 
                    wp_reset_postdata();
                endif; 
                ?>
            </footer>
        </article>
        
        <?php endwhile; ?>
    </div>
</main>

<style>
/* Single Quote Article Styles */
.single-quote-article {
    padding: 40px 0 60px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    min-height: 80vh;
}

.quote-article-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Breadcrumb */
.quote-breadcrumb {
    margin-bottom: 30px;
    font-size: 0.9rem;
    color: #6c757d;
}

.quote-breadcrumb a {
    color: #007cba;
    text-decoration: none;
}

.quote-breadcrumb a:hover {
    text-decoration: underline;
}

.quote-breadcrumb .separator {
    margin: 0 10px;
    color: #adb5bd;
}

.quote-breadcrumb .current {
    color: #495057;
    font-weight: 500;
}

/* Quote Header */
.quote-header {
    background: #ffffff;
    border-radius: 12px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    border: 1px solid #e9ecef;
    position: relative;
}

.featured-badge {
    position: absolute;
    top: -12px;
    right: 20px;
    background: #ffc107;
    color: #212529;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.quote-title {
    font-size: 2.2rem;
    color: #2c3e50;
    margin: 0 0 30px 0;
    font-weight: 700;
    line-height: 1.3;
    text-align: center;
}

.quote-meta-info {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.quote-author-section {
    display: flex;
    align-items: center;
    gap: 20px;
}

.author-photo {
    flex-shrink: 0;
}

.author-photo img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e9ecef;
}

.author-details {
    flex: 1;
}

.author-name {
    font-size: 1.4rem;
    color: #2c3e50;
    margin: 0 0 8px 0;
    font-weight: 600;
}

.author-position {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 15px 0;
    line-height: 1.4;
}

.quote-rating {
    display: flex;
    align-items: center;
    gap: 10px;
}

.rating-label {
    color: #495057;
    font-weight: 500;
    font-size: 0.9rem;
}

.stars {
    display: flex;
    gap: 2px;
}

.star {
    font-size: 1.2rem;
    color: #ffc107;
}

.star.empty {
    color: #dee2e6;
}

.rating-text {
    color: #6c757d;
    font-size: 0.9rem;
}

.quote-date-info {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.date-label {
    color: #495057;
    font-weight: 500;
    font-size: 0.9rem;
}

.quote-date-info time {
    color: #6c757d;
    font-size: 0.9rem;
}

/* Quote Content */
.quote-content-wrapper {
    background: #ffffff;
    border-radius: 12px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    border: 1px solid #e9ecef;
    position: relative;
}

.quote-icon {
    position: absolute;
    top: -10px;
    left: 30px;
    font-size: 4rem;
    color: #007cba;
    font-family: Georgia, serif;
    line-height: 1;
    background: #ffffff;
    padding: 0 10px;
}

.quote-content {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #2c3e50;
    font-style: italic;
    text-align: center;
    margin-top: 20px;
}

.quote-content p {
    margin-bottom: 20px;
}

.quote-content p:last-child {
    margin-bottom: 0;
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