<?php
	include_once "common/base.php";
	$pageTitle = "Home";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<?php

	//pre-populate the fields.
	include_once 'inc/class.stuff.inc.php';
	$lists = new Stuff($db);
	list(
			$VaultID,
			$doctor_name,
			$doctor_contact,
			$funeral,
			$resting,
			$will,
			$additional_info,
			$file_name_wedding,
			$file_directory_wedding,
			$file_name_birth,
			$file_directory_birth,
			$file_name_insurance,
			$file_directory_insurance
		) = $lists->loadVaultItems();
	//end of pre-populate
	
	
	//update vault
	if (isset($_POST['update']))
	{
		include_once "inc/class.stuff.inc.php";	
		$userObj = new Stuff($db);
		if ($userObj -> uploadVault() === TRUE)
		{
			header("Location: vault.php?updated=true");		
		}
	}
	//end of update
	
	
	
	//deleting of items
	if (isset($_GET['delete']))
	{
		$id = $_GET['id'];
		$type = $_GET['delete'];
		
		include_once "inc/class.stuff.inc.php";	
		$userObj = new Stuff($db);
		if ($userObj -> deleteVaultItem($type,$id) === TRUE)
		{
			header("Location: vault.php?updated=true");		
		}
	}
	//

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
<form class="form-horizontal" method="post" action="vault.php" enctype="multipart/form-data">  
        <fieldset>  
          <legend><h2>Your Vault</h2></legend> 
           
           <input type="hidden" name="update" value="true" />
           
          <div class="control-group">  
            <label class="control-label" for="input01">Doctors name:</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" id="input01" name="doctor_name" value="<?=$doctor_name?>">  
              <p class="help-block"></p>  
            </div>
          </div>
          
          <div class="control-group">  
            <label class="control-label" for="input01">Doctors contact:</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" id="input01" name="doctor_contact" value="<?=$doctor_contact?>">  
              <p class="help-block"></p>  
            </div>
          </div>
             
          <div class="control-group">  
            <label class="control-label" for="fileInput">Wedding Certificate:</label>  
            <div class="controls">  
              <input class="input-file" id="fileInput" type="file" name="WeddingCertificate" >
              <br/>
              <?php if (!isset($file_name_wedding))		  
			  {				  
			  ?> 
              <a href="<?=$file_directory_wedding?>" title="Download">
              	<span class="label label-info">
					<?=$file_name_wedding?>
                </span>
              </a>
              
             
                  <a href="vault.php?delete=wedding&id=<?=$VaultID?>">
                      <span class="label label-important">Delete</span>
                  </a>
              <?php			  
			  }				
			  ?>              
              
            </div> 
          </div> 
          
          <div class="control-group">  
            <label class="control-label" for="fileInput">Birth Certificate:</label>  
            <div class="controls">  
              <input class="input-file" id="fileInput" type="file" name="BirthCertificate" value="<?=$file_name_birth?>">  
              <br/>
              <?php if (!isset($file_name_birth))		  
			  {				  
			  ?>
              <a href="<?=$file_directory_birth?>" title="Download">
              <span class="label label-info"><?=$file_name_birth?></span> 
              </a>
              

                  <a href="vault.php?delete=birth&id=<?=$VaultID?>">
                    <span class="label label-important">Delete</span>
                  </a>              
              <?php			  
			  }			  
			  ?>
              
            </div>  
          </div> 
          
          <div class="control-group">  
            <label class="control-label" for="fileInput">Insurance Details:</label>  
            <div class="controls">  
              <input class="input-file" id="fileInput" type="file" name="InsuranceDetails" value="<?=$file_name_insurance?>">  
              <br/>
              <?php if (!isset($file_name_insurance))		  
			  {				  
			  ?>
              <a href="<?=$file_directory_insurance?>" title="Download" >
              	<span class="label label-info"><?=$file_name_insurance?></span> 
              </a>

                  <a href="vault.php?delete=insurance&id=<?=$VaultID?>">
                    <span class="label label-important">Delete</span>
                  </a>
              <?php
			  }
			  ?>
            </div>  
          </div> 
           
          <div class="control-group">  
            <label class="control-label" for="textarea">Funeral Arrangements:</label>  
            <div class="controls">  
              <textarea class="input-xlarge" id="textarea" rows="3" name="funeral" ><?=$funeral?></textarea>  
            </div>  
          </div>
          
          <div class="control-group">  
            <label class="control-label" for="input01">Final resting place:</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" id="input01" name="resting" value="<?=$resting?>">  
              <p class="help-block"></p>  
            </div>
          </div>
          
          <div class="control-group">  
            <label class="control-label" for="input01">Will information:</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" id="input01" name="will" value="<?=$will?>">  
              <p class="help-block"></p>  
            </div>
          </div>
          
          <div class="control-group">  
            <label class="control-label" for="textarea">Additional information:</label>  
            <div class="controls">  
              <textarea class="input-xlarge" id="textarea" rows="3" name="additional_info"><?=$additional_info?></textarea>  
            </div>  
          </div>
          
          <div class="form-actions">  
            <button type="submit" class="btn btn-warning btn-large">Save changes</button>  
            <!--<button class="btn">Cancel</button>-->  
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