
window.onload = function () {
    // Retrieve the cart from sessionStorage
    let cart = sessionStorage.getItem("foodItem");

    console.log(cart); // For debugging, you can remove this later

    if (cart) {
        // Parse the cart data back to an array
        cart = JSON.parse(cart);

        // Get the container where the cart items will be displayed
        const tableContainer = document.querySelector(".table");
        const subtotalContainer = document.querySelector(".alin");
        let subtotal = 0;

        // Clear existing rows (if any)
        document.querySelectorAll(".taple-cont").forEach(el => el.remove());

        // Loop through the cart items and create the HTML
        cart.forEach((item, index) => {
            // Set quantity to 1 if it's not provided
            let quantity = item.quantity || 1;

            const cartItemDiv = document.createElement("div");
            cartItemDiv.classList.add("taple-cont");

            // Calculate item total
            let itemTotal = item.price * quantity;
            subtotal += itemTotal; // Add the item total to the subtotal
            console.log(item.image);
            // Construct the HTML for each cart item
            cartItemDiv.innerHTML = `
                <p><img src="${item.image}" alt="${item.name}"></p>
                <p>${item.name}</p>
                <p>&nbsp;&nbsp;&nbsp; &#8377;${item.price}</p>
                <p class="boxincart">
                    <button onclick="updateQuantity(${index}, -1)">-</button>
                    <span>${quantity}</span>
                    <button onclick="updateQuantity(${index}, 1)">+</button>
                </p>
                <p>&nbsp;&nbsp;&#8377;${itemTotal}</p>
                <p>&emsp;&emsp;&emsp;<button onclick="removeItem(${index})">x</button></p>
            `;

            // Append the new item to the container
            tableContainer.appendChild(cartItemDiv);
        });

        // Update the subtotal, delivery fee, and total
        let deliveryFee = 40;
        let total = subtotal + deliveryFee;
        subtotalContainer.innerHTML = `&#8377;${subtotal}`; // Update subtotal display
        document.getElementById("in-tot-spe").querySelector(".alin").innerHTML = `&#8377;${total}`; // Update total display
       
    } else {
        // If the cart is empty
        document.querySelector(".table").innerHTML = "<p>Your cart is empty.</p>";

        // Optionally, disable checkout button if cart is empty
        document.querySelector(".pts").disabled = true;
    }
};

// Function to update item quantity in the cart
function updateQuantity(index, change) {
    let cart = JSON.parse(sessionStorage.getItem("foodItem")); // Get the cart

    if (cart) {
        // Ensure cart is an array
        if (!Array.isArray(cart)) {
            cart = [cart];
        }

        // Update the quantity of the item
        cart[index].quantity = (cart[index].quantity || 1) + change;

        // Ensure the quantity doesn't drop below 1
        if (cart[index].quantity < 1) {
            cart[index].quantity = 1;
        }

        // Save the updated cart back to sessionStorage
        sessionStorage.setItem("foodItem", JSON.stringify(cart));

        // Reload the page to reflect the updated cart
        window.location.reload();
    }
}

// Function to remove an item from the cart
function removeItem(index) {
    let cart = JSON.parse(sessionStorage.getItem("foodItem")); // Use "foodItem" as the key

    if (cart) {
        // Ensure cart is an array
        if (!Array.isArray(cart)) {
            cart = [cart];
        }

        cart.splice(index, 1); // Remove the item at the given index

        // If the cart becomes empty after removal, clear it from sessionStorage
        if (cart.length === 0) {
            sessionStorage.removeItem("foodItem");
        } else {
            sessionStorage.setItem("foodItem", JSON.stringify(cart)); // Update the cart in sessionStorage
        }

        window.location.reload(); // Reload the page to update the cart display
    }
}

// Function to handle the Proceed to Pay button click
function proceedToPay() {
    // Retrieve the current cart from sessionStorage
    let cart = JSON.parse(sessionStorage.getItem("foodItem"));

    if (cart) {
        // Store the current cart in sessionStorage
        console.log(cart);
      
        
        // Clear the cart from sessionStorage after proceeding to payment
       
   alert("  ");
        // Redirect to the payment page // Change this to your payment page URL
    } else {
        alert("Your cart is empty!"); // Alert if there's no cart data
    }
}


// Assuming you have a button with an ID of 'proceedToPayBtn' in your HTML
document.getElementById("proceedToPayBtn").addEventListener("click", proceedToPay);
