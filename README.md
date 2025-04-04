# 🍅 Tomato - Food Delivery Website

Tomato is a comprehensive food delivery website tailored for a **local restaurant**, built using a robust stack of **HTML, CSS, JavaScript, PHP, XAMPP, and MySQL**. It provides a seamless experience for users to browse menus, place orders, and track them, while empowering administrators with efficient management tools for users, menu items, and orders.

---

## 🚀 Key Features

### 🛒 **User Functionalities**

* **Secure User Authentication:**
    * Registration and login system to ensure user privacy and order security.
* **Dynamic Menu Browsing:**
    * Intuitive interface to explore diverse dishes and categories.
* **Advanced Search and Filtering:**
    * Efficient tools to find meals by name, category, or price, enhancing user experience.
* **Streamlined Cart and Checkout:**
    * Simple and efficient order placement process.
* **Real-time Order Tracking:**
    * Up-to-date order status updates for customer convenience.

### 🔧 **Admin Capabilities**

* **Comprehensive User Management (CRUD):**
    * Ability to create, read, update, and delete user accounts.
* **Efficient Menu Management:**
    * Tools to add, edit, or remove dishes, ensuring menu accuracy.
* **Effective Order Management:**
    * Functionality to update order statuses, facilitating smooth operations.

---

## 🏗️ Technical Architecture

* **Frontend:**
    * HTML: Structuring the web pages.
    * CSS: Styling the user interface for optimal presentation.
    * JavaScript: Adding interactivity and dynamic features.
* **Backend:**
    * PHP: Server-side scripting for dynamic content and data processing.
* **Database:**
    * MySQL: Relational database management system for data storage.
* **Server Environment:**
    * Apache (via XAMPP): Local server environment for development and testing.

---
---

## 🛠️ Installation and Setup Guide

### 1️⃣ Install XAMPP

* Download and install **[XAMPP](https://www.apachefriends.org/download.html)** for your operating system.

### 2️⃣ Clone the Project Repository

* Use Git to clone the repository to your local machine:
    ```bash
    git clone [https://github.com/rthakkar0555/tomato.git](https://github.com/rthakkar0555/tomato.git)
    ```

### 3️⃣ Move Project Files to XAMPP Directory

* Transfer the `tomato` folder into the `htdocs` directory of your XAMPP installation:
    * Example: `C:\xampp\htdocs\tomato\`

### 4️⃣ Start Apache and MySQL Services

* Open the XAMPP Control Panel.
* Start the Apache and MySQL services by clicking the "Start" buttons.

### 5️⃣ Import the Database

* Open your web browser and navigate to phpMyAdmin: `http://localhost/phpmyadmin/`.
* Create a new database named `tomato`.
* Select the `tomato` database.
* Go to the "Import" tab.
* Choose the `tomato.sql` file from your project folder.
* Click "Go" to import the database schema and data.

### 6️⃣ Configure Database Connection

* Open the `db_config.php` file located in the project folder.
* Update the MySQL connection credentials if necessary:
    ```php
    $host = "localhost";
    $user = "root"; // Default username
    $password = ""; // Default password (empty by default)
    $database = "tomato";
    ```

### 7️⃣ Run the Application

* Open your web browser.
* Navigate to `http://localhost/tomato/`.
* Start ordering food online!
