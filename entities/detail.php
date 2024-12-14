<?php
session_start();
require_once('../db/db.php');
$i=$_GET['index'];

$query=$db->prepare('SELECT * FROM organization WHERE OrganizationID=?');
$query->execute([$i]);
$organization = $query->fetch();
/*
***json stuff***
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
*/
//Set image
$img=$organization['Logo'];
$img='/Logos/'.$img;
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Charity Donation</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Return to Index</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="campaigns/index.php">Campaigns</a></li>
                        <li class="nav-item dropdown">
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="charity_create_edit_delete/edit.php?index=<?= $i?>" class="btn btn-outline-dark" type="submit">
                            Edit Charity
                        </a>
						<a href="charity_create_edit_delete/delete.php?index=<?= $i?>" class="btn btn-outline-dark" type="submit">
                            Delete Charity
                        </a>
                    </form>
                </div>
            </div>
        </nav>
        <!--Display Charity-->
		<h1><?= $organization['OrganizationName']?></h1>
        <h2><?= $organization['Address']?></h2>
        <h2><?= $organization['Email']?></h2>
        <h3><?= $organization['Phone']?></h3>
		<img width="300" src="<?= $img ?>" />
		<h3>Bio</h3>
		<p><?= $organization['Bio'] ?></p>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>