<?php
session_start();
include("includes/header.php");
if (!empty($_GET['id']) OR !empty($_GET['texte']))
{
	if(!empty($_SESSION['id'])){
	$id = $_SESSION['id'];		
	}

	$reqComment = $bdd->query('SELECT id, id_post, id_membre, texte, DATE_FORMAT(date, \'%d/%m/%Y - %Hh%i\') AS date_creation_fr FROM post_commentaires WHERE id_post = "'.$_GET['id'].'" ORDER BY date DESC');
	$req = $bdd->query('SELECT id, id_membre, titre, post, DATE_FORMAT(date, \'%d/%m/%Y - %Hh%i\') AS date_creation_fr FROM post_blog WHERE id = "'.$_GET['id'].'"');
	while ($donnees = $req->fetch())
	{
		$reqId = $bdd->query('SELECT pseudo FROM membres WHERE id = "'.$donnees['id_membre'].'"')->fetch();
	?>
	<div style="text-align:center; margin-top: 10px;">
	<a href="index">Retourner sur le blog</a>
	<div class="blog">
		<h3 id="presentation" style="margin-top: 15px;">
			<?php echo htmlspecialchars($donnees['titre']).' par : '.$reqId['pseudo']; ?>
			<em><?php echo $donnees['date_creation_fr']; ?></em><?php if(isset($id) && $id == $donnees['id_membre']){ ?><br/><form action="modifier.php" method="post"><input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" /><input type="hidden" name="id_membre" value="<?php echo $donnees['id_membre']; ?>" /><button type="hidden" style="margin-bottom: 5px;margin-right: 15px;border: 0px; background: transparent;"><img src="css/img/modif.png" width="50" height="30" alt="submit" /></button></form><?php } ?>
		</h3>
     
		<div id="contenuPost" style="margin-bottom: 10px;">
		<?php
		$id_post = $donnees['id'];
		// On affiche le contenu du billet
		$texte1 = nl2br(htmlspecialchars($donnees['post']));
		echo code($texte1);
		?>
		<br />
		</div>
	</div>
	<?php
	} 
	// Fin de la boucle des billets
	if(isset($_SESSION['id']))
	{
	?>
	<div id="contenuPost" style="margin-bottom: 10px;">
	<h2 id="presentation">Commentaires</h2><br/>
	<form action="lecture.php" method="get" name="commentaires">
		<input type="hidden" name="id" value="<?php echo $id_post ?>" />
		<textarea type="textarea" name="texte" placeholder="Contenu de l'article" style="max-width:1000px;width:80%;max-height:300px;height:50px;margin-top:15px;"></textarea><br />
		<input type="submit" style="max-width:1000px;width:40%;height:30px;margin-top:15px;"/>
	</form><br />
	<?php
	}
	else
	{
		// echo 'Connectez-vous pour commenter l\'article.';
		?>
		<h2 style="color:#bc6687;">Connectez-Vous pour commenter l'article.</h2>
		<?php
	}
	while ($comms = $reqComment->fetch())
	{
		$reqId = $bdd->query('SELECT pseudo FROM membres WHERE id = "'.$comms['id_membre'].'"');
		while ($pseu = $reqId->fetch())
		{
			$pseudo = $pseu['pseudo'];
		?>
		<h3><?php echo $pseudo.' le '; ?><em><?php echo $comms['date_creation_fr']; ?></em></h3>
		<p id="contenuComm" style="margin-bottom: 10px;">
		<?php
		// On affiche le contenu du billet
		$texte2 = nl2br(htmlspecialchars($comms['texte']));
		echo code($texte2);
		?>
			<br />
		</p>
		<?php
		}
	}
	if(!empty($_GET['texte']) && !empty($_SESSION['id']))
	{
		$ajoutComm = $bdd->query('INSERT INTO `post_commentaires` (`id`, `id_post`, `id_membre`, `texte`, `date`) VALUES (NULL, "'.$_GET['id'].'", "'.$id.'", "'.$_GET['texte'].'", NOW())');
		if ($ajoutComm)
		{
			echo 'Le blog à été mis à jour avec votre post. Merci.';
			?>
			<a href="index">Retourner sur le blog.</a>
			<?php
		}
		else
		{
			echo 'ERREUR.';
		}
	}
}
?>
</div>
</div>