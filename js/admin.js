function changeOrderStatus(orderID, newStatus) {
  fetch('/myWebShop/submission/apis/admin_apis/changeOrderStatus.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ orderID, newStatus })
  })
      .then(response => response.json())
      .then(data => {
          console.log("new status: " + data.newStatus)
          const currentStatus = document.getElementById("orderStatus")
          for (let option of currentStatus.options){
            if (option === data.newStatus){
              option.selected = true;
              break;
            }
          }
          document.getElementById(`td-order-status-${orderID}`).textContent = data.newStatus;
          })
          
      .catch(error => console.error('Error changing order status:', error));
}

const currentOrderStatus = document.querySelectorAll("#orderStatus")
currentOrderStatus.forEach(select => {
  select.addEventListener("change", () => {
    const newStatus = select.value;
    const orderID = select.getAttribute('data-orderID');
    changeOrderStatus(orderID, newStatus);
  });
});


function changeUserBlockedStatus(userID, newStatus) {
  fetch('/myWebShop/submission/apis/admin_apis/changeUserBlockedStatus.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ userID, newStatus })
  })
      .then(response => response.json())
      .then(data => {
          console.log("new status: " + data.newStatus)
          const currentStatus = document.getElementById("blockedStatus")
          for (let option of currentStatus.options){
            if (option === data.newStatus){
              option.selected = true;
              break;
            }
          }
          document.getElementById(`td-blocked-status-${userID}`).textContent = data.newStatus;

          })
          
      .catch(error => console.error('Error changing blocked status:', error));
}

const currentBlockedStatus = document.querySelectorAll("#blockedStatus")
currentBlockedStatus.forEach(select => {
  select.addEventListener("change", () => {
    const newStatus = select.value;
    const userID = select.getAttribute('data-userID');
    changeUserBlockedStatus(userID, newStatus);
  });
});
