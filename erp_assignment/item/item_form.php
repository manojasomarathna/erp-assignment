<?php
include '../db.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    // Basic validation (optional)
    if (empty($item_code) || empty($item_name) || empty($item_category) || empty($item_subcategory) || !is_numeric($quantity) || !is_numeric($unit_price)) {
        $error = "Please fill all fields correctly.";
    } else {
        // Prepared statement for safety
        $stmt = $conn->prepare("INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiid", $item_code, $item_name, $item_category, $item_subcategory, $quantity, $unit_price);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Item added successfully!');
                    window.location.href = 'item_list.php';
                  </script>";
            exit;
        } else {
            $error = "Error adding item: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #fff;
        }
        .form-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 100%;
            color: #000;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #222;
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
<div class="form-box">
    <h2>Add Item</h2>

    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Item Code</label>
            <input type="text" name="item_code" class="form-control" required value="<?= isset($item_code) ? htmlspecialchars($item_code) : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" required value="<?= isset($item_name) ? htmlspecialchars($item_name) : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Item Category</label>
            <select name="item_category" class="form-select" required>
                <option value="">--Select--</option>
                <option value="1" <?= (isset($item_category) && $item_category == '1') ? 'selected' : '' ?>>Printers</option>
                <option value="2" <?= (isset($item_category) && $item_category == '2') ? 'selected' : '' ?>>Laptops</option>
                <option value="3" <?= (isset($item_category) && $item_category == '3') ? 'selected' : '' ?>>Gadgets</option>
                <option value="4" <?= (isset($item_category) && $item_category == '4') ? 'selected' : '' ?>>Ink Bottles</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Item Subcategory</label>
            <select name="item_subcategory" class="form-select" required>
                <option value="">--Select--</option>
                <option value="1" <?= (isset($item_subcategory) && $item_subcategory == '1') ? 'selected' : '' ?>>HP</option>
                <option value="2" <?= (isset($item_subcategory) && $item_subcategory == '2') ? 'selected' : '' ?>>Dell</option>
                <option value="3" <?= (isset($item_subcategory) && $item_subcategory == '3') ? 'selected' : '' ?>>Lenovo</option>
                <option value="5" <?= (isset($item_subcategory) && $item_subcategory == '5') ? 'selected' : '' ?>>Samsung</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required value="<?= isset($quantity) ? htmlspecialchars($quantity) : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Unit Price</label>
            <input type="text" name="unit_price" class="form-control" required value="<?= isset($unit_price) ? htmlspecialchars($unit_price) : '' ?>">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Add Item</button>
        </div>
    </form>
</div>
</body>
</html>
