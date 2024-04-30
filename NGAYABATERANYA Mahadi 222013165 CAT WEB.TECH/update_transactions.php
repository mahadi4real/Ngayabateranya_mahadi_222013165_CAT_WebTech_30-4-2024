<?php
include('db_connection.php');

// Check if Payment Method is set
if (isset($_REQUEST['PaymentMethod'])) {
  $equip_id = $_REQUEST['PaymentMethod'];

  $stmt = $connection->prepare("SELECT * FROM transactions WHERE PaymentMethod=?");
  $stmt->bind_param("i", $equip_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['PaymentMethod'];
    $y = $row['TransactionDate'];
    $z = $row['Amount'];
    $w = $row['transaction_id'];
    $t = $row['sale_id'];
    
  } else {
    echo "PaymentMethod  not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Transactions </title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Transaction  form -->
    <h2><u>Update Form of Transactions </u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="TransactionDate">TransactionDate:</label>
    <input type="text" name="TransactionDate" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="PaymentMethod">PaymentMethod:</label>
    <input type="text" name="PaymentMethod" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="Amount"> Amount:</label>
    <input type="number" name="Amount" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <label for="transaction_id"> transaction_id:</label>
    <input type="text" name="transaction_id" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

     <label for="sale_id"> sale_id:</label>
    <input type="text" name="sale_id" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br> 

    <input type="submit" name="up" value="Update">

  </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $PaymentMethod1 = $_POST['PaymentMethod'];
  $TransactionDate1 = $_POST['TransactionDate'];
  $Amount1 = $_POST['Amount'];
  $transaction_id1 = $_POST['transaction_id'];
  $sale_id3 = $_POST['sale_id'];

  $stmt = $connection->prepare("UPDATE transactions SET PaymentMethod1=?, TransactionDate1=?,Amount1=?, transaction_id1=? , sale_id3=? WHERE TransactionDate1=?");
  $stmt->bind_param("issssi", $PaymentMethod1, $TransactionDate1, $Amount1, $transaction_id1, $sale_id3);
  $stmt->execute();

  // Redirect to equipment.php
  header('Location: transactions.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>