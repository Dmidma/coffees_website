<?php
	
	require("../includes/config.php");

	if (!empty($_GET) && isset($_GET["comment"]) && isset($_GET["coffee"]) && verify_connected_user() === true)
	{	

		$coffee_id = $_GET["coffee"];
		$coffee_query = "SELECT name, description, image_path FROM coffee_shop WHERE id=?;";
		$result = query($coffee_query, $coffee_id);

		// if no coffee was found by that id
		// redirect to coffee.php
		if (empty($result))
			redirect("coffee.php");

		$user_id = $_SESSION["connected_user"];
		$comment = $_GET["comment"];

		$comment_query = "INSERT INTO comments (commenter, comment) VALUES (?, ?);";

		query($comment_query, $user_id, $comment);

		$comment_id = query("SELECT LAST_INSERT_ID() AS id;")[0]["id"];

		$coffee_comment = "INSERT INTO coffee_shop_comments (coffee_shop, comment) VALUES (?, ?);";

		query($coffee_comment, $coffee_id, $comment_id);

		
		redirect("coffee.php?coffee=" . $coffee_id);
	}
?>