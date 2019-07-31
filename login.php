<?php
	include_once "common/base.php";
	$pageTitle = "Log In";

	if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])):
		include_once "common/header.php";
?>

		<p>You are currently <strong>logged in.</strong></p>
		<p><a href="logout.php">Log out</a></p>
<?php
	elseif
		(
			!empty($_POST['token'])
			&& $_SESSION['token']==$_POST['token']
			&& !empty($_POST['username'])
			&& !empty($_POST['password'])
		):
		include_once 'inc/class.people.inc.php';
		$users = new People($db);
		if($users->accountLogin()===TRUE):
			header("Location: index.php");
			exit;
		else:
			include_once "common/header.php";
?>
		    	
		<h2>Login Failed&mdash;Try Again?</h2>
		<form method="post" action="login.php" name="loginform" id="loginform">
			<div>
            	<label for="username">Email</label>
				<input type="text" name="username" id="username" />
				<br /><br />
                <label for="password">Password</label>
				<input type="password" name="password" id="password" />
				<br /><br />
				<input type="submit" name="login" id="login" value="Login" class="button" />
				<input type="hidden" name="token"
					value="<?php echo $_SESSION['token']; ?>" />
			</div>
		</form>
		<p><a href="/password.php">Did you forget your password?</a></p>
<?php
		endif;
	else:
		include_once "common/header.php";
?>
       
        
<form method="post" action="login.php" name="loginform" id="loginform" class="form-horizontal">
<fieldset>
<legend><h2>Your list awaits...</h2></legend>

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

<div class="control-group">  
<label class="control-label" for="username">Email:</label>  
<div class="controls">  
<input type="text" class="input-xlarge" name="username" id="username">  
<p class="help-block">

</p>  
</div>
</div> 

<div class="control-group">  
<label class="control-label" for="password">Password:</label>  
<div class="controls">  
<input type="password" class="input-xlarge" name="password" id="password">  
<p class="help-block">
<a href="password.php">Did you forget your password?</a>
</p>  
</div>
</div> 

<div class="form-actions">  
<button name="login" id="login" type="submit" class="btn btn-warning btn-large">Login</button>  
</div> 
</fieldset>
</form> 
<?php
	endif;
?>

		<div style="clear: both;"></div>
<?php
	//include_once "common/ads.php";
	include_once "common/close.php";
?>