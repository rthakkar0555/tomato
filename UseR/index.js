function search(){
        let item = prompt("Enter food item:");
        if (item) {
            let filteredProducts = storedProducts.filter(p => p.product_name.toLowerCase().includes(item.toLowerCase()));
            let filteredHTML = '';
            filteredProducts.forEach(function(product) {
                filteredHTML += `<div id='${product.product_name}' class='food-item' onclick="addToCart('${product.product_image}', '${product.product_name}', ${product.product_price})">
                                   <div class='food-item-container'>
                                     <img src='${product.product_image}' alt='' class='food-item-img'>
                                   </div>
                                   <div class='food-item-info'>
                                     <div class='food-item-name-rating'>
                                       <p>${product.product_name}</p>
                                       <img src='rating_starts.png' alt='rateMe'>
                                     </div>
                                     <p class='food-item-desc'>${product.product_desc}</p>
                                     <p class='food-item-price'>&#8377;${product.product_price}</p>
                                   </div>
                                 </div>`;
            });
            productList.innerHTML = filteredHTML;
        }
    }
function addToCart(img, name, price) {
    // Create the new food item object
    const newItem = {
        name: name,
        price: price,
        image: img,
        quantity: 1 // Default quantity of 1
    };
    console.log(img);
    // Retrieve existing cart from sessionStorage
    let cart = sessionStorage.getItem("foodItem");

    if (cart) {
        // Parse the cart data if it exists
        cart = JSON.parse(cart);

        // Check if the cart is an array, if not make it an array
        if (!Array.isArray(cart)) {
            cart = [cart];
        }

        // Check if the item already exists in the cart
        let itemExists = false;
        cart.forEach(item => {
            if (item.name === newItem.name) {
                item.quantity += 1; // Increase the quantity of the existing item
                itemExists = true;
            }
        });

        // If the item doesn't exist, add it to the cart
        if (!itemExists) {
            cart.push(newItem);
        }
    } else {
        // If no cart exists, initialize a new array with the first item
        cart = [newItem];
    }

    // Store the updated cart back into sessionStorage
    sessionStorage.setItem("foodItem", JSON.stringify(cart));

    console.log(cart); // Logging for debugging
}

