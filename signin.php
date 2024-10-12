<?php

if(count($_POST)>0){
	echo '<pre>';
	print_r($_POST);
	foreach($_POST as $key=>$value) echo $key.':'.$value.'<br />';
}else{
?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div> 
                <label>Email</label><br />
                <input name="email" type="email" />
            </div>
            <div> 
                <label>Password</label><br />
                <input name="password" type="password" />
            </div>
            <button type="Submit">Sign In</button>
            <button type="Reset">Reset</button>
        </form>
<?php
}
