<?php include '../db.php';

// Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM item WHERE id=$id");
    header("Location: ".$_SERVER['PHP_SELF']); // Redirect to avoid resubmission
    exit;
}

// Search
$search = $_GET['search'] ?? '';
$search_esc = $conn->real_escape_string($search);
if (!empty($search)) {
    $result = $conn->query("SELECT * FROM item WHERE item_name LIKE '%$search_esc%' OR item_code LIKE '%$search_esc%'");
} else {
    $result = $conn->query("SELECT * FROM item");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Item List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.3);
            padding: 30px 40px;
            max-width: 1100px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            color: #222;
        }
        form.mb-3 {
            max-width: 400px;
            margin: 0 auto 30px auto;
        }
        .btn-success {
            background-color: #2c3e50;
            border-color: #2c3e50;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #4ca1af;
            border-color: #4ca1af;
        }
        table {
            border-collapse: separate;
            border-spacing: 0 10px;
            width: 100%;
        }
        th {
            background-color: #2c3e50;
            color: white;
            font-weight: 600;
            padding: 12px 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        td {
            background-color: #f7f9fa;
            padding: 12px 15px;
            text-align: center;
            border-bottom: 10px solid transparent;
        }
        tr:hover td {
            background-color: #d0e7f9;
        }
        a.btn-warning {
            background-color: #f0ad4e;
            border-color: #eea236;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        a.btn-warning:hover {
            background-color: #ec971f;
            border-color: #d58512;
            color: #fff;
        }
        a.btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        a.btn-danger:hover {
            background-color: #c9302c;
            border-color: #ac2925;
            color: #fff;
        }
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                display: none;
            }
            tr {
                margin-bottom: 15px;
                border-bottom: 2px solid #4ca1af;
                padding-bottom: 10px;
            }
            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                top: 12px;
                font-weight: 600;
                color: #2c3e50;
                text-align: left;
            }
            form.mb-3 {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Item List</h2>

    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search by name or code" value="<?= htmlspecialchars($search) ?>" />
    </form>

    <a href="item_form.php" class="btn btn-success mb-3">Add New Item</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Item Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td data-label="ID"><?= $row['id'] ?></td>
                <td data-label="Item Code"><?= htmlspecialchars($row['item_code']) ?></td>
                <td data-label="Name"><?= htmlspecialchars($row['item_name']) ?></td>
                <td data-label="Category"><?= htmlspecialchars($row['item_category']) ?></td>
                <td data-label="Sub Category"><?= htmlspecialchars($row['item_subcategory']) ?></td>
                <td data-label="Quantity"><?= $row['quantity'] ?></td>
                <td data-label="Unit Price"><?= $row['unit_price'] ?></td>
                <td data-label="Actions">
                    <a href="item_update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this item?')" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
