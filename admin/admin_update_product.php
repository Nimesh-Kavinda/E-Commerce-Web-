<?php

@include '../includes/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../index.php');
};

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);

   mysqli_query($conn, "UPDATE `products` SET name = '$name', price = '$price' WHERE id = '$update_p_id'") or die('query failed');
   mysqli_query($conn, "UPDATE `cart` SET name = '$name', price = '$price' WHERE pid = '$update_p_id'") or die('query failed');
   mysqli_query($conn, "UPDATE `wishlist` SET name = '$name', price = '$price' WHERE pid = '$update_p_id'") or die('query failed');
   
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = '../uploaded_img/'.$image;
   $old_image = $_POST['update_p_image'];
   
   if(!empty($image)){
      if($image_size <= 2000000){
         mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed');
         mysqli_query($conn, "UPDATE `cart` SET image = '$image' WHERE pid = '$update_p_id'") or die('query failed');
         mysqli_query($conn, "UPDATE `wishlist` SET image = '$image' WHERE pid = '$update_p_id'") or die('query failed');
         move_uploaded_file($image_tmp_name, $image_folter);
         unlink('../uploaded_img/'.$old_image);
      }
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>
   <link rel="stylesheet" href="../css/admin_page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
   
<?php @include './includes/admin_nav.php'; ?>

<section class="container my-5">
   <div class="row justify-content-center">
      <div class="col-md-6">
         <?php
            if (isset($_GET['update'])) {
               $update_id = $_GET['update'];
               $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
                  while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="" method="post" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
            <img src="../uploaded_img/<?php echo $fetch_products['image']; ?>" class="img-fluid mb-3" alt="">
            <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
            <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
            <div class="mb-3">
               <input type="text" class="form-control" value="<?php echo $fetch_products['name']; ?>" required placeholder="Update product name" name="name">
            </div>
            <div class="mb-3">
               <input type="number" min="0" class="form-control" value="<?php echo $fetch_products['price']; ?>" required placeholder="Update product price" name="price">
            </div>
            <div class="mb-3">
               <input type="file" accept="image/jpg, image/jpeg, image/png, image/webp" class="form-control" name="image">
            </div>
            <div class="d-grid gap-2 justify-content-center">
               <input type="submit" value="Update Product" name="update_product" class="btn btn-danger w-100">
               <a href="./admin_products.php" class="btn btn-secondary">Back</a>
            </div>
         </form>
         <?php
                  }
               } else {
                  echo '<p class="text-center">No product found for update</p>';
               }
            } else {
               echo '<p class="text-center">No product selected for update</p>';
            }
         ?>
      </div>
   </div>
</section>

<?php @include './includes/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
