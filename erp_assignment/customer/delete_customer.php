<?php
include '../db.php';
session_start(); // Start session

// Validate and sanitize ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Prepared statement to securely delete
    $stmt = $conn->prepare("DELETE FROM customer WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Customer deleted successfully.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error deleting customer: " . htmlspecialchars($conn->error);
        $_SESSION['msg_type'] = "danger";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid customer ID.";
    $_SESSION['msg_type'] = "warning";
}

$conn->close();

// Redirect with feedback
header("Location: view_customers.php");
exit();
?>
