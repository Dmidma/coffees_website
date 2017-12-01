<?php
	

	require("../../includes/functions.php");
	
	$str_json = file_get_contents('php://input');


	$users = json_decode($str_json);


	$max_nbr_users = $users->{'nbrRows'};

	// map for each element
	// either 'success' or 'refused'
	$vads = [];

	for ($i = 1; $i <= $max_nbr_users; $i++)
	{

		if (isset($users->{$i}))
		{		
			// get all user variable
  			$name = $users->{$i}->{"name"};
  			$last_name = $users->{$i}->{"lastName"};
  			$birthday = $users->{$i}->{"birthday"};
  			$username = $users->{$i}->{"username"};
  			$password = $users->{$i}->{"password"};
  			$email = $users->{$i}->{"email"};
  			$verified = $users->{$i}->{"verified"};
  			$authority = $users->{$i}->{"authority"};

  			query("START TRANSACTION;");

  			// check if the current email is valid and get its id
  			$email_id = check_email($email);
  			if ($email_id === false)
  			{	
  				$vads[$i] = "refused";
  				continue;
  			}

  			// generate a salt for the password
			$salt = generate_salt();
			// hash the salt and password
			$hashed_password = saltit_hashit($password, $salt);

  			// user insertion query
  			$uiq = "INSERT INTO user_registery (name, last_name, username, password, melh, email, verified, authority) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";


  			$check_insertion = query($uiq,
  				$name, 
  				$last_name, 
  				$username, 
  				$hashed_password, 
  				$salt,
  				$email_id, 
  				$verified, 
  				$authority);

  			if ($check_insertion === false) 
  			{
  				$vads[$i] = "refused";
  				query("ROLLBACK;");
  			}
  			else
  			{
  				$vads[$i] = "success";
  				query("COMMIT;");
  			}
  			
		}
	}

	echo json_encode($vads);
	// var_dump($videos);
?>