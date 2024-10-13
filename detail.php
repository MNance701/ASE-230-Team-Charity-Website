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
	</head>
	<body>
		<a href="index.php">Go back</a>
		<h1><?= $charities[$i]['name'].' '.$charities[$i]['goal'] ?> (<?= $charities[$i]['datePublished'] ?>)</h1>
		<img width="300" src="<?= $charities[$i]['img'] ?>" />
		<h3>Bio</h3>
		<p><?= $charities[$i]['donationGoal'] ?></p>
	</body>
</html>