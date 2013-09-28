<?php
    session_start();
    include 'includes/header.php';
    ?>
    <div id="inscription">
        <form class="form" action="" method="post">
            <input class="pseudo" placeholder="pseudo" type="text" name="pseudo"><br/>
            <input class="pass" placeholder="Mot de passe" type="password" name="pass1">
            <input class="pass" placeholder="Vérification" type="password" name="pass2"><br/>
            <input class="email" placeholder="email" type="mail" name="email">
            <br/><button type="submit" name="submit" class="btn">Submit</button>
        </form>
    </div>
    <?php
    if(!empty($_POST['pseudo']) && !empty($_POST['pass1']) && $_POST['pass1'] === $_POST['pass2'])
    {
        $pseudo = $_POST['pseudo'];
        $pass = $_POST['pass1'];
        $email = $_POST['email'];
        $key = generer($pseudo, $pass);
        $password = crypter($key, $pass);
        $maChaineDecrypter = decrypter($key, $password);
        $null = "NULL";
        $req = 'INSERT INTO membres(id, pseudo, mdp, email, crypt_key) VALUES("'.crypter($key, $null).'", "'.$pseudo.'", "'.$password.'", "'.$email.'", "'.$key.'")';
        $sql = 'SELECT COUNT(*) FROM membres WHERE pseudo = "'.$pseudo.'"';
        if ($res = $bdd->query($sql))
        {
            if ($res->fetchColumn() > 0)
            {
                ?>
                <p style="text-align: center; margin-left: 50px;">ERREUR: NOM DEJA ENTRE.</p><br />
                <?php
            }
            else
            {
                $ajoutNom = $bdd->query($req);
                if ($ajoutNom)
                {
                    ?>
                    <p style="text-align: center; margin-left: 50px;">Vous êtes désormais inscrits.</p><br />
                    <?php
                }
                else
                {
                    ?>
                    <p style="text-align: center; margin-left: 50px;">ERREUR.</p><br />
                    <?php
                }
            }
        }
    }
    ?>
<?php include 'includes/footer.php';