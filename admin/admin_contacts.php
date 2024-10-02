<?php

@include '../includes/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/admin_page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
   
<?php @include './includes/admin_nav.php'; ?>

<section class="messages container my-4">

    <h1 class="title text-center mb-4 text-muted"><i class="bi bi-chat-heart text-danger"></i> Messages</h1>

    <div class="row">
        <div class="col-12">
            <div class="box-container">
                <?php
                $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                if (mysqli_num_rows($select_message) > 0) {
                    while ($fetch_message = mysqli_fetch_assoc($select_message)) {
                        ?>
                        <div class="box card mb-3 p-3">
                            <p>User id: <span class="fw-bold"><?php echo $fetch_message['user_id']; ?></span></p>
                            <p>Name: <span class="fw-bold" style="text-transform: capitalize;"><?php echo $fetch_message['name']; ?></span></p>
                            <p>Phone Number: <span class="fw-bold"><?php echo $fetch_message['number']; ?></span></p>
                            <p>Email: <span class="fw-bold"><?php echo $fetch_message['email']; ?></span></p>
                            <p>Message: <span class="fw-bold" style="text-transform: capitalize;"><?php echo $fetch_message['message']; ?></span></p>
                            <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="btn btn-danger w-25">Delete</a>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p class="text-center text-muted">You have no messages!</p>';
                }
                ?>
            </div>
        </div>
    </div>

</section>

<?php @include './includes/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
