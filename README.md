# কুয়েট সাংবাদিক সমিতি (KUET Journalism Association) - Dynamic CMS Portfolio

This is a fully functional **Content Management System (CMS)** portfolio website for **কুয়েট সাংবাদিক সমিতি (KUETJA)**, the official student journalism club of Khulna University of Engineering & Technology (KUET).

## 🚀 Project Overview
The website serves as a dynamic, data-driven digital platform for the club, showcasing its mission, executive committee members, recent news, and campus activities. It features a secure admin panel for authorized users to manage all content.

### ✨ Key Features:

#### Frontend:
- Clean & Professional UI with minimalist design
- Fully Responsive layout for all devices
- Dark Mode Toggle with localStorage support
- Image Lightbox for media content
- ScrollSpy Navigation with auto-highlighting
- Dynamic Content Filtering by categories
- Smooth CSS3 animations throughout

#### Backend & CMS:
- Secure Admin Panel with session-based authentication
- Dynamic Content Rendering from MySQL database
- Full CRUD Operations for news and members
- Environment Variable Security with .env file
- PDO Prepared Statements to prevent SQL injection
- Image Upload functionality for news

## 🛠️ Tech Stack
- Frontend: HTML5, CSS3, Vanilla JavaScript
- Backend: PHP 8.2+ (Native, no frameworks)
- Database: MySQL 5.7+
- Security: Password hashing, Sessions, PDO prepared statements
- Typography: Google Fonts (Merriweather & Noto Serif Bengali)

## 📂 Project Structure
- index.php - Homepage with dynamic news display
- all-news.php - All news page with pagination
- club-info.php - Club information & committee members
- admin/ - Admin panel with login, CRUD operations
- db.php - Database connection & config parser
- .env - Environment variables (database credentials)
- database.sql - Database schema & initial data
- style.css - Frontend styling & dark mode
- script.js - Frontend interactions
- assets/ - Images and media files

## 🗄️ Database Schema
1. users - Admin authentication (id, username, password)
2. news - News articles (id, title, category, details, image, created_at)
3. members - Committee members (id, name, position, dept_batch, media, image, committee_type)

## 🚀 Getting Started

### Prerequisites
- XAMPP or any local PHP/MySQL server
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Git for version control

### Installation Steps

1. Clone the repository and navigate to the project folder

2. Setup Database:
   - Open phpMyAdmin at http://localhost/phpmyadmin
   - Create database named kuetja_db
   - Import database.sql into the database

3. Configure Environment:
   - Ensure .env file exists with proper credentials

4. Run the Website:
   - Place project folder in htdocs (XAMPP)
   - Access via http://localhost/folder-name/

5. Admin Login:
   - Navigate to http://localhost/folder-name/admin/login.php
   - Default: Username: admin, Password: admin123

## 👨‍💼 Admin Panel Usage

Administrators can:
- Add News articles with title, category, details, and images
- View all published articles in table format
- Delete outdated news articles
- Add Members to executive or advisory committee
- View all registered members with details
- Delete members from the system
- Securely logout

## 🔐 Security Features
- Password hashing using PHP password_hash()
- Session management on protected routes
- PDO prepared statements against SQL injection
- XSS Protection with htmlspecialchars()
- Environment variables for sensitive credentials

## 📝 Git Commits History
- feat: init database schema and config
- feat: dynamic frontend rendering
- feat: admin panel and auth endpoints

## 🎨 Customization
- Update admin credentials in phpMyAdmin users table
- Add new categories through admin panel
- Customize styling in style.css and admin/style.css

## 👨‍💻 Developer Information
Name: Shahidur Rahman Shawon
Department: Computer Science and Engineering (CSE)
Institution: Khulna University of Engineering & Technology (KUET)
GitHub: https://github.com/Shahidur8381

Last Updated: 29 April 2026
