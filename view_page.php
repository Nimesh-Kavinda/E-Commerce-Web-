<?php

@include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:index.php');
}

if (isset($_POST['add_to_wishlist'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_wishlist_numbers) > 0) {
        $message[] = 'already added to wishlist';
    } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'product added to wishlist';
    }
}

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart';
    } else {

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick View</title>
    <link rel="stylesheet" href="./css//nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/user_profile.css">
    <link rel="stylesheet" href="./css/view_page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php @include './includes/nav.php'; ?>

<?php @include './includes/user_profile.php'; ?>

 <!-- Page navigation btn top and bottem  -->
 <button id="scrollBtn" class="btn btn-lg btn-secondary d-none d-md-block scroll-btn">
    <i id="scrollIcon" class="scrollIcon"></i> 
  </button>

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


<section class="container my-5 Product_details">
    <h3 class="text-center mb-4"><i class="bi bi-ticket-detailed-fill text-muted"></i> Product Details</h3>

    <?php  
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
    ?>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <form action="" method="POST">
                <div class="card">
                    <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $fetch_products['name']; ?></h5>
                        <p class="card-text text-muted">Rs. <?php echo $fetch_products['price']; ?>/-</p>
                        <p class="card-text text-muted"><?php echo $fetch_products['details']; ?></p>
                        <div class="input-group mb-3 d-flex">
                            <h6 class="text-center m-2 text-muted">Select Quanity</h6><input type="number" name="product_quantity" value="1" min="0" class="form-control" style="max-width: 100px;">
                        </div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <button type="submit" name="add_to_wishlist" class="btn btn_wlist p-2 mb-2 w-100">&#129293;</button>
                        <button type="submit" name="add_to_cart" class="btn btn_cart w-100">Add to Cart</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
            }
        } else {
            echo '<p class="text-center text-muted">No product details available!</p>';
        }
    }
    ?>

    <div class="text-center mt-4">
        <a id="backButton" class="btn btn-outline-secondary btn_goback">Go Back</a>
    </div>
</section>

<?php @include './includes/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="./js/back_button.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
