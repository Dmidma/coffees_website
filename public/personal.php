<?php
	
	require("../includes/config.php");


	if (verify_connected_user() === true) 
	{		

		// fetch information about the user
		
		$user_query = "SELECT u.name, u.last_name, u.username, e.local_part, d.domain_name, d.domain_tld FROM user_registery u INNER JOIN email e INNER JOIN email_domains d ON e.domain_id = d.id AND e.id = u.email WHERE u.id=?;";

		$user = query($user_query, $_SESSION["connected_user"])[0];


		if ($_SERVER["REQUEST_METHOD"] == "GET")
		{
			render("personal.php", ["title" => "User Space", "user" => $user]);
			exit;
		}
		else if ($_SERVER["REQUEST_METHOD"] == "POST")
		{	

			query("START TRANSACTION;");

			// get both password and confirmation
			$password = $_POST["password"];
			$confirmation = $_POST["confirmation"];
			// check if the password and confirmation are identical
			if ($password != $confirmation)
			{	
				// password does not confirm
				render("personal.php", ["title" => "User Space", "user" => $user, "message" => "Password and Confrimation does not match!"]);
				exit;
			}

			// check the length of the password
			if (!$password || mb_strlen($password) < 8)
			{
				// invalid password
				render("personal.php", ["title" => "User Space", "user" => $user, "message" => "Password must contain 8+ characters!"]);
				exit;
			}
			
			// generate a salt for the password
			$salt = generate_salt();
			// hash the salt and password
			$hashed_password = saltit_hashit($password, $salt);


			$update_password = "UPDATE user_registery SET melh=?, password=? WHERE id=?;";


			$final_result = query($update_password, $salt, $hashed_password, $_SESSION["connected_user"]);
			if ($final_result === false)
			{
				render("personal.php", ["title" => "User Space", "user" => $user, "message" => "Something went wrong! Please repeat!"]);
				exit;
			}

			query("COMMIT;");
			

			render("personal.php", ["title" => "User Space", "user" => $user, "message" => "Password Changed!"]);
			exit;
		}
	}

	redirect("index.php");

?>