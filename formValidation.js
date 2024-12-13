let usernameField = document.getElementById("username");
let passwordField = document.getElementById("password");
let confirmPasswordField = document.getElementById("confirmPassword");
let changeUsernameField = document.getElementById("changeUsername")
let changePasswordField = document.getElementById("changePassword")

function checkUsername() {
  let username = usernameField.value;
  if (username.length >= 5 && username !== username.toUpperCase() && username !== username.toLowerCase()) {
    usernameField.style.backgroundColor = "green";
  } else if (username == "") {
    usernameField.style.backgroundColor = "";
  }
   else {
    usernameField.style.backgroundColor = "red";
  }
}

function checkPassword() {
  let password = passwordField.value;
  if (password.length >= 10) {
    passwordField.style.backgroundColor = "green";
  } else if (password == "") {
    passwordField.style.backgroundColor = "";
  }else {
    passwordField.style.backgroundColor = "red";
  }
}

function validateConfirmPassword() {
  if (!confirmPasswordField) return;
  let password = passwordField.value;
  let confirmPassword = confirmPasswordField.value;
  if (password === confirmPassword && password !== "") {
    confirmPasswordField.style.backgroundColor = "green";
  } else if (confirmPassword == "") {
    confirmPasswordField.style.backgroundColor = "";
  } else {
    confirmPasswordField.style.backgroundColor = "red";
  }
}

function checkChangePassword(){
  if (!changePasswordField) return;
  let newPassword = changePasswordField.value;
  let password = passwordField.value;
  if (newPassword === password){
    changePasswordField.style.backgroundColor = "red";
    console.log("New password cant be the same as the old password")
  }
  else if (newPassword === ""){
    changePasswordField.style.backgroundColor = "";
  }
}

function checkChangeUsername(){
  console.log("sup")
  if (!changeUsernameField) return;
  let newUsername = changeUsernameField.value;
  let username = usernameField.value;
  if (newUsername === username){
    changeUsernameField.style.backgroundColor = "red";
    console.log("New username cant be the same as the old username")
  }
  else if (newUsername === ""){
    changeUsernameField.style.backgroundColor = "";
  }
}


usernameField.addEventListener("input", checkUsername);
passwordField.addEventListener("input", checkPassword);
if (confirmPasswordField) {
  confirmPasswordField.addEventListener("input", validateConfirmPassword);
}
if (changeUsernameField) {
  changeUsernameField.addEventListener("input", checkChangeUsername);  
}
if (changePasswordField) {
  changePasswordField.addEventListener("input", checkChangePassword);  
}

