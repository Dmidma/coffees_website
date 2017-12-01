<?php

	require("../includes/config.php");



	if (verify_connected_user() === true) 
	{
		render("home.php", ["title" => "Welcome"]);
		exit;
	}


	render("lock.php", ["title" => "Lock page"]);
?>