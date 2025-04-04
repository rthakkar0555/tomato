<?php
// Start session
session_start();

// Database connection details
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = ""; // Default for XAMPP
$dbname = "project"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Create an array to store products
$products = [];

if ($result->num_rows > 0) {
    // Store each product in the array
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} 

// Close the connection
$conn->close();

// Convert the PHP array to JSON format for JavaScript
$products_json = json_encode($products);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato/</title>
    <link rel="icon" href="icons/fruits-and-vegetables-tomato-pack.png" type="image/icon">
    <link rel="stylesheet" href="si.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="navB">
            <div class="bar1">
                <a href="index.php"><img src="icons/logo.png" alt="logo"></a>
            </div>
            <div class="bar2">
                <ul class="menu">
                    <li class="menuItem"><a href="index.php">home</a></li>
                    <li class="menuItem"><a href="#explore-menu">menu</a></li>
                    <li class="menuItem"><a href="#app-down">mobile app</a></li>
                    <li class="menuItem"><a href="#foot">contact us</a></li>
                </ul>
            </div>
            <div class="bar3">
                <button id="src" onclick="search()"><img src="icons/search_icon.png" alt="search"></button>
                <a href="cart.html"><img src="icons/basket_icon.png" alt="basket"></a>
                <div class="navB-pf">
                    <img src="icons/profile_icon.png" alt="pf">
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="main">
            <div class="maincont">
                <h2>Order your<br>favorite food here</h2>
                <p>Choose from a diverse menu featuring a delectable array of dishes crafted with the finest ingredients and elevate your dining experience, one delicious meal at a time.</p>
                <a href="index.php#explore-menu"><button>View Menu</button></a>
            </div>
        </div>
        <div class="explore-menu" id="explore-menu">
                <h1>Explore our menu</h1>
                <p class="explore-menu-text">Choose from a diverse menu featuring a delectable array of dishes.Our mission is to satisfy your cravings and elevate your dining experience, one delicious meal at a time.</p>
            <div class="explore-menu-list">
                <div class="explore-menu-list-item" style="margin-left: 15px;">
                    <a href="menu1.html#explore-menu"><img src="icons/menu_1.png" alt="" class="menuimg">
                        <p class="m">Salad</p>
                    </a>
                </div>
                <div class="explore-menu-list-item">
                    <a href="menu2.html#explore-menu"><img src="icons/menu_2.png" alt="" class="menuimg">
                        <p class="m">Rolls</p>
                    </a>
                </div>
                <div class="explore-menu-list-item">
                    <a href="menu3.html#explore-menu"><img src="icons/menu_3.png" alt="" class="menuimg">
                        <p class="m">Deserts</p>
                    </a>
                </div>
                <div class="explore-menu-list-item">
                    <a href="menu4.html#explore-menu"><img src="icons/menu_4.png" alt="" class="menuimg">
                        <p class="m">Sandwich</p>
                    </a>
                </div>
                <div class="explore-menu-list-item">
                    <a href="menu5.html#explore-menu"><img src="icons/menu_5.png" alt="" class="menuimg">
                        <p class="m">Cake</p>
                    </a>
                </div>
                <div class="explore-menu-list-item">
                    <a href="menu6.html#explore-menu"><img src="icons/menu_6.png" alt="" class="menuimg">
                        <p class="m">Pure Veg</p>
                    </a>
                </div>
                <div class="explore-menu-list-item">
                    <a href="menu7.html#explore-menu"><img src="icons/menu_7.png" alt="" class="menuimg">
                        <p class="m">Pasta</p>
                    </a>
                </div>
                <div class="explore-menu-list-item" style="margin-right: 15px;">
                    <a href="menu8.html#explore-menu"><img src="icons/menu_8.png" alt="" class="menuimg">
                        <p class="m">Noodles</p>
                    </a>
                </div>
            </div>
            <hr>
            </div>
            <div class="food-dis" id="food-dis">
                <h2>Top dishes near you</h2>
                <div class="food-dis-list" id="list">
                <script>
      
                    let products=  <?php echo $products_json; ?>;
                            
                    sessionStorage.setItem('products', JSON.stringify(products));
                    console.log(products);
                    // Retrieve the data from session storage and display it on the page
                    let storedProducts = JSON.parse(sessionStorage.getItem('products'));

                    // Display the products on the page
                    let productList = document.getElementById("list");
                    storedProducts.forEach(function(product) {
                        product.product_image=product.product_image.slice(21);
                        var productDiv = document.createElement("div");

                        productDiv.innerHTML = "<div id='"+ product.product_name + "' class='food-item' onclick=\"addToCart('"+ product.product_image +"', '" + product.product_name + "', " + product.product_price + ")\">" + "<div class='food-item-container'>" + "<img src='"+ product.product_image + "' alt='' class='food-item-img'>" +"</div>" +"<div class='food-item-info'>" +
                        "<div class='food-item-name-rating'>" +"<p>" + product.product_name + "</p>" +
                        "<img src='rating_starts.png' alt='rateMe'>" + "</div>" +
                        "<p class='food-item-desc'>" + product.product_desc + "</p>" +
                        "<p class='food-item-price'>&#8377;" + product.product_price + "</p>" +
                        "</div>" +"</div>";  
                        // div block of food item
                    console.log(productDiv);
                    productList.appendChild(productDiv);
                    });    
                 </script>
                </div>
            </div>
        </div>
        </div>
    </main>
    <div class="app-down" id="app-down">
        <p>For Better Experience Download <br>Tomato App</p>
        <div class="platform">
            <img src="icons/play_store.png" alt="ps">
            <img src="icons/app_store.png" alt="as">
        </div>
    </div>
    <footer>
        <div class="foot" id="foot">
            <div class="foot-cont">
<div class="foot-cont-L">
                    <img src="icons/logo.png" alt="logo">
                    <hr>
                    <p>
                        Bringing delicious meals right to your doorstep, <br>
                        because every craving deserves a quick and tasty solution! <br>
                        Crafted with <span style="color:tomato;">&#10084;</span> By <span class="arm">#.A.R.M</span> <br>
                        .Apurv <br>.Rishi <br> .Malay<br>
                    </p>
                <div class="foot-soc">
                    <img src="icons/facebook_icon.png" alt="fb">
                    <img src="icons/twitter_icon.png" alt="twr">
                    <img src="icons/linkedin_icon.png" alt="li">
                </div>
            </div>
                <div class="foot-cont-C">
                    <h2>COMPANY</h2>
                                        <hr>
                    <ul>
                        <a href="https://globalgreengroup.com/tomatoes/"><li>Home</li></a>
                        <li>About us</li>
                        <li>Delivery</li>
                        <a href="https://www.termsfeed.com/live/6bbaaabf-1a66-42bd-9389-30f3fe723e9d"><li>Privacy policy</li></a>
                    </ul>
                </div>
                <div class="foot-cont-R">
                    <h2>GET IN TOUCH</h2>
                    <hr>
                    <ul>
                        <li>+91-143143143</li>
                        <li>iloveyou@heart.com</li>
                    </ul>
                </div>
            </div>
            <hr>
                <p class="foot-cp">Copyright 2024 &copy; Tomato.com - All Right Reserved.</p>
        </div>
    </footer>
    <script src="index.js"></script>
</body>
</html>