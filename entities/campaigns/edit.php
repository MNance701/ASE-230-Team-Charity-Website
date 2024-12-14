<?php
session_start();
require_once('../../db/db.php');
//Gets the index of the specific campaign
$i=$_GET['index'];
//If role is 3 (charity editor) or 4 (admin)
//This action is allowed, but otherwise the user is sent away
    if($_SESSION['role'] == 3 || $_SESSION['role'] == 4){
    //If the submit button is pressed
    //The campaign is changed
    if(count($_POST)>0){
        //change the campaign in the database
        //The organization can't be changed
        $query=$db->prepare('UPDATE campaign SET `CampaignName`=?,
        `Description`=?, `StartDate`=?, `EndDate`=?, `Goal`=? WHERE CampaignID=?');
        $query->execute([$_POST['name'], $_POST['description'], $_POST['startdate'], $_POST['enddate'], $_POST['goal'], $i]);
        header('location:detail.php?index='.$i);
    }
    $query=$db->prepare('SELECT * FROM campaign WHERE CampaignID=?');
    $query->execute([$i]);
    $oldCampaign = $query->fetch();

    ?>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <title>Edit Campaign</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
        <body>
            <header class="bg-dark py-5">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="text-center text-white">
                        <h1 class="display-4 fw-bolder">Edit Campaign</h1>
                    </div>
                </div>
            </header>
            <form method="POST" enctype="multipart/form-data">
                <label>Campaign Name</label>
                <input type="text" name="name" value="<?= $oldCampaign['CampaignName'] ?>" required />
                <label>Description</label>
                <input type="text" name="description" value="<?= $oldCampaign['Description'] ?>" required />
                <label>Start Date</label>
                <input type="date" name="startdate" value="<?= $oldCampaign['StartDate'] ?>" required />
                <label>End Date</label>
                <input type="date" name="enddate" value="<?= $oldCampaign['EndDate'] ?>" required />
                <label>Goal</label>
                <input type="text" name="goal" value="<?= $oldCampaign['Goal'] ?>" required />
                <button type="submit">Submit</button>
                <button type="reset">Reset Form</button>
            </form>
            <a href="../detail.php?index=<?=$i?>">Go Back</a>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>
    </html>
<?php
} else {
    header('location: ../index.php');
    die();
}