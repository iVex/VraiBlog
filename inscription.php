<?php
	session_start();
	include 'includes/header.php';
	?>
	<div style="text-align: center;margin-left: 50px;">
		<form id="searchform" action="" method="post">
			<input onclick="this.value='';" value="pseudo" type="text" name="pseudo" width="300px"><br />
			<input onclick="this.value='';" value="pass" type="password" name="pass1" width="300px"><br />
			<input onclick="this.value='';" value="pass" type="password" name="pass2" width="300px"><br />
			<input onclick="this.value='';" value="email" type="mail" name="email" width="300px"><br />
			<input type="submit" name="submit" class="button" value="Envoyer" />
		</form>
	<?php
	if(!empty($_POST['pseudo']) && !empty($_POST['pass1']) && $_POST['pass1'] === $_POST['pass2'])
	{
		$pseudo = $_POST['pseudo'];
		$pass = $_POST['pass1'];
		$email = $_POST['email'];
		$key = generer($pseudo, $pass);
		$password = crypter($key, $pass);
		$maChaineDecrypter = decrypter($key, $password);
		$req = 'INSERT INTO membres(id, pseudo, mdp, email, crypt_key) VALUES(NULL, "'.$pseudo.'", "'.$password.'", "'.$email.'", "'.$key.'")';
		$sql = 'SELECT COUNT(*) FROM membres WHERE pseudo = "'.$pseudo.'"';
		if ($res = $bdd->query($sql))
		{
			if ($res->fetchColumn() > 0)
			{
				echo 'ERREUR: NOM DEJA ENTRE';
			}
			else
			{
				$ajoutNom = $bdd->query($req);
				if ($ajoutNom)
				{
					echo 'Vous êtes désormais inscrits.'."<br />";
					echo "Votre clé vous permettant de discuter avec un ami : ".$key;
				}
				else
				{
					echo 'ERREUR.';
				}
			}
		}
	}
	?>
	</div>
<?php include 'includes/footer.php';