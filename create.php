<?php
/*Potential Login
require_once('Auth.php');
if(!isLogged()){
    header('location: index.php');
    die();
}*/
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" />
            <label>Goal</label>
            <input type="text" name="goal" />
            <label>Set a Donation Goal (Optional)</label>
            <input type="number" name="donationGoal" />
            <label>Upload Image</label>
            <input type="file" name="img" />
            <button type="submit">Submit</button>
            <button type="reset">Reset Form</button>
        </form>
    </body>
</html>