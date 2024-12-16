<?php 
session_start();
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
require_once 'db_info.php';
if ($conn->connect_error)
    die('Fail connection' . $conn->connect_error);
$query = "SELECT * FROM userinfo WHERE email='$email' AND password='$password'";
$result = $conn->query($query);
if(mysqli_num_rows($result)>0){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['email'] = $row['email'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['id'] = $row['id'];
    echo "Login Successful!";
}
else{
    echo "<p style='color: red;'>Username or password is incorrect!</p>";
}

$conn->close();
?>