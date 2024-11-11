<?php
    session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirm</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css' integrity='sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==' crossorigin='anonymous' />
    <link rel="stylesheet" href="./css/oder_confirm.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="order-container">
        <h1>Order Confirmed!</h1>
        <p>Thank you for your purchase. Your order is being processed and we will be contact shortly.</p>
        <div class="order-id">Celebrate Your Events</div>
        <button class="cta-button mt-3" onclick="window.location.href='./home.php'">Return to Home</button>
    </div>
</body>

</html>