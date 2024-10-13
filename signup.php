<?php

if(count($_POST)>0){
    if(!isset($_POST['firstname'][0])) die('The first name is required');
	if(!isset($_POST['lastname'][0])) die('The last name is required');
	if(!isset($_POST['email'][0])) die('The email is required');
    if(!isset($_POST['address'][0])) die('The address is required');
    if(!isset($_POST['age'][0])) die('The age is required');
	if(!isset($_POST['password'][0])) die('The password is required');
    if(!isset($_POST['confirmpassword'][0])) die('The confirm password is required');
	
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die('The email is in the wrong format');
	
	echo 'Thank you, '.htmlspecialchars($_POST['name']);
}

if(count($_POST)>0){
	echo '<pre>';
	print_r($_POST);
	foreach($_POST as $key=>$value) echo $key.':'.$value.'<br />';
}else{
?>
        <form method="POST" action="process.php">
            <div> 
                <label>First Name</label><br />
                <input name="firstname" type="text" />
                <span class="error">* required</span>
            </div>
            <div> 
                <label>Last Name</label><br />
                <input name="lastname" type="text" />
                <span class="error">* required</span>
            </div>
            <div>
                <label>Email</label><br />
                <input name="email" type="email" />
                <span class="error">* required</span>
            </div>
            <div> 
                <label>Address</label><br />
                <input name="address" type="text" />
                <span class="error">* required</span>
            </div>
            <div>
                <label>Age</label><br />
                <input name="age" type="number" />
                <span class="error">* required</span>
            </div>
            <div>
                <label>Username</label><br />
                <input name="username" type="text" />
                <span class="error">* required</span>
            </div>
            <div> 
                <label>Password</label><br />
                <input name="password" type="password" />
                <span class="error">* required</span>
            </div>
            <div> 
                <label>Confirm Password</label><br />
                <input name="confirmpassword" type="password" />
                <span class="error">* required</span>
            </div>
            <button type="submit">Submit Form</button>
            <button type="Reset">Reset Form</button>
        </form>
<?php
}
