<?php

@include '../includes/db.php';


$user_id = $_SESSION['user_id'];

if (isset($_POST['update_password'])) {
    $current_pass = md5(mysqli_real_escape_string($conn, $_POST['current_pass']));
    $new_pass = md5(mysqli_real_escape_string($conn, $_POST['new_pass']));
    $confirm_new_pass = md5(mysqli_real_escape_string($conn, $_POST['confirm_new_pass']));

    $check_current_pass = mysqli_query($conn, "SELECT password FROM `users` WHERE id = '$user_id' AND password = '$current_pass'") or die('query failed');
    
    if (mysqli_num_rows($check_current_pass) === 0) {
        $message[] = 'Current password is incorrect!';
    } elseif ($new_pass != $confirm_new_pass) {
        $message[] = 'New passwords do not match!';
    } else {
        mysqli_query($conn, "UPDATE `users` SET password = '$new_pass' WHERE id = '$user_id'") or die('query failed');
        $message[] = 'Password updated successfully!';
    }
}
?>

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

          <form action="" method="post" class="list-group mt-4">
        <h6>Change Your Password</h6>
        <input type="password" name="current_pass" class="list-group-item mb-2" placeholder="Enter Current Password" required>
        <input type="password" name="new_pass" class="list-group-item mb-2" placeholder="Enter New Password" required>
       <input type="password" name="confirm_new_pass" class="list-group-item mb-2" placeholder="Confirm New Password" required>
       <input type="submit" name="update_password" class="btn btn-outline-primary mt-3" value="Change Password">
     </form>


        </ul>
  
        
        <div class="d-grid gap-2 btn_logout">
        <a class="text-center text-white" href="./functions/logout_fun.php"><button class="btn b_lout w-75"  onclick="return confirmLogout();">Logout</button></a>
        <a class="text-center text-white" href="./functions/user_acc_delete_fun.php"><button class="btn b_delete w-75"  onclick="return confirmDeleteAcc();">Delete Account</button></a>

        </div>
      </div>
    </div>
  </section>

  <script src="./js/confirm.js"></script>