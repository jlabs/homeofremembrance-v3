<?php
	include_once "common/base.php";
	$pageTitle = "Treasured Memories";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<?php
	//uploading memory
	if (isset($_POST['update']))
	{
		include_once "inc/class.stuff.inc.php";	
		$userObj = new Stuff($db);
		if ($userObj -> uploadTreasuredMemory() === TRUE)
		{
			header("Location: treasured-memories.php?updated=true");		
		}
	}
	
	//deleting a memory
	if (isset($_GET['delete']))
	{
		$id = $_GET['delete'];	
		
		include_once "inc/class.stuff.inc.php";	
		$userObj = new Stuff($db);
		if ($userObj -> deleteTreasuredMemory($id) === TRUE)
		{
			header("Location: treasured-memories.php?updated=true");		
		}
	}
?>

<?php

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


<!-- content goes here -->
<form class="form-horizontal" action="treasured-memories.php" method="post" enctype="multipart/form-data">  
<fieldset>  
<legend><h2>Treasured Memories</h2></legend>

<input type="hidden" name="update" value="true" />

<div class="control-group">  
    <label class="control-label" for="input01">Location</label>  
    <div class="controls">  
    	<input type="text" class="input-xlarge" id="Born" value="" name="Location">  
    	<p class="help-block">The location of the treasured memory.</p>  
	</div>
</div> 

<div class="control-group">  
<label class="control-label" for="input01">Notes</label>  
<div class="controls">  
<input type="text" class="input-xlarge" id="input01" value="" name="Notes">  
<p class="help-block">Any notes to do with your treasured memory.</p>  
</div>
</div> 
 

<div class="control-group">  
<label class="control-label" for="select01">Date of memory:</label>  
<div class="controls">  
  <select id="select01" name="memory_day">  
    <option>1</option>
    <?php //echo through a loop to get days
        for ($i = 2; $i <= 31; $i++)
        {
            echo "<option>$i</option>";
        }
    ?>  
  </select>  
  
  <select id="select01" name="memory_month"> 
  <option>January</option> 
    <?php //echo through a loop to get months
        for ($i = 2; $i <= 12; $i++)
        {
            $monthName = date("F", mktime(0, 0, 0, $i, 10));
            echo "<option>$monthName</option>";
        }
    ?>  
  </select> 
  
  <select id="select01" name="memory_year"> 
  <option>1990</option> 
    <?php //echo through a loop to get years
        $currentYear = date("Y");
        for ($i = 1901; $i <= $currentYear; $i++)
        {
            echo "<option>$i</option>";
        }
    ?>  
  </select> 
</div>  
</div>

    <div class="control-group">  
        <label class="control-label" for="fileInput">Upload time capsule item:</label>  
        <div class="controls">  
        	<input class="input-file" id="fileInput" type="file" name="TreasuredMemory">  
        </div>  
    </div>

<div class="form-actions">  
<button type="submit" class="btn btn-warning btn-large">Add Memory</button>  
<button class="btn">Cancel</button>  
</div> 
</fieldset>  
</form>

<div class="container">
<div class="row"> 
<?php	
	include_once 'inc/class.stuff.inc.php';
	$lists = new Stuff($db);
	
	//echo "<ul>";
	list($output) = $lists->loadTreasuredMemories();
	//echo "</ul>";
?>
</div>
</div>
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