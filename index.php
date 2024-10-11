<?php
include './includes/db.php';
?>
<!-- registraion function  -->

<?php

@include '../includes/db.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
         $message2[] = 'registered successfully!';
      }
   }

}

?>

<!-- login fun  -->

<?php


session_start();

if(isset($_POST['login_submit'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:./admin/admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id']; 
         header('location:./home.php');

      }else{
         $message3[] = 'no user found!';
      }

   }else{
      $message3[] = 'incorrect email or password!';
   }

}
 
?>

<!doctype html>
 <html lang="en" class="data-bs-theme">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#8B93FF">
    <title>Sweety Cake House</title>
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <!-- Naigation -->

    <nav class="navbar navbar-expand-lg" id="nav">

      <div class="main-con container-fluid">

        <span class="navbar-brand d-flex gap-2 text-white">
        <img src="./assest/img/logo-w.png" alt="" class="img-fluid" width="100px" height="20px">
        </span>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-muted"></span>
        </button>

        <div class="list collapse navbar-collapse justify-content-between" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link menu_item" href="#nav">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link menu_item" href="#aboutus">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link menu_item" href="#products">Products</a>
            </li>
          </ul>
          <div class="btn_section">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active b_login_a" aria-current="page" href="#login"><button class="btn b_signin b_login btn-md border border-0">Sign In</button></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#register"><button class="btn b_signup b_register btn-md border border-0">Sign Up</button></a>
              </li>
            </ul>
          </div>

          <div class="d-flex ms-3 cart_and_wishlist">
           <a href="#login"> <button class="btn border-0 text-center wish_btn b_loginfirts" href="#login">
              <i class="bi bi-bag-heart-fill text-white fs-4"></i><sup class="fs-5 text-white">0</sup>
            </button>
          </a>
           <a href="#login"><button class="btn border-0 text-center cart_btn b_loginfirts">
            <i class="bi bi-cart-check-fill text-white fs-4"></i><sup class="fs-5 text-white">0</sup>
          </button>
        </a> 
          </div>

          <div onclick="activeDarkMode()" class="d_mode">
            <button
              class="btn btn-outline-primary mx-3 text-center"
              id="switch-mode">
              <i class="bi bi-moon-stars-fill text-white fs-4"></i>
              <i class="bi bi-sun-fill text-white d-none fs-4"></i>
            </button>
          </div>

        </div>
      </div>
    </nav>
      <!-- End of nav -->


  <!-- Registration erro and Succesfull msgs  -->
    <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="msg_box container text-center text-danger fs-4 p-1 mt-2 mb-3">
         <span>'.$message.'</span>
        <a class = "b_register" href = "#register" onclick="this.parentElement.remove();"><i class="fas fa-times text-danger fs-3"></i> </a>
      </div>
      ';
   }
}
?>

<?php
if(isset($message2)){
   foreach($message2 as $message2){
      echo '
      <div class="msg_box container text-center text-success bg-light fs-4 border border-success p-1 mt-2">
         <span>'.$message2.'</span>
        <a class = "b_login" href = "#login" onclick="this.parentElement.remove();"><i class="fas fa-check text-success fs-3"></i> </a>
      </div>
      ';
   }
}
?>

