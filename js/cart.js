
// loads the total items when the page is reloaded
function fetchTotalItems() {
    fetch('/myWebShop/submission/apis/shopping_cart_apis/getTotalItems.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(({ totalItems }) => {
            document.querySelector('#cart-count').textContent = totalItems;
        })
}

document.addEventListener("DOMContentLoaded", () => {
    fetchTotalItems();
    getDiscountedTotal()
}) 


// add the item with the given pid to the cart 
function addToCart(pid, name, price) {
    fetch('/myWebShop/submission/apis/shopping_cart_apis/addToCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ pid, name, price })
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.user_blocked)
            if(!data.user_blocked){

                alert('Product added to cart!');
                console.log('Response from server:', data);
                
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.totalItems;
                }
            }
            else{
                alert('Your account is blocked by the administrator!');
            }
        })
        .catch(error => console.error('Error adding to cart:', error));
}

document.querySelectorAll(".add-to-cart-button").forEach(button => {
    button.addEventListener("click", function (e) {
        const pid = this.getAttribute('data-pid');
        const name = this.getAttribute('data-name');
        const price = this.getAttribute('data-price');

        addToCart(pid, name, price);
    });
});


// removes the item with the selected pid from the cart (quantity=0)
function removeFromCart(pid) { 
    fetch('/myWebShop/submission/apis/shopping_cart_apis/removeProduct.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ pid })
    })
        .then(response => response.json())
        .then(data => {
            const parentItem = document.querySelector(".cart-items");
            const cartItem = document.querySelector(`[data-item="${pid}"]`);
            console.log(cartItem)
            if (cartItem) {
                parentItem.removeChild(cartItem)
            }
            if (data.total !== undefined && data.totalItems !== undefined && data.taxes !== undefined && data.totalWithTaxes !== undefined) {
                document.querySelector('#cart-count').textContent = data.totalItems;
                document.querySelector('#cart-total').textContent = `Total: $${parseFloat(data.total).toFixed(2)}`;
                document.querySelector("#cart-taxes").textContent = `Taxes: $${parseFloat(data.taxes).toFixed(2)}`;
                document.querySelector("#cart-total-with-taxes").textContent = `Total with taxes : $${parseFloat(data.totalWithTaxes).toFixed(2)}`;
            }

            if (data.totalItems === 0) {
                const cartSummary = document.querySelector(".cart-summary")
                cartSummary.innerHTML = "<p>Your cart is empty!</p>";
                cartSummary.classList.add("empty-cart")


            }
        })
        .catch(error => console.error('Error removing from cart:', error));
}

document.querySelectorAll('.remove-button').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const pid = this.getAttribute('data-pid');

        removeFromCart(pid);
    });
});



// updates the quantity of the item with the given pid with the new quantity
function updateCart(pid, newQuantity) {
    fetch('/myWebShop/submission/apis/shopping_cart_apis/updateCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ pid, newQuantity })
    })
        .then(response => response.json())
        .then(data => {
            if (data.total !== undefined && data.totalItems !== undefined) {
                // Update the total and total items in the UI
                document.querySelector('#cart-count').textContent = data.totalItems;
                document.querySelector('#cart-total').textContent = `Total: $${parseFloat(data.total).toFixed(2)}`;
                document.querySelector("#cart-taxes").textContent = `Taxes: $${parseFloat(data.taxes).toFixed(2)}`;
                document.querySelector("#cart-total-with-taxes").textContent = `Total with taxes: $${parseFloat(data.totalWithTaxes).toFixed(2)}`;

                const subtotal = (parseFloat(data.updated_cart[pid]["price"]) * parseInt(newQuantity))
                document.querySelector(`span[data-pid="${pid}"]`).innerHTML = "Subtotal: $" + parseFloat(subtotal).toFixed(2)
            }
        })
}

document.querySelectorAll('.update-button').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const pid = this.getAttribute('data-pid');
        const newQuantity = document.querySelector(`input[data-pid="${pid}"]`).value;
        console.log(pid);
        updateCart(pid, newQuantity);
    });
});


// fetches the login status and allows the user to click the buy now button accordingly
function fetchLoginStatus() {
    return fetch('/myWebShop/submission/apis/shopping_cart_apis/getLoginStatus.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data && typeof data.loginStatus !== 'undefined') {
                return data.loginStatus; 
            } else {
                throw new Error("Invalid response format");
            }
        })
        .catch(error => {
            console.error('Error fetching login status:', error);
            return false; 
        });
}

document.addEventListener("DOMContentLoaded", () => {
    const buyNowBtn = document.getElementById('buyNowBtn');
    const userOrdersBtn = document.getElementById("userOrders1")
    if (!buyNowBtn) {
        return;
    }
    fetchLoginStatus().then(userLoggedIn => {
        console.log("Login Status:", userLoggedIn);

        buyNowBtn.addEventListener('click', () => {
            if (userLoggedIn) {
                window.location.href = '../pages/checkout.php'; 
                console.log("hi")
            } else {
                alert('You need to log in to proceed with your purchase.');
                window.location.href = '../pages/auth/login.php'; 
            }
        });

        if (userOrdersBtn) {
            userOrdersBtn.addEventListener('click', () => {
                if (userLoggedIn) {
                    window.location.href = '../pages/userOrders.php'; 
                } else {
                    alert('You need to log in to proceed.');
                    window.location.href = '../pages/auth/login.php'; 
                }
            });
        } else {
            console.warn("userOrders button not found in the DOM.");
        }

    }).catch(error => {
        console.error('Error fetching login status:', error);
    });
});


function getDiscountedTotal() {
    fetch('/myWebShop/submission/apis/shopping_cart_apis/placeOrder.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ order_now: true })
    })
    .then(response => response.json())
    .then(data => {
        if (data.discount && data.discounted_total) {
            document.getElementById("orderSummary").insertAdjacentHTML("beforeend",  
                `<p><strong>Discount: $${data.discount}</strong></p>
                <p><strong>Discounted Total: $${data.discounted_total}</strong></p>`);
        } else {
            console.error("Error fetching discount: ", data.error);
        }
    })
    .catch(error => {
        console.error("Error fetching the discounted total:", error);
    });
}



