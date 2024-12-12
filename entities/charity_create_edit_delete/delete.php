<?php
require_once('../../db/db.php');
//Gets the index of the specific charity
$i=$_GET['index'];
/*
***json file process. Not necessary now that the data is in a database***
//Put the json file into an array
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
*/
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
    /*
    ***More json stuff***
    //remove the indexed charity from the list of charities
    unset($charities[$i]);
    //Removes the indexing from the array
    $charities=array_values($charities);
    //Write the json file with the <?php die()?\> and $charities
    file_put_contents('organizations.json.php', '<?php die()?>'.json_encode($charities));
    */
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