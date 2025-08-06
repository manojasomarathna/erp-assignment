<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ERP System - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #1a1a1a;
        }
        .container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }
        .btn-group a {
            margin: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ERP System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="customer/add_customer.php">Add Customer</a></li>
                    <li class="nav-item"><a class="nav-link" href="customer/view_customers.php">View Customers</a></li>
                    <li class="nav-item"><a class="nav-link" href="item/item_form.php">Add Item</a></li>
                    <li class="nav-item"><a class="nav-link" href="item/item_list.php">View Items</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reports</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="report/report_invoice.php">Invoice Report</a></li>
                            <li><a class="dropdown-item" href="report/report_invoice_item.php">Invoice Item Report</a></li>
                            <li><a class="dropdown-item" href="report/report_item.php">Item Report</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Welcome to ERP Assignment System</h1>
        <p>Please use the navigation bar to manage data or view reports.</p>
        <div class="btn-group">
            <a href="customer/add_customer.php" class="btn btn-outline-light">Register Customer</a>
            <a href="item/item_form.php" class="btn btn-outline-light">Register Item</a>
            <a href="report/report_invoice.php" class="btn btn-outline-light">Invoice Report</a>
            <a href="report/report_invoice_item.php" class="btn btn-outline-light">Invoice Item Report</a>
            <a href="report/report_item.php" class="btn btn-outline-light">Item Report</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
