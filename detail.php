<?php
$i=$_GET['index'];
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Charity Donation</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item dropdown">
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="index.php" class="btn btn-outline-dark" type="submit">
                            Return to Index
                        </a>
                        <a href="edit.php?index=<?= $i?>" class="btn btn-outline-dark" type="submit">
                            Edit Charity
                        </a>
						<a href="delete.php?index=<?= $i?>" class="btn btn-outline-dark" type="submit">
                            Delete Charity
                        </a>
                    </form>
                </div>
            </div>
        </nav>
        <!--Display Charity-->
        <a href="index.php">Go back</a>
		<h1><?= $charities[$i]['name'].' '.$charities[$i]['goal'] ?> (<?= $charities[$i]['datePublished'] ?>)</h1>
		<img width="300" src="<?= $charities[$i]['img'] ?>" />
		<h3>Bio</h3>
		<p><?= $charities[$i]['donationGoal'] ?></p>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>