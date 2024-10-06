<?php

@include '../includes/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../index.php');
};

if(isset($_POST['add_product'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $category_id = $_POST['category_id']; // Add this line to capture the selected category ID
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = '../uploaded_img/'.$image;


   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');
   if(mysqli_num_rows($select_product_name) > 0){
      echo '<script>alert("product name already exists!");</script>';
   } else {

   $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, price, category_id, image, details) VALUES('$name', $price, $category_id, '$image', '$details')") or die(mysqli_error($conn));


      if($insert_product){
         if($image_size > 2000000){
            
         } else {
        
            move_uploaded_file($image_tmp_name, $image_folter);
            
         }
      }
   }
}


if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('./uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
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
         <form action="" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
            <h3 class="text-center mb-4 text-muted">Add New Product</h3>
            <div class="mb-3">
               <input type="text" class="form-control" required placeholder="Name" name="name" autocomplete="off">
            </div>
            <div class="mb-3">
               <input type="number" min="0" class="form-control" required placeholder="Price (Rs.)" name="price" autocomplete="off">
            </div>
            <div class="mb-3">
               <select name="category_id" class="form-select" required>
                  <option value="">Select Category</option>
                  <?php
                 
                     $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
                     while ($fetch_categories = mysqli_fetch_assoc($select_categories)) {
                        echo '<option value="' . $fetch_categories['category_id'] . '">' . $fetch_categories['name'] . '</option>';
                     }
                  ?>
               </select>
            </div>
            <div class="mb-3">
               <input type="file" accept="image/jpg, image/jpeg, image/png, image/webp" required class="form-control" name="image" autocomplete="off">
            </div>
            <div class="mb-3">
               <input type="text" class="form-control" required placeholder="Description" name="details" autocomplete="off">
            </div>
            <div class="text-center">
               <input type="submit" value="Add Product" name="add_product" class="btn btn-danger w-50">
            </div>
         </form>
      </div>
   </div>
</section>

<section class="container">
   <?php

   $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
   while ($fetch_categories = mysqli_fetch_assoc($select_categories)) {
      echo '<div class="mb-5">';
      echo '<h2 class="text-center fs-3 mb-4 fw-bold text-muted">' . $fetch_categories['name'] . '</h2>';
      echo '<div class="row g-4">';

      $category_id = $fetch_categories['category_id'];
      $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
         while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
               <div class="card h-100">
                  <img src="../uploaded_img/<?php echo $fetch_products['image']; ?>" class="card-img-top" alt="">
                  <div class="card-body text-center">
                     <h5 class="card-title"><?php echo $fetch_products['name']; ?></h5>
                     <p class="card-text">Rs.<?php echo $fetch_products['price']; ?>.00</p>
                     <div class="d-flex justify-content-between">
                        <a href="./admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="btn btn-secondary">Update</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this product?');">Delete</a>
                     </div>
                  </div>
               </div>
            </div>
            <?php
         }
      } else {
         echo '<p class="text-center">No products available in this category</p>';
      }
      echo '</div>'; // Close row
      echo '</div>'; // Close category div
   }
   ?>
</section>

<?php @include './includes/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
