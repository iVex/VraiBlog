<?php
if(empty($_GET['page'])){ $limit = "ORDER BY 0,5"; }else{ $calcul = $_GET['page']*5; $limit = "ORDER BY ".$calcul.",5"; }
$req = $bdd->query('SELECT id, id_membre, titre, post, DATE_FORMAT(date, \'%d/%m/%Y - %Hh%i\') AS date_creation_fr FROM post_blog "'.$limit.'"') or die(print_r($limit));
                $nombre = 0;
                $sqlPosts = $bdd->query('SELECT COUNT(*) AS nbr FROM post_blog');
                $sqlPosts2 = $sqlPosts->fetch();
                $nombrePosts = $sqlPosts2['nbr'];
                if ($nombrePosts <= 0) {
                    ?>
                    <p style="text-align:center;">Il n'y a pas de posts, désolé.</p>
                    <?php
                }
                 else
                 {
                while ($donnees = $req->fetch())
                {
                    $sql = $bdd->query("SELECT COUNT(*) AS nbr FROM post_commentaires WHERE id_post = '".$donnees['id']."'");
                    $sql2 = $sql->fetch();
                    $nombre = $sql2['nbr'];
                    $reqId = $bdd->query('SELECT pseudo FROM membres WHERE id = "'.$donnees['id_membre'].'"')->fetch();
                    $pseudo = $reqId['pseudo'];
                        ?>
                                <div id="news">
                                    <div class="billet">
                                        <div class="content_billet">
                                            <div class="titre">
                                                <div class="titre_content"><?php echo htmlspecialchars(addslashes($donnees['titre'])); ?></div>
                                                <div class="titre_info">Par <div class="pseudo"><?php echo ' '.$pseudo;?></div><div class="nombre">Il y a <?php echo $nombre;?> commentaires</div></div>
                                            </div>
                                            <div class="content">
                                                <div class="texte">
                                                        <?php
                                                        // On affiche le contenu du billet
                                                        $texte1 = htmlspecialchars($donnees['post']);
                                                        if(strlen(code($texte1)) >= 300)
                                                        {
                                                            $texte2 = substr(code($texte1), 0,  300).' ...';
                                                            echo code($texte2);
                                                        }
                                                        else
                                                        {
                                                            echo code($texte1);
                                                        }
                                                        ?>
                                                </div>
                                                <div class="suite"><a name="suite" href="lecture-<?php echo $donnees['id']; ?>">Lire la suite</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                    }
                }
                    ?>