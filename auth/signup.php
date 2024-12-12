<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection
    require_once('../db/db.php');

    // Sanitize and validate input data
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmpassword = trim($_POST['confirmpassword'] ?? '');

    // Check required fields
    if (!$firstname || !$lastname || !$email || !$address || !$age || !$username || !$password || !$confirmpassword) {
        die('All fields are required.');
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }

    // Check if passwords match
    if ($password !== $confirmpassword) {
        die('Passwords do not match.');
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $stmt = $db->prepare('INSERT INTO donor (name, Email, Password, Address, TotalDonations) VALUES (?, ?, ?, ?, 0)');
    try {
        $stmt->execute(["$firstname $lastname", $email, $hashedPassword, $address]);
        echo 'Registration successful! <a href="signin.php">Sign in</a>';
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry
            die('Email already exists.');
        }
        die('Database error: ' . $e->getMessage());
    }
} else {
?>
    <form method="POST" action="">
        <div>
            <label>First Name</label><br />
            <input name="firstname" type="text" required />
            <span class="error">* required</span>
        </div>
        <div>
            <label>Last Name</label><br />
            <input name="lastname" type="text" required />
            <span class="error">* required</span>
        </div>
        <div>
            <label>Email</label><br />
            <input name="email" type="email" required />
            <span class="error">* required</span>
        </div>
        <div>
            <label>Address</label><br />
            <input name="address" type="text" required />
            <span class="error">* required</span>
        </div>
        <div>
            <label>Age</label><br />
            <input name="age" type="number" required />
            <span class="error">* required</span>
        </div>
        <div>
            <label>Username</label><br />
            <input name="username" type="text" required />
            <span class="error">* required</span>
        </div>
        <div>
            <label>Password</label><br />
            <input name="password" type="password" required />
            <span class="error">* required</span>
        </div>
        <div>
            <label>Confirm Password</label><br />
            <input name="confirmpassword" type="password" required />
            <span class="error">* required</span>
        </div>
        <button type="submit">Submit Form</button>
        <button type="reset">Reset Form</button>
    </form>
<?php
}
?>