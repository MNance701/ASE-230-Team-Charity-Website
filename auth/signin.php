<?php
session_start(); 

require_once('../db/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        die('The email is required');
    }
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        die('The password is required');
    }

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        die('The email is in the wrong format');
    }
    if (preg_match('/[^a-zA-Z0-9@.]/', $_POST['email'])) {
        die('Special characters are not allowed in the email');
    }

    $password = $_POST['password'];
    if (preg_match('/[^a-zA-Z0-9]/', $password)) {
        die('Password contains invalid characters. Only letters and numbers are allowed.');
    }

    try {
        $stmt = $db->prepare('SELECT * FROM donor WHERE Email=?');
        $stmt->execute([$email]);
        $donor = $stmt->fetch();

        if ($user && password_verify($password, $donor['Password'])) {
            $_SESSION['username'] = $donor['Name'];
            $_SESSION['role'] = $donor['Status'];

            header('Location: ../entities/index.php');
            exit;
        } else {
            echo '<p style="color: red;">Invalid email or password</p>';
        }
    } catch (PDOException $e) {
        die('Database error: '.$e->getMessage());
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