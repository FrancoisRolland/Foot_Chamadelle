<?php
header("Content-Type:text/plain; charset=iso-8859-1");

$equipe = "3";
if( isset($_GET['equipe']))
{
	
	if($_GET['equipe'] == $equipe)
	{
		echo "ici";
	}
	else
	{
		echo $_GET['equipe'];
	}
}
else
{
	echo "oula";
}

?>