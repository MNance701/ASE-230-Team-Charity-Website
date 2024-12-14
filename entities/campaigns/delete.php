<?php
session_start();
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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Delete Campaign</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <h1>Are you sure you want to delete <?= $campaign['OrganizationName']?>?</h1>
        <h2>This campaign will no longer exist in the website, and the associated files will be deleted from our systems</h2>
        <h2>This will not affect any funds that have already been donated to the campaign</h2>
        <a class="btn btn-danger" href="delete.php?index=<?= $_GET['index'] ?>&confirm=1">Yes</a>
        <a class="btn btn-primary" href="detail.php?index=<?= $_GET['index'] ?>">No</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>