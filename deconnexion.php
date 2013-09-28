<?php
session_start();
setcookie('user_id', ' ', time() - 3600, '/', 'unvraiblog.loc');
session_destroy();
header('location: index.php');
exit;
?>