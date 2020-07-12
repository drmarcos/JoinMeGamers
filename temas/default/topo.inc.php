<?php

/* ----------------------------------------------------------------------------------------- */
/* --------------------------------- [ LOGOUT ] -------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

if(!isset($sec_logout)){

/*%%%%%%%%%%%%%%%%%%%%%%%%%%*/

}else{
	
/* ----------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

	session_unset();
	unset($sec_logout);
	@header("Location: default.php");
	print('<span class="alert alert-success">*Volte sempre!<span>'.$sec_logout);
}

	$katwo->Login();
	
/* ----------------------------------------------------------------------------------------- */
/* --------------------------------- [ //LOGIN ] ------------------------------------------- */ 
/* ----------------------------------------------------------------------------------------- */
$str = '';
$str .=	$katwo->meta('!DOCTYPE html');
$str .=	$katwo->meta('html lang="en"');
$str .=	$katwo->meta('head');
$str .=	$katwo->meta('meta charset="utf-8"');
$str .=	$katwo->meta('meta name="viewport" content="width=device-width, initial-scale=1"');
$str .=	$katwo->meta('link rel="stylesheet" href="temas/default/css/337_bootstrap.min.css"');
$str .=	$katwo->meta('link rel="stylesheet" href="temas/default/css/katworma.css"');
$str .=	$katwo->meta('link rel="shortcut icon" href="temas/default/imagens/icones/favicon.ico" type="image/x-icon"');
$str .=	$katwo->meta('script src="js/321_jquery.min.js"');
$str .=	$katwo->meta('/script');
$str .=	$katwo->meta('script src="js/337_bootstrap.min.js"');
$str .=	$katwo->meta('/script');
$str .=	$katwo->meta('script src="js/popper.js"');
$str .=	$katwo->meta('/script');
$str .=	$katwo->meta('title');
$str .= "\t\t".$tituloSiteNavegador."\n";
$str .=	$katwo->meta('/title');
$str .=('<script type="text/javascript">
 function startTime() {var today=new Date();var h=today.getHours();var m=today.getMinutes();var s=today.getSeconds();m=checkTime(m);s=checkTime(s);document.getElementById(\'mostraHora\').innerHTML=h+":"+m+":"+s;t=setTimeout(\'startTime()\',500);}
 function checkTime(i){if (i<10) {i="0" + i;}return i;}
 </script>')."\n";
$str .=	$katwo->meta('/head');
$str .=	$katwo->meta('body onload="startTime()"');
print $str;
unset($str);
?>