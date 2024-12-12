<?php
require_once('../../db/db.php');
//Gets the index of the specific charity
$i=$_GET['index'];
//If the submit button is pressed
//The charity is changed
if(count($_POST)>0){
    //for the image
	if(isset($_FILES['image'])){
		//the user wants to modify the image
        $image=uniqid().'.'.pathinfo($_FILES['image']['name'])['extension'];
	}else $image=$_POST['old_image'];
    //Move from temp folder to the Logos folder
    move_uploaded_file($_FILES['image']['tmp_name'],'../Logos/'.$image);
    //change the organization in the database
    $query=$db->prepare('UPDATE  organization SET `OrganizationName`=?,
    `Address`=?, `Email`=?, `Phone`=?, `Bio`=?, `Logo`=? WHERE OrganizationID=?');
    $query->execute([$_POST['name'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['bio'], $image, $i]);
    header('location:../detail.php?index='.$i);
}
$query=$db->prepare('SELECT * FROM organization WHERE OrganizationID=?');
$query->execute([$i]);
$oldOrganization = $query->fetch();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Edit Charity</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>