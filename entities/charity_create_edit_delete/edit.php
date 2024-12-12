<?php
require_once('../../db/db.php');
//Gets the index of the specific charity
$i=$_GET['index'];
//If the submit button is pressed
//The charity is changed
if(count($_POST)>0){
    /*
    ***json stuff***
    //Remove <?php die()?\> from the json file to prevent reading errors
    $string=file_get_contents('organizations.json.php');
    $string=str_replace('<?php die()?>', '', $string);
    //Read the json file
    $charities=json_decode($string,true);
    $raisedFunds=$charities[$i]['raisedFunds'];
    */
    //for the image

	if(isset($_FILES['image'])){
		//the user wants to modify the image
        $image=uniqid().'.'.pathinfo($_FILES['image']['name'])['extension'];
	}else $image=$_POST['old_image'];
    //Move from temp folder to the Logos folder
    move_uploaded_file($_FILES['image']['tmp_name'],'../Logos/'.$image);
    /*json stuff
    ***
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
    */
    //change the organization in the database
    $query=$db->prepare('UPDATE  organization SET `OrganizationName`=?,
    `Address`=?, `Email`=?, `Phone`=?, `Bio`=?, `Logo`=? WHERE OrganizationID=?');
    $query->execute([$_POST['name'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['bio'], $image, $i]);
    header('location:../detail.php?index='.$i);
}
$query=$db->prepare('SELECT * FROM organization WHERE OrganizationID=?');
$query->execute([$i]);
$oldOrganization = $query->fetch();
/*
***json stuff***
//If the charity form has not been submitted
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
$oldCharity=$charities[$i];
*/
?>
<html>
    <head>
        <title>Edit</title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" value="<?= $oldOrganization['OrganizationName'] ?>" required />
            <label>Address</label>
            <input type="text" name="address" value="<?= $oldOrganization['Address'] ?>" required />
            <label>Email</label>
            <input type="email" name="email" value="<?= $oldOrganization['Email'] ?>" required />
            <label>Phone</label>
            <input type="text" name="phone" value="<?= $oldOrganization['Phone'] ?>" required />
            <label>Bio</label>
            <input type="text" name="bio" value="<?= $oldOrganization['Bio'] ?>" required />
            <label>Upload New Logo</label>
            <!--Image is no longer required, since it is already set-->
            <input type="file" name="image" />
            <input type="hidden" name="old_image" value="<?= $oldOrganization['Logo'] ?>" />            
            <button type="submit">Submit</button>
            <button type="reset">Reset Form</button>
        </form>
        <a href="../detail.php?index=<?=$i?>">Go Back</a>
    </body>
</html>