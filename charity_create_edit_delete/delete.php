<?php
//Gets the index of the specific charity
$i=$_GET['index'];
//Put the json file into an array
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
//If user confirms the deletion of the charity
if(isset($_GET['confirm']) && $_GET['confirm']==1){
    //delete the associated image from logos
    $imgfilename=$charities[$i]['img'];
    $imgfilename='/Logos/'.$imgfilename;    
    unlink(__DIR__.$imgfilename);
    //remove the indexed charity from the list of charities
    unset($charities[$i]);
    //Removes the indexing from the array
    $charities=array_values($charities);
    //Write the json file with the <?php die()?\> and $charities
    file_put_contents('organizations.json.php', '<?php die()?>'.json_encode($charities));
}
?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1>Are you sure you want to delete the charity?</h1>
        <h2>The charity will no longer exist in the website, and the associated files, such as the logo, will be deleted from our systems</h2>
        <a href="delete.php?index=<?= $_GET['index'] ?>&confirm=1">Yes</a>
        <a href="detail.php?index=<?= $_GET['index'] ?>">No</a>
    </body>
</html>