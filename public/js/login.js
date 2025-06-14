function togglePasswordVisibility() {
    const passwordField = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.src = "images/Hide.png"; // Hide Icon
        eyeIcon.alt = "Hide Password";
    } else {
        passwordField.type = "password";
        eyeIcon.src = "images/show.png"; // Show Icon
        eyeIcon.alt = "Show Password";
    }
}
