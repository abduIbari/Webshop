
function searchUsers(userString) {
  fetch('/myWebShop/submission/apis/searchbar_apis/searchUsers.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ userString }) 
  })
    .then(response => response.json())
    .then(data => {
      const container = document.getElementById('users-table-body');

      container.innerHTML = '';

      if (data.matching_users && data.matching_users.length > 0) {

        data.matching_users.forEach(user => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${user.userID}</td>
            <td>${user.username}</td>
            <td>${user.active == 1 ? "Logged in" : "Logged out"}</td>
            <td id="td-blocked-status-${user.userID}">${user.blocked == 1 ? "Blocked" : "Unblocked"}</td>
            <td>
              <select name="blockedStatus" id="blockedStatus-${user.userID}" class="auth-button" data-userID="${user.userID}">
                <option value="Blocked" ${user.blocked == 1 ? 'selected' : ''}>Blocked</option>
                <option value="Unblocked" ${user.blocked == 0 ? 'selected' : ''}>Unblocked</option>
              </select>
            </td>
          `;
          container.appendChild(row);
        });
      } else {
        container.textContent = 'No matching users found.';
      }
    })
    .catch(error => console.error('Error searching products:', error));
}

document.getElementById("userSearchInput").addEventListener("input", e => {
  console.log("Input event fired!"); // This will confirm if the event is triggered

  const userString = e.target.value.trim();
  console.log("Searching for:", userString); 
  searchUsers(userString);
})
