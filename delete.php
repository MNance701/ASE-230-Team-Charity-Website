<?php
$i=$_GET['index'];
//Put the json file into an array
$charities=json_decode(file_get_contents('organizations.json.php'),true);
?>
<html>
    <head>
    </head>
    <body>
        <a href="detail.php?index=<?=$i?>">Go Back</a>
    </body>
</html>