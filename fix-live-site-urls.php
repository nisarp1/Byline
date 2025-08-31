<?php
/**
 * Fix Live Site URLs Script
 * 
 * This script updates the WordPress database to use the correct live site URLs
 * Run this once after deploying to Cloudways
 */

// Database connection - Update these with your Cloudways database details
$db_host = 'YOUR_CLOUDWAYS_DB_HOST';
$db_name = 'YOUR_CLOUDWAYS_DB_NAME';
$db_user = 'YOUR_CLOUDWAYS_DB_USER';
$db_pass = 'YOUR_CLOUDWAYS_DB_PASSWORD';

// Site URLs
$old_url = 'http://localhost/byline-wp'; // Your local development URL
$new_url = 'https://phpstack-1448755-5721123.cloudwaysapps.com'; // Your Cloudways URL

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    
    // Update wp_options table
    $sql = "UPDATE wp_options SET option_value = REPLACE(option_value, ?, ?) WHERE option_name IN ('home', 'siteurl')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$old_url, $new_url]);
    
    echo "Updated wp_options table\n";
    
    // Update wp_posts table
    $sql = "UPDATE wp_posts SET guid = REPLACE(guid, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$old_url, $new_url]);
    
    echo "Updated wp_posts table\n";
    
    // Update post content
    $sql = "UPDATE wp_posts SET post_content = REPLACE(post_content, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$old_url, $new_url]);
    
    echo "Updated post content\n";
    
    // Update post excerpt
    $sql = "UPDATE wp_posts SET post_excerpt = REPLACE(post_excerpt, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$old_url, $new_url]);
    
    echo "Updated post excerpts\n";
    
    // Update meta values
    $sql = "UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$old_url, $new_url]);
    
    echo "Updated post meta\n";
    
    echo "\n✅ URL replacement completed successfully!\n";
    echo "Your site should now work properly at: $new_url\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
