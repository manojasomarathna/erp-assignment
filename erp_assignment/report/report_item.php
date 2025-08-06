<?php
include '../db.php';

// Get unique items by name
$query = "SELECT item_name, item_category, item_subcategory, SUM(quantity) as total_quantity
          FROM item
          GROUP BY item_name, item_category, item_subcategory";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: #fff;
            min-height: 100vh;
            padding: 30px;
        }
        .report-box {
            background: #ffffff;
            color: #333;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container report-box">
        <h2>Item Report</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['item_name']) ?></td>
                    <td><?= htmlspecialchars($row['item_category']) ?></td>
                    <td><?= htmlspecialchars($row['item_subcategory']) ?></td>
                    <td><?= htmlspecialchars($row['total_quantity']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
