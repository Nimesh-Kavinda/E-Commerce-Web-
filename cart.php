<?php

@include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'Cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
    <link rel="stylesheet" href="./css//nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/user_profile.css">
    <link rel="stylesheet" href="./css/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php @include './includes/nav.php'; ?>


<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="msg_box container text-center fs-4 p-1 mt-2 mb-3">
         <span>'.$message.'</span>
        <a class = "b_login" href = "#login" onclick="this.parentElement.remove();"><i class="fas fa-check fs-3"></i> </a>
      </div>
      ';
   }
}
?>

<?php
    include './includes/user_profile.php'
    
    ?>

       <!-- Page navigation btn top and bottem  -->
   <button id="scrollBtn" class="btn btn-lg btn-secondary d-none d-md-block scroll-btn">
    <i id="scrollIcon" class="scrollIcon"></i> 
  </button>

<section class="container mt-5 hedling">
    <div class="text-center mb-4">
        <h3><i class="bi bi-cart-check-fill text-muted fs-2"></i> Shopping Cart</h3>
    </div>
</section>

<section class="shopping-cart container mb-5">

    <h1 class="title text-center mb-4">Added Items</h1>

    <div class="row">

    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 text-center p-3">
            <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><?php echo $fetch_cart['name']; ?></h5>
                <p class="card-text">Price: Rs.<?php echo $fetch_cart['price']; ?>.00</p>
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                    <div class="input-group mb-3">
                        <h6 class="text-center py-2 me-2 text-primary">Select Suantity</h6>
                        <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="form-control">
                        <button type="submit" class="btn btn_update" name="update_quantity">Update</button>
                    </div>
                </form>
                <p class="card-text">Sub-Total: <strong>Rs.<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>.00</strong></p>
            </div>
        </div>
    </div>
    <?php
    $grand_total += $sub_total;
        }
    }else{
        echo '<p class="text-center text-muted">Your cart is empty.</p>';
    }
    ?>
    </div>

    <div class="text-center delete mt-4">
        <a href="cart.php?delete_all" class="btn_delete btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('Delete all from cart?');">Delete All</a>
    </div>

    <div class="cart-total text-center mt-4">
        <p>Total: <span class="fw-bold">Rs.<?php echo $grand_total; ?>.00</span></p>
        <a href="./products.php" class="btn_shoping btn btn-outline-secondary mx-2">Continue Shopping</a>
        <a href="./checkout.php" class="btn btn_checkout <?php echo ($grand_total > 1)?'':'disabled' ?>">Checkout</a>
    </div>

</section>

<?php @include './includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="./js/card.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
