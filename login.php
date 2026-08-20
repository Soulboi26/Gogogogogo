<?php
session_start();

if($_SERVER["REQUEST_METHOD"] != "POST"){
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost","root","","user_db");

$email = $_POST['email'];
$password = $_POST['password'];

if(empty($email) || empty($password)){
    header("Location: login.html?status=empty");
    exit();
}

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result && $result->num_rows > 0){

    $row = $result->fetch_assoc();

    if(password_verify($password, $row['password'])){
        $_SESSION['user'] = $email;
        header("Location: login.html?status=success");
        exit();
    } else {
        header("Location: login.html?status=wrong");
        exit();
    }

} else {
    header("Location: login.html?status=notfound");
    exit();
}
?>