<?php
include '../db.php';
$id = intval($_GET['id']); // Security improvement
$result = $conn->query("SELECT * FROM customer WHERE id = $id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
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
        .form-container {
            background-color: rgba(255,255,255,0.95);
            padding: 35px 40px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #2c3e50;
        }
        label {
            font-weight: 600;
        }
        .btn-success {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }
        .btn-success:hover {
            background-color: #4ca1af;
            border-color: #4ca1af;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Edit Customer</h2>
    <form action="update_customer.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <select name="title" id="title" class="form-select" required>
                <option value="Mr" <?= $row['title'] == 'Mr' ? 'selected' : '' ?>>Mr</option>
                <option value="Mrs" <?= $row['title'] == 'Mrs' ? 'selected' : '' ?>>Mrs</option>
                <option value="Miss" <?= $row['title'] == 'Miss' ? 'selected' : '' ?>>Miss</option>
                <option value="Dr" <?= $row['title'] == 'Dr' ? 'selected' : '' ?>>Dr</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input name="fname" id="fname" value="<?= htmlspecialchars($row['first_name']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input name="lname" id="lname" value="<?= htmlspecialchars($row['last_name']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input name="contact" id="contact" value="<?= htmlspecialchars($row['contact_no']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">District</label>
            <input name="district" id="district" value="<?= htmlspecialchars($row['district']) ?>" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Update Customer</button>
        </div>
    </form>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
