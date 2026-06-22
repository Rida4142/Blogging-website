function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var message = document.getElementById("passwordMessage");
    var signinButton = document.getElementById("signin_btn");

    if (password === confirmPassword && password !== "") {
        message.innerHTML = "<span style='color: green;'>✔ Passwords match!</span>";
        signinButton.disabled = false; 
    } else {
        message.innerHTML = "<span style='color: red;'>❌ Passwords do not match!</span>";
        signinButton.disabled = true; 
    }
}
