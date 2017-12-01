<form method="post" action="signup.php">



	<h1> Sign up </h1>

	<p> 
        <label for="namesignup" class="uname" data-icon="u">Name:</label>
        <input id="namesignup" name="name" required="required" type="text" placeholder="Name" />
    </p>

    <p> 
        <label for="lastnamesignup" class="uname" data-icon="u">Last Name:</label>
        <input id="lastnamesignup" name="last_name" required="required" type="text" placeholder="Last Name" />
    </p>

    <p> 
        <label for="birthdaysignup" class="uname" data-icon="B">Birthday:</label>
        <input id="birthdaysignup" name="birthday" required="required" type="date" />
    </p>


    <p> 
        <label for="usernamesignup" class="uname" data-icon="u">User Name:</label>
        <input id="usernamesignup" name="username" required="required" type="text" placeholder="Username" />
    </p>
    <p> 
        <label for="emailsignup" class="youmail" data-icon="e" > Email:</label>
        <input id="emailsignup" name="email" required="required" type="email" placeholder="Email"/> 
    </p>
    <p> 
        <label for="passwordsignup" class="youpasswd" data-icon="p">Password: </label>
        <input id="passwordsignup" name="password" required="required" type="password" placeholder="Password"/>
    </p>
    <p> 
        <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirmation: </label>
        <input id="passwordsignup_confirm" name="confirmation" required="required" type="password" placeholder="Confirmation"/>
    </p>
    <p class="signin button"> 
		<input type="submit" value="Signup"/> 
	</p>
	<div>
	<?php
		if (isset($message))
		{
			echo htmlspecialchars($message);
		}
	?>
	</div>

    <p class="change_link">  
		Already a member ?
		<a href="#tologin" class="to_register"> Go and log in </a>
	</p>
</form>