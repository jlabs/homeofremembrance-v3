<?php
	include_once "common/base.php";
	$pageTitle = "Home";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<form action="db-interaction/users.php" method="post" class="form-horizontal">
<fieldset> 
		<legend><h2>Reset Your Password</h2></legend>
	
		<input type="hidden" name="action" value="resetpassword" />
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
				
                    
        <div class="control-group">  
            <label class="control-label" for="username">Your email address:</label>  
            <div class="controls">  
                <input type="text" class="input-xlarge" name="username" id="username" value="<?=$_SESSION['username']?>">  
                <p class="help-block">
                    An email will be sent to your registered email to reset your password.
                </p>  
            </div>
        </div> 
                            
        <div class="form-actions">  
        <button name="reset" id="reset" value="Reset Password" type="submit" class="btn btn-warning btn-large">Yes</button>  
  
</div> 
</fieldset>
		</form>

<?php else:
	//if the person isn't logged in, then give a sample page.
	include_once "sample-page.php";
	endif;
?>
            
<?php
	//the footer of the page.
	//include_once "common/ads.php";
	include_once "common/close.php";
?>