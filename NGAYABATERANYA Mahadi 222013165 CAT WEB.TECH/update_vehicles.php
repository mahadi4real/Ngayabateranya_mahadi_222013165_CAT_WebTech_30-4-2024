<?php
include('db_connection.php');

// Check if Make is set
if (isset($_REQUEST['Make'])) {
  $payid = $_REQUEST['Make'];

  $stmt = $connection->prepare("SELECT * FROM vehicles WHERE Make=?");
  $stmt->bind_param("i", $payid);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['Make'];
    $y = $row['color'];
    $z = $row['price'];
    $w = $row['seats'];
    $t = $row['vehicle_id'];
    
  } else {
    echo "Vehicle not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update payment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payment form -->
    <h2><u>Update Form of Vehicles</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="color">color:</label>
    <input type="text" name="color" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="Make">Make:</label>
    <input type="text" name="Make" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="seats">Seats:</label>
    <input type="text" name="seats" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <label for="vehicle_id">vehicle_id:</label>
    <input type="text" name="payMthd" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $color1 = $_POST['color'];
  $Make1 = $_POST['Make'];
  $seats1 = $_POST['seats'];
  $vehicle_id4 = $_POST['vehicle_id'];
  

  $stmt = $connection->prepare("UPDATE payment SET color1=?, Make1=?, seats1=?, vehicle_id4=? WHERE Make1");
  $stmt->bind_param("issssi", $color1, $Make1, $seats1, $vehicle_id4);
  $stmt->execute();

  // Redirect to payment.php
  header('Location: vehicles.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>