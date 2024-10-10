<?php
/*Potential Login
require_once('auth.php');
if(!isLogged()){
    header('location: index.php');
    die();
}*/
if(count($_POST)>0){
    $filename=uniqid().'.'.pathinfo($_FILES['img']['name'])['extension'];
    //Move from temp folder to the Logos folder
    move_uploaded_file($_FILES['img']['tmp_name'],__DIR__.'/Logos/'.$filename);
    //Store in db
    $charity=[
        'name'=>$_POST['name'],
        'goal'=>$_POST['goal'],
        'img'=>$filename,
        //datePublished=>,
        'raisedFunds'=>0,
        'donationGoal'=>$_POST['donationGoal']
    ];
    //Remove <?php die()?\> from the json file to prevent reading errors
    $string=file_get_contents('organizations.json.php');
    $string=str_replace('<?php die()?>', '', $string);
    //Read the json file
    $charities=json_decode($string,true);
    //Add $charity to the $charities array
    $charities[]=$charity;
    //Write the json file with the <?php die()?\> and $charities
    file_put_contents('organizations.json.php', '<?php die()?>'.json_encode($charities));
    
    //test that the creation of the charity works
    echo '<pre>';
    print_r($charities);
    echo '</pre>';
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
            <label>Goal</label>
            <input type="text" name="goal" required />
            <label>Set a Donation Goal (Optional)</label>
            <input type="number" name="donationGoal" />
            <label>Upload Image</label>
            <!--Made the image required for now-->
            <input type="file" name="img" required />
            <button type="submit">Submit</button>
            <button type="reset">Reset Form</button>
        </form>
    </body>
</html>