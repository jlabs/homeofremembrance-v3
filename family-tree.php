<?php
	include_once "common/base.php";
	$pageTitle = "Home";
	include_once "common/header.php";
?>

<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])&& $_SESSION['LoggedIn']==1): ?>

<!-- content goes here -->
<div id='chart_div'></div>


<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>
  google.load('visualization', '1', {packages:['orgchart']});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Name');
	data.addColumn('string', 'Parent');
	data.addRows([
	  ['Jack and Valerie', ''],
	  ['Betty and Bill',''],
	  
	  ['Mark', 'Jack and Valerie'],['Susan', 'Jack and Valerie'],
	  ['Terry','Betty and Bill'],['Tina','Betty and Bill'],['Sandra','Betty and Bill'],
	  //[{v:'Jamie',f:'Jamie<br /><a href="#" style="color:red;">Edit</a><a href="#" style="color:red;">Remove</a>'}, 'Susan'],
	  
	]);
	var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
	chart.draw(data, {allowHtml:true});
  }
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