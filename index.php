<?php
	include_once "common/base.php";
	$pageTitle = "Home";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<!-- content goes here -->


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