<?php
if(isset($message3)){
   foreach($message3 as $message3){
      echo '
      <div class="msg_box container text-center text-danger fs-4 p-1 mt-2 mb-3">
         <span>'.$message3.'</span>
        <a class = "b_login" href = "#login" onclick="this.parentElement.remove();"><i class="fas fa-times text-danger fs-3"></i> </a>
      </div>
      ';
   }
}
?>
 <!-- end of msgs  -->

   <!-- Page navigation btn top and bottem  -->
   <button id="scrollBtn" class="btn btn-lg btn-secondary d-none d-md-block scroll-btn">
    <i id="scrollIcon" class="scrollIcon"></i> 
  </button>

   <!-- Discription section  -->

  <section id="content" class="description">

    <div class="welcome_section container-fluid text-center">

      <div class="row text-center">

      <div class="satatements col-12 col col col-lg-7 px-3 py-2 text-center align-items-center justify-content-center">
        <h2 class="m-2 p-2 fw-bold shopname"><span class="fs-1 greeting"><span class="title_l1">W</span>elcome</span> to <span class="title_w1"><span class="title_l1">S</span>weety</span> <span class="title_w2">Cake</span> <span class="title_w3">House</span>..!</h2>
        <p class="my-2 p-2 discription">
          At Kandyan Cake Shop, we blend the rich heritage of Kandyan traditions with contemporary baking techniques to bring you a delightful array of cakes and pastries. Nestled in the heart of our community, our shop is renowned for its commitment to quality, flavor, and artistic design.
        </p>
        <h3 class="m-1 p-3 fs-2">Our Offerings</h3>
        <div class="offerings">
        <ul class="m-2 p-2 fs-5">
          <li class="p-1">Custom Cake Orders</li>
          <li class="p-1">Door Step Free Delivery</li>
          <li class="p-1">Online Ordering and Delivery</li>
          <li class="p-1">Gift Vouchers</li>
        </ul>
        </div>
        
        <div class="show_btn p-3 mt-4">
          <a href="#login"><button class="btn btn-lg text-white b_login">Discover More</button></a>
        </div>
      </div>

      <div class="image col col-sm col-md col-lg-5 text-center align-items-center d-flex">
        <img src="./assest/img/logo-c.png" alt="" class="text-center img-fluid d-none d-lg-block lazyload" width="600px" height="auto">
      </div>


    </div>
    </div>

  </section>

   <!-- end description section  -->

    <!-- Products Section  -->

  <section id="products" class="products">
    
      <div class="topic_product">
        <hr width="60%" class="top_hr">
        <span class="key">O</span>
        <span class="key">U</span>
        <span class="key">R</span>
        <span class="key">-</span>
        <span class="key">P</span>
        <span class="key">R</span>
        <span class="key">O</span>
        <span class="key">D</span>
        <span class="key">U</span>
        <span class="key">C</span>
        <span class="key">T</span>
        <span class="key">S</span>
        <hr width="60%" class="down_hr">
      </div>
    
 <div class="container my-5">
    <div class="row">

        <?php
$select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 9") or die('query failed');
if (mysqli_num_rows($select_products) > 0) {
    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
?>

<div class="col-md-4">
    <div class="card my-3 shadow-lg">
          
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="card-img-top" alt="Product Image">
     
            <div class="card-body text-center">
            <h5 class="card-title"><?php echo $fetch_products['name']; ?></h5>
            <p class="card-text text-muted"><strong>Rs.<?php echo $fetch_products['price']; ?>.00</strong></p>

            <input type="hidden" name="product_quantity" value="1">
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

            <a href="#login" class="btn btn_wish b_loginfirts w-50">&#129293;</a> <br><br>
            <a href="#login" class="btn btn_cart b_loginfirts w-75">Add to Cart</a>
        </div>
    </div>
</div>

<?php
    }
} else {
    echo '<div class="container noproducts_msg py-2 my-2">
    <p class="text-center text-muted m-3 fs-5">No products added yet!</p>
    </div>';
}
?>
      </div>
  </div>
