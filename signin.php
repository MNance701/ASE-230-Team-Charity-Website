<?php
session_start(); // Start the session

// Database connection details
$host = '127.0.0.1';
$db = 'charity_website';
$user = 'AMC';
$pass = 'Charity2024$';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Handle connection errors
    die("Database connection failed: " . $e->getMessage());
}

// Handle the sign-in process when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email and password are provided using isset()
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        die('The email is required');
    }
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        die('The password is required');
    }

    // Validate email format and disallow special characters
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        die('The email is in the wrong format');
    }
    if (preg_match('/[^a-zA-Z0-9@.]/', $_POST['email'])) {
        die('Special characters are not allowed in the email');
    }

    // Check if password contains special characters
    $password = $_POST['password'];
    if (preg_match('/[^a-zA-Z0-9]/', $password)) {
        die('Password contains invalid characters. Only letters and numbers are allowed.');
    }

    // Try to fetch user from the database based on email
    try {
        // Prepare SQL query to fetch user details
        $stmt = $pdo->prepare('SELECT * FROM user WHERE Email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['Password'])) {
            // Set session variables on successful login
            $_SESSION['username'] = $user['UserName'];
            $_SESSION['user_id'] = $user['UserID'];

            // Redirect to a protected page (e.g., dashboard)
            header('Location: ../dashboard.php');
            exit;
        } else {
            // Incorrect email or password
            echo '<p style="color: red;">Invalid email or password</p>';
        }
    } catch (PDOException $e) {
        // Database error
        die('Database error: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
</head>
<body>
    <h1>Sign In</h1>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div> 
            <label>Email</label><br />
            <input name="email" type="email" required />
        </div>
        <div> 
            <label>Password</label><br />
            <input name="password" type="password" required />
        </div>
        <button type="submit">Sign In</button>
        <button type="reset">Reset</button>
    </form>
</body>
</html>
