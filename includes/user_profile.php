<section class="user_profile">
   
    <div class="offcanvas offcanvas-end profile" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfileLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasProfileLabel">User Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="text-center mb-4">
        
          <img src="./assest/img/user_icon2.png" alt="User Profile Picture" class="rounded-circle img-thumbnail" style="width: 250px">
        </div>
       
        <h4 class="text-center"><?php echo $_SESSION['user_name']; ?></h4>
       
        
       
        <ul class="list-group mb-4 mt-3">
          <li class="list-group-item"><strong>Email:</strong> <?php echo $_SESSION['user_email']; ?></li>

          <!-- <form action="" class="list-group">
          <input type="password" class="list-group-item" placeholder="Change Your Password">
          <input type="submit" class="btn btn-outline-primary mt-3" value="Change Password">
        </form> -->

        </ul>
  
        
        <div class="d-grid gap-2 btn_logout">
        <a class="text-center text-white" href="./functions/logout_fun.php"><button class="btn b_lout w-75"  onclick="return confirmLogout();">Logout</button></a>
        <a class="text-center text-white" href="./functions/user_acc_delete_fun.php"><button class="btn b_delete w-75"  onclick="return confirmDeleteAcc();">Delete Account</button></a>

        </div>
      </div>
    </div>
  </section>

  <script src="./js/confirm.js"></script>