<?php
/**
 * Flush Permalinks Script
 * 
 * This script flushes WordPress permalinks to update the rewrite rules
 * after changing custom post type slugs.
 * 
 * Usage: Access this file via browser or run via command line
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if WordPress is loaded
if (!function_exists('flush_rewrite_rules')) {
    die('Error: WordPress not loaded properly.');
}

// Flush rewrite rules
flush_rewrite_rules(true);

echo "<h1>Permalink Flush Complete</h1>";
echo "<p>The following changes have been applied:</p>";
echo "<ul>";
echo "<li>Product post type has_archive set to true</li>";
echo "<li>archive-product.php template created for /products/ URL</li>";
echo "<li>Rewrite rules have been flushed</li>";
echo "</ul>";
echo "<p><strong>Next steps:</strong></p>";
echo "<ul>";
echo "<li>Test the <a href='/products/'>/products/</a> page</li>";
echo "<li>Test individual product URLs (should use /products/product-name/)</li>";
echo "<li>Test product category URLs</li>";
echo "</ul>";

// Optional: Delete this file after use for security
// unlink(__FILE__);
?>