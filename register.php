<?php
$conn = new mysqli("localhost","root","","user_db");

if($conn->connect_error){
    die("Connection Failed");
}

// 🔥 safe fetch
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// check empty
if(empty($username) || empty($email) || empty($password)){
    echo "<script>alert('All fields required'); window.location.href='register.html';</script>";
    exit();
}

// hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insert
$sql = "INSERT INTO users (username,email,password)
        VALUES ('$username','$email','$hashed_password')";

if($conn->query($sql)){
    header("Location: login.html");
    exit();
} else {
    echo "error";
}

$conn->close();
?>