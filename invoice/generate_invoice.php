<?php
require_once '../classes/Database.php';
require_once '../classes/Cart.php';
require_once '../lib/TCPDF-main/TCPDF-main/tcpdf.php'; // Include TCPDF library

// Initialize database connection and cart
$database = new Database();
$db = $database->connect();
$cart = new Cart($db);
$cartContents = $cart->getCartContents();

// Check if cart is empty
if (empty($cartContents)) {
    die("Your cart is empty!");
}

// Initialize PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator('Your Company Name');
$pdf->SetAuthor('Your Company Name');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');

// Set page margins (optional)
$pdf->SetMargins(15, 15, 15);

// Add a page
$pdf->AddPage();

// Define company information
$companyName = 'Sunglass Store';
$companyPhone = '+1(647)272-8617';
$companyEmail = 'sunglass@gmail.com';

// Construct company information content
$companyInfo = "<div class='company-info'>{$companyName}</div>";
$companyInfo .= "<div class='company-info'>Phone: {$companyPhone}</div>";
$companyInfo .= "<div class='company-info'>Email: {$companyEmail}</div>";

// Construct invoice header
$header = "<h2 class='invoice-header'>Invoice</h2>";
$header .= "<h3 class='invoice-header'>Order Details</h3>";

// Start building the table
$table = "<table class='invoice-table'>";
$table .= "<tr>
    <th class='table-header'>Product Name</th>
    <th class='table-header'>Price</th>
    <th class='table-header'>Quantity</th>
    <th class='table-header'>Total</th>
</tr>";

$total = 0; // Initialize total cost

// Populate table with cart contents
foreach ($cartContents as $item) {
    $itemTotal = $item['price'] * $item['quantity'];
    $total += $itemTotal;
    $table .= "<tr class='table-row'>
        <td class='table-cell'>{$item['name']}</td>
        <td class='table-cell'>\${$item['price']}</td>
        <td class='table-cell'>{$item['quantity']}</td>
        <td class='table-cell'>\${$itemTotal}</td>
    </tr>";
}

// Close the table and display the total with right alignment
$table .= "<tr class='table-row'>
    <td colspan='3' class='table-cell'>Grand Total</td>
    <td class='table-cell'>\${$total}</td>
</tr></table>";

// Combine all content
$content = $companyInfo . $header . $table;

// Print text using writeHTML()
$pdf->writeHTML($content, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('invoice.pdf', 'I'); // This will send the PDF to the browser for downloading
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><style>
.company-info {
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 10px;
    }
    
    .invoice-header {
        text-align: center;
    }
    
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table-header {
        text-align: left;
        width: 50%;
        border: 1px solid black;
        padding: 5px;
    }
    
    .table-cell {
        text-align: right;
        border: 1px solid black;
        padding: 5px;
    }
    
    .table-row {
        border: 1px solid black;
    }
</style>
</body>
</html>
