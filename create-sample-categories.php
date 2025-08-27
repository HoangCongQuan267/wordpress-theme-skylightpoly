<?php
/**
 * Sample Product Categories Creator
 * 
 * This file creates sample product categories for testing.
 * Access this file through WordPress admin to create categories.
 * 
 * Usage: Add this to your theme's functions.php or run it once through WordPress admin.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    // If accessed directly, load WordPress
    require_once('../../../wp-load.php');
}

// Check if user has admin capabilities
if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
}

/**
 * Create sample product categories
 */
function create_sample_product_categories() {
    $sample_categories = array(
        array(
            'name' => 'Plastic Containers',
            'slug' => 'plastic-containers',
            'description' => 'Various types of plastic containers for storage and packaging'
        ),
        array(
            'name' => 'Food Packaging',
            'slug' => 'food-packaging', 
            'description' => 'Food-safe plastic packaging solutions'
        ),
        array(
            'name' => 'Industrial Plastics',
            'slug' => 'industrial-plastics',
            'description' => 'Heavy-duty plastic products for industrial use'
        ),
        array(
            'name' => 'Household Items',
            'slug' => 'household-items',
            'description' => 'Plastic products for everyday household use'
        ),
        array(
            'name' => 'Custom Solutions',
            'slug' => 'custom-solutions',
            'description' => 'Custom plastic manufacturing solutions'
        )
    );
    
    $created_categories = array();
    $existing_categories = array();
    
    foreach ($sample_categories as $category_data) {
        // Check if category already exists
        $existing_term = term_exists($category_data['slug'], 'product_category');
        
        if (!$existing_term) {
            // Create the category
            $result = wp_insert_term(
                $category_data['name'],
                'product_category',
                array(
                    'slug' => $category_data['slug'],
                    'description' => $category_data['description']
                )
            );
            
            if (!is_wp_error($result)) {
                $created_categories[] = $category_data['name'];
            }
        } else {
            $existing_categories[] = $category_data['name'];
        }
    }
    
    return array(
        'created' => $created_categories,
        'existing' => $existing_categories
    );
}

// Create categories if form is submitted
$message = '';
if (isset($_POST['create_categories'])) {
    $result = create_sample_product_categories();
    
    if (!empty($result['created'])) {
        $message .= '<div class="notice notice-success"><p>Created categories: ' . implode(', ', $result['created']) . '</p></div>';
    }
    
    if (!empty($result['existing'])) {
        $message .= '<div class="notice notice-info"><p>Already existing categories: ' . implode(', ', $result['existing']) . '</p></div>';
    }
    
    if (empty($result['created']) && empty($result['existing'])) {
        $message .= '<div class="notice notice-error"><p>No categories were created or found.</p></div>';
    }
}

// Get current categories count
$current_categories = get_terms(array(
    'taxonomy' => 'product_category',
    'hide_empty' => false,
));

$categories_count = is_array($current_categories) ? count($current_categories) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Sample Product Categories</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 600px; }
        .notice { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .notice-success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .notice-info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; }
        .notice-error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .btn { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #005a87; }
        .info-box { background: #f8f9fa; padding: 15px; border-radius: 4px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Sample Product Categories</h1>
        
        <?php echo $message; ?>
        
        <div class="info-box">
            <h3>Current Status</h3>
            <p><strong>Product categories currently in database:</strong> <?php echo $categories_count; ?></p>
            
            <?php if ($categories_count > 0): ?>
                <h4>Existing Categories:</h4>
                <ul>
                    <?php foreach ($current_categories as $cat): ?>
                        <li><?php echo esc_html($cat->name); ?> (<?php echo $cat->count; ?> products)</li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        
        <form method="post">
            <p>This will create sample product categories for your products page:</p>
            <ul>
                <li>Plastic Containers</li>
                <li>Food Packaging</li>
                <li>Industrial Plastics</li>
                <li>Household Items</li>
                <li>Custom Solutions</li>
            </ul>
            
            <button type="submit" name="create_categories" class="btn">Create Sample Categories</button>
        </form>
        
        <div class="info-box">
            <h3>Next Steps</h3>
            <ol>
                <li>After creating categories, go to <strong>WordPress Admin > Products > Product Categories</strong></li>
                <li>Create or edit products and assign them to categories</li>
                <li>Visit your products page to see the categories in the left panel</li>
            </ol>
        </div>
        
        <p><a href="<?php echo admin_url('edit-tags.php?taxonomy=product_category&post_type=product'); ?>">Go to Product Categories Admin</a></p>
        <p><a href="<?php echo admin_url('edit.php?post_type=product'); ?>">Go to Products Admin</a></p>
        <p><a href="<?php echo get_permalink(get_page_by_path('products')); ?>">View Products Page</a></p>
    </div>
</body>
</html>