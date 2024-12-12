<?php 
require_once('../../db/db.php');
//Access campaigns from the database
$query=$db->query('SELECT campaign.*,organization.OrganizationName FROM campaign JOIN organization ON campaign.OrganizationID=organization.OrganizationID');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charity Donation</title>
        <!-- Bootstrap icons-->
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="campaigns/index.php">Campaigns</a></li>
                        <li class="nav-item dropdown">
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="../signin.php" class="btn btn-outline-dark" type="submit">
                            Sign In
                        </a>
                        <a href="../signout.php" class="btn btn-outline-dark" type="submit">
                            Sign Out
                        </a>
                        <a href="create.php" class="btn btn-outline-dark" type="submit">
                            Create Campaign
                        </a>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">New Campaigns</h1>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php while($campaign=$query->fetch()){?>
                        <div class="col mb-5">
                            <div class="card h-90">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">
                                            <h3><a href="detail.php?index=<?= $campaign['CampaignID'] ?>"><?= $campaign['CampaignName'] ?>
                                            <h4><?= $campaign['OrganizationName']?></h4>
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="detail.php?index=<?= $i ?>">Read More</a></div>
                                </div>
                            </div>    
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Aiden Gill, Malachi Nance, and Cley Shelton 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    </body>
</html>