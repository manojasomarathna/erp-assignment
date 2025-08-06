<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form field names samāna vidhiyen ganna
    $title = $_POST['title'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $contact = $_POST['contact_no'];
    $district = $_POST['district'];

    // Prepared statement eka hadamu
    $stmt = $conn->prepare("INSERT INTO customer (title, first_name, last_name, contact_no, district) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $fname, $lname, $contact, $district);

    if ($stmt->execute()) {
        // Success alert + redirect
        echo "<script>
                alert('Customer added successfully!');
                window.location = 'view_customers.php';
              </script>";
        exit;
    } else {
        // Error handling - lassanā message ekak
        $error = $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #222;
        }
        .form-label {
            font-weight: 500;
        }
        .error-message {
            color: red;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Register Customer</h2>

    <?php if (!empty($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <select class="form-select" name="title" id="title" required>
                <option value="">--Select--</option>
                <option value="Mr" <?= (isset($title) && $title == 'Mr') ? 'selected' : '' ?>>Mr</option>
                <option value="Mrs" <?= (isset($title) && $title == 'Mrs') ? 'selected' : '' ?>>Mrs</option>
                <option value="Miss" <?= (isset($title) && $title == 'Miss') ? 'selected' : '' ?>>Miss</option>
                <option value="Dr" <?= (isset($title) && $title == 'Dr') ? 'selected' : '' ?>>Dr</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" required value="<?= isset($fname) ? htmlspecialchars($fname) : '' ?>">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" required value="<?= isset($lname) ? htmlspecialchars($lname) : '' ?>">
        </div>

        <div class="mb-3">
            <label for="contact_no" class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact_no" id="contact_no" required value="<?= isset($contact) ? htmlspecialchars($contact) : '' ?>">
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">District</label>
            <select class="form-select" name="district" id="district" required>
                <option value="">--Select--</option>
                <option value="Colombo" <?= (isset($district) && $district == 'Colombo') ? 'selected' : '' ?>>Colombo</option>
                <option value="Kandy" <?= (isset($district) && $district == 'Kandy') ? 'selected' : '' ?>>Kandy</option>
                <option value="Galle" <?= (isset($district) && $district == 'Galle') ? 'selected' : '' ?>>Galle</option>
                <option value="Kurunegala" <?= (isset($district) && $district == 'Kurunegala') ? 'selected' : '' ?>>Kurunegala</option>
                <option value="Matara" <?= (isset($district) && $district == 'Matara') ? 'selected' : '' ?>>Matara</option>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Add Customer</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
