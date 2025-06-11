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

 1. Clone the repository

```bash
git clone https://github.com/mouadhoudaibi/PFE-.git
cd PFE- 
```
 2. Install dependencies
Make sure you have Composer installed, then run:
```bash
composer install
```
3. Create a .env file
Duplicate .env.example and rename it to .env, then configure your database settings:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
 4. Generate application key
```bash
php artisan key:generate
```
 5. Run database migrations
```bash
php artisan migrate
```
 6. (Optional) Seed the database with test data
```bash
php artisan db:seed
```
 7. Start the development server
```bash
php artisan serve
```
Visit the app at:

🔗 http://127.0.0.1:8000 — Home

🔐 http://127.0.0.1:8000/admin/login — Admin Login

👨‍🏫 http://127.0.0.1:8000/prof/login — Professor Login

🎓 http://127.0.0.1:8000/etudiant/login — Student Login

🖼️ Screenshots <br> <br>
🔐 Login Pages <br>
Admin Login
<img width="959" alt="image" src="https://github.com/user-attachments/assets/c76d3d43-35ad-4cc0-b737-584a4d2ab404" />
Professor Login
<img width="957" alt="image" src="https://github.com/user-attachments/assets/520d73a9-b6a1-48a4-8d8e-83b0b296d6a6" />
Student Login
<img width="960" alt="image" src="https://github.com/user-attachments/assets/4e2f0c94-d8db-46fd-b27d-5ba3ba7eb6bb" />

📊 Dashboards <br>
Admin Dashboard
<img width="949" alt="image" src="https://github.com/user-attachments/assets/edda1634-15d7-42f3-be9c-4c19f20cb3ee" />

Professor Dashboard
<img width="945" alt="image" src="https://github.com/user-attachments/assets/ad0811e1-6add-49e3-aae3-cdb9c6855546" />


Student Dashboard
<img width="944" alt="image" src="https://github.com/user-attachments/assets/702564b4-87dc-4f71-95dd-0c76e067b05c" />


Prof Grade to Student 
<img width="960" alt="image" src="https://github.com/user-attachments/assets/7fb3cc42-3c9c-4998-a52b-351f2bb69ce6" />

Student All Grades View 
<img width="942" alt="image" src="https://github.com/user-attachments/assets/633e12d2-3cb9-46b9-bfe5-233f770c4629" />

Student Total Grades
<img width="938" alt="image" src="https://github.com/user-attachments/assets/3e135c1c-2c0f-4f07-90fa-273fa01a48fb" />
<img width="944" alt="image" src="https://github.com/user-attachments/assets/c61f67b0-6a4e-49cd-9223-cdf4d5e41835" />









📂 Tech Stack
Laravel (PHP)

Blade (Laravel templating)

MySQL 






