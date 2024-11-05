<nav class="navbar navbar-expand-lg shadow" id="nav">

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
            <a class="nav-link menu_item" href="./home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu_item" href="./about_us.php">About US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu_item" href="./products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu_item" href="./contact.php">Contact Us</a>
          </li>
          <li class="nav-item"></li>
            <a class="nav-link menu_item" href="./oders.php">Oders</a>
          </li>
        </ul>

        <div class="btn_logout">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./functions/logout_fun.php"  onclick="return confirmLogout();"><button class="btn b_lout btn-md border border-0">Log Out</button></a>
            </li>
          </ul>
        </div>

        <div class="d-flex ms-1 cart_and_wishlist">

                <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
                 ?>

          <button class="btn border-0 text-center wish_btn">
            <a href="./wishlist.php" class="text-decoration-none"><i class="bi bi-bag-heart-fill text-white fs-4"></i><sup class="fs-5 text-white"><?php echo $wishlist_num_rows; ?></sup></a>
          </button>

          <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>

          <button class="btn border-0 text-center cart_btn">
          <a href="./cart.php" class="text-decoration-none"><i class="bi bi-cart-check-fill text-white fs-4"></i><sup class="fs-5 text-white"><?php echo $cart_num_rows; ?></sup></a>
        </button>

    

        <button class="btn border-0 text-center profile_btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile" aria-controls="offcanvasProfile">
          <i class="bi bi-person-square text-white fs-4"></i>
        </button>
          
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
  
  <script src="./js/confirm.js"></script>