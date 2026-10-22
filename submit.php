<?php

$host = "localhost";
$dbname = "web_form_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection failed.");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");

$errors = [];

if (strlen($name) < 3) {
    $errors[] = "Name must contain at least 3 characters.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
}

if (!preg_match('/^[0-9]{10}$/', $phone)) {
    $errors[] = "Invalid phone number.";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo htmlspecialchars($error) . "<br>";
    }

    echo '<br><a href="index.html">Go back</a>';
    exit;
}

try {

    // Prepared statement prevents SQL injection
    $stmt = $pdo->prepare(
        "INSERT INTO users (name, email, phone)
         VALUES (:name, :email, :phone)"
    );

    $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":phone" => $phone
    ]);

    echo "<h2>Registration successful!</h2>";
    echo "<p>Your information has been saved.</p>";
    echo '<a href="index.html">Register another user</a>';

} catch (PDOException $e) {

    if ($e->getCode() == 23000) {
        echo "This email is already registered.";
    } else {
        echo "Something went wrong. Please try again.";
    }
}