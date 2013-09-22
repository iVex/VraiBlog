<?php
session_start();
include("includes/header.php");
?>
<div style="text-align:center;">
	<h2 style="margin-top: 20px;">Redaction d'un Article</h2><br />
	<div>
		<p>Bienvenue dans la rédaction d'un article sur le site, vous avez obtenu les droits de redacteurs, et vous pouvez donc rediger un article. Mais il y a des regles à respecter :<br />- Pas d'insultes<br />- Pas de vulgarités non-nécessaires<br />- Les éloges au administrateurs ou modérateurs ne sont pas interdites.<br />Le BBcode suivant est disponible : - [g] "texte" [/g] (mettre en <?php echo code('[g]gras[/g])') ?> - [i] "texte" [/i] (mettre en <?php echo code('[i]italique[/i])')?>- [s] "texte" [/s] (mettre en <?php echo code('[s]souligné[/s])')?>- [t] "texte" [/t] (mettre en <?php echo code('[t]barré[/t])')?>-[url] "lien" [/url] (Mettre un lien) -[img] "lien d'une image" [/img] (Mettre une image)</p>
	</div> 
	<form method="post" name="redaction">
		<input type="text" name="titre" value="<?php if(isset($redacTitre)){echo $redacTitre;} ?>" placeholder="Titre de l'article" style="max-width:1000px;width: 80%;"/><br />
		<textarea type="textarea" name="texte" value="<?php if(isset($redacContenu)){echo $redacContenu;} ?>" placeholder="Contenu de l'article" style="max-width:1000px;width:80%;max-height:500px;height:15%;margin-top:15px;"></textarea><br />
		<input type="submit" style="max-width:1000px;width:40%;height:50px;margin-top:15px;"/>
	</form>
	<?php
	if (!empty($_POST['titre']) && !empty($_POST['texte']))
	{
		$redacTitre = $_POST['titre'];
		$redacContenu = $_POST['texte'];
		$id_redac = $_SESSION['id'];
	
		$req = 'INSERT INTO `post_blog` (`id`, `id_membre`, `titre`, `post`, `date`) VALUES (NULL, "'.$id_redac.'", "'.$redacTitre.'", "'.$redacContenu.'", NOW())';
		$sql = 'SELECT COUNT(*) FROM post_blog WHERE titre = "'.$redacTitre.'"';
		if ($res = $bdd->query($sql))
		{
			if ($res->fetchColumn() > 0)
			{
				echo 'ERREUR: Ce titre à déjà été utilisé, veuillez en choisir un autre.';
			}
			else
			{
				$ajoutPost = $bdd->query($req);
				if ($ajoutPost)
				{
					echo 'Le blog à été mis à jour avec votre post. Merci.';
					?>
					<a href="index.php">Retourner sur le blog.</a>
					<?php
				}
				else
				{
					echo 'ERREUR.';
				}
			}
		}
}?>
</div>
<?php include 'includes/footer.php'; ?>