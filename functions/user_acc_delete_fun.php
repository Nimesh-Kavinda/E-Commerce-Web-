<?php

session_start();


require '../includes/db.php'; 


if (isset($_SESSION['user_id'])) {

    $userId = $_SESSION['user_id'];


    $sql = "DELETE FROM users WHERE id = ?";
    

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $userId);
        

        if ($stmt->execute()) {
            echo "Account deleted successfully.";
  
            session_destroy(); 
            header("Location: ../index.php"); 
            exit;
        } else {
            echo "Error deleting account: " . $stmt->error;
        }
        

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "No user is logged in.";
}


$conn->close();
?>
