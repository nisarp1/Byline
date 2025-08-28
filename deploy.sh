#!/bin/bash

# Byline WordPress Deployment Script for Cloudways
# This script handles the deployment process for Cloudways

echo "🚀 Starting Byline WordPress deployment..."

# Set error handling
set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "wp-config.php" ] && [ ! -f "wp-config-sample.php" ]; then
    print_error "WordPress configuration file not found. Please run this script from the WordPress root directory."
    exit 1
fi

# Create wp-config.php if it doesn't exist
if [ ! -f "wp-config.php" ] && [ -f "wp-config-sample.php" ]; then
    print_warning "wp-config.php not found. Please copy wp-config-sample.php to wp-config.php and configure your database settings."
    print_status "You can do this manually or run: cp wp-config-sample.php wp-config.php"
fi

# Set proper permissions
print_status "Setting file permissions..."
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Make wp-config.php readable only by owner
if [ -f "wp-config.php" ]; then
    chmod 600 wp-config.php
fi

# Make wp-content/uploads writable
if [ -d "wp-content/uploads" ]; then
    chmod -R 755 wp-content/uploads
    print_status "Made wp-content/uploads writable"
fi

# Check for required directories
print_status "Checking required directories..."
for dir in wp-content/themes wp-content/plugins wp-content/uploads; do
    if [ ! -d "$dir" ]; then
        mkdir -p "$dir"
        print_status "Created directory: $dir"
    fi
done

# Create .htaccess if it doesn't exist
if [ ! -f ".htaccess" ]; then
    print_status "Creating .htaccess file..."
    cat > .htaccess << 'EOF'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
EOF
fi

# Check PHP version compatibility
print_status "Checking PHP version..."
PHP_VERSION=$(php -r "echo PHP_VERSION;")
print_status "PHP version: $PHP_VERSION"

# Verify WordPress core files
print_status "Verifying WordPress core files..."
if [ ! -f "wp-load.php" ] || [ ! -f "wp-settings.php" ]; then
    print_error "WordPress core files are missing. Please ensure this is a complete WordPress installation."
    exit 1
fi

# Database connection test (if wp-config.php exists)
if [ -f "wp-config.php" ]; then
    print_status "Testing database connection..."
    if php -r "
        require_once 'wp-config.php';
        try {
            \$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if (\$mysqli->connect_error) {
                throw new Exception('Connection failed: ' . \$mysqli->connect_error);
            }
            echo 'Database connection successful\n';
            \$mysqli->close();
        } catch (Exception \$e) {
            echo 'Database connection failed: ' . \$e->getMessage() . '\n';
            exit(1);
        }
    "; then
        print_status "Database connection test passed"
    else
        print_warning "Database connection test failed. Please check your wp-config.php settings."
    fi
fi

# Final checks
print_status "Performing final checks..."

# Check if index.php exists
if [ ! -f "index.php" ]; then
    print_error "index.php not found. This is required for WordPress to function."
    exit 1
fi

# Check if wp-content directory exists
if [ ! -d "wp-content" ]; then
    print_error "wp-content directory not found. This is required for WordPress to function."
    exit 1
fi

print_status "✅ Deployment script completed successfully!"
print_status "📝 Next steps:"
echo "   1. Configure your domain in Cloudways"
echo "   2. Set up your database credentials in wp-config.php"
echo "   3. Complete WordPress installation by visiting your domain"
echo "   4. Install and activate your theme"
echo "   5. Configure your plugins"

print_status "🌐 Your WordPress site should now be ready for deployment!"
