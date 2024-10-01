<?php
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
        </form>
    </body>
</html>