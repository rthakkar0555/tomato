# 🍅 Tomato - Food Delivery Website

Tomato is a food delivery website designed for a **local restaurant**, built using **HTML, CSS, JavaScript, PHP, XAMPP, and MySQL**. It allows users to browse the menu, place orders, and track them, while admins can manage users, menu items, and orders.

---

## 🚀 Features

### 🛒 **User Features**
- **User Registration & Login** (Secure authentication)
- **Browse Menu** (View dishes & categories)
- **Search & Filters** (Find meals by name, category, or price)
- **Add to Cart & Checkout** (Simple order process)
- **Order Tracking** (Real-time order updates)


### 🔧 **Admin Features**
- **Manage Users** (CRUD operations)
- **Manage Menu** (Add, edit, or remove dishes)
- **Manage Orders** (Update order statuses)

---

## 🏗️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP  
- **Database:** MySQL  
- **Server:** Apache (via XAMPP)  

---

## 📁 Project Structure
/tomato │── /htdocs/tomato │ │── /assets (CSS, images, JS) │ │── /includes (Database connection, session handling) │ │── index.php (Home page) │ │── menu.php (Display menu items) │ │── cart.php (Shopping cart) │ │── checkout.php (Order processing) │ │── login.php (User login) │ │── register.php (User registration) │ │── admin/ (Admin panel) │ └── db_config.php (Database connection)


---

## 🛠️ Installation & Setup

### 1️⃣ Install XAMPP
Download and install **[XAMPP](https://www.apachefriends.org/download.html)**.

### 2️⃣ Clone the Repository
```sh
git clone https://github.com/rthakkar0555/tomato.git

###3️⃣ Move Files to XAMPP Directory
Move the tomato folder inside the htdocs directory of XAMPP:
C:\xampp\htdocs\tomato\

###4️⃣ Start Apache & MySQL in XAMPP
Open XAMPP Control Panel.
Click Start next to Apache.
Click Start next to MySQL.

###5️⃣ Import Database
Open your browser and go to phpMyAdmin (http://localhost/phpmyadmin/).
Click on Databases > Create New Database.
Name it tomato and click Create.
Go to the Import tab.
Click Choose File, select the tomato.sql file from the project folder.
Click Go to import the database.

###6️⃣ Configure Database Connection
Open the file db_config.php inside the project folder.

Update the MySQL credentials if needed:
$host = "localhost";
$user = "root"; // Default username
$password = ""; // Default is empty
$database = "tomato";

###7️⃣ Run the Project
Open your browser.
Visit http://localhost/tomato/.
Enjoy ordering your food online! 
