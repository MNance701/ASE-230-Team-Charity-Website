<?php
session_start();
require_once('../../db/db.php');
/*Potential Login
require_once('auth.php');
if(!isLogged()){
    header('location: index.php');
    die();
}*/
//If the submit button is pressed
if(count($_POST)>0){
    $filename=uniqid().'.'.pathinfo($_FILES['img']['name'])['extension'];
    //Move from temp folder to the Logos folder
    //The actual image is stored in the Logos folder, but the filename is stored in the db
    move_uploaded_file($_FILES['img']['tmp_name'],'../Logos/'.$filename);

    //Store in db
    $query=$db->prepare('INSERT INTO organization(`OrganizationName`,
    `Address`, `Email`, `Phone`, `Bio`, `Logo`)VALUES(?,?,?,?,?,?)');
    $query->execute([$_POST['name'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['bio'], $filename]);
    //Sends the user to the detail page of the website that they just created
    header('location:../detail.php?index='.$db->lastInsertId());
}
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" required />
            <label>Address</label>
            <input type="text" name="address" required />
            <label>Email</label>
            <input type="email" name="email" required />
            <label>Phone</label>
            <input type="text" name="phone" required />
            <label>Bio</label>
            <input type="textarea" name="bio" required />
            <label>Upload Logo</label>
            <!--Made the image required for now-->
            <input type="file" name="img" required />
            <button type="submit">Submit</button>
            <button type="reset">Reset Form</button>
        </form>
    </body>
</html>