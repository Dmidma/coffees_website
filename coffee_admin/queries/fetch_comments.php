<?php
	

	require("../../includes/functions.php");


	// Reaching only via POST
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	

		// TODO: add the session testing
		if (!empty($_POST["foo"]) && 
			$_POST["foo"] == "bar") /*&& 
			!empty($_SESSION["terma"]) && 
			$_SESSION["terma"] == "alouch")*/
		{
			// prepare the query
			$query = "SELECT c.id, c.comment, c.comment_date, u.username, s.name FROM  comments c, user_registery u, coffee_shop s, coffee_shop_comments x WHERE x.coffee_shop = s.id AND x.comment = c.id AND c.commenter = u.id ORDER BY c.comment_date;";


			// execute cubrid_query(query)
			$rows = query($query);

			// echo the JSON encoded version of the result
			echo json_encode($rows);
		}
	}
?>
