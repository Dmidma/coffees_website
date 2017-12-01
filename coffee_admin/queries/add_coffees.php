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
  			$description = $users->{$i}->{"description"};
  			$latitude = $users->{$i}->{"latitude"};
  			$longitude = $users->{$i}->{"longitude"};
  			$image_path = $users->{$i}->{"imagePath"};
  			$street_address = $users->{$i}->{"streetAddress"};
  			$phone = $users->{$i}->{"phone"};
  			

  			query("START TRANSACTION;");


  			// user insertion query
  			$uiq = "INSERT INTO coffee_shop (name, description, latitude, longitude, image_path, street_address, phone) VALUES (?, ?, ?, ?, ?, ?, ?);";


  			$check_insertion = query($uiq,
  				$name, 
  				$description, 
  				$latitude, 
  				$longitude, 
  				$image_path,
  				$street_address, 
  				$phone);

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