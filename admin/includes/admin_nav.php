<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <span>'.$message.'</span>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';
   }
}
?>

<header class="header bg-light border-bottom py-3">
   <div class="container-fluid">


      <nav class="navbar navbar-expand-lg navbar-light">


         <a href="admin_page.php" class="navbar-brand text-decoration-none fw-bold fs-3">
            <img src="./../assest/img/logo-c.png" alt="Logo" class="img-fluid" width="100px" height="20px">
         </a>


         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>


         <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center">
               <li class="nav-item">
                  <a href="./admin_page.php" class="nav-link">Dashboard</a>
               </li>
               <li class="nav-item">
                  <a href="./admin_products.php" class="nav-link">ADD</a>
               </li>
               <li class="nav-item">
                  <a href="./admin_orders.php" class="nav-link">Orders</a>
               </li>
               <li class="nav-item">
                  <a href="./admin_users.php" class="nav-link">Users</a>
               </li>
               <li class="nav-item">
                  <a href="admin_contacts.php" class="nav-link">Feedbacks</a>
               </li>
            </ul>

 
            <ul class="navbar-nav ms-auto text-center m-2">
               <li class="nav-item">
                  <p class="mb-0 text-muted fw-bold">Username: <span class="fw-bold text-danger" style="text-transform: capitalize;"><?php echo $_SESSION['admin_name']; ?></span></p>             
               </li>
               <li class="nav-item mx-3">
                  <p class="text-muted fw-bold">Email: <span class="fw-bold text-danger"><?php echo $_SESSION['admin_email']; ?></span></p>
               </li>
               <li class="nav-item">
                  <a href="./functions/admin_logout_fun.php" class="btn btn-danger btn-sm mt-2 mt-lg-0">Logout</a>
               </li>
            </ul>
         </div>

      </nav>
   </div>
</header>



