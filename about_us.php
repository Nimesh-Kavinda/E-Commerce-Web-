<?php

include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}; 

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>
   <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/user_profile.css">
    <link rel="stylesheet" href="./css/about_us.css">
    <link rel="stylesheet" href="/css/loader.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

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

<section id="aboutus" class="aboutus mb-5">
  <div class="container-fluid about_cover d-none d-lg-block">
    <div class="text-center title">
      <h2 class="display-4 fw-bold">Sweety Cake House</h2>
    </div>
  </div>

  <div class="container about_details mt-5">
    <div class="row gy-4 align-items-center">
      <div class="col-lg-6">
        <img src="./assest/img/about_cake.png" class="img-fluid rounded" alt="Workshop Image">
      </div>

      <div class="col-lg-6 content text-center">
    <h3 class="text-start fw-bold mb-3">Contact Us</h3>
    <hr class="">
    <p class="lead text-secondary text-start fw-bold">
        <i class="fas fa-map-marker-alt"></i> Address: No-134/4, Colombo-Kandy Rode, Molagoda, Kegalle.
    </p>

    <p class="lead text-secondary text-start fw-bold">
        <i class="fas fa-phone"></i> Phone: 077 8525 115
    </p>

    <p class="lead text-secondary text-start fw-bold">
        <i class="fas fa-envelope"></i> Email: sweetycakehouse@gmail.com
    </p>

    <h2 class="text-end mt-5 mb-3">Our Branches</h2>
    <hr class="text-end right_to_left">
    <p class="lead text-secondary text-end fw-bold">
        <i class="fas fa-store b_i"></i> Kandy Branch: No-154/4, Main Street, Kandy
    </p>
    <p class="lead text-secondary text-end fw-bold">
        <i class="fas fa-store b_i"></i> Kurunagala Branch: No-236/1, Puththalam Road, Kurungala.
    </p>
    <p class="lead text-secondary text-end fw-bold">
        <i class="fas fa-store b_i"></i> Kadawatha Branch: No-32 Colombo Road, Kadawatha.
    </p>
</div>
    </div>
  </div>

  <div class="container-fluid offers">
    <div class="row text-center">
      <div class="col-lg-4 d-flex justify-content-center p-3">
        <i class="fa fa-truck fs-1 p-3 text-muted"></i>
        <div class="ms-3 text-muted">
          <h2>Fast Delivery</h2>
          <h6>On all Location</h6>
        </div>
      </div>
      <div class="col-lg-4 d-flex justify-content-center p-3">
        <i class="fa fa-gift fs-1 p-3 text-muted"></i>
        <div class="ms-3 text-muted">
          <h2>Offers & Gifts</h2>
          <h6>On all Orders</h6>
        </div>
      </div>
      <div class="col-lg-4 d-flex justify-content-center p-3">
        <i class="fa fa-credit-card fs-1 p-3 text-muted"></i>
        <div class="ms-3 text-muted">
          <h2>Secure Payments</h2>
          <h6>Protected Methods</h6>
        </div>
      </div>
    </div>
  </div>

  <div class="container my-5 team">
    <div class="row text-center">
      <div class="col-12">
        <h3 class="mb-4">Meet Our Team</h3>
      </div>
      <div class="col-lg-4">
        <div class="card shadow">
          <img src="./assest/img/member_01.jpg" class="card-img-top" alt="Member 1">
          <div class="card-body">
            <h5 class="card-title fw-bold">Lakshika Madhumali</h5>
            <p class="card-text text-muted">Baker Specialist</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card shadow">
          <img src="./assest/img/member_02.jpg" class="card-img-top" alt="Member 2">
          <div class="card-body">
            <h5 class="card-title">Anuradha Deshani</h5>
            <p class="card-text text-muted">Decorator</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card shadow">
          <img src="./assest/img/member_03.jpg" class="card-img-top" alt="Member 3">
          <div class="card-body">
            <h5 class="card-title">Mahesha Dilhani</h5>
            <p class="card-text text-muted">Customer Service</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5 mb-1 map">
    <h3 class="text-center">Find Us Here</h3>
    <div class="ratio ratio-16x9 mt-4">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15831.555174936682!2d80.33542144050192!3d7.253495820159392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae316b5affca98d%3A0xec4aece6bdbb55b1!2sKegalle!5e0!3m2!1sen!2slk!4v1728107144239!5m2!1sen!2slk" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>

</section>

<?php
     include './includes/footer.php';
 
      ?>

 
    <script src="./js/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="./js/card.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
