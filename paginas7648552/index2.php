<?php
session_start();
extract($_REQUEST, EXTR_PREFIX_ALL|EXTR_REFS, 'sec');
include('../config.php');
$_SESSION["loginUsuario"] = md5($sec_usrname);
$_SESSION["loginSenha"] = md5($sec_psw);
$_SESSION["confirmacao"] = $sec_confirmacao;//CAPTCHA
if($producao == 0){	
header("Location: $ROTA/default.php");
}else{	
header("Location: $ROTA/default.php");
}

exit();
?>