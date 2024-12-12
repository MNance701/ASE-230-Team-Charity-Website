<?php
require_once('../../db/db.php');
//Gets the index of the specific campaign
$i=$_GET['index'];
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
        <title>Edit Campaign</title>
    </head>
    <body>
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
    </body>
</html>