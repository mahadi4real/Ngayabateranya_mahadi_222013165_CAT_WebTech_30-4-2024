<?php
include('db_connection.php');

// Check if customer Id is set
if (isset($_REQUEST['customer_id'])) {
  $customer_id = $_REQUEST['customer_id'];

  $stmt = $connection->prepare("SELECT * FROM sale WHERE customer_id=?");
  $stmt->bind_param("i", $customer_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['customer_id'];
    $y = $row['vehicle_id'];
    $z = $row['SaleDate'];
    $w = $row['TotalAmount'];
    $t = $row['sale_id'];
    
  } else {
    echo "Sale not found.";
  }
}

$stmt->close(); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Sale</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Sale form -->
    <h2><u>Update Form of Sale</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="customer_id">customer Id:</label>
    <input type="text" name="customer Id" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="vehicle_id">vehicle_id:</label>
    <input type="text" name="vehicle_id" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="SaleDate">SaleDate:</label>
    <input type="date" name="SaleDate" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <label for="sale_id">Sale Id:</label>
    <input type="text" name="sale_id" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $customer_id3 = $_POST['customer_id'];
  $vehicle_id3 = $_POST['vehicle_id'];
  $SaleDate2 = $_POST['SaleDate'];
  $TotalAmount2 = $_POST['TotalAmount'];
  $sale_id2 = $_POST['sale_id'];
  

  // Update the Sale in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE sale SET vehicle_id3=?, SaleDate2=?, TotalAmount2=?, sale_id2=? WHERE customer_id3=?");
  $stmt->bind_param("isssi", $vehicle_id3, $SaleDate2, $TotalAmount2, $sale_id2, $customer_id3);
  $stmt->execute();

  // Redirect to sale.php
  header('Location: sale.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>