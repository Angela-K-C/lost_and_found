**Loom Video Link**
https://www.loom.com/share/01acb40e5c5c4fce987dbf7a215cf356?sid=a4e8c7a5-c553-43da-8a6a-966f810143c9

# 🧭 Lost and Found Campus Portal

A campus-oriented lost and found web application that helps students and staff report and find lost belongings, reducing physical office traffic and increasing item recovery rates.

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
