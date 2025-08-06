<?php
include '../db.php';

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = trim($_POST["item_code"] ?? '');
    $item_name = trim($_POST["item_name"] ?? '');
    $item_category = trim($_POST["item_category"] ?? '');
    $item_sub_category = trim($_POST["item_subcategory"] ?? '');
    $quantity = $_POST["quantity"] ?? '';
    $unit_price = $_POST["unit_price"] ?? '';

    // Validation
    if ($item_code === '') $errors[] = "Item code is required.";
    if ($item_name === '') $errors[] = "Item name is required.";
    if ($item_category === '') $errors[] = "Item category is required.";
    if ($item_sub_category === '') $errors[] = "Item subcategory is required.";
    if (!is_numeric($quantity)) $errors[] = "Quantity must be numeric.";
    if (!is_numeric($unit_price)) $errors[] = "Unit price must be numeric.";

    if (count($errors) === 0) {
        $stmt = $conn->prepare("INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssid", $item_code, $item_name, $item_category, $item_sub_category, $quantity, $unit_price);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Database error: Failed to insert item.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 35px 40px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
            max-width: 550px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #222;
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
<div class="form-container">
    <?php if ($success): ?>
        <div class="alert alert-success text-center">
            Item added successfully!
        </div>
        <div class="text-center">
            <a href="item_list.php" class="btn btn-custom">Go to Item List</a>
            <a href="item_form.php" class="btn btn-outline-secondary ms-2">Add Another Item</a>
        </div>
    <?php else: ?>
        <h2>Add New Item</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="text-center mb-3">
            <a href="item_form.php" class="btn btn-outline-secondary">Back to Form</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
