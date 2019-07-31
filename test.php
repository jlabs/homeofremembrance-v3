<?php


if(isset($_POST['textybox']))
{
	echo $_FILES['thing']["name"];
	echo $_FILES["thing"]["size"];
	
	echo $_POST['textybox'];
}

?>

<form method="post" />
<input type="text" name="textbox" />
<input type="file" name="thing" />
<input type="submit" value="send" />
</form>