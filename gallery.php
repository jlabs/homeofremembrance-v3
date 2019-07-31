<?php
	include_once "common/base.php";
	$pageTitle = "Home";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<!-- content goes here -->
<?php
	if (isset($_POST['update']))
	{
		include_once "inc/class.stuff.inc.php";	
		$userObj = new Stuff($db);
		if ($userObj -> uploadImageToGallery() === TRUE)
		{
			//header("Location: gallery.php?updated=true");		
		}
	}
?>

<?php
//if the page has been updated

if ((isset($_GET['updated'])) && ($_GET['updated'] == true))
{
?>
<div class="alert alert-success">  
  <a class="close" data-dismiss="alert">×</a>  
  <strong>Success!</strong> File Uploaded.  
</div> 
<?php
}
?>

<form class="form-horizontal" method="post" action="gallery.php" enctype="multipart/form-data">  
    <fieldset>  
		<legend><h2>Image Gallery</h2></legend>		
		<input type="hidden" name="update" value="true" />		
		<div class="control-group">  
			<label class="control-label" for="fileInput">Upload your image here:</label>  
			<div class="controls">  
				<input class="input-file" id="fileInput" type="file" name="Image" accept="image/*">  
			</div>  
		</div> 	
		<div class="form-actions">  
			<button type="submit" class="btn btn-warning btn-large"><i class="icon-save"></i> Upload image.</button>  
		</div>
    
    </fieldset>
</form>

<div class="container">
<div class="row"> 
<?php	
	include_once 'inc/class.stuff.inc.php';
	$lists = new Stuff($db);
	
	echo "<ul class='thumbnails'>";
	list($output) = $lists->loadImages();
	echo "</ul>";
?>
</div>
</div>
<!--end of content-->

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