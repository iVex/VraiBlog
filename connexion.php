<?php
session_start();
include 'includes/header.php';
?>
<?php
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
?><div style="text-align: center;margin-left: 50px;">
		<?php echo 'Vous êtes connecté !'; ?>
<?php
}
else
{
if(!empty($_POST['pseudo']) && !empty($_POST['pass']))
{
	$pseudo = $_POST['pseudo'];
	$pass = $_POST['pass'];
	$key = generer($pseudo, $pass);
	$password = crypter($key, $pass);

	$req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND mdp = :pass');
	$req->execute(array(
		'pseudo' => $pseudo,
		'pass' => $password));

	$resultat = $req->fetch();
 
	if ($resultat)
	{
		$_SESSION['id'] = $resultat['id'];
		$_SESSION['pseudo'] = $pseudo;
	}
	if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
	{
		echo 'Vous êtes connecté !';
	}
	else if (!$resultat)
	{
		echo 'Mauvaises informations de connexion.';
	}
	?> </div><?php
	}
}
?>
<div style="text-align: center;margin-left: 50px;">
		<form id="searchform" action="" method="post">
			<input onclick="this.value='';" value="pseudo" type="text" name="pseudo" width="300px"><br />
			<input onclick="this.value='';" value="pass" type="password" name="pass" width="300px"><br />
			<input type="submit" name="submit" class="button" value="Envoyer" />
		</form>
		<p>Pas inscrit ? <a href="inscription.php">Inscription</a></p>
</div>
<div style="text-align:center;margin-left:50px;">
</div>
<?php
include 'includes/footer.php';?>