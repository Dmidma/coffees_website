<?php
	
	/**
	 * functions.php
	 *
	 * Essential and helper functions.
	 */
	
	require_once("constants.php");



	/**
	 * Function that will make a database connection, and then 
	 * executes the SQL query if valid.
	 * It will return an array of all rows in result set or 
	 * false on error.
	 */
	function query()
	{
		// SQL Statement
		$sql = func_get_arg(0);

		// Parameters, if any
		$parameters = array_slice(func_get_args(), 1);

		// try to connect to database
		static $handle;
		if (!isset($handle))
		{
			try
			{
				// connect to database
				$handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

				// ensure that PDO::prepare returns false when passed invalid SQL
				$handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch (Exception $e)
			{
				// trigger error and exit
				trigger_error($e->getMessage(), E_USER_ERROR);
				exit;
			}
		}

		// prepare SQL statement
		$statement = $handle->prepare($sql);
		if ($statement === false)
		{
			// trigger error and exit
			trigger_error($handle->errorInfo()[2], E_USER_ERROR);
			exit;
		}

		// execute SQL statement
		$results = $statement->execute($parameters);

		// return results set's rows, if any
		if ($results !== false)
		{
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			return false;
		}
	}


	/**
	 * Function that help debug on the JavaScript console.
	 * It will test if the data is an object or regular variable.
	 */
	function debug_to_console($data)
	{
		if (is_array($data) || is_object($data))
		{
			echo("<script>console.log('PHP console debuging:" . json_decode($data) . "');</script>");
		}
		else
		{
			echo("<script>console.log('PHP console debuging:" . $data . "');</script>");	
		}
	}

	/**
	 * Renders template, passing in values.
	 */
	function render($template, $values = [])
	{
		// if template exists, render it
		if (file_exists("../templates/$template"))
		{
			// extract variables into local scope
			extract($values);

			// render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer.php");
		}
		else
		{
			trigger_error("Invalid template: $template", E_USER_ERROR);
		}
	}


	/**
	 * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
	 */
	function redirect($destination)
	{
		// handle URL
		if (preg_match("/^https?:\/\//", $destination))
		{
			header("Location: " . $destination);
		}

		// handle abolute path
		else if (preg_match("/^\//", $destination))
		{
			$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
			$host = $_SERVER["HTTP_HOST"];
			header("Location: $protocol://$host$destination");
		}

		// handle relative path
		{
			$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
			$host = $_SERVER["HTTP_HOST"];
			$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: $protocol://$host$path/$destination");
		}

		// exit immediately since we're redirecting anyway
		exit;
	}


	/**
	 * This function will download the image from the url and save it
	 * into the image_path.
	 * @param  String $url        The url of the image.
	 * @param  String $image_path The path of the image.
	 */
	function download_image($url, $image_path)
	{
    	file_put_contents($image_path, file_get_contents($url));
	}


	function download_image_into_dir($url, $image_name, $folder) 
	{
		// trim the url
		$url = trim($url);

		// get image format from the image url
		$image_format = array();
		preg_match("/\..{3}$/", $url, $image_format);

		// if no format was found exit with false
		if (!isset($image_format[0]))
		{
			return false;
		}


		// create the image's name
		$img = $image_name . strtolower($image_format[0]);

		// lowercase the letters of the img
		$img = strtolower($img);

		// replace any space or / by _
		$to_replace = array("/", " ");
		$img = str_replace($to_replace, "_", $img);

		// check the validity of the folder
		// TODO: comment this out on the server
		/*
		if (!file_exists($folder))
		{
			return false;
		}
		*/
		// Dahh !
		download_image($url, $folder . $img);

		// return the name of the image
		return $img;
	}



	function logout()
	{
		// unset any session variables
		$_SESSION = [];


		// destroy session
		session_destroy();
	}


	function same_page_error($template, $title, $message)
	{
		render($template, ["title" => $title, "message" => $message]);
		exit;
	}

	
	// This function will generate a salt text with the specified length.
	// The length will be by default 20
	function generate_salt($leng = 20)
	{
        $salt = "";
        $possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        
        for ($i = 0; $i < $leng; $i++ )
			$salt = $salt . substr($possible, rand(0, strlen($possible)), 1);
		

		// substr(str_shuffle(str_repeat($possible, $leng)), 0,$leng);

        return $salt;
	}

	/**
     * Sends email to user, using PHPMailer.
     */
    function send_email($email, $msg)
    {	

    	require("./includes/PHPMailer-master/PHPMailerAutoload.php");

        

    	$mail = new PHPMailer;

    	$mail->isSMTP();
    	$mail->Host = 'smtp-mail.outlook.com';
    	$mail->Port = 587;	
    	$mail->SMTPAuth = true;
    	$mail->Username = 'verify-me1@outlook.com';
    	$mail->Password = 'harder1593';

    	$mail->setFrom('verify-me1@outlook.com', 'Verify');
    	$mail->addAddress($email);
    	$mail->isHTML(true);			

    	$mail->Subject = 'Email Verification';
    	$mail->Body    = '<h1>Thank you for your Registration</h1>' . '<b>' . $msg . '</b>';
    	
    	// if the email was successfuly sent we will redirect to profile
    	if($mail->send())
    	{
    	    return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    function send_verification_email($email, $salt, $id)
    {
    	$msg = "Verify your email by clicking on this link: " . "http://mi-casa/oth/verify.php?pghz=" . $id . "&eadef=" . $salt;
    	return send_email($email, $msg);
    }

    function something_went_wrong($template, $bool)
    {	
    	if ($bool === false)
    	{	
    		query("ROLLBACK;");
    		same_page_error($template, "Error", "Something Went Wrong! Plz Repeat");
    	}
    }


    /**
     * This function will check the email, if it is inserted it will return false
     * else it will insert it in the database and return its id.
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    function check_email($email)
    {
    	// Retrieve domain, top level domain, and local part of the email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if ($email === false)
		{
			// the email was intered in a wrong manner
			return false;
		}
			
		$two_parts = explode("@", $email);
		$local = $two_parts[0];
		$domains = $two_parts[1];

		$two_parts = explode(".", $domains);
		$domain = $two_parts[0];
		$tld = $two_parts[1];


		// check if the email is not used
		$email_query = 'SELECT COUNT(*) AS nbr_emails FROM email e INNER JOIN email_domains d ON e.domain_id=d.id where e.local_part=? AND d.domain_name=? AND d.domain_tld=?;';
		$check_email = query($email_query, $local, $domain, $tld)[0];

		// used email
		if ($check_email["nbr_emails"] != 0)
			return false;

		// check the email domains
		$query_email_domains = "SELECT id FROM email_domains WHERE domain_name=? AND domain_tld=?;";
		$check_email_domains = query($query_email_domains, $domain, $tld);

		if ($check_email_domains === false)
			return false;

		// found a match
		if (isset($check_email_domains) && isset($check_email_domains[0]))
		{	
			// get email domain id
			$email_domain_id = $check_email_domains[0]["id"];
		}
		else
		{	
			// insert the new email domain
			$query_insert_email_domains = "INSERT INTO email_domains (domain_name, domain_tld) VALUES (?, ?);";
			query($query_insert_email_domains, $domain, $tld);
			// get email domain id
			$email_domain_id = query("SELECT LAST_INSERT_ID() AS id")[0]["id"];
			if ($email_domain_id === false)
				return false;
		}

		// insert the local part
		$query_insert_email = "INSERT INTO email (local_part, domain_id) VALUES(?, ?);";
		$inserted_email = query($query_insert_email, $local, $email_domain_id);
		if ($inserted_email === false)
			return false;

		// get email id
		$email_id = query("SELECT LAST_INSERT_ID() AS id")[0]["id"];
		if ($email_id === false)
			return false;
		else
			return $email_id;

    }

    /**
     * Given a password and salt this function will concatinate the both parameter
     * and generate a hashed password
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    function saltit_hashit($password, $salt)
    {
    	// PASSWORD_DEFAULT specifies the bcrypt algorithm
		// cost array key specifies the work factor
		// Hash the password with the salt
		$password_and_salt = trim($password) . $salt;
		$hashed_password = password_hash($password_and_salt, PASSWORD_DEFAULT, ['cost' => 12]);

		return $hashed_password;
    }



    function verify_connected_user()
    {
    	if (isset($_SESSION["connected_user"]))
		{
			// verify the id of the connected user
			$user_id = $_SESSION["connected_user"];
			$verify_user = "SELECT COUNT(id) AS nbr FROM user_registery WHERE id=?";
			$result = query($verify_user, $user_id);
			if (isset($result[0]["nbr"]) && $result[0]["nbr"] == 1)
			{
				return true;
			}
		}

		return false;
    }

?>