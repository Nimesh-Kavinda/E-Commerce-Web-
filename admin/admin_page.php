<?php

@include '../includes/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../index.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
      <link rel="stylesheet" href="../css/admin_page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body class="d-flex flex-column min-vh-100">

<?php @include './includes/admin_nav.php'; ?>

<section class="container my-5">
   <h1 class="text-center mb-4 text-muted"><i class="bi bi-house-dash text-danger"></i> Dashboard</h1>

   <div class="table-responsive tabel_main">
      <table class="table table-bordered table-hover text-center tabel_dash">
         <thead class="table-dark">
            <tr>
               <th scope="col">Category</th>
               <th scope="col">Count</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td class="p-3">Orders Placed</td>
               <td class="p-3">
                  <?php
                     $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                     $number_of_orders = mysqli_num_rows($select_orders);
                     echo $number_of_orders;
                  ?>
               </td>
            </tr>
            <tr>
               <td class="p-3">Products Added</td>
               <td class="p-3">
                  <?php
                     $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                     $number_of_products = mysqli_num_rows($select_products);
                     echo $number_of_products;
                  ?>
               </td>
            </tr>
            <tr>
               <td class="p-3">Users</td>
               <td class="p-3">
                  <?php
                     $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                     $number_of_users = mysqli_num_rows($select_users);
                     echo $number_of_users;
                  ?>
               </td>
            </tr>
            <tr>
               <td class="p-3">Admins</td>
               <td class="p-3">
                  <?php
                     $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                     $number_of_admin = mysqli_num_rows($select_admin);
                     echo $number_of_admin;
                  ?>
               </td>
            </tr>
            <tr>
               <td class="p-3">Total Accounts</td>
               <td class="p-3">
                  <?php
                     $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                     $number_of_account = mysqli_num_rows($select_account);
                     echo $number_of_account;
                  ?>
               </td>
            </tr>
            <tr>
               <td class="p-3">New Messages</td>
               <td class="p-3">
                  <?php
                     $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                     $number_of_messages = mysqli_num_rows($select_messages);
                     echo $number_of_messages;
                  ?>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</section>


<?php @include './includes/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
