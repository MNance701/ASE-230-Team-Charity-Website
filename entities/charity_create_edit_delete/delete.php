<?php
require_once('../../db/db.php');
//Gets the index of the specific charity
$i=$_GET['index'];

//Gets an organization
$query=$db->prepare('SELECT * FROM organization WHERE OrganizationID=?');
$query->execute([$_GET['index']]);
$organization = $query->fetch();
//If user confirms the deletion of the charity
if(isset($_GET['confirm']) && $_GET['confirm']==1){
    //delete the associated image from logos
    $imgfilename=$organization['Logo'];
    $imgfilename='../Logos/'.$imgfilename;    
    unlink($imgfilename);
    //Remove from database
    $query=$db->prepare('DELETE FROM organization WHERE OrganizationID=?');
    $query->execute([$_GET['index']]);
    //Return to index
    header('location:../index.php');
}
?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1>Are you sure you want to delete <?= $organization['OrganizationName']?>?</h1>
        <h2>This charity will no longer exist in the website, and the associated files, such as the logo, will be deleted from our systems</h2>
        <a href="delete.php?index=<?= $_GET['index'] ?>&confirm=1">Yes</a>
        <a href="../detail.php?index=<?= $_GET['index'] ?>">No</a>
    </body>
</html>