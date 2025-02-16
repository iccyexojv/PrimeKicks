<?php
session_start();


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prime_kicks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users from the database
$sql = "SELECT id, username, email, gender, location, role FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel - Prime Kicks</title>
    <style>
          @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
html,body{
  height: 100%;
  width: 100%;
  place-items: center;
  background: #f2f2f2;
  
}

nav {
  position:static;
  background: #1b1b1b;
  width: 100%;
  padding: 5px 0;

}
nav .menu {
  max-width: 1250px;
  margin: auto;
  display: flex;
  align-items:center;
  justify-content: space-between;
  padding: 0 20px;
}
.menu .logo a {
  text-decoration: none;
  color: #fff;
  font-size: 35px;
  font-weight: 600;
}
.menu ul {
  display: inline-flex;
}
.menu ul li {
  list-style: none;
  margin-left: 7px;
}
.menu ul li:first-child {
  margin-left: 0px;
}
.menu ul li a {
  text-decoration: none;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  padding: 8px 15px;
  border-radius: 5px;
  transition: all 0.3s ease;
}
.menu ul li a:hover {
  background: #fff;
  color: black;
}
footer{
  background-color:  #1b1b1b;
  text-align: center;
  color: #fff;
  padding: 5px 0;
  width: 100%;
  margin-top:375px;
}
        h2 {
            color: #333;
        }
        .table-container {
            width: 100%;
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 10px 15px;
            background-color: black;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: green;
        }
        .btn2{
            background-color:green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            padding: 3px 8px; 
        }
        .btn2:hover{
            background-color: darkgreen;
        }
    </style>
</head>
<body>
        <!--navagation -->
        <nav>
      <div class="menu">
        <div class="logo">
        <a href="order_list.php">Prime Kicks</a>
        </div>
        <ul>
                 <li><a href="order_list.php">Order-List</a></li>
                 <li><a href="product.php">New Stock</a></li>
                <li><a href="user.php">User</a></li>
                <li><a href="view_products.php">Store</a></li>
                <li><a href="Logout_admin.php">Logout</a></li>

        
         
        </ul>
      </div>
    </nav>
  
    

<h2>Admin Panel</h2>

<div class="table-container">
    <h3>All Users</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Location</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
    <?php
    // Check if there are any users in the database
    if ($result->num_rows > 0) {
        // Output each user's details
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . ucfirst($row['gender']) . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . ucfirst($row['role']) . "</td>";
            echo "<td>
                    <a href='edit_user.php?id=" . $row['id'] . "' class='btn2'>Edit</a>
                    <a  href='delete_user.php?id=" . $row['id'] . "' class='btn2' 
                    onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete </a >
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No users found.</td></tr>";
    }
    ?>
</tbody>

    </table>
</div>



</body>
<footer>
      <p> Privacy Policy | Terms and Conditions</p>       
         <p>@ 2024 Prime Kicks, Inc.</p>
    </footer>
</html>

<?php
// Close connection
$conn->close();
?>
