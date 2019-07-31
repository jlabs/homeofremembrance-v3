<?php
	include_once "common/base.php";
	$pageTitle = "Register";
	include_once "common/header.php";

	if(!empty($_POST['username'])):
		include_once "inc/class.users.inc.php";
		$users = new ColoredListsUsers($db);
		echo $users->createAccount();
	else: 
?>

		
		<form method="post" action="signup.php" id="registerform" class="form-horizontal">
        <fieldset>
        <legend><h2>Sign up</h2></legend>
        
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

        <div class="control-group">  
            <label class="control-label" for="username">Email:</label>  
            <div class="controls">  
                <input type="text" class="input-xlarge" name="username" id="username">  
                <p class="help-block">
                    An email will be sent to your registered email to register.
                </p>  
            </div>
        </div> 
				
            
<div class="form-actions">  
<button name="register" id="register" value="Reset Password" type="submit" class="btn btn-warning btn-large">Sign Me Up</button>  

</div> 
</fieldset>
</form>

<?php
	endif;
	include_once 'common/close.php';
?>