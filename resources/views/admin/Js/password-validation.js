function validatePassword() {
    var password = document.getElementById("psw").value;
    var confirmPassword = document.getElementById("psw-repeat").value;

    if (password !== confirmPassword) {
        var warningMessage = document.getElementById("warning-message");
        warningMessage.innerHTML = "Password and Repeat Password do not match.";
        return false;
    }

    return true;
}
