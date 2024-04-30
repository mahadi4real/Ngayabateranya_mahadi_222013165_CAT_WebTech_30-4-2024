<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendance table</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;

      background-color: darkcyan;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
<header>
   

</head>

<body bgcolor="skyblue">
 
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/4.jpg" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./HOME.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a>
   <li style="display: inline; margin-right: 10px;"><a href="./HOME.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php">customer</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sale.php">Sale</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./stock.php">Stock</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./transaction.php">Transaction</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./vehicles.php">vehicles</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
<h1>Customer</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="customer_id">customer_id:</label>
        <input type="number" id="customer_id" name="customer_id"><br><br>

        <label for="name">name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="phone">phone:</label>
        <input type="number" id="phone" name="phone" required><br><br>

        <label for="vehicle">vehicle:</label>
        <input type="text" id="vehicle" name="vehicle" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('db_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO customer (customer_id, name, phone, vehicle) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isssss", $customer_id, $name, $phone, $vehicle);

        // Set parameters from POST data with validation (optional)
        $customer_id = intval($_POST['customer_id']); // Ensure integer for ID
        $name = htmlspecialchars($_POST['name']); // Prevent XSS
        $phone = htmlspecialchars($_POST['phone']); // Prevent XSS
        $vehicle = filter_var($_POST['vehicle'], 
    
         
        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>

<?php
// Connection details
   include('db_connection.php');
  
// SQL query to fetch data from customer table
$sql = "SELECT * FROM customer";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Information</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Customer Details</h2></center>
    <table border="8">
        <tr>
            <th>customer_id</th>
            <th>name</th>
            <th>phone</th>
            <th>vehicle</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        // Connection details
    include('db_connection.php');

        // Prepare SQL query to retrieve all details about the customer
        $sql = "SELECT * FROM customer";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $appid = $row['customer_id']; // Fetch the customer ID
                echo "<tr>
                    <td>" . $row['customer_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['vehicle'] . "</td>
                    
                    <td><a style='padding:4px' href='delete_customer.php?AttendanceID=$appid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_customer.php?AttendanceID=$appid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
    </section>

  
<footer>
  <center> 
     <b><h2>Car dealership 2024</h2></b>>
  </center>
</footer>
</body>
</html>