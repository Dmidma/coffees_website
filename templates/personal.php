<link rel="stylesheet" type="text/css" href="../public/css/change.css">
<?php

	echo "<h3>Welcome <b>" . 
		$user["name"] . 
		"</b> <b>" . 
		$user["last_name"] .
		" </b>to our coffee website.</h3><br/>";

	echo "<p>Your username is : <i>" . 
		$user["username"] . 
		"</i>. Feel free to check the coffees and comment in the comment section.</p>";
	
	echo "<p>Your email address is: " . 
		$user["local_part"] . "@" . $user["domain_name"] . "." . $user["domain_tld"] . 
		"</p>";
?>

<h3>You can change your password here: </h3>

<form action="personal.php" method="post">
	<p> 
        <label for="password">Password: </label>
        <input name="password" required type="password" placeholder="Password"/>
    </p>
    <p> 
        <label for="password_confirm">Confirmation: </label>
        <input id="password_confirm" name="confirmation" required type="password" placeholder="Confirmation"/>
    </p>
	<input type="submit" value="Change"/> 
</form>

<div>
	<?php
		if (isset($message))
		{
			echo htmlspecialchars($message);
		}
	?>
	</div>