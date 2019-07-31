<?php
	include_once "common/base.php";
	$pageTitle = "My Details.";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<?php

	//pre-populate the fields.
	include_once 'inc/class.people.inc.php';
	$lists = new People($db);
	list(
		$Firstname,
		$Surname,
		$dob_day,
		$dob_month,
		$dob_year
		) = $lists->loadMyDetails();
	//end of pre-populate
	
	//save the updated info
	if (isset($_POST['update']))
	{
		include_once "inc/class.people.inc.php";	
		$userObj = new People($db);
		if ($userObj -> saveMyDetails() === TRUE)
		{
			header("Location: my-details.php?updated=true");
			$updated = true;
			exit;
		}
	}
	//end of save

?>

<!-- content goes here -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

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

<form class="form-horizontal" method="post" action="my-details.php">  
        <fieldset>  
          <legend><h2>Enter your details on this page.</h2></legend> 
          
          <input type="hidden" name="update" value="true" />
           
          <div class="control-group">  
            <label class="control-label" for="input01">Firstname</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" id="input01" name="Firstname" value="<?=$Firstname?>">  
              <p class="help-block">You can enter your firstname here.</p>  
            </div>
              
          </div>
          <div class="control-group">  
            <label class="control-label" for="input01">Surname</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" id="input01" name="Surname" value="<?=$Surname?>" /></p>  
              <p class="help-block">Enter your surname here.</p>  
            </div>
		</div>
        
          <div class="control-group">  
            <label class="control-label" for="select01">Your date of birth.</label>  
            <div class="controls">  
              <select id="select01" name="dob_day">  
              	<option><?=$dob_day?></option>
              	<?php //echo through a loop to get days
					for ($i = 1; $i <= 31; $i++)
					{
						echo "<option>$i</option>";
					}
				?>  
              </select>  
              
              <select id="select01" name="dob_month"> 
              <option><?=$dob_month?></option> 
              	<?php //echo through a loop to get months
					for ($i = 1; $i <= 12; $i++)
					{
						$monthName = date("F", mktime(0, 0, 0, $i, 10));
						echo "<option>$monthName</option>";
					}
				?>  
              </select> 
              
              <select id="select01" name="dob_year"> 
              <option><?=$dob_year?></option> 
              	<?php //echo through a loop to get years
					$currentYear = date("Y");
					for ($i = 1900; $i <= $currentYear; $i++)
					{
						echo "<option>$i</option>";
					}
				?>  
              </select> 
            </div>  
          </div>
                
          <div class="form-actions">  
            <button type="submit" class="btn btn-warning btn-large">Save changes</button>  
            <button class="btn">Cancel</button>  
          </div>  
        </fieldset>  
</form>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
    $( "#datepicker" ).datepicker( "option", "showAnim", "slide" );
	$( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "en-GB" ] );
  });
  </script>  

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