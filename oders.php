<?php

@include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <link rel="stylesheet" href="./css//nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/user_profile.css">
    <link rel="stylesheet" href="./css/oders.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
   
<?php @include './includes/nav.php'; ?>

<?php @include './includes/user_profile.php'; ?>

   <!-- Page navigation btn top and bottem  -->
   <button id="scrollBtn" class="btn btn-lg btn-secondary d-none d-md-block scroll-btn">
    <i id="scrollIcon" class="scrollIcon"></i> 
  </button>



<section class="container text-center mt-5 heading">       
    <h3 class="text-center mb-4"><i class="fa fa-truck text-muted fs-3 mx-2" aria-hidden="true"></i></i>Orders</h3>    
</section>

<section class="container oder_form">
    <div class="row g-4">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="col-12 col-md-6 col-lg-4 form_box mb-5">
        <div class="card h-100 shadow-lg">
            <div class="card-body">
                <p> <strong>Placed on:</strong> <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                <p> <strong>Name:</strong> <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p> <strong>Number:</strong> <span><?php echo $fetch_orders['number']; ?></span> </p>
                <p> <strong>Email:</strong> <span class="email"><?php echo $fetch_orders['email']; ?></span> </p>
                <p> <strong>Address:</strong> <span><?php echo $fetch_orders['address']; ?></span> </p>
                <p> <strong>Payment method:</strong> <span><?php echo $fetch_orders['method']; ?></span> </p>
                <p> <strong>Your orders:</strong> <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                <p> <strong>Total price:</strong> <span>Rs. <?php echo $fetch_orders['total_price']; ?> //-</span> </p>
                <p> <strong>Payment status:</strong> 
                   <span class="text-danger">
                       <?php echo $fetch_orders['payment_status']; ?>
                   </span>
                </p>
            </div>
        </div>
    </div>
    <?php
        }
    }else{
        echo '<p class="text-center">No orders placed yet!</p>';
    }
    ?>
    </div>
</section>

<?php @include './includes/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
