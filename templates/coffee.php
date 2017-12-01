		<link rel="stylesheet" type="text/css" href="../public/css/coffee.css">
		<img id = "introImg" src = "../public/img/Coffee-Shop_text.jpg" width = "840px" height = "400px" />
		<section>

		<ul>
		<?php
			foreach ($coffees as $value) {
				echo "<li>";
				echo '<a href="coffee.php?coffee=' . 
					$value["coffee_id"] . 
					'">' . 
					$value["coffee_name"] . 
					'</a>';
				echo "</li>";
			}
		?>
		</ul>
		</section>
		<aside>
			<h2>Coffee's rank:</h2>
			<ul>
				<li><a href = "#">coffee1</a></li>
				<li><a href = "#">coffee2</a></li>
				<li><a href = "#">coffee3</a></li>
				<li><a href = "#">coffee4</a></li>
				<li><a href = "#">coffee5</a></li>
				<li><a href = "#">coffee6</a></li>
		</aside>