<?php
include 'db.php';

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $skills = $_POST['skills'];
    $check = mysqli_query(
    $conn,
    "SELECT * FROM volunteers
     WHERE email='$email'
     OR phone='$phone'"
);

if(mysqli_num_rows($check) > 0)
{
    echo "<script>
    alert('Volunteer already registered');
    </script>";
}
else
{
    $sql = "INSERT INTO volunteers(name,email,phone,city,skills)
            VALUES('$name','$email','$phone','$city','$skills')";

    if(mysqli_query($conn,$sql))
{
    echo "<script>
            alert('Volunteer Registered Successfully');
            window.location='index.php';
          </script>";
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Volunteer Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Volunteer Registration Form</h1>

<form method="POST">

    <input type="text" name="name" placeholder="Full Name" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="text" name="phone" placeholder="Phone Number" required>

    <input type="text" name="city" placeholder="City" required>

    <input type="text" name="skills" placeholder="Skills" required>

<div style="text-align:center;">
    <button type="submit" name="register">Register</button>
</div>

</form>

</body>
</html>
