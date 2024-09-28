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
            <a class="nav-link menu_item" href="#products">About US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu_item" href="#aboutus">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu_item" href="./contact.html">Contact Us</a>
          </li>
          <li class="nav-item"></li>
            <a class="nav-link menu_item" href="./oders.html">Oders</a>
          </li>
        </ul>
        <!-- <div class="btn_section">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active b_login_a" aria-current="page" href="#login"><button class="btn b_signin b_login btn-md border border-0">Sign In</button></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#register"><button class="btn b_signup b_register btn-md border border-0">Sign Up</button></a>
            </li>
          </ul>
        </div> -->

        <div class="btn_logout">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./functions/logout_fun.php"><button class="btn b_lout btn-md border border-0">Log Out</button></a>
            </li>
          </ul>
        </div>

        <div class="d-flex ms-1 cart_and_wishlist">
          <button class="btn border-0 text-center wish_btn">
            <i class="bi bi-bag-heart-fill text-white fs-4"></i><sup class="fs-5 text-white">0</sup>
          </button>
          <button class="btn border-0 text-center cart_btn">
          <i class="bi bi-cart-check-fill text-white fs-4"></i><sup class="fs-5 text-white">0</sup>
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