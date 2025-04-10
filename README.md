# 🎓 Student Grade Management System

This is a Laravel-based web application for managing student grades in a school or university.  
It supports different user roles: **Admins**, **Professors**, and **Students**, each with their own dashboard and permissions.

Admins can assign professors to subjects and student groups. Professors can submit grades, and students can view their results.

---

## 🚀 Features

- Separate login for Admins, Professors, and Students  
- Admin dashboard to manage users, groups, subjects, and assignments  
- Professor dashboard to view assigned groups and submit grades  
- Student dashboard to view personal grades  
- Role-based access control  
- Clean and simple interface  

---

## ⚙️ Installation

Follow these steps to run the project locally:

### 1. Clone the repository

```bash
git clone https://github.com/your-username/your-project-name.git
cd your-project-name 
```
### 2. Install dependencies
Make sure you have Composer installed, then run:
```bash
composer install
```
### 3. Create a .env file
Duplicate .env.example and rename it to .env, then configure your database settings:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
### 4. Generate application key
```bash
php artisan key:generate
```
### 5. Run database migrations
```bash
php artisan migrate
```
### 6. (Optional) Seed the database with test data
```bash
php artisan db:seed
```
### 7. Start the development server
```bash
php artisan serve
```
Visit the app at:

🔗 http://127.0.0.1:8000 — Home

🔐 http://127.0.0.1:8000/admin/login — Admin Login

👨‍🏫 http://127.0.0.1:8000/prof/login — Professor Login

🎓 http://127.0.0.1:8000/etudiant/login — Student Login

🖼️ Screenshots <br>
🔐 Login Pages
<img width="959" alt="image" src="https://github.com/user-attachments/assets/c76d3d43-35ad-4cc0-b737-584a4d2ab404" />


