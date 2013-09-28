<?php
function crypter($maCleDeCryptage='', $maChaineACrypter){
	if($maCleDeCryptage==''){
		$maCleDeCryptage=$GLOBALS['PHPSESSID'];
	}
	$maCleDeCryptage = md5($maCleDeCryptage);
	$letter = -1;
	$newstr = '';
	$strlen = strlen($maChaineACrypter);
	for($i = 0; $i < $strlen; $i++ ){
		$letter++;
		if ( $letter > 31 ){
			$letter = 0;
		}
		$neword = ord($maChaineACrypter{$i}) + ord($maCleDeCryptage{$letter});
		if ( $neword > 255 ){
			$neword -= 256;
		}
		$newstr .= chr($neword);
	}
	return base64_encode($newstr);
}
function decrypter($maCleDeCryptage='', $maChaineCrypter){
	if($maCleDeCryptage==''){
		$maCleDeCryptage=$GLOBALS['PHPSESSID'];
	}
	$maCleDeCryptage = md5($maCleDeCryptage);
	$letter = -1;
	$newstr = '';
	$maChaineCrypter = base64_decode($maChaineCrypter);
	$strlen = strlen($maChaineCrypter);
	for ( $i = 0; $i < $strlen; $i++ ){
		$letter++;
		if ( $letter > 31 ){
		$letter = 0;
		}
		$neword = ord($maChaineCrypter{$i}) - ord($maCleDeCryptage{$letter});
		if ( $neword < 1 ){
		$neword += 256;
		}
		$newstr .= chr($neword);
	}
	return $newstr;
}
function generer($pseudo, $pass)
{
	$key_base = md5($pseudo).md5($pass);
	$key = sha1($key_base);
	return $key;
}
function code($texte)
{
//Smileys
$texte = str_replace(':D ', '<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" />', $texte);
$texte = str_replace(':lol: ', '<img src="./images/smileys/lol.gif" title="lol" alt="lol" />', $texte);
$texte = str_replace(':triste:', '<img src="./images/smileys/triste.gif" title="triste" alt="triste" />', $texte);
$texte = str_replace(':frime:', '<img src="./images/smileys/cool.gif" title="cool" alt="cool" />', $texte);
$texte = str_replace(':rire:', '<img src="./images/smileys/rire.gif" title="rire" alt="rire" />', $texte);
$texte = str_replace(':s', '<img src="./images/smileys/confus.gif" title="confus" alt="confus" />', $texte);
$texte = str_replace(':O', '<img src="./images/smileys/choc.gif" title="choc" alt="choc" />', $texte);
$texte = str_replace(':question:', '<img src="./images/smileys/question.gif" title="?" alt="?" />', $texte);
$texte = str_replace(':exclamation:', '<img src="./images/smileys/exclamation.gif" title="!" alt="!" />', $texte);

//Mise en forme du texte
//gras
$texte = preg_replace('`\[g\](.+)\[/g\]`isU', '<strong>$1</strong>', $texte);
//italique
$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
//souligné
$texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $texte);
//Barré
$texte = preg_replace('`\[t\](.+)\[/t\]`isU', '<s>$1</s>', $texte);
//Titre h1
$texte = preg_replace('`\[h1\](.+)\[/h1\]`isU', '<h1>$1</h1>', $texte);
//lien
$texte = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
$texte = preg_replace('#https://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
$texte = preg_replace('#ftp://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
$texte = preg_replace('#ftps://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);

//On retourne la variable texte
return $texte;
}
function cookietosession($bdd)
{
	$req = $bdd->query('SELECT * FROM membres WHERE id = "'.$_COOKIE['user_id'].'"');
	while($resultat = $req->fetch())
	{
		$_SESSION['id'] = $resultat['id'];
	}
}
?>