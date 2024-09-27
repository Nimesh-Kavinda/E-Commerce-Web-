<?php

@include '../includes/db.php';

if (isset($_POST['submit'])) {
    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = $filter_pass;
    $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
    $cpass = $filter_cpass;

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'This user already exists!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Your confirm password does not match!';
        } else {
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$hashed_pass')") or die('query failed');
            $message2[] = 'You have registered successfully!';
        }
    }
}
?>
