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
			$query = "SELECT e.id, e.local_part, d.domain_name, d.domain_tld FROM email e INNER JOIN email_domains d ON e.domain_id = d.id ORDER BY e.id DESC";

			// execute cubrid_query(query)
			$rows = query($query);

			// echo the JSON encoded version of the result
			echo json_encode($rows);
		}
	}
?>
