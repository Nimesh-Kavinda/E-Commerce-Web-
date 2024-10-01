<!doctype html>
<html lang="en" class="data-bs-theme">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sweety Cake House - Products</title>
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/darkmode.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
   
     <!-- Page navigation btn top and bottem  -->
   <button id="scrollBtn" class="btn btn-lg btn-secondary d-none d-md-block scroll-btn">
    <i id="scrollIcon" class="scrollIcon"></i> 
  </button>

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


   <!-- User Profile  -->
   <section class="user_profile">
   
    <div class="offcanvas offcanvas-end profile" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfileLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasProfileLabel">User Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="text-center mb-4">
        
          <img src="https://via.placeholder.com/150" alt="User Profile Picture" class="rounded-circle img-thumbnail">
        </div>
       
        <h4 class="text-center">Nimesh Kavinda</h4>
       
        
       
        <ul class="list-group mb-4 mt-3">
          <li class="list-group-item"><strong>Email:</strong> johndoe@example.com</li>
          <li class="list-group-item"><strong>Phone:</strong> +123 456 7890</li>
          <li class="list-group-item"><strong>Adress:</strong> New York, USA</li>

          <form action="" class="list-group">
          <input type="password" class="list-group-item" placeholder="Change Your Password">
          <input type="submit" class="btn btn-outline-primary mt-3" value="Change Password">
        </form>

        </ul>
  
        
        <div class="d-grid gap-2">
          <button class="btn btn-danger">Logout</button>
        </div>
      </div>
    </div>
  </section>
  

    <!-- End Of User Profile  -->








    <section class="heading">
        <h3>All Products</h3>
    </section>
    
    <section class="products">
    
    
       <div class="box-container">
    
                   <form action="" method="POST" class="box">
                      <div class="price">00</div>
                      <div class="image">
                         <img src="uploaded_img/" alt="">
                      </div>
                      <div class="name"></div>
                      <input type="hidden" name="product_quantity" value="1" min="0" class="qty">
                      <input type="hidden" name="product_id" value="">
                      <input type="hidden" name="product_name" value="">
                      <input type="hidden" name="product_price" value="">
                      <input type="hidden" name="product_image" value="">
                      <input type="submit" value="&#10084;" name="add_to_wishlist" class="option-btn">
                      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                   </form>
    
       </div>
    
    </section>
    <section class="products">
       
            <div class="category">
            <br>
            <br>
            <br>
            <br>
            <br>
             <br>
          <h2 style="font-size: 30px; text-align: center; margin-bottom: 20px;"></h2>
           
           <div class="box-container">
           
                    <form action="" method="POST" class="box">
                        <div class="price">Rs.00</div>
                        <div class="image">
                            <img src="uploaded_img/" alt="">
                        </div>
                        <div class="name"></div>
                        <input type="hidden" name="product_quantity" value="1" min="0" class="qty">
                        <input type="hidden" name="product_id" value="">
                        <input type="hidden" name="product_name" value="">
                        <input type="hidden" name="product_price" value="">
                        <input type="hidden" name="product_image" value="">
                        <input type="submit" value="&#10084;" name="add_to_wishlist" class="option-btn">
                        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    </form>
                   
            <p class="empty">No Products Available</p>
           </div>
           </div>
      
    </section>
    
    
    

















<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
<script src="./js/navigation.js"></script>
<script src="./js/darkmode.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</body>
</html>