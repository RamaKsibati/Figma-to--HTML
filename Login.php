<?php
// Start the session to use session variables
session_start();

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password strength
function validatePassword($password) {
    // Check if password is at least 8 characters long and contains letters and numbers
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email, password, and verification code from the form submission
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verificationCode = $_POST['verification_code'];

    // Simple form validation
    $errors = [];

    // Validate email
    if (!validateEmail($email)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (!validatePassword($password)) {
        $errors[] = "Password must be at least 8 characters long and include both letters and numbers.";
    }

    // Validate verification code
    if (empty($verificationCode)) {
        $errors[] = "Verification code cannot be empty.";
    }

    // Check if there are any errors
    if (empty($errors)) {
        // Here you can add your logic to check the credentials
        // For demonstration, we will just echo the input values
        echo "Email: " . htmlspecialchars($email) . "<br>";
        echo "Password: " . htmlspecialchars($password) . "<br>";
        echo "Verification Code: " . htmlspecialchars($verificationCode) . "<br>";

        // Redirect to a success page or handle login logic here
        // header("Location: success.php");
        // exit();
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: new.html"); // Change to your login page URL
    exit();
}
?>