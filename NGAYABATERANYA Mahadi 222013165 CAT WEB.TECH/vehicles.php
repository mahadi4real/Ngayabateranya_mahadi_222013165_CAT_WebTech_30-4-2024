<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment table</title>
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

<body bgcolor="yellow">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/collage logo.png" width="90" height="60" alt="Logo">
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
<h1>Vehicles</h1>

<form method="post" onsubmit="return confirmInsert();">
        <label for="Make">Make:</label>
        <input type="text" id="Make" name="Make"><br><br>

        <label for="color">color:</label>
        <input type="text" id="color" name="color" required><br><br>

        <label for="price">price:</label>
        <input type="text" id="price" name="price" required><br><br>

        <label for="seats">seats:</label>
        <input type="text" id="seats" name="seats" required><br><br>

        <label for="vehicle_id">vehicle Id:</label>
        <input type="text" id="vehicle_id" name="vehicle_id" required><br><br>

        

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('db_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO vehicles (Make, color, price, seats, vehicle_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $Make, $color, $price, $seats, $vehicle_id);

        // Set parameters from POST data with validation (optional)
        $Make = ($_POST['Make']); 
        $color = ($_POST['color']); 
        $price = ($_POST['price']); 
        $seats = filter_var($_POST['seats']); 
        $vehicle_id = ($_POST['vehicle_id']); 
         
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

// SQL query to fetch data from Vehicles
$sql = "SELECT * FROM vehicles";
$result = $connection->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicles Information</title>
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
    <center><h2>Vehicle Details</h2></center>
    <table border="5">
        <tr>
            <th>Make</th>
            <th>Color</th>
            <th>price</th>
            <th>seats</th>
            <th>Vehicle Id</th>
        
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
       
        // Define connection parameters
        // Connection details
    include('db_connection.php');
 
        // Prepare SQL query to retrieve all vehicles
        $sql = "SELECT * FROM vehicles";
        $result = $connection->query($sql);

       
        if ($result->num_rows > 0) {
          
            while ($row = $result->fetch_assoc()) {
                $mjid = $row['Make']; // Fetch the Make
                echo "<tr>
                    <td>" . $row['Make'] . "</td>
                    <td>" . $row['color'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['seats'] . "</td>
                    <td>" . $row['vehicle_id'] . "</td>
                    
                    <td><a style='padding:4px' href='delete_vehicles.php?PaymentID=$mjid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_vehicles.php?PaymentID=$mjid'>Update</a></td> 
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