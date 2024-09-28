<?php

@include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}


if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>
   <link rel="stylesheet" href="./css//nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/user_profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php @include './includes/nav.php'; ?>

<?php
    include './includes/user_profile.php'
    
    ?>

<section class="container mt-5">
    <div class="text-center mb-4">
        <h3>&#10084; Wishlist</h3>
    </div>
</section>

<section class="wishlist container">

    <div class="row">

    <?php
        $grand_total = 0;
        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_wishlist) > 0){
            while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
    ?>
    <form action="" method="POST" class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <img src="uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><?php echo $fetch_wishlist['name']; ?></h5>
                <p class="card-text">Price: Rs.<?php echo $fetch_wishlist['price']; ?>.00</p>
                <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['pid']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
                <button type="submit" name="add_to_cart" class="btn btn-primary w-100">Add to Cart</button>
            </div>
        </div>
    </form>
    <?php 
    $grand_total += $fetch_wishlist['price'];
        }
    }else{
        echo '<p class="text-center text-muted">Your wishlist is empty</p>';
    }
    ?>
    </div> 

    <div class="text-center mt-4">
        <p class="fw-bold">Total: Rs.<?php echo $grand_total; ?>.00</p>
        <a href="shop.php" class="btn btn-outline-secondary">Continue Shopping</a>
        <a href="wishlist.php?delete_all" class="btn btn-danger <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('Delete all from wishlist?');">Delete All</a>
    </div>

</section>










<?php @include './includes/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>
