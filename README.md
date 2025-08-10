# Custom Blue Orange WordPress Theme

A modern, responsive WordPress theme featuring a blue and orange color palette with a distinctive two-row header design.

## Features

### Design
- **Two-row header layout**:
  - Top row: Contact information and social media links
  - Main row: Logo/site title and compact navigation menu
- **Blue and orange color scheme**:
  - Primary Blue: #2c5aa0
  - Light Blue: #4a90e2
  - Primary Orange: #ff6b35
  - Light Orange: #ff8c42
- **Fully responsive design** that works on all devices
- **Modern, clean layout** with proper spacing and typography

### Functionality
- Custom post templates (single posts, pages, 404 error page)
- Widget-ready sidebar with default widgets
- Custom navigation menus
- Featured image support
- Comment system integration
- Search functionality
- Custom logo support
- SEO-friendly structure
- Accessibility features

### Customization
- Custom header and background support
- Widget areas (primary sidebar, footer)
- Menu locations (primary, footer)
- Custom image sizes
- Customizable contact information
- Social media links

## Installation

### Method 1: Manual Installation
1. Download or clone this theme to your local machine
2. Compress the theme folder into a ZIP file
3. In your WordPress admin dashboard, go to **Appearance > Themes**
4. Click **Add New** then **Upload Theme**
5. Choose the ZIP file and click **Install Now**
6. After installation, click **Activate**

### Method 2: FTP Installation
1. Download the theme files
2. Upload the entire theme folder to `/wp-content/themes/` directory
3. In WordPress admin, go to **Appearance > Themes**
4. Find "Custom Blue Orange Theme" and click **Activate**

## Setup and Customization

### 1. Configure Menus
1. Go to **Appearance > Menus**
2. Create a new menu for "Primary Menu"
3. Add your pages/links to the menu
4. Assign it to the "Primary Menu" location

### 2. Customize Header Information
Edit the contact information in `header.php`:
```php
// Update these lines with your information
<span class="phone">
    📞 <a href="tel:+1234567890">+1 (234) 567-890</a>
</span>
<span class="email">
    ✉️ <a href="mailto:info@yoursite.com">info@yoursite.com</a>
</span>
<span class="address">
    📍 123 Main Street, City, State 12345
</span>
```

### 3. Add Social Media Links
Update the social media links in `header.php`:
```php
<div class="social-links">
    <a href="https://facebook.com/yourpage" aria-label="Facebook">📘</a>
    <a href="https://twitter.com/yourhandle" aria-label="Twitter">🐦</a>
    <a href="https://instagram.com/yourhandle" aria-label="Instagram">📷</a>
    <a href="https://linkedin.com/company/yourcompany" aria-label="LinkedIn">💼</a>
</div>
```

### 4. Set Up Widgets
1. Go to **Appearance > Widgets**
2. Add widgets to "Primary Sidebar" area
3. Recommended widgets:
   - Search
   - Recent Posts
   - Categories
   - Tag Cloud
   - Custom HTML (for additional content)

### 5. Upload a Custom Logo
1. Go to **Appearance > Customize**
2. Click **Site Identity**
3. Upload your logo (recommended size: 200x60px)

### 6. Set Featured Images
- When creating posts/pages, set featured images
- Recommended sizes:
  - Large: 800x400px
  - Medium: 400x300px
  - Small: 200x150px

## File Structure

```
customWordpressThemes/
├── style.css          # Main stylesheet with theme information
├── index.php          # Main template file (homepage/blog)
├── header.php         # Header template with two-row design
├── footer.php         # Footer template
├── sidebar.php        # Sidebar template with widgets
├── single.php         # Single post template
├── page.php           # Page template
├── 404.php            # 404 error page template
├── functions.php      # Theme functions and features
└── README.md          # This file
```

## Customization Tips

### Color Scheme
To change colors, edit the CSS variables in `style.css`:
```css
:root {
    --primary-blue: #2c5aa0;    /* Change primary blue */
    --light-blue: #4a90e2;      /* Change light blue */
    --primary-orange: #ff6b35;  /* Change primary orange */
    --light-orange: #ff8c42;    /* Change light orange */
}
```

### Typography
To change fonts, update the Google Fonts import in `functions.php`:
```php
wp_enqueue_style('custom-blue-orange-fonts', 'https://fonts.googleapis.com/css2?family=YourFont:wght@300;400;500;600;700&display=swap', array(), null);
```

### Layout
- The theme uses CSS Grid for the main content area
- Sidebar can be hidden by deactivating widgets
- Header rows can be customized in `header.php`
- Footer content can be modified in `footer.php`

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## WordPress Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- MySQL 5.6 or higher

## Support

For support and customization requests:
- Email: info@yoursite.com
- Phone: +1 (234) 567-890

## License

This theme is released under the GPL v2 or later license.

## Changelog

### Version 1.0.0
- Initial release
- Two-row header design
- Blue and orange color scheme
- Responsive layout
- Widget support
- Custom post templates
- SEO optimization

---

**Note**: This theme includes placeholder contact information and social media links. Please update these with your actual information before using the theme on a live website.