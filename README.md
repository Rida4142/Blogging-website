# Blogging Website (BlogsNet)

## Overview

This is a PHP blogging website with user authentication, blog posting, comments, categories, FAQ, and an admin panel.

## Project Structure

- `admin_panel.php` - Admin dashboard access page.
- `adminlogin.php` - Admin login page.
- `adminlogout.php` - Admin logout handler.
- `auth.php` - Authentication helper and session handling.
- `authenticated.php` - Restricts access to authenticated users.
- `authlogin.php` - Login processing logic.
- `blog.php` - Blog listing and display page.
- `comment.php` - Comment submission page.
- `conn.php` - Database connection script.
- `dashboard.php` - User dashboard page.
- `delete_category.php` - Category delete handler.
- `delete_comment.php` - Comment delete handler.
- `delete_faq.php` - FAQ delete handler.
- `delete_post.php` - Blog post delete handler.
- `delete_users.php` - User delete handler.
- `display_activitylog.php` - Activity log view.
- `edit_category.php` - Category edit page.
- `edit_post.php` - Blog post edit page.
- `explore.php` - Browse/explore blog posts.
- `functions.php` - Shared functions used across pages.
- `gender.php` - Gender selection helper.
- `goback.php` - Navigation helper.
- `index.php` - Landing page.
- `like.php` - Like/unlike blog post handler.
- `login.php` - User login page.
- `logout.php` - User logout handler.
- `manage_blogs.php` - Admin blog management page.
- `manage_categories.php` - Admin category management page.
- `manage_comments.php` - Admin comment management page.
- `manage_faq.php` - Admin FAQ management page.
- `manage_users.php` - Admin user management page.
- `post.php` - Single blog post page.
- `postfaq.php` - FAQ submission page.
- `profile_card.php` - Profile card component.
- `reply.php` - Reply to comment handler.
- `resend_email.php` - Resend verification email.
- `resend_vemail.php` - Resend verification UI.
- `signin.php` - User registration page.
- `submit_blog.php` - Blog post submission handler.
- `submit_faq.php` - FAQ submission handler.
- `support.php` - Support/contact page.
- `table.php` - Table helper layout.
- `toolbar.php` - Toolbar component.
- `verify_email.php` - Email verification handler.

### Folders

- `assets/` - Static images, background assets, and media.
- `blog/` - Blog-specific template fragments:
  - `blog_title.php`
  - `comment_card.php`
  - `comments_disp.php`
- `includes/` - Shared layout and navigation includes:
  - `blogheader.php`
  - `exploreheader.php`
  - `footer.php`
  - `header.php`
  - `navbar.php`
  - `navbar2.php`
  - `postheader.php`
- `js/` - Client-side scripts:
  - `editor.js`
  - `editorfaq.js`
  - `passwordCheck.js`
- `styles/` - CSS stylesheets:
  - `blog.css`
  - `comment.css`
  - `explore.css`
  - `post.css`
  - `style.css`
- `vendor/` - Composer dependencies and autoload files.

### Configuration

- `composer.json` - PHP dependency configuration.
- `composer.lock` - Locked Composer package versions.
- `package.json` - Node package metadata (if used for tooling).
- `package-lock.json` - Locked npm package versions.

### Database

- `blol(2).sql` - SQL dump for creating the blog database schema and sample data.

## Notes 

- The web app is a PHP/MYSQL system with frontend templates spread across `includes/` and `blog/`.
- `conn.php` centralizes database connection logic.
- `auth.php` and `authenticated.php` handle session and access controls.
- Admin management pages are separate from public pages and use dedicated handlers for CRUD actions.
- Static styling and scripts are organized under `styles/` and `js/`.

## How to Run

1. Configure a local PHP server or use XAMPP/WAMP.
2. Import `blol(2).sql` into MySQL.
3. Update database credentials in `conn.php`.
4. Open `index.php` in your browser.
