<?php include 'includes/fonctions.php'; include 'includes/bdd.php';
if(isset($_COOKIE['user_id']))
{
    cookietosession($bdd);
}
?>
<!doctype html>
<html>
    <head>
        <title>Tests</title>
        <link rel="stylesheet" type="text/css" href="style/tests.css" />
        <link rel="icon" href="style/img/favicon.ico" />
    </head>
    <body>
        <header id="header">
            <a class="logo" href="index.php"></a>
            <div id="menu">
                <div class="rubriques">
                    <?php
                    if (isset($_SESSION['id'])) {
                    ?>
                    <a href="redaction.php">
                        <div class="rubrique test">
                            <div class="test">Redaction</div>
                        </div>
                    </a>
                    <a href="deconnexion.php">
                        <div class="rubrique test2">
                            <div class="test">D&eacuteconnexion</div>
                        </div>
                    </a>
                    <?php } else{?>
                    <a href="connexion.php">
                        <div class="rubrique test">
                            <div class="test">Connexion</div>
                        </div>
                    </a><?php } ?>
                </div>
            </div>
        </header>
        <div id="corps">