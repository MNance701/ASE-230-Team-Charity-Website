<?php
$i=$_GET['index'];

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