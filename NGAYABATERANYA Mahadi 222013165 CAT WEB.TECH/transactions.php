<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Member table</title>
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
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/4.jpg" width="90" height="60" alt="Logo">
  </li>
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
<h1>Transaction</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="PaymentMethod">PaymentMethod:</label>
        <input type="text" id="PaymentMethod" name="PaymentMethod"><br><br>

        <label for="TransactionDate">TransactionDate:</label>
        <input type="text" id="TransactionDate" name="TransactionDate" required><br><br>

        <label for="Amount">Amount:</label>
        <input type="text" id="Amount" name="Amount" required><br><br>

        <label for="transaction_id">transaction_id:</label>
        <input type="number" id="transaction_id" name="transaction_id" required><br><br>

        <label for="sale_id">sale_id:</label>
        <input type="text" id="sale_id" name="sale_id" required><br><br>



        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('db_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO transactions (PaymentMethod, TransactionDate, Amount, transaction_id, sale_id) VALUES (?, ?, ?, ?, ?,)");
        $stmt->bind_param("issssss", $PaymentMethod, $TransactionDate, $Amount, $transaction_id, $sale_id);

        // Set parameters from POST data with validation (optional)
        $PaymentMethod = ($_POST['PaymentMethod']); // Ensure integer for ID
        $TransactionDate = ($_POST['TransactionDate']); 
        $Amount = ($_POST['Amount']); 
        $transaction_id = ($_POST['transaction_id']); 
        $sale_id = ($_POST['sale_id']);
       
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

// SQL query to fetch data from member
$sql = "SELECT * FROM transactions";
$result = $connection->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction Information</title>
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
    <center><h2>Transaction Details</h2></center>
    <table border="5">
        <tr>
            <th>Payment Method</th>
            <th>Transaction Date </th>
            <th>Amount</th>
            <th>Transaction Id</th>
            <th>Sale id</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
       
        // Define connection parameters
        // Connection details
    include('db_connection.php');
 
        // Prepare SQL query to retrieve all transactions
        $sql = "SELECT * FROM transactions";
        $result = $connection->query($sql);

        // Check if there are any member
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $mjid = $row['PaymentMethod']; // Fetch the Payment Method
                echo "<tr>
                    <td>" . $row['PaymentMethod'] . "</td>
                    <td>" . $row['TransactionDate'] . "</td>
                    <td>" . $row['Amount'] . "</td>
                    <td>" . $row['transaction_id'] . "</td>
                    <td>" . $row['sale_id'] . "</td>
                    
                    <td><a style='padding:4px' href='delete_transactions.php?MemberID=$mjid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_transactions.php?MemberID=$mjid'>Update</a></td> 
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
    <b><h2>Car Dealership 2024</h2></b>
  </center>
</footer>
</body>
</html>