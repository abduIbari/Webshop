
function addToCart(pid, name, price) {
    fetch('/myWebShop/addToCart.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ pid, name, price })
    })
    .then(response => response.json())
    .then(data => {
        alert('Product added to cart!');
        // Update cart count if available
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = data.totalItems;
        }
    })
    .catch(error => console.error('Error adding to cart:', error));
}

