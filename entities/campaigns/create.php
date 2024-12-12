<?php
require_once('../../db/db.php');
/*Potential Login
require_once('auth.php');
if(!isLogged()){
    header('location: index.php');
    die();
}*/
//If the submit button is pressed
if(count($_POST)>0){
    //Find the associated organization name
    //Since each organization name is unique, it will not overlap with other rows
    $query=$db->prepare('SELECT * FROM organization WHERE OrganizationName=?');
    $query->execute([$_POST['org']]);
    $orgID=$query->fetch();
    //Store in db
    $query=$db->prepare('INSERT INTO campaign(`OrganizationID`,
    `CampaignName`, `Description`, `StartDate`, `EndDate`, `Goal`)VALUES(?,?,?,?,?,?)');
    $query->execute([$orgID['OrganizationID'], $_POST['name'], $_POST['description'], $_POST['startdate'], $_POST['enddate'], $_POST['goal']]);
    header('location:index.php');
}
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Create Campaign</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <label>Organization Name</label>
            <input type="text" name="org" required />
            <label>Name</label>
            <input type="text" name="name" required />
            <label>Description</label>
            <input type="text" name="description" required />
            <label>Start Date</label>
            <input type="date" name="startdate" required />
            <label>End Date</label>
            <input type="date" name="enddate" required />
            <label>Goal</label>
            <input type="text" name="goal" required />
            <button type="submit">Submit</button>
            <button type="reset">Reset Form</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>