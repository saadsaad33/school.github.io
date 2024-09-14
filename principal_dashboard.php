<?php 
// Database connection
$servername = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "school"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Prevent SQL injection
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Query to check credentials
$sql = "SELECT * FROM principals WHERE username='$user' AND password=SHA1('$pass')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Successful login
    session_start();
    $_SESSION['username'] = $user;
    header("Location: pdash.html"); // Redirect to pdash.html after successful login
    exit();
} else {
    // Incorrect credentials
    echo "<script>alert('Nom d\'utilisateur ou mot de passe incorrect'); window.location.href='index.php';</script>";
}

// Close connection
$conn->close();
?>
