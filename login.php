 <?php
session_start();

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username=="admin" && $password=="1234")
    {
        $_SESSION['admin']="admin";
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Volunteer Registration System</h1>

<div class="login-container">

    <h2>Admin Login</h2>

    <?php
    if(isset($error))
    {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="POST">

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>
