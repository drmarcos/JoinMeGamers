<?php
/* ----------------------------------------------------------------------------------------- */
/* --------------------------------- [ CONFIG ] -------------------------------------------- */ 
/* ----------------------------------------------------------------------------------------- */

/****************************************************************/
/* --- [ live On = 1 * NÃO MUDE A POSIÇÃO DA LINHA ABAIXO ] --- */
$statusLive = 1;
/* --- [ jogo ativo * NÃO MUDE A POSIÇÃO DA LINHA ABAIXO ] --- */
$jogoAtivoAgora = 1;
/****************************************************************/


/* --- [ ZERO (0) DESENVOLVIMENTO [ ********* ] UM (1) PRODUÇÃO ] --- */
$producao = 0;
$nomeArquivoArmazem = 'newfile.txt';
$exibedatahoje =  date('d/m/Y');
$nomeSite = '<b style="color:#ab69d5; font-size:3.2em;">';
$nomeSite .= 'KATWORMA';
$nomeSite .= '</b>';
$nomeSite .= '&nbsp;by KatwoGamer';
$nomeFormLogin = 'KATWORMACESSO';
$tituloSiteNavegador = 'Join me Gamers';
$tituloConfig = 'Live Stream de';
$tituloConfig .= ' [ <a href="http://www.youtube.com/katwogamer" target="_blank">';
$tituloConfig .= '<b style="color:#ab69d5;">';
$tituloConfig .= 'KATWOGAMER';
$tituloConfig .= '</b>';
$tituloConfig .= '</a> ]';
$creditosFooter = 'By M. Oliveira »»»';

/* --- [ SEGURANÇA ] --- */


//print md5('admin');//caso precise
$usuarioMD5 = '21232f297a57a5a743894a0e4a801fc3';
$senhaMD5 = '21232f297a57a5a743894a0e4a801fc3';
$idioma = 'pt_br';

/* --- [ TOKEN ] --- */
// ALTERE ESSE VALOR PARA QUE SEUS DIRETÓRIOS FIQUEM PROTEGIDOS
// VOCÊ DEVE ALTERAR AS PASTA TAMBÉM
$tokenSite = '7648552';


/* --- [ DEV ] --- */

$DEBUG = 0;//1 MOSTRA TUDO QUE GOSTARIAMOS DE CONFERIR

/* --- [ LINKS ] --- */

$linkCanalYoutube = 'https://www.youtube.com/user/katwogamer';
$linkFacebook = 'https://www.facebook.com/katwogamer';
$linkInstagran = 'http://www.instagram.com/katwogamer';
$linkTweeter = 'https://twitter.com/katwogamer';
$linkGrupoFacebook = 'https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2Fgroups%2Fkatworma%2F';

if($producao == 0){
	$ROTA = "http://localhost/chamaeuKatwo";	
	$INCLUDE = "C:/xampp/htdocs/chamaeuKatwo";
}else{
	$ROTA = "http://www.SEU_SITE.com.br/chamaeukatwo";		
	$INCLUDE = "/home/SUA_CONTA/SEU_DOMINIO.com.br/chamaeukatwo";	
}
?>
