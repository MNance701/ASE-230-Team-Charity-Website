<?php
$i=$_GET['index'];
//Remove <?php die()?\> from the json file to prevent reading errors
$string=file_get_contents('organizations.json.php');
$string=str_replace('<?php die()?>', '', $string);
//Read the json file
$charities=json_decode($string,true);
?>
<?php
$host = 'localhost';
$db = 'charity_website';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
    $pdo = new PDO($dsn, $user, $pass, $options);
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
