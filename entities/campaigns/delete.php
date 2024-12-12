<?php
require_once('../../db/db.php');

$i=$_GET['index'];

//Gets the index of the specific charity
$query=$db->prepare('SELECT * FROM campaign WHERE CampaignID=?');
$query->execute([$i]);
$campaign = $query->fetch();
//If user confirms the deletion of the charity
if(isset($_GET['confirm']) && $_GET['confirm']==1){
    //Remove from database
    $query=$db->prepare('DELETE FROM campaign WHERE CampaignID=?');
    $query->execute([$i]);
    //Return to campaign index
    header('location:index.php');
}
?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1>Are you sure you want to delete <?= $campaign['OrganizationName']?>?</h1>
        <h2>This campaign will no longer exist in the website, and the associated files will be deleted from our systems</h2>
        <h2>This will not affect any funds that have already been donated to the campaign</h2>
        <a href="delete.php?index=<?= $_GET['index'] ?>&confirm=1">Yes</a>
        <a href="detail.php?index=<?= $_GET['index'] ?>">No</a>
    </body>
</html>