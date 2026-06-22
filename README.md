# Blogging Web App

A full-featured blogging platform with user authentication, content management, social interaction, and admin controls — built with a relational MySQL database and a PHP backend.

---

## Features

**Users**
- Register and log in securely
- Create, edit, and delete blog posts
- Comment on and like other users' posts
- View personal post history and activity

**Admin**
- Full admin dashboard with logging
- Monitor user activity and content
- Manage posts and user accounts

**General**
- Clean, responsive UI
- Secure session management
- Relational database design with proper normalization

---

## Tech Stack

| Layer | Technology |
|---|---|
| Frontend | HTML, CSS, JavaScript |
| Backend | PHP |
| Database | MySQL |
| Version Control | Git, GitHub |

---

## Database Design

The database is designed around four core entities:

- **Users** — stores credentials and profile data
- **Posts** — stores blog content linked to authors
- **Comments** — linked to both posts and users
- **Activity Logs** — tracks admin-relevant user actions

Relationships are enforced through foreign keys with proper indexing for query performance.

---

## Getting Started

### Prerequisites

- PHP 7.4 or above
- MySQL 5.7 or above
- Apache or NGINX (XAMPP or WAMP works fine locally)

### Installation

1. Clone the repository

```bash
git clone https://github.com/Rida4142/blogging-web-app.git
```

2. Move the project into your server's root directory (e.g. `htdocs` for XAMPP)

3. Import the database

- Open phpMyAdmin
- Create a new database called `blogging_app`
- Import the `database.sql` file from the `/db` folder

4. Configure the database connection

Open `config/db.php` and update:

```php
$host = 'localhost';
$db   = 'blogging_app';
$user = 'root';
$pass = '';
```

5. Start Apache and MySQL

```
http://localhost/blogging-web-app
```

---







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
  ---

## Screenshots

<img width="1917" height="911" alt="image" src="https://github.com/user-attachments/assets/112dc4fc-cce0-4726-b32e-bcbb078ad2b3" />
<img width="1917" height="897" alt="image" src="https://github.com/user-attachments/assets/6d38c3cd-64c8-4cb9-a8fa-7913c96f1f7f" />
<img width="1890" height="907" alt="image" src="https://github.com/user-attachments/assets/65843a6d-b22e-44d9-848e-7a84ee7a35c0" />
<img width="1917" height="897" alt="image" src="https://github.com/user-attachments/assets/f66df645-740d-418a-8e80-e3dd1c568d56" />


---

## Built By

**Rida Waheed**
---
**Daud Shafi**
---
**Ahmed Raza**
---
Software Engineering Students at NUST Islamabad  



## Notes 

- The web app is a PHP/MYSQL system with frontend templates spread across `includes/` and `blog/`.
- `conn.php` centralizes database connection logic.
- `auth.php` and `authenticated.php` handle session and access controls.
- Admin management pages are separate from public pages and use dedicated handlers for CRUD actions.
- Static styling and scripts are organized under `styles/` and `js/`.

