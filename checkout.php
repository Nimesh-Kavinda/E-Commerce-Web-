<?php

@include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}; 

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('Y-M-d');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'your cart is empty!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'order placed already!';
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
        header('location:./oder_confirm.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/user_profile.css">
    <link rel="stylesheet" href="./css/checkout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
   
<?php include './includes/nav.php'; ?>

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

 <!-- Page navigation btn top and bottem  -->
 <button id="scrollBtn" class="btn btn-lg btn-secondary d-none d-md-block scroll-btn">
    <i id="scrollIcon" class="scrollIcon"></i> 
  </button>

  <?php @include './includes/user_profile.php'; ?>

<section class="heading text-center py-4">
    <h3><i class="bi bi-bag-check-fill text-muted"></i> Checkout</h3>
</section>

<section class="display_order container my-4">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p class="mb-2"> <?php echo $fetch_cart['name'] ?> <span>(<?php echo 'Rs.'.$fetch_cart['price'].'.00'.' x '.$fetch_cart['quantity'] ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty text-center">your cart is empty</p>';
        }
    ?>
    <div class="grand_total text-end">Total : <span>Rs.<?php echo $grand_total; ?>.00</span></div>
</section>

<section class="checkout container my-4">

    <h3 class="pb-3">Place an Order</h3>

    <form action="" method="POST" class="form_checkout px-3 py-2">

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name :</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="number" class="form-label">Mobile Number :</label>
                <input type="number" name="number" id="number" min="0" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail :</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="method" class="form-label">Payment Method:</label>
                <select name="method" id="method" class="form-select" required>
                    <option value="cash on delivery">Cash on Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paypal">Paypal</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="flat" class="form-label">Address Line 01 :</label>
                <input type="text" name="flat" id="flat" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="street" class="form-label">Address Line 02 :</label>
                <input type="text" name="street" id="street" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="city" class="form-label">City :</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="state" class="form-label">State :</label>
                <input type="text" name="state" id="state" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="country" class="form-label">Country :</label>
                <input type="text" name="country" id="country" class="form-control" placeholder="" required autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="pin_code" class="form-label">Postal Code:</label>
                <input type="number" min="0" name="pin_code" id="pin_code" class="form-control" placeholder="" required autocomplete="off">
            </div>
        </div>

        <div class="text-center my-4">
            <input type="submit" name="order" value="Order Now" class="btn btn-primary">
        </div>

    </form>

</section>

<?php include './includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
