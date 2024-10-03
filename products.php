<?php

include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

if(isset($_POST['add_to_wishlist'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_wishlist_numbers) > 0){
        $message[] = 'already added to wishlist';
    }elseif(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'product added to wishlist';
    }

}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
   <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/products.css">
    <link rel="stylesheet" href="./css/user_profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

   <!-- Page navigation btn top and bottem  -->
   <button id="scrollBtn" class="btn btn-lg btn-secondary d-none d-md-block scroll-btn">
    <i id="scrollIcon" class="scrollIcon"></i> 
  </button>

   <!-- Naigation -->

  <?php
  include './includes/nav.php';
  ?>

    <!-- User Profile  -->
    <?php
    include './includes/user_profile.php'
    
    ?>

<section class="text-center py-4 heading">
    <h2><i class="bi bi-cart4 text-muted"></i> All Products</h2>
</section>

<section class="products container">
   <div class="row">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
               <form action="" method="POST" class="col-md-4 col-sm-6 mb-4">
                  <div class="card h-100">
                      <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                          <h5 class="card-title"><?php echo $fetch_products['name']; ?></h5>
                          <p class="card-text">Rs.<?php echo $fetch_products['price']; ?>.00</p>
                          <input type="hidden" name="product_quantity" value="1">
                          <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                          <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                          <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                          <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                          
                          <input type="submit" value="&#129293;" name="add_to_wishlist" class="btn btn_wishlist w-50 mb-2">
                          <input type="submit" value="Add to Cart" name="add_to_cart" class="btn btn_cart w-75">
                          
                      </div>
                  </div>
               </form>
      <?php
         }
      }else{
         echo '<p class="text-center">No Products Available</p>';
      }
      ?>

   </div>
</section>

<section class="products container">
    <h2 class="text-center my-5">View Products by Categories</h2>
    <?php
    $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
    while ($fetch_categories = mysqli_fetch_assoc($select_categories)) {
        echo '<h3 class="text-center mb-4">' . $fetch_categories['name'] . '</h3>';
        echo '<div class="row">';
        $category_id = $fetch_categories['category_id'];
        $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                ?>
                <form action="" method="POST" class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $fetch_products['name']; ?></h5>
                            <p class="card-text">Rs.<?php echo $fetch_products['price']; ?>.00</p>
                            <input type="hidden" name="product_quantity" value="1">
                            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                            <input type="submit" value="&#129293;" name="add_to_wishlist" class="btn btn_wishlist w-50 mb-2">
                            <input type="submit" value="Add to Cart" name="add_to_cart" class="btn btn_cart w-75">
                        </div>
                    </div>
                </form>
                <?php
            }
        } else {
            echo '<p class="text-center">No Products Available</p>';
        }
        echo '</div>';
    }
    ?>
</section>

<?php
     include './includes/footer.php';
 
      ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
