<?php 
	header("Content-type: text/css");
	
	//start of custom colours
	$dark_grey = "#292929";
	$gold_green = "#E4FC60";
	$card_grey = "#E6E6E6";
	$card_bg = "#F4F4F4";
	
	//transparent colours
	$transparent_yellow = "rgba(201,173,71,0.85)";
	
	//flat ui colours
	$colour_sunflower = "#F1C40F";
	$colour_asbestos = "#7F8C8D";
	$colour_midnightblue = "#2C3E50";
?>

body { color:<?=$dark_grey?> !important; background: url(../images/bg-small.jpg) !important; background-size:100% auto; }
form { background:<?=$card_grey?> !important; margin-top:-10px; }
legend { margin-right:-13px; }
input[type="file"] {  }
h2 { margin-bottom:-2px; margin-left:13px; }
a { color:<?=$card_grey?>; }

.form-horizontal { background-color:<?=$transparent_yellow?> !important; }
.form-horizontal .controls { margin-left:400px; }
.form-horizontal .control-label { width:380px; padding-left:5px; }
.form-horizontal .form-actions { padding-left:400px; }

.span12 { font-size:18px; }
.form-actions { background:<?=$card_grey?> !important; }
.form-horizontal textarea { <?=$card_grey?> !important; }

.navbar-inner { background:<?=$dark_grey?> !important; border:0px; }
.navbar .nav > li > a { color:<?=$card_bg?> !important; font-size:24px; text-shadow:0 0 0 !important; }
.navbar .nav li.dropdown.open > .dropdown-toggle { color:<?=$dark_grey?> !important; }

.container {margin-top:0px !important; }

.row { background-color:<?=$transparent_yellow?> !important; margin-left:0px; }

.editable-area { display:inline; font-size:18px; }
.editable-area form input[type=text] { width:250px; }

.dropdown-menu { background:<?=$dark_grey?> !important; }
.dropdown-menu li > a:hover { background:<?=$gold_green?>; color:<?=$dark_grey?>; }
.dropdown-menu li > a { color:<?=$card_bg?>; }

.form-horizontal .control-label { font-weight:bold; font-size:18px; }

.ui-datepicker { background:white; }
.ui-datepicker-header { background:<?=$dark_grey?>; }

select { width:auto; }

.alert {  }

.thumbnail { border:1px #fff dashed }

<!-- header stuff -->
.header-thumbnails { display:inline; padding-left:10px; }
.header-thumbnail { padding-left:8px; }
<!-- end of header stuff -->

<!-- bucket list stuff -->

#list { list-style: none; }
#list li { position: relative; margin: 0 0 8px 0; padding: 0 0 0 70px; width: 835px; }
#list li span { padding: 8px; width: 815px; display: block; position: relative; }
.colorBlue span { background: rgb(115, 184, 191); }
.colorYellow span { background: rgb(255, 255, 255); }
.colorRed span { background: rgb(187, 49, 47); color: white; }
.colorGreen span { background: rgb(145, 191, 75); }
.tab { background: url(../images/minibuttons.png) no-repeat; height: 21px; top: 8px; }
.draggertab { position: absolute; left: 0px; width: 31px; cursor: move; }
.draggertab:hover { background-position: 0 -21px; }
.colortab { position: absolute; left: 34px; width: 34px; background-position: -31px 0; cursor: pointer; }
.colortab:hover { background-position: -31px -21px; }
.deletetab { position: absolute; right: -35px; width: 15px; background-position: -82px 0; cursor: pointer; }
.deletetab:hover { background-position: -82px -21px; }
.donetab { position: absolute; right: -17px; width: 16px; background-position: -65px 0; cursor: pointer; }
.donetab:hover { background-position: -65px -21px; }
.crossout { position: absolute; top: 50%; left: 0; height: 1px; }

#share-area { margin: 20px 0 0 68px; width: 600px; background: rgba(0,0,0,0.5); color:white; padding:5px; }

<!-- end of bucket list stuff -->