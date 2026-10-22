<?php

$host = "localhost";
$dbname = "formdata";
$username = "root";
$password = "";


 $conn =  mysqli_connect($host, $username, $password, $dbname) or die("Database connection failed.");

//   if(!$conn){
//     die("Connection failed: " . mysqli_connect_error());
//   } else {
//     echo "Connected successfully";
//   }



$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$contact = trim($_POST["contact"] ?? "");


$stmt = "INSERT INTO userdata (name, email, contact)
         VALUES ('$name', '$email', '$contact')";

if (mysqli_query($conn, $stmt)) {

    echo "<h2>Registration successful!</h2>";
    echo "<p>Your information has been saved.</p>";
    echo '<a href="index.html">Register another user</a>';

} else {

    if (mysqli_errno($conn) == 1062) {
        echo "<h2>Already registered.</h2>";
        echo '<a href="index.html">Register another user</a>';
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
}
   mysqli_query($conn, $stmt);


  mysqli_close($conn);
