<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" required />
            <label>Goal</label>
            <input type="text" name="goal" required />
            <label>Set a Donation Goal (Optional)</label>
            <input type="number" name="donationGoal" />
            <label>Upload Image</label>
            <!--Made the image required for now-->
            <input type="file" name="img" required />
            <button type="submit">Submit</button>
            <button type="reset">Reset Form</button>
        </form>
    </body>
</html>