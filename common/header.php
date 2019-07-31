<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"> 

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

	<title>Home of Remembrance | <?php echo $pageTitle ?></title>

	<!--<link rel="stylesheet" href="style.css" type="text/css" />-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-custom.php" type="text/css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!--[if IE]>
    	<link rel="stylesheet" href="css/bootstrap-custom-ie8.css">
    <![endif]-->
    
    <!--icon for the site-->
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- javascript for the site -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.jeditable.js" type="text/javascript" charset="utf-8"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2"></script>-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.3/jquery.backstretch.min.js"></script>

</head>

<body>

<noscript>This website requires Java in order to function correctly.</noscript>

<script type="text/javascript">
    $(document).ready(function() {
        $.backstretch("images/bg-small.jpg");
    });
</script>

	<div id="page-wrap">
		<div id="header">
			<!--<h1><a href="/">Colored Lists</a></h1>-->
			<div id="control">

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<!-- put logged in menu here. -->
<div class="navbar navbar-fixed-top">  
  <div class="navbar-inner">  
    <div class="container">  
    <!--navigation does here-->  
        <ul class="nav">  
            <li class="dropdown">  
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-home"></i>Hello<b class="caret"></b></a>  
                <ul class="dropdown-menu">  
                    <li><a href="#"><i class="icon-thumbs-up"></i>Help</a></li>  
                    <li><a href="#"><i class="icon-envelope"></i>Contact Us</a></li>  
                    <li><a href="password.php"><i class="icon-edit"></i>Change Password</a></li>
                    <li><a href="logout.php"><i class="icon-off"></i>Logout</a></li>  
                </ul>  
            </li>  
        </ul>
        
        <ul class="nav">  
            <li class="dropdown">  
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i><?=$_SESSION['Firstname']?><b class="caret"></b></a>  
                <ul class="dropdown-menu">  
                    <li><a href="about-me.php"><i class="icon-user"></i>About Me</a></li>  
                    <li><a href="gallery.php"><i class="icon-picture"></i>Photo Gallery</a></li> 
                    <li><a href="my-details.php"><i class="icon-reorder"></i>My Details</a></li>  
                    <li><a href="bucket-list.php"><i class="icon-list-ol"></i>My Bucket List</a></li>  
                    <li><a href="time-capsule.php"><i class="icon-time"></i>Time Capsule</a></li>  
                    <li><a href="vault.php"><i class="icon-key"></i>Vault</a></li>  
                    <li><a href="treasured-memories.php"><i class="icon-camera"></i>Treasured Memories</a></li>  
                </ul>  
            </li>  
        </ul> 
        
        <ul class="nav">  
            <li class="dropdown">  
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                	<i class="icon-group"></i>
					<?=$_SESSION['Surname']?><b class="caret"></b>
                </a>  
                <ul class="dropdown-menu">  
                    <li><a href="family-tree.php"><i class="icon-sitemap"></i>Family Tree</a></li>  
                </ul>  
            </li>  
        </ul>
		
		<?php	
			include_once 'inc/class.stuff.inc.php';
			$lists = new Stuff($db);
			list($output) = $lists->loadHeaderThumbs();
		?>
        
        <form class="navbar-search pull-right" style="background:none !important; padding-top:2px !important;">  
  			<input type="text" class="search-query" placeholder="<?php echo $_SESSION['UserID']; ?>"> 
		</form>
    </div>  
  </div>  
</div>
        
<?php else: ?>

<div class="navbar navbar-fixed-top">  
    <div class="navbar-inner">  
        <div class="container">  
        <ul class="nav">  
            <li><a href="signup.php">Sign up</a></li>  
            <li><a href="login.php">Log in</a></li>   
            </ul>  
        </div>  
    </div>  
</div> 
        
<?php endif; ?>

			</div>

			<div class="clear"></div>

		</div>
        
<div style="height:41px;"></div>
<br />
<div class="container">