<?php
	include_once "common/base.php";
	$pageTitle = "Bucketlist";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<!-- content goes here -->
<?php

	include_once 'inc/class.lists.inc.php';
	$lists = new BucketListItems($db);
	$LID = $lists->getListID();
?>


<form action="db-interaction/lists.php" id="add-new" method="post" class="form-horizontal">
<fieldset>
<legend><h2>Your bucketlist.</h2></legend>

<input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
<input type="hidden" id="current-list" name="current-list" value="<?php echo $LID; ?>" />
<input type="hidden" id="new-list-item-position" name="new-list-item-position" value="<?php echo ++$order; ?>" />
<input type="hidden" name="action" value="add" />
  
<div class="control-group">  
<label class="control-label" for="username">Your bucketlist item:</label>  
<div class="controls"> 
<input type="text" id="new-list-item-text" name="new-list-item-text" />
<p class="help-block">

</p>  
</div>
</div>

<div class="form-actions">  
	<input type="submit" id="add-new-submit" value="Add" class="btn btn-warning btn-large" />
</div>
    
</fieldset>
</form>

<?php
if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username']))
{ 	            

	echo "\t\t\t<ul id='list' style='list-style:none; margin:0px;'>\n";

	include_once 'inc/class.lists.inc.php';
	$lists = new BucketListItems($db);
	list($LID, $URL, $order) = $lists->loadListItemsByUser();

	echo "</ul>";
}
?>

<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.mini.js"></script>
<script type="text/javascript" src="js/lists.js"></script>
<script type="text/javascript">
		 initialize();
</script>
<!-- end of content -->

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