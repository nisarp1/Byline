# Cloudways Deployment Configuration Guide

## 🚀 Quick Setup for Cloudways

### Step 1: Create Application on Cloudways
1. Log into your Cloudways account
2. Click "Add Application"
3. Choose "Custom PHP" as application type
4. Select your preferred server location
5. Choose PHP version 8.0 or higher
6. Click "Add Application"

### Step 2: Configure Application Settings
1. Go to your application dashboard
2. Navigate to "Application Settings"
3. Set the following:
   - **Application Name**: Byline
   - **Application URL**: Your domain
   - **PHP Version**: 8.0 or higher
   - **MySQL Version**: 8.0

### Step 3: Deploy from GitHub
1. In your application, go to "Deployment via Git"
2. Connect your GitHub account
3. Select the "Byline" repository
4. Set branch to `main`
5. Click "Deploy"

### Step 4: Database Configuration
1. Go to "Database Manager" in your Cloudways app
2. Note down the database credentials:
   - Database Name
   - Username
   - Password
   - Host
   - Port

2. Update your `wp-config.php` with these credentials:
```php
define('DB_NAME', 'your_cloudways_db_name');
define('DB_USER', 'your_cloudways_db_user');
define('DB_PASSWORD', 'your_cloudways_db_password');
define('DB_HOST', 'your_cloudways_db_host');
```

### Step 5: Domain Configuration
1. Go to "Domain Management"
2. Add your custom domain
3. Point your domain's DNS to Cloudways nameservers
4. Wait for DNS propagation (up to 24 hours)

### Step 6: SSL Certificate
1. Go to "SSL Certificate"
2. Choose "Let's Encrypt" (free)
3. Enter your domain
4. Click "Install Certificate"

## 🔧 Environment Variables (Optional)

For better security, you can use Cloudways environment variables:

```php
// In wp-config.php
define('DB_NAME', $_SERVER['DB_NAME']);
define('DB_USER', $_SERVER['DB_USER']);
define('DB_PASSWORD', $_SERVER['DB_PASSWORD']);
define('DB_HOST', $_SERVER['DB_HOST']);
```

## 📁 File Structure on Cloudways

After deployment, your files will be in:
```
/application/public_html/
├── wp-admin/
├── wp-content/
├── wp-includes/
├── wp-config.php
├── index.php
└── ... (other WordPress files)
```

## 🔒 Security Settings

### File Permissions
- Files: 644
- Directories: 755
- wp-config.php: 600
- wp-content/uploads: 755

### Recommended Security Plugins
1. Wordfence Security
2. Sucuri Security
3. iThemes Security

## 🚀 Performance Optimization

### Cloudways Settings
1. **Varnish**: Enable for better caching
2. **Redis**: Enable for session storage
3. **CDN**: Enable CloudwaysCDN

### WordPress Optimization
1. Install a caching plugin (WP Rocket, W3 Total Cache)
2. Optimize images
3. Use a CDN
4. Enable GZIP compression

## 📊 Monitoring

### Cloudways Monitoring
- Application monitoring
- Server monitoring
- Database monitoring
- Error logs

### WordPress Monitoring
- Uptime monitoring
- Performance monitoring
- Security monitoring

## 🔄 Deployment Workflow

### Development
1. Make changes locally
2. Test thoroughly
3. Commit to git
4. Push to GitHub

### Production
1. Cloudways automatically pulls from GitHub
2. Runs deployment script
3. Updates live site

### Rollback
1. Go to "Deployment via Git"
2. Select previous commit
3. Click "Deploy"

## 📞 Support

### Cloudways Support
- 24/7 Live Chat
- Ticket System
- Knowledge Base

### WordPress Support
- WordPress.org Forums
- WordPress Codex
- Developer Documentation

## 🔧 Troubleshooting

### Common Issues
1. **Database Connection Error**
   - Check wp-config.php credentials
   - Verify database exists

2. **Permission Errors**
   - Run deployment script
   - Check file permissions

3. **SSL Issues**
   - Verify domain configuration
   - Check SSL certificate installation

4. **Performance Issues**
   - Enable caching
   - Optimize images
   - Use CDN

### Logs Location
- Application logs: `/storage/logs/`
- Error logs: `/storage/logs/error.log`
- Access logs: `/storage/logs/access.log`
