<?php

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
            </div>
            <div> 
                <label>Last Name</label><br />
                <input name="lastname" type="text" />
            </div>
            <div>
                <label>Email</label><br />
                <input name="email" type="email" />
            </div>
            <div> 
                <label>Address</label><br />
                <input name="address" type="text" />
            </div>
            <div>
                <label>Age</label><br />
                <input name="age" type="number" />
            </div>
            <div>
                <label>Username</label><br />
                <input name="username" type="text" />
            </div>
            <div> 
                <label>Password</label><br />
                <input name="password" type="password" />
            </div>
            <div> 
                <label>Confirm Password</label><br />
                <input name="confirmpassword" type="password" />
            </div>
            <button type="submit">Submit Form</button>
            <button type="Reset">Reset Form</button>
        </form>
<?php
}
