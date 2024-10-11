<?php
$i=$_GET['index'];
//Put the json file into an array
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
//test 
//echo $charities[$i]['name'];
//If user confirms the deletion of the charity
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
?>
<html>
    <head>
    </head>
    <body>
        <a href="detail.php?index=<?=$i?>">Go Back</a>
    </body>
</html>