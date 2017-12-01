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
			$query = "SELECT * FROM user_registery ORDER BY id DESC;";



			// TODO: finish this part of the query

			// select e.local_part, d.domain_name, d.domain_tld from email e INNER JOIN email_domains d on e.domain_id = d.id;



			// execute cubrid_query(query)
			$rows = query($query);

			// echo the JSON encoded version of the result
			echo json_encode($rows);
		}
	}
?>
