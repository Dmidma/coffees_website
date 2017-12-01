<?php
	
	require("../../includes/functions.php");


	// Reaching only via POST
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		// TODO: test the existance of session.

		// ensure id was found
		if (!empty($_POST["id"]))
		{	
			// save the video id in another variable
			$video_id = $_POST["id"];

			$final = false;

			// start the transaction
			query("START TRANSACTION;");

			// remove the email
			query("DELETE FROM email WHERE id=" . $video_id . ";");
			
			

			// commit the transaction
			$final = query("COMMIT;");


			echo $final;
		}
	}
?>