</section>

 <!-- End Products Section  -->

  <!-- about us section  -->

 <section id="aboutus" class="about_us">

  <div class="topic_aboutus">
    <hr width="60%" class="top_hr">
    <span class="key">A</span>
    <span class="key">B</span>
    <span class="key">O</span>
    <span class="key">U</span>
    <span class="key">T</span>
    <span class="key">-</span>
    <span class="key">U</span>
    <span class="key">S</span>
    <hr width="60%" class="down_hr">
  </div>

  <div class="container about_content py-3">

    <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
      <div class="col-12 col-lg-6 col-xl-5">
        <img class="img-fluid rounded" loading="lazy" src="./assest/img/about_cake.png" alt="About 1">
      </div>
      <div class="col-12 col-lg-6 col-xl-7">
        <div class="row justify-content-xl-center">
          <div class="col-12 col-xl-11">

            <h3 class="mb-3">Welcome to Sweety Cake House</h3>
            <p class="lead topic_msg fs-5 text-secondary mb-3 ps-2">At Sweety Cake House, we believe that every celebration deserves a sweet touch. Our passion for baking, combined with the finest ingredients, creates the most delightful cakes for your special moments.</p>

            <h3 class="mb-3">Our Journey</h3>
            <p class="lead topic_msg fs-5 text-secondary mb-3 ps-2">What began as a small, family-run bakery has grown into a beloved cake destination. We are proud to serve cakes that are not just desserts, but memories made with love and care.</p>

            <h3 class="mb-3">Quality Ingredients, Exquisite Flavors</h3>
            <p class="lead topic_msg fs-5 text-secondary mb-3 ps-2">We source only the highest quality ingredients to ensure that every bite is rich, flavorful, and irresistibly fresh. Whether it’s a birthday, wedding, or just a sweet craving, our cakes promise to delight.</p>

            <h3 class="mb-3">Our Promise</h3>
            <p class="lead topic_msg fs-5 text-secondary mb-3 ps-2">We are committed to providing cakes that are as unique and special as the moments they celebrate. With a focus on freshness, flavor, and creativity, Sweety Cake House is your go-to destination for sweet indulgence.</p>
            <p class="mb-2 cover_msg">We are a fast-growing company, but we have never lost sight of our core values. We believe in collaboration, innovation, and customer satisfaction. We are always looking for new ways to improve our products and services.</p>

          </div>
        </div>
      </div>
    </div>
  </div>

 </section>

  <!-- login form  -->

 <section class="login_from text-center text-lg-start d-none" id="login">


  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right bg-body-tertiary" style="
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">Sign In now</h2>
           
            <form action="" method="post">
              
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" required autocomplete="off" />
                <label class="form-label" for="form3Example3">Email address</label>
              </div>

            
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="pass" name="pass" class="form-control" required autocomplete="off" />
                <label class="form-label" for="form3Example4">Password</label>
              </div>

              
              <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33"/>
                <label class="form-check-label" for="form2Example33">
                  Subscribe to our Email Service
                </label>
              </div>

             
              <button type="submit" name="login_submit" data-mdb-button-init data-mdb-ripple-init class="btn text-white btn-block mb-4 text-uppercase">
                Sign In
              </button>

              
              <div class="text-center">
                <p>Don't have an Account, <a class="register_link b_register">Sign Up</a> First.</p>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-1 mb-lg-0">
        <img src="./assest/img/login_form_cake.jpg" class="w-100 rounded-4 shadow-5 h-300 d-none d-md-block"
          alt="" loading="eager"/>
      </div>
    </div>
  </div>



 </section>

  <!-- registration form  -->

<section class="register_form text-center mb-5 d-none" id="register">
 
  <div class="header_img bg-image">
        <h1 class="text-center text-white align-items-center pt-2 mt-2"><span class="name_l1">S</span>weety <span class="name_l1">C</span>ake <span class="name_l1">H</span>ouse</h1>
        <img src="./assest/img/logo-w.png" alt="" width="200px" class="pt-3 mb-3">
        </div>
  

  <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
          <h2 class="fw-bold mb-5">Sign up now</h2>
          <form action="" method="post">

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="name" name="name" class="form-control" required autocomplete="off"/>
              <label class="form-label" for="form3Example3">Full Name</label>
            </div>

           
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" required autocomplete="off"/>
              <label class="form-label" for="form3Example3">Email address</label>
            </div>

            
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="pass" name="pass" class="form-control" required autocomplete="off"/>
              <label class="form-label" for="form3Example4">Password</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="cpass" name="cpass" class="form-control" required autocomplete="off"/>
              <label class="form-label" for="form3Example4">Confirm Password</label>
            </div>
      
            <div class="form-check d-flex justify-content-center mb-4">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33"/>
              <label class="form-check-label" for="form2Example33">
              I hereby confirm that all the information provided by me is accurate and complete to the best of my knowledge.
              </label>
            </div>

            <button type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn text-white btn-block mb-4">
              Sign up
            </button>

           
            <div class="text-center">
              <p>Do you have Already Registerd, Please <a class="login_link b_login" href="#login">Sign In</a> here.</p>
            </div>
          </form>
        </div>
        <div class="col-lg-6 d-none d-xl-block">
          <img src="./assest/img/register_cover.jpg" alt="" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- fotter  -->

 <?php
 include './includes/footer.php';
 
 ?>

 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="./js/navigation.js"></script>
    <script src="./js/darkmode.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/card.js"></script>
    <script src="./js/scroll_ani.js"></script>
    <script src="./js//scrol_ani_about.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>