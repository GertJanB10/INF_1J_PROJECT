<?php include "includes/topinclude.php"; ?>
	<div class="inhoud">
		<form action="#" method="post">
			Username: <input type="text" name="username"><br>
			Password: <input type="password" name="password"><br>
			<input type="submit" name="sub">
		</form>
		<?php
			if (isset($_POST["sub"]))
			{
				require "connection_database.php";
				session_start();
				if (empty($_POST["username"]) || empty($_POST["password"]))
				{
					echo "You have tof hdshsvdjk";
				} else
				{
					$username = $_POST["username"];
					$password = $_POST["password"];
					$string = "SELECT gebruiker, wachtwoord FROM gebruiker WHERE gebruiker = '$username' AND wachtwoord = '$password'";
					$result = mysqli_query($DBConnect, $string);
					$count = mysqli_num_rows($result);
					if ($count == 1)
					{
						$_SESSION['login_user'] = '1';

						header("location: index.php");
					} else
					{
						echo "Je gebruikersnaam of wachtwoord is verkeerd";
					}
				}
			}
		?>
	</div>
<?php include "includes/botinclude.php"; ?>
