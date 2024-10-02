<?php

@include '../includes/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

if(isset($_POST['update_user_type'])){
   $update_user_id = $_POST['user_id'];
   $new_user_type = $_POST['user_type'];
   mysqli_query($conn, "UPDATE `users` SET user_type = '$new_user_type' WHERE id = '$update_user_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>
   <link rel="stylesheet" href="../css/admin_page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
   
<?php @include './includes/admin_nav.php'; ?>

<section class="container my-5">
   <h1 class="text-center mb-4 text-muted"><i class="bi bi-people text-danger"></i> Users</h1>

   <div class="row">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="col-md-4 mb-4">
         <div class="card p-3 shadow-sm">
            <p><strong>User ID:</strong> <span><?php echo $fetch_users['id']; ?></span></p>
            <p><strong>Username:</strong> <span style="text-transform: capitalize;"><?php echo $fetch_users['name']; ?></span></p>
            <p><strong>Email:</strong> <span><?php echo $fetch_users['email']; ?></span></p>
            <p><strong>Type:</strong> <span style="text-transform: capitalize;" class="<?php if($fetch_users['user_type'] == 'admin'){ echo 'text-danger'; } ?>"><?php echo $fetch_users['user_type']; ?></span></p>

            <form action="admin_users.php" method="post">
               <input type="hidden" name="user_id" value="<?php echo $fetch_users['id']; ?>">
               <div class="mb-3">
                  <label for="user_type" class="form-label text-danger fw-bold">Change User Type</label>
                  <select name="user_type" class="form-select" required>
                     <option value="user" <?php if($fetch_users['user_type'] == 'user'){ echo 'selected'; } ?>>User</option>
                     <option value="admin" <?php if($fetch_users['user_type'] == 'admin'){ echo 'selected'; } ?>>Admin</option>
                  </select>
               </div>
               <input type="submit" name="update_user_type" value="Update Type" class="btn btn-secondary w-100">
            </form>

            <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Delete this user?');" class="btn btn-danger mt-3 w-100">Delete User</a>
         </div>
      </div>
      <?php
            }
         }
      ?>
   </div>
</section>

<?php @include './includes/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
