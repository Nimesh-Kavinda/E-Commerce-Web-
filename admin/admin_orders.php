<?php

@include '../includes/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
   exit;
}

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

<section class="placed-orders container my-5 flex-grow-1">
   <h1 class="title text-center mb-4 text-muted"><i class="bi bi-luggage text-danger"></i> Placed Orders</h1>

   <!-- Filter Form -->
   <form method="GET" action="" class="row g-3 mb-4">
      <div class="col-md-6">
         <label for="method" class="form-label">Filter Here from Payment Method</label>
         <select name="method" id="method" class="form-select">
            <option value="">All Methods</option>
            <option value="cash on delivery" <?php echo (isset($_GET['method']) && $_GET['method'] == 'cash on delivery') ? 'selected' : ''; ?>>Cash on Delivery</option>
            <option value="credit card" <?php echo (isset($_GET['method']) && $_GET['method'] == 'credit card') ? 'selected' : ''; ?>>Credit Card</option>
            <option value="paypal" <?php echo (isset($_GET['method']) && $_GET['method'] == 'paypal') ? 'selected' : ''; ?>>Paypal</option>
         </select>
      </div>
      <div class="col-12">
         <button type="submit" class="btn btn-primary">Filter</button>
         <a href="admin_orders.php" class="btn btn-secondary">Clear Filter</a>
      </div>
   </form>

   <div class="row g-4">
      <?php
      
      // Initialize the base query
      $query = "SELECT * FROM `orders`";
      
      // Check if there are filters and build WHERE clause accordingly
      $where_clauses = [];
      if (!empty($_GET['method'])) {
         $method = mysqli_real_escape_string($conn, strtolower($_GET['method'])); // Convert to lowercase for consistency
         $where_clauses[] = "LOWER(`method`) = '$method'"; // Ensure case-insensitive comparison
      }
      
      // Combine the base query with any where clauses
      if (count($where_clauses) > 0) {
         $query .= " WHERE " . implode(" AND ", $where_clauses);
      }

      // Execute the query
      $select_orders = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));

      // Display debugging information if the query returns no results
      if(mysqli_num_rows($select_orders) === 0){
         echo '<p class="text-center text-danger">No orders match the selected filters!</p>';
      } else {
         // Display orders if found
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="col-md-6 col-lg-4">
         <div class="card shadow-sm h-100">
            <div class="card-body">
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
      }
      ?>
   </div>
</section>

<?php @include './includes/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
