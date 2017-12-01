<!DOCTYPE html>
<html>
<head>

	<?php if (isset($title)): ?>
		<title><?= htmlspecialchars($title) ?></title>
	<?php else: ?>
		<title>Coffee</title>
    <?php endif ?>

	<link rel = "stylesheet" type = "text/css" href = "./css/index.css">
</head>
<body>
	<div id = "page">
		<div class = "logo">
            <a href = "index.php"><img class = "logo" src = "./img/logo-site.gif" /></a>
        </div>
        <nav class = "menu">
			<ul>
				<li class = "menuContent"><a href = "index.php" class = "on">Home</a></li>
				<li class = "menuContent"><a href = "coffee.php">Coffee</a></li>
				<li class = "menuContent"><a href = "types.php">Types</a></li>
				<li class = "menuContent"><a href = "where.php">Where?</a></li>
				<li class = "menuContent"><a href = "personal.php">User</a></li>
				<li class = "menuContent"><a href = "logout.php">Logout</a></li>
			</ul>
		</nav>