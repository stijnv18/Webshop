<?php

// Connect to the database
$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$dbname = "webshop";

$conn = mysqli_connect($servername, $usernamedb, $passworddb, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $email = $_POST['email'];
    $active = $_POST['Active'];
    $password = $_POST['password'];
    //$Reg = $_POST['Reg'];
    if (isset($_POST['Active'])) {
        $active = 1;
    } else {
        $active = 0;
    }
    
    if (isset($_POST['emp'])) {
        $emp = 1;
    } else {
        $emp = 0;
    }
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO customer (Firstname,Lastname,email,IsActive,Password,Registrationcode,employe) VALUES ('$Firstname', '$Lastname', '$email','$active',' $hashed_password','None','$emp')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create an Account</title>
</head>
<body>
    <h1>Create an Account</h1>
    <form method="post" action="">
        <label for="Firstname">First Name:</label><br>
        <input type="text" id="Firstname" name="Firstname"><br>
        <label for="Lastname">Last Name:</label><br>
        <input type="text" id="Lastname" name="Lastname"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="Active">Active:</label><br>
        <input type="checkbox" id="Active" name="Active"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <!--<label for="Reg">Registration Code:</label><br>
        <input type="text" id="Reg" name="Reg"><br>-->
        <label for="emp">Employee:</label><br>
        <input type="checkbox" id="emp" name="emp"><br><br>
        <input type="submit" value="Submit" name="submit">
    </form> 
</body>
</html>
