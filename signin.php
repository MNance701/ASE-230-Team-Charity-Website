<?php

if(count($_POST)>0){
	if(!isset($_POST['email'][0])) die('The email is required');
	if(!isset($_POST['password'][0])) die('The password is required');
	
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die('The email is in the wrong format');
	
	echo 'Thank you, '.htmlspecialchars($_POST['name']);
}

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
                <span class="error">* required</span>
            </div>
            <div> 
                <label>Password</label><br />
                <input name="password" type="password" />
                <span class="error">* required</span>
            </div>
            <button type="Submit">Sign In</button>
            <button type="Reset">Reset</button>
        </form>
<?php
}
