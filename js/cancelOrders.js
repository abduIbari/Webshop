function cancelOrder(userID, orderID) {
  fetch('/myWebShop/submission/apis/customer_apis/cancelOrders.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
        },
          body: JSON.stringify({ userID, orderID })
  })
      .then(response => response.json())
      .then(data => {
          console.log("order cancelled: " + data.order_cancelled)
          if (data.order_cancelled){
            document.querySelector(`#td-user-order-status-${orderID}`).textContent = "Cancelled"
          }
          })    
      .catch(error => console.error('Error changing blocked status:', error));
}

const cancelButton = document.querySelectorAll(`#td-user-order-cancel`);
cancelButton.forEach(button => {
    button.addEventListener("click", () => {  
    const userID = button.getAttribute('data-userID'); 
    const orderID = button.getAttribute('data-orderID'); 
    cancelOrder(userID, orderID)
    })
})
