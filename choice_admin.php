<?php

@include './includes/db.php';

session_start();

$user_id = $_SESSION['user_id'];
$admin_id = $_SESSION['admin_id'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Cake House - Popup Card</title>
  <link rel="stylesheet" href="./css/choice_admin.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


  <button type="button" class="btn btn-primary d-none" id="modalTrigger" data-bs-toggle="modal" data-bs-target="#welcomeModal">
    Launch Welcome Modal
  </button>


  <div class="modal fade box" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true" 
       data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title px-2" id="welcomeModalLabel">Hey! Welcome to <span class="fw-bold fs-3">Sweety Cake House</span> Online Shop</h5>
        </div>
        <div class="modal-body text-center">
          <p>Welcome to Sweet Cake House! As a <span class="fw-bold">Admin</span>, Please choose one of the options below to continue:</p>
        </div>
        <div class="modal-footer justify-content-center box_button">
          <a href="./home.php" class="btn btn_user">Vist as User</a>
          <a href="./admin/admin_page.php" class="btn btn_admin">Visit as Admin</a>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var modalTrigger = document.getElementById('modalTrigger');
      modalTrigger.click(); 
    });
  </script>

</body>
</html>
