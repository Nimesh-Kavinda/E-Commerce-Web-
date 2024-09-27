<?php

session_start();

@include '../includes/db.php';

if (isset($_POST['submit'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = $filter_pass;

    // Fetch user record by email
    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        // Verify the hashed password using password_verify()
        if (password_verify($pass, $row['password'])) {
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header("Location: ../admin_page.php");
                exit();
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id']; 
                header("Location: ../home.php");
                exit();
            } else {
                $message3[] = 'No user found!';
            }
        } else {
            $message3[] = 'Incorrect email or password!';
        }
    } else {
        $message3[] = 'Incorrect email or password!';
    }
}
?>



