<?php
include '../db.php';

$start = $_GET['start'] ?? date('Y-m-01');
$end = $_GET['end'] ?? date('Y-m-d');

$query = "SELECT im.invoice_no, i.date, c.first_name, it.item_code, it.item_name, it.item_category, im.unit_price
          FROM invoice_master im
          JOIN invoice i ON im.invoice_no = i.invoice_no
          JOIN customer c ON i.customer = c.id
          JOIN item it ON im.item_id = it.id
          WHERE i.date BETWEEN '$start' AND '$end'";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Invoice Item Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            color: #fff;
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.3);
            color: #333;
            max-width: 1100px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #222;
            font-weight: 700;
        }
        form.row.g-3 {
            justify-content: center;
            margin-bottom: 30px;
        }
        input[type="date"] {
            max-width: 180px;
        }
        .btn-primary {
            background-color: #2c3e50;
            border-color: #2c3e50;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #4ca1af;
            border-color: #4ca1af;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }
        th {
            background-color: #2c3e50;
            color: #fff;
            font-weight: 600;
            padding: 12px 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        td {
            background-color: #f7f9fa;
            color: #333;
            padding: 12px 15px;
            text-align: center;
            border-bottom: 8px solid transparent;
        }
        tr:hover td {
            background-color: #d0e7f9;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }
            input[type="date"] {
                max-width: 100%;
            }
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
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Invoice Item Report</h2>
        <form method="GET" class="row g-3">
            <div class="col-auto">
                <input type="date" name="start" class="form-control" value="<?= htmlspecialchars($start) ?>" />
            </div>
            <div class="col-auto">
                <input type="date" name="end" class="form-control" value="<?= htmlspecialchars($end) ?>" />
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td data-label="Invoice No"><?= htmlspecialchars($row['invoice_no']) ?></td>
                    <td data-label="Date"><?= htmlspecialchars($row['date']) ?></td>
                    <td data-label="Customer"><?= htmlspecialchars($row['first_name']) ?></td>
                    <td data-label="Item Code"><?= htmlspecialchars($row['item_code']) ?></td>
                    <td data-label="Item Name"><?= htmlspecialchars($row['item_name']) ?></td>
                    <td data-label="Category"><?= htmlspecialchars($row['item_category']) ?></td>
                    <td data-label="Unit Price"><?= htmlspecialchars($row['unit_price']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
