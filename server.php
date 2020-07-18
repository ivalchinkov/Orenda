<?php
session_start();
// Starting the session, necessary
// for using session variables


// Declaring and hoisting the variables
$username = "";
$email = "";
$errors = array();
$_SESSION['success'] = "";

// DBMS connection code -> hostname,
// username, password, database name
$db = mysqli_connect('localhost', 'ivalchinkov', '88Ddb1d5', 'registration');
if(!$db){
    echo "Грешка при свързване с базата данни". mysqli_connect_error();
}

// Registration code
if (isset($_POST['reg_user'])) {

    // Receiving the values entered and storing
    // in the variables
    // Data sanitization is done to prevent
    // SQL injections
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $retype_password = mysqli_real_escape_string($db, $_POST['retype_password']);

    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($username)) { array_push($errors, "Моля въведете потребителско име."); }
    if (empty($email)) { array_push($errors, "Моля въведете имейл адрес."); }
    if (empty($password)) { array_push($errors, "Моля въведете парола."); }

    if ($password !== $retype_password) {
        array_push($errors, "Двете пароли не съвпадат.");
        // Checking if the passwords match
    }

    // If the form is error free, then register the user
    if (count($errors) == 0) {

        // Password encryption to increase data security
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Inserting data into table
        $query = "INSERT INTO users (username, email, password)
				VALUES('$username', '$email', '$password')";

        mysqli_query($db, $query);

        // Storing username of the logged in user,
        // in the session variable
        $_SESSION['username'] = $username;

        // Welcome message
        $_SESSION['success'] = "Добре дошли.";

        // Page on which the user will be
        // redirected after logging in
        header('location: index.php');
    }
}

// User login
if (isset($_POST['login_user'])) {

    // Data sanitization to prevent SQL injection
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Error message if the input field is left blank
    if (empty($username)) {
        array_push($errors, "Моля въведете потребителско име.");
    }
    if (empty($password)) {
        array_push($errors, "Моля въведете парола.");
    }

    // Checking for the errors
    if (count($errors) == 0) {

        // Password matching
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM users WHERE username=
				'$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        // $results = 1 means that one user with the
        // entered username exists
        if (mysqli_num_rows($results) == 1) {

            // Storing username in session variable
            $_SESSION['username'] = $username;

            // Welcome message
            $_SESSION['success'] = "Добре дошли!";

            // Page on which the user is sent
            // to after logging in
            header('location: index.php');
        }
        else {

            // If the username and password doesn't match
            array_push($errors, "Невалидно потребителско име или парола.");
        }
    }
}

?>
