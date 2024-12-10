<?php
//Gets the index of the specific charity
$i=$_GET['index'];
//If the submit button is pressed
//The charity is changed
if(count($_POST)>0){
    //Remove <?php die()?\> from the json file to prevent reading errors
    $string=file_get_contents('organizations.json.php');
    $string=str_replace('<?php die()?>', '', $string);
    //Read the json file
    $charities=json_decode($string,true);
    $raisedFunds=$charities[$i]['raisedFunds'];
    
    //for the image

	if(isset($_FILES['image'])){
		//the user wants to modify the image
        $image=uniqid().'.'.pathinfo($_FILES['img']['name'])['extension'];
	}else $image=$_POST['old_image'];
    //Move from temp folder to the Logos folder
    move_uploaded_file($_FILES['img']['tmp_name'],__DIR__.'/Logos/'.$filename);
    //Store in db
    $charity=[
        'name'=>$_POST['name'],
        'goal'=>$_POST['goal'],
        'img'=>$image,
        'datePublished'=>$_POST['datePublished'],
        'raisedFunds'=>$raisedFunds,
        'donationGoal'=>$_POST['donationGoal']
    ];
    //Add $charity to the $charities array
    $charities[$i]=$charity;
    //Write the json file with the <?php die()?\> and $charities
    file_put_contents('organizations.json.php', '<?php die()?>'.json_encode($charities));
}
//If the charity form has not been submitted
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
$oldCharity=$charities[$i];
?>
<html>
    <head>
        <title>Edit</title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" value="<?= $oldCharity['name'] ?>" required />
            <label>Goal</label>
            <input type="text" name="goal" value="<?=$oldCharity['goal']?>" required />
            <label>Date Founded</label>
            <input type="date" name="date_founded" value="<?= $oldCharity['date_founded'] ?>" />
            <label>Change Donation Goal</label>
            <input type="number" name="donationGoal" value="<?=$oldCharity['donationGoal']?>" />
            <label>Upload New Logo</label>
            <!--Image is no longer required, since it is already set-->
            <input type="file" name="image" />
            <input type="hidden" name="old_image" value="<?= $oldCharity['img'] ?>" />            
            <button type="submit">Submit</button>
            <button type="reset">Reset Form</button>
        </form>
        <a href="detail.php?index=<?=$i?>">Go Back</a>
    </body>
</html>