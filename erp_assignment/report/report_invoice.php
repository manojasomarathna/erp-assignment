<?php
include '../db.php';

// Get start and end dates from GET, if not set use current month first day and today
$start = $_GET['start'] ?? date('Y-m-01');
$end = $_GET['end'] ?? date('Y-m-d');

// Prepare query with parameterized statement to avoid SQL injection
$query = "SELECT i.invoice_no, i.date, 
                 CONCAT(c.title, ' ', c.first_name, ' ', c.middle_name, ' ', c.last_name) AS customer_name,
                 d.district, i.item_count, i.amount
          FROM invoice i
          JOIN customer c ON i.customer = c.id
          JOIN district d ON c.district = d.id
          WHERE i.date BETWEEN ? AND ?
          ORDER BY i.date ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $start, $end);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            min-height: 100vh;
            padding: 40px;
            color: #fff;
        }
        .report-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            color: #000;
        }
        h2 {
            text-align: center;
            color: #222;
        }
    </style>
</head>
<body>
<div class="container report-box">
    <h2>Invoice Report</h2>
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-5">
            <label class="form-label">Start Date</label>
            <input type="date" name="start" class="form-control" value="<?= htmlspecialchars($start) ?>" required>
        </div>
        <div class="col-md-5">
            <label class="form-label">End Date</label>
            <input type="date" name="end" class="form-control" value="<?= htmlspecialchars($end) ?>" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-dark w-100">Search</button>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Customer</th>
                <th>District</th>
                <th>Item Count</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['invoice_no']) ?></td>
                <td><?= htmlspecialchars($row['date']) ?></td>
                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                <td><?= htmlspecialchars($row['district']) ?></td>
                <td><?= htmlspecialchars($row['item_count']) ?></td>
                <td><?= htmlspecialchars($row['amount']) ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">No records found for selected date range.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
