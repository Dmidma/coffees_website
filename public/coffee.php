<?php
	
	require("../includes/config.php");

	if (verify_connected_user() === false)
	{
		redirect("index.php");
	}
	else if (empty($_GET) && !isset($_GET["coffee"]))
	{
		// get coffee list
		$query_coffees = "SELECT id, name FROM coffee_shop;";
		$result = query($query_coffees);

		$rows = [];
		foreach ($result as $value) {
			$rows[] = [
				"coffee_id" => $value["id"],
				"coffee_name" => $value["name"]
			];
		}


		render("coffee.php", ["title" => "Coffee page", "coffees" => $rows]);
	}
	else
	{	
		// get the coffee id and then search in the database
		$coffee_id = $_GET["coffee"];
		$coffee_query = "SELECT name, description, image_path FROM coffee_shop WHERE id=?;";
		$result = query($coffee_query, $coffee_id);

		// if no coffee was found by that id
		// redirect him to coffee.php
		if (empty($result))
			redirect("coffee.php");
		
		$coffee = $result[0];

		$comments_query = "SELECT u.username, c.comment, c.comment_date FROM user_registery u INNER JOIN comments c INNER JOIN coffee_shop_comments e ON u.id = c.commenter AND c.id=e.comment WHERE e.coffee_shop=? ORDER BY c.comment_date DESC;";

		$comments = query($comments_query, $coffee_id);

		$com = [];
		foreach ($comments as $value) {
			$com[] = [
				"commenter" => $value["username"],
				"comment" => $value["comment"],
				"date" => $value["comment_date"]
			];
		}



		render("specific_coffee.php", 
			["title" => $coffee["name"], 
			"coffee_image" => $coffee["image_path"], 
			"description" => $coffee["description"], 
			"comments" => $com]);
	}

?>