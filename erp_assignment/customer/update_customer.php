<?php
include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        .btn-custom {
            background-color: #2c3e50;
            border-color: #2c3e50;
            color: white;
        }
        .btn-custom:hover {
            background-color: #4ca1af;
            border-color: #4ca1af;
        }
    </style>
</head>
<body>
<div class="container">
<?php
// Get data from form
$id = $_POST['id'] ?? '';
$title = $_POST['title'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$contact = $_POST['contact'] ?? '';
$district = $_POST['district'] ?? '';

// Simple validation
if ($id && $title && $fname && $lname && $contact && $district) {
    $stmt = $conn->prepare("UPDATE customer SET title=?, first_name=?, last_name=?, contact_no=?, district=? WHERE id=?");
    $stmt->bind_param("sssssi", $title, $fname, $lname, $contact, $district, $id);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Customer updated successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error updating customer: ' . htmlspecialchars($conn->error) . '</div>';
    }

    $stmt->close();
} else {
    echo '<div class="alert alert-warning">All fields are required.</div>';
}

$conn->close();
?>

    <div class="mt-4">
        <a href="view_customers.php" class="btn btn-custom">Back to Customer List</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
