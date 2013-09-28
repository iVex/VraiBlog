<?php
session_start();
include 'includes/header.php';
?>
<?php
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
?>
    <h2 class="connected"><a href="index.php">Vous etes connect&eacute</a></h2>
<?php
}
?>
<div id="connexion">
        <form class="form" action="" method="post">
            <input class="pseudo" placeholder="Pseudo" type="text" name="pseudo" width="300px">
            <input class="mdp" placeholder="Mot de passe" type="password" name="pass" width="300px">
            <div class="final">
                <br/>
                <label for="test" class="checkbox">
                    <input type="checkbox" id="test" name="remember">
                    <span class="rounded"></span>
                    Se Souvenir de moi
                </label>
                <br/><button type="submit" name="submit" class="btn">Submit</button>
            </div>
        </form>
        <?php
        if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo']))
        {
            ?>
            <div class="inscription"><div>Pas inscrit ? <a href="inscription.php">Inscription</a></div></div>
            <?php
        }
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
    if(isset($_POST['remember']))
    {
        setcookie('user_id', $resultat['id'], time() + 3600 * 24 * 3, '/', 'unvraiblog.loc');
    }
    if ($resultat)
    {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
    }
    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
        ?>
        <h2 class="connected"><a href="index.php">Vous etes connect&eacute</a></h2>
        <?php
    }
    else if (!$resultat)
    {
        ?>
        <p style="text-align: center; margin-left: 50px;">Mauvaises informations de connexion.</p><br/>
            <?php
    }
    ?> </div><?php
}
?>
</div>
<?php
include 'includes/footer.php';?>