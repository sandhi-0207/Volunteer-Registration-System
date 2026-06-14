<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';

/* Total Volunteers Count */
$count = mysqli_query($conn, "SELECT COUNT(*) as total FROM volunteers");
$total = mysqli_fetch_assoc($count);

/* Search Logic */
if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM volunteers WHERE name LIKE '%$search%'"
    );
}
else
{
    $result = mysqli_query(
        $conn,
        "SELECT * FROM volunteers"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="top-bar">
<h1>Volunteer Dashboard</h1>
<a href="index.php">Add New Volunteer</a>
<a href="logout.php">Logout</a>
</div>
<div class="report-box">
    <h2>Total Volunteers</h2>
    <h1><?php echo $total['total']; ?></h1>
</div>
<?php

$report = mysqli_query($conn,
"SELECT city, COUNT(*) as total
FROM volunteers
GROUP BY city");

?>

<h2>City Wise Volunteer Report</h2>

<table border="1" cellpadding="10">
<tr>
    <th>City</th>
    <th>Total Volunteers</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($report))
{
?>
<tr>
    <td><?php echo $row['city']; ?></td>
    <td><?php echo $row['total']; ?></td>
</tr>
<?php
}
?>
</table>
<!-- Search Form -->
<div class="search-box"> 
<form method="GET">
    <input type="text" name="search" placeholder="Search Name">
    <button type="submit">Search</button>
</form>
</div>

<br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>City</th>
    <th>Skills</th>
    <th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['city']; ?></td>
    <td><?php echo $row['skills']; ?></td>
    <td>
        <a href="delete.php?id=<?php echo $row['id']; ?>">
            Delete
        </a>
    </td>
</tr>
<?php
}
?>

</table>
 
</body>
</html>
