<?php
include('db_connection.php');

// Check if AttendanceID is set
if (isset($_REQUEST['customer_id'])) {
  $attid = $_REQUEST['customer_id'];

  $stmt = $connection->prepare("SELECT * FROM customer WHERE customer_id=?");
  $stmt->bind_param("i", $attid);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['customer_id'];
    $y = $row['name'];
    $z = $row['phone'];
    $w = $row['vehicle'];
  } else {
    echo "customer not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update attendance</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update attendance form -->
    <h2><u>Update Form of attendance</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="customer_id">customer_id:</label>
    <input type="text" name="customer_id" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="name">name:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="phone"> phone:</label>
    <input type="text" name="phone" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <label for="vehicle">Vehicle:</label>
    <input type="text" name="vehicle" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>


    <input type="submit" name="up" value="Update">

  </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $customer_id2 = $_POST['customer_id'];
  $name2 = $_POST['name'];
  $phone2 = $_POST['phone'];
  $vehicle2 = $_POST['vehicle'];
  

  $stmt = $connection->prepare("UPDATE customer SET customer_id=?, name=?, phone=?, vehicle=?,WHERE customer_id=?");
  $stmt->bind_param("issssi", $customer_id2, $name2, $phone2, $vehicle2);
  $stmt->execute();

  // Redirect to attendance.php
  header('Location: customer.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>