Project Folder Structure

erp_assignment/
│
├── index.php
├── db.php
│
│
├── customer/
│   ├── add_customer.php
│   ├── view_customers.php
│   ├── edit_customer.php
│   ├── delete_customer.php
│   └── update_customer.php
│
├── item/
│   ├── item_form.php
│   ├── item_list.php
│   ├── item_update.php
│   └── delete_item.php
│
├── reports/
│   ├── report_invoice.php
│   ├── report_invoice_item.php
│   └── report_item.php
│
└── README.txt





http://localhost/erp_assignment/index.php
http://localhost/erp_assignment/customer/edit_customer.php?id=3
http://localhost/erp_assignment/customer/add_customer.php
http://localhost/erp_assignment/customer/insert_customer.php
http://localhost/erp_assignment/customer/view_customers.php
http://localhost/erp_assignment/customer/update_customer.php
http://localhost/erp_assignment/customerdelete_customer.php


http://localhost/erp_assignment/item/item_update.php?id=3
http://localhost/erp_assignment/item/item_list.php
http://localhost/erp_assignment/item/item_form.php
http://localhost/erp_assignment/item/item_list.php?search=kl9956
http://localhost/erp_assignment/item/item_list.php?delete=2
http://localhost/erp_assignment/item/insert_item.php




http://localhost/erp_assignment/report/report_invoice.php?start=2025-08-01&end=2025-08-05
http://localhost/erp_assignment/report/report_invoice_item.php?start=2025-08-01&end=2025-08-30
http://localhost/erp_assignment/report/report_item.php








ERP System for Software Interns
===============================

Project Overview
----------------
This ERP system is developed using PHP and MySQL. It supports basic operations like inserting, updating, deleting, and searching system data.

Features Implemented:
1. Customer Management
   - Register and view customers
   - Fields: Title, First Name, Last Name, Contact Number, District
   - Includes form validation

2. Item Management
   - Register and view items
   - Fields: Item Code, Item Name, Item Category, Item Subcategory, Quantity, Unit Price
   - Includes form validation

3. Reports
   - Invoice Report: Search by date range; shows Invoice No, Date, Customer, Customer District, Item Count, Invoice Amount
   - Invoice Item Report: Search by date range; shows Invoice No, Invoice Date, Customer Name, Item Name & Code, Item Category, Unit Price
   - Item Report: Lists unique items with category, subcategory, and quantity

Database
---------
- Import the provided SQL dump file (`assignment.sql`) into your MySQL server.
- Database name: `assignment`
- Make sure to update database connection settings (`db.php`) with your MySQL credentials.

Setup Instructions
-------------------
1. Install XAMPP or any PHP-MySQL development environment.
2. Place the project folder inside the web server directory (`htdocs` for XAMPP).
3. Import the `assignment.sql` file into MySQL via phpMyAdmin or MySQL command line.
4. Update database connection settings in `db.php` (host, username, password, database).
5. Open the browser and navigate to the project URL, e.g., `http://localhost/erp_assignment/index.php`.
6. Use the navigation bar to access Customer and Item forms and view reports.
7. Use the date filters in reports to search for data within specific date ranges.

Assumptions
-----------
- Contact number is stored as a string with a fixed length of 10 digits.
- District names are predefined and selectable.
- Item categories and subcategories are stored in separate tables for easy selection.
- Basic form validation is implemented in PHP and HTML.
- Bootstrap 5 is used for responsive and clean UI design.

How to Use
----------
- Register customers and items via respective forms.
- Use the report section to view invoice and item data filtered by date.
- The system supports search, insert, update, and delete functionalities as per the assignment.

GitHub Repository
-----------------
Link to the GitHub repo: https://github.com/manojasomarathna/erp-assignment

Contact
-------
For any queries, contact:
- Your Name: manojamsomarathna@gmail.com
- contact: 0742770633
- HR: hr@csquarefintech.com
- luckshinif@csquarefintech.com
- support@csqure.cloud


---

Thank you!
