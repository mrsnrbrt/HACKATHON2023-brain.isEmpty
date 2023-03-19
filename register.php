<?php
session_start();

// adatbázis kapcsolódás
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// új felhasználó hozzáadása
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
    } else {
    echo "Hiba történt a regisztráció során: " . $conn->error;
    }
    }    
    
    $conn->close();
    ?>