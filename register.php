<?php
session_start();
include 'register.html';

if(!array_key_exists('count', $_SESSION)){
    $_SESSION['count'] = 0;
}
//Database connection
$conn_db_orenda = mysqli_connect('localhost', 'ivalchinkov', '88Ddb1d5', 'orenda_cart');
if(!$conn_db_orenda){
    echo 'Грешка при свързване с базата данни.' . mysqli_connect_error();
}

if(isset($_POST) && !empty($_POST)){
    $username = trim($_POST['username']," ");
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $retype_password = password_hash($_POST['retype_password'], PASSWORD_DEFAULT);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
}
$email = $_POST['email'];
$retype_password = $_POST['retype_password'];

$sql = "INSERT INTO register (username, form_email,form_password, form_retype_password) VALUES ('$username', '$email','$password', $retype_password')";

mysqli_query($conn_db_orenda, $sql);

$cookie_name = "loggedin";
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = sha1(sha1($password. "salt")."salt");
    $query = "SELECT * FROM register WHERE username = '$username' AND form_password = $password_hash";
    $result = mysqli_query ($conn_db_orenda, $query);
    $count = mysqli_num_rows($result);

    if($count == 1){}
}
else if(isset($_POST['register'])){
}





