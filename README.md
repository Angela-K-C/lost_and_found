# 🧭 Lost and Found Campus Portal

A campus-oriented lost and found web application that helps students and staff report and find lost belongings, reducing physical office traffic and increasing item recovery rates.

---

## 🧨 Problem

Every day, students on campus lose belongings like books, bottles, school IDs, and more. Though a Lost and Found office exists, many students don’t know its location. This leads to:

- Unclaimed items piling up  
- Increased staff workload  
- Frustration and potential loss for students

---

## 💡 Solution

This website provides a centralized, always-available platform where users can:

- Report lost or found items  
- Browse or search reports  
- Receive notifications about matching items  
- Get directions to the Lost and Found office

---

## 👥 Users of the System

### 1. General Users (Students & Staff)
- Register and log in using school credentials  
- Report and search for lost/found items  
- View office directions  
- Receive updates on item matches

### 2. Admin
- Moderate submissions  
- Manage duplicate or inappropriate reports  
- Close resolved cases  
- Notify users about important updates  

---

## 🧾 User Stories

As a **student or staff member**, I want to:
- Create an account with my school credentials  
- Report and search for items  
- Get notified when items matching my description are found  
- Log out securely  

As an **admin**, I want to:
- Log in using institutional credentials  
- Upload, moderate, and verify items  
- Notify users and resolve cases  
- Securely log out  

---

## 🗂️ File Structure

```
project_root/
│
├── index.php                     # Landing page of the website
│
├── assets/                      # Static assets
│   ├── css/
│   │   ├── style.css            # Main stylesheet
│   │   └── navstyles.css        # Styles for navigation bar
│   ├── icons/                   # Icon assets
│   └── images/                  # Image assets
│
├── js/                          # JavaScript files (future enhancements)
│
├── includes/
│   └── navbar.php               # Reusable navigation bar component
│
├── pages/
│   └── login.php                # User login page
│
├── sql/
│   └── schema.sql               # SQL file to create and initialize database
```

---

## 🛠️ How to Run the Project Locally

### 📦 Requirements

- PHP (v7.4 or later)
- MySQL/MariaDB
- Apache or any local PHP server (e.g. XAMPP, WAMP, Laragon)

---

### 🧑‍💻 Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/your-username/lost-and-found.git
cd lost-and-found
```

2. **Set up the database**

- Open your database client (e.g. phpMyAdmin or MySQL CLI)
- Run the `schema.sql` file located in the `sql/` folder to create the required tables

3. **Start a local PHP server (if not using XAMPP/WAMP)**

```bash
php -S localhost:8000
```

Then visit `http://localhost:8000/index.php` in your browser.

4. **If using XAMPP/WAMP:**

- Place the project in your `htdocs` (XAMPP) or `www` (WAMP) directory
- Start Apache and MySQL services
- Visit `http://localhost/lost-and-found/index.php`

---

## 👥 Group Members

- **Kosgei Angela Chepngeno**
- **Alicia Maryanne**
- **Maina Robert Ndung'u** 
- **Ochieng Wendy Wendo**  
- **Munene Michelle Gakenyi**
