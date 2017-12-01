<?php
	

	// configuration
	// require("./includes/functions.php");
	require("../includes/config.php");

	// if user reached page via GET	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{	
		
		redirect("index.php#toregister");
		//render("signup.php", ["title" => "Sign Up"]);
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	

		// Nothing to check since we can have different users
		// with the same name and/or last_name and/or birthday
		$name = $_POST["name"];
		$last_name = $_POST["last_name"];
	
		// $birthday = DateTime::createFromFormat("Y-M-D", $_POST["birthday"]);
		// debug_to_console($birthday->format("d-m-Y"));
		

		// check the user name
		$username = $_POST["username"];
		$check_username = query("SELECT COUNT(*) as nbr_users FROM user_registery WHERE username=?;", $username);
		if (isset($check_username["nbr_users"]) && $check_username["nbr_users"] != 0)
		{
			// invalid username
			same_page_error("index.php", "Sign UP", "Invalid User Name!");
		}


		$password = $_POST["password"];
		$confirmation = $_POST["confirmation"];
		// check if the password and confirmation are identical
		if ($password != $confirmation)
		{	
			// password does not confirm
			same_page_error("signup.php", "Sign UP", "Password and Confrimation does not match!");
		}

		// check the length of the password
		if (!$password || mb_strlen($password) < 8)
		{
			// invalid password
			same_page_error("signup.php", "Sign UP", "Password must contain 8+ characters!");
		}
		
		// generate a salt for the password
		$salt = generate_salt();
		// hash the salt and password
		$hashed_password = saltit_hashit($password, $salt);

		
		// start a transaction here, since we are going to insert a block
		query("START TRANSACTION;");
		
		// TODO: check this
		$email_id = check_email($_POST["email"]);
		if ($email_id === false)
		{
			// the email was intered in a wrong manner
			same_page_error("lock.php", "Sign UP", "Invalid Email!");
		}
		

		

		// insert the new user to the database		
		$insert_query = "INSERT INTO user_registery (name, last_name, username, password, melh, email) VALUES (?, ?, ?, ?, ?, ?);";

		$inserted_user = query($insert_query, $name, $last_name, $username, $hashed_password, $salt, $email_id);
		something_went_wrong("signup.php", $inserted_user);

		/*
		// send email confirmation
		$sent_mail = send_verification_email($email, $salt, query("SELECT LAST_INSERT_ID() AS id")[0]["id"]);
		something_went_wrong("signup.php", $sent_mail);
		*/

		// commit the transaction
		$after_insertion = query("COMMIT;");
		something_went_wrong("signup.php", $after_insertion);

		// should add something to the user!
		// This will print something to the user
		same_page_error("lock.php", "Sign UP", "Sign Up done! Please confirm your email!");
		exit;
	}
?>