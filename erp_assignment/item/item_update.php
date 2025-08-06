<?php 
include '../db.php';

$id = intval($_GET['id']);
$item = $conn->query("SELECT * FROM item WHERE id=$id")->fetch_assoc();

if (!$item) {
    echo "<script>alert('Item not found!'); window.location='item_list.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = trim($_POST["item_code"] ?? '');
    $item_name = trim($_POST["item_name"] ?? '');
    $item_category = trim($_POST["item_category"] ?? '');
    $item_sub_category = trim($_POST["item_subcategory"] ?? '');
    $quantity = $_POST["quantity"] ?? 0;
    $unit_price = $_POST["unit_price"] ?? 0;

    $stmt = $conn->prepare("UPDATE item SET item_code=?, item_name=?, item_category=?, item_subcategory=?, quantity=?, unit_price=? WHERE id=?");
    $stmt->bind_param("sssssdi", $item_code, $item_name, $item_category, $item_sub_category, $quantity, $unit_price, $id);
    $stmt->execute();

    echo "<script>alert('Item updated successfully!'); window.location='item_list.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255,255,255,0.95);
            padding: 35px 40px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.3);
            max-width: 550px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            color: #222;
        }
        label {
            font-weight: 600;
            color: #2c3e50;
        }
        .form-control:focus {
            border-color: #4ca1af;
            box-shadow: 0 0 6px #4ca1af;
        }
        button.btn-primary {
            background-color: #2c3e50;
            border-color: #2c3e50;
            transition: background-color 0.3s ease;
        }
        button.btn-primary:hover {
            background-color: #4ca1af;
            border-color: #4ca1af;
        }
        a.btn-secondary {
            margin-left: 10px;
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            transition: background-color 0.3s ease;
        }
        a.btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Item</h2>
    <form method="POST" novalidate>
        <div class="mb-3">
            <label for="item_code" class="form-label">Item Code</label>
            <input type="text" id="item_code" name="item_code" value="<?= htmlspecialchars($item['item_code']) ?>" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="item_name" class="form-label">Item Name</label>
            <input type="text" id="item_name" name="item_name" value="<?= htmlspecialchars($item['item_name']) ?>" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="item_category" class="form-label">Item Category</label>
            <input type="text" id="item_category" name="item_category" value="<?= htmlspecialchars($item['item_category']) ?>" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="item_subcategory" class="form-label">Item Sub Category</label>
            <input type="text" id="item_subcategory" name="item_subcategory" value="<?= htmlspecialchars($item['item_subcategory']) ?>" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" class="form-control" min="0" required />
        </div>
        <div class="mb-3">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="text" id="unit_price" name="unit_price" value="<?= htmlspecialchars($item['unit_price']) ?>" class="form-control" required />
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Update Item</button>
            <a href="item_list.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
</body>
</html>
