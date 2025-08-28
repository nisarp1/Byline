# Byline WordPress Project

A WordPress-based project for the Byline website.

## 🚀 Quick Start

### Prerequisites
- WordPress 6.0+
- PHP 7.4+
- MySQL 5.7+
- Web server (Apache/Nginx)

### Local Development Setup
1. Clone the repository
2. Configure your local web server to point to the project directory
3. Create a local database
4. Copy `wp-config-sample.php` to `wp-config.php` and update database settings
5. Run WordPress installation

## ☁️ Cloudways Deployment

### Initial Deployment
1. **Create Application on Cloudways**
   - Log into your Cloudways account
   - Create a new application
   - Choose "Custom PHP" as the application type
   - Select your preferred server and PHP version

2. **Deploy from GitHub**
   - In your Cloudways application, go to "Deployment via Git"
   - Connect your GitHub account
   - Select the "Byline" repository
   - Set the branch to `main` or `master`
   - Click "Deploy"

3. **Configure WordPress**
   - Update `wp-config.php` with Cloudways database credentials
   - Set up your domain in Cloudways
   - Complete WordPress installation

### Database Configuration
Update your `wp-config.php` with Cloudways database settings:
```php
define('DB_NAME', 'your_cloudways_db_name');
define('DB_USER', 'your_cloudways_db_user');
define('DB_PASSWORD', 'your_cloudways_db_password');
define('DB_HOST', 'your_cloudways_db_host');
```

### Environment Variables
For production, consider using environment variables for sensitive data:
```php
define('DB_NAME', $_SERVER['DB_NAME']);
define('DB_USER', $_SERVER['DB_USER']);
define('DB_PASSWORD', $_SERVER['DB_PASSWORD']);
define('DB_HOST', $_SERVER['DB_HOST']);
```

## 📁 Project Structure
```
byline-wp/
├── wp-admin/          # WordPress admin files
├── wp-content/        # Themes, plugins, uploads
│   ├── plugins/       # Custom plugins
│   ├── themes/        # Custom themes
│   └── uploads/       # Media uploads (gitignored)
├── wp-includes/       # WordPress core files
├── .gitignore         # Git ignore rules
├── README.md          # This file
└── wp-config.php      # WordPress configuration (gitignored)
```

## 🔧 Development Workflow

### Making Changes
1. Create a feature branch: `git checkout -b feature/your-feature`
2. Make your changes
3. Test locally
4. Commit changes: `git commit -m "Add feature description"`
5. Push to GitHub: `git push origin feature/your-feature`
6. Create a pull request

### Deployment
- Push to `main` branch to trigger automatic deployment
- Cloudways will automatically pull the latest changes

## 🛠️ Customization

### Themes
- Place custom themes in `wp-content/themes/`
- Follow WordPress theme development standards

### Plugins
- Place custom plugins in `wp-content/plugins/`
- Follow WordPress plugin development standards

## 🔒 Security Notes
- `wp-config.php` is excluded from version control for security
- Uploads directory is excluded to prevent large files in repository
- Consider using environment variables for sensitive configuration

## 📞 Support
For deployment issues, refer to:
- [Cloudways Documentation](https://www.cloudways.com/en/support/)
- [WordPress Codex](https://codex.wordpress.org/)

## 📝 License
This project follows WordPress licensing terms.
