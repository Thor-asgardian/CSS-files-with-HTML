<?php
// Define variables and set to empty values
$customerId = $userId = $password = $token = $email = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Customer Id
    if (empty($_POST["customerId"])) {
        $errors[] = "Customer ID is required";
    } else {
        $customerId = test_input($_POST["customerId"]);
    }

    // Validate User Id
    if (empty($_POST["userId"])) {
        $errors[] = "User ID is required";
    } else {
        $userId = test_input($_POST["userId"]);
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $errors[] = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    // Validate Token value
    if (empty($_POST["token"])) {
        $errors[] = "Token value is required";
    } else {
        $token = test_input($_POST["token"]);
        if (!ctype_digit($token)) {
            $errors[] = "Token value must be a number";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $errors[] = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
    }

    // If there are no errors, display the submitted data
    if (empty($errors)) {
        echo "<h2>Your Input:</h2>";
        echo "Customer ID: " . $customerId . "<br>";
        echo "User ID: " . $userId . "<br>";
        echo "Password: " . $password . "<br>";
        echo "Token value: " . $token . "<br>";
        echo "Email: " . $email . "<br>";
    } else {
        // Display errors
        echo "<h2>Error:</h2>";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>