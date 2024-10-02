<?php

@include '../includes/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
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
<body class="d-flex flex-column min-vh-100"> <!-- Flex container for the body -->

<?php @include './includes/admin_nav.php'; ?>

<!-- Main content section with flex-grow to push the footer down -->
<section class="placed-orders container my-5 flex-grow-1"> 
   <h1 class="title text-center mb-4 text-muted"><i class="bi bi-luggage text-danger"></i> Placed Orders</h1>

   <div class="row g-4">
      <?php
      
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="col-md-6 col-lg-4">
         <div class="card shadow-sm h-100">
            <div class="card-body">
               <p class="card-text">User ID: <span class="fw-bold"><?php echo $fetch_orders['user_id']; ?></span></p>
               <p class="card-text">Placed On: <span class="fw-bold"><?php echo $fetch_orders['placed_on']; ?></span></p>
               <p class="card-text">Name: <span class="fw-bold" style="text-transform: capitalize;"><?php echo $fetch_orders['name']; ?></span></p>
               <p class="card-text">Phone Number: <span class="fw-bold"><?php echo $fetch_orders['number']; ?></span></p>
               <p class="card-text">Email: <span class="fw-bold"><?php echo $fetch_orders['email']; ?></span></p>
               <p class="card-text">Address: <span class="fw-bold" style="text-transform: capitalize;"><?php echo $fetch_orders['address']; ?></span></p>
               <p class="card-text">Total Products: <span class="fw-bold" style="text-transform: capitalize;"><?php echo $fetch_orders['total_products']; ?></span></p>
               <p class="card-text">Total Price: <span class="fw-bold">Rs.<?php echo $fetch_orders['total_price']; ?>.00</span></p>
               <p class="card-text">Payment Method: <span class="fw-bold" style="text-transform: capitalize;"><?php echo $fetch_orders['method']; ?></span></p>
            </div>
         </div>
      </div>
      <?php
         }
      }else{
         echo '<p class="text-center text-danger">No orders placed yet!</p>';
      }
      ?>
   </div>
</section>

<?php @include './includes/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>
