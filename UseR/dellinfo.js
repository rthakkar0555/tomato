let current = JSON.parse(sessionStorage.getItem("foodItem"));
let odr ='', total = 0;
let totalItems = 0;
current.forEach(ele => {
    odr += `${ele.name}X${ele.quantity}, `;
    total += ele.price * ele.quantity;
    totalItems += ele.quantity;
});
function proceedToOrder() {
    // Get the values from the input fields
    const firstName = document.getElementById("first-name").value;
    const lastName = document.getElementById("last-name").value;
    const email = document.getElementById("email").value;
    const street = document.getElementById("street").value;
    const city = document.getElementById("city").value;
    const state = document.getElementById("state").value;
    const zipCode = document.getElementById("zip-code").value;
    const country = document.getElementById("country").value;
    const phone = document.getElementById("phone").value;

    // Create an address object
   
    // Retrieve the current order from sessionStorage
   
  
    let currentOrder = {
        firstName,
        lastName,
        email,
        street,
        city,
        state,
        zipCode,
        country,
        phone,
        orderDetails: odr,
        totalPrice: total,
        totalItems: totalItems
    };

    // Send data to the PHP server using fetch
    fetch("http://localhost/UseR/save_order.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(currentOrder)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);

        // Clear the order from sessionStorage since it has been stored
        sessionStorage.removeItem("foodItem");

       
        window.location.href = "index.php"; 
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Failed to save order.");
    });
}
let t=document.getElementById("stotal");

t.innerText=total;
console.log(total);
console.log(t);
t=document.getElementById("total");
t.innerText=total+40;
// Add event listener to the Proceed to Payment button
document.querySelector(".pts").addEventListener("click", proceedToOrder);
