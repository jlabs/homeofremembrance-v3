<?php

	include_once "common/base.php";
	$pageTitle = "About me.";
	include_once "common/header.php";
	
	//pre-populate the fields.
	include_once 'inc/class.people.inc.php';
	$lists = new People($db);
	list(
		$about_born,
		$about_parents,
		$about_lived,
		$about_educated,
		$about_currently,
		$about_likes,
		$about_dislikes,
		$about_about,
		$about_visibility
		) = $lists->loadAboutMe();

//update list

if (isset($_POST['update']))
{
	include_once "inc/class.people.inc.php";	
	$userObj = new People($db);
	if ($userObj -> saveAboutMe() === TRUE)
	{
		header("Location: about-me.php?updated=true");		
	}
}

//end of update
	
?>

<?php

if ((isset($_GET['updated'])) && ($_GET['updated'] == true))
{
?>
<div class="alert alert-success">  
  <a class="close" data-dismiss="alert">×</a>  
  <strong>Success!</strong> Changes were saved.  
</div> 
<?php
}
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<!-- content goes here -->

<form class="form-horizontal" action="about-me.php" method="post">  
<fieldset>  
<legend><h2>About Me</h2></legend>

<input type="hidden" name="update" value="true" />

<div class="control-group">  
    <label class="control-label" for="input01">I was born in</label>  
    <div class="controls">  
    	<input type="text" class="input-xlarge" id="Born" value="<?=$about_born?>" name="Born">  
    	<p class="help-block">You can enter your firstname here.</p>  
	</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">My parents are</label>  
<div class="controls">  
<input type="text" class="input-xlarge" id="input01" value="<?=$about_parents?>" name="Parents">  
<p class="help-block">You can enter your firstname here.</p>  
</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">During my life, I have lived in</label>  
<div class="controls">  
<textarea class="input-xlarge" id="textarea" rows="3" name="Lived"><?=$about_lived?></textarea>  
</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">I was educated at</label>  
<div class="controls">  
<textarea class="input-xlarge" id="textarea" rows="3" name="Educated"><?=$about_educated?></textarea>  
</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">I am currently</label>  
<div class="controls">  
<textarea class="input-xlarge" id="textarea" rows="3" name="Currently"><?=$about_currently?></textarea>  
</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">I'm really into</label>  
<div class="controls">  
<textarea class="input-xlarge" id="Like" rows="3" name="Likes"><?=$about_likes?></textarea>  
</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">But I don't like</label>  
<div class="controls">  
<textarea class="input-xlarge" id="textarea" rows="3" name="Dislikes"><?=$about_dislikes?></textarea>  
</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">And finally, a bit about me</label>  
<div class="controls">  
<textarea class="input-xlarge" id="textarea" rows="3" name="About"><?=$about_about?></textarea>  
</div> 
</div> 

<div class="form-actions">  
<button type="submit" class="btn btn-warning btn-large">Save changes</button>  
<button class="btn">Cancel</button>  
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