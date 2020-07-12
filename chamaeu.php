<?php

function BlocamosAdmListaNews($pagina){if(basename($_SERVER["PHP_SELF"])==$pagina){exit(header('Location: default.php'));}}
BlocamosAdmListaNews('chamaeu.php');
date_default_timezone_set('America/Sao_Paulo');

/*************************************************************************************************/
/*************************************************************************************************/
	
$hoje =  date('dmY');
$hora = date('H:i:s');
$titulo =  $tituloConfig;
print('
<style>
.navbar {
    min-height: 150px;
 /*  
 	background-image: url(\'imagens/counter_strike.png\');
    background-repeat: no-repeat;
    background-size:100%;
*/
	/*
	background-image: url(\'imagens/battle_field.png\');
	*/
    background-repeat: no-repeat;
    background-size:100%;
    bottom: 0;
    color: black;
    left: 0;
    overflow: auto;
    padding: 1.5em;
    
    right: 0;
    text-align: center;
    top: 0;
    background-size: cover;
}
</style>
');


$str = '';
$str .=	$katwo->tags('nav','navbar navbar-inverse');
$str .=	$katwo->tags('div','container-fluid');
$str .=	$katwo->tags('div','navbar-header');
$str .= $katwo->tags('button','navbar-toggle',1, 'type="button" data-toggle="collapse" data-target="#myNavbar"');
$str .=	$katwo->tags('span','icon-bar',3);
$str .=	$katwo->tags('/button',NULL,1)."\n";
$str .=	$katwo->duasTags('a href="default.php"','navbar-brand','/a',NULL,$nomeSite)."\n";
$str .=	$katwo->tags('/div');
$str .=	$katwo->duasTags('div id="myNavbar','collapse navbar-collapse','ul','nav navbar-nav');
$str .=	$katwo->tags('li','active');
$str .=	$katwo->tags('a href="#"');
$str .=	$katwo->duasTags('span','glyphicon glyphicon-home','/span');
$str .= $_INICIAL;
$str .=	$katwo->duasTags('/a',NULL,'/li');

$str .= $katwo->tags('li');
$str .= $katwo->tags('a data-toggle="modal" href="#ModalPatrocinadores"');
$str .=	$katwo->duasTags('span','glyphicon glyphicon-piggy-bank','/span');
$str .= $_PATROCINADORES;
$str .=	$katwo->duasTags('/a',NULL,'/li');

$str .= $katwo->tags('li');
$str .= $katwo->tags('a data-toggle="modal" href="#ModalColaboradores"');
$str .=	$katwo->duasTags('span','glyphicon glyphicon-flag','/span');
$str .= $_COLABORAR;
$str .=	$katwo->duasTags('/a',NULL,'/li');

$str .= $katwo->tags('li');
$str .= $katwo->tags('a data-toggle="modal" href="#ModalProjetos"');
$str .=	$katwo->duasTags('span','glyphicon glyphicon-file','/span');
$str .= $_PROJETOS;
$str .=	$katwo->duasTags('/a',NULL,'/li');

$str .= $katwo->tags('li');
$str .= $katwo->tags('a data-toggle="modal" href="#ModalContato"');
$str .=	$katwo->duasTags('span','glyphicon glyphicon-envelope','/span');
$str .= $_CONTATO;
$str .=	$katwo->duasTags('/a',NULL,'/li');


$str .= $katwo->tags('li');
$str .= $katwo->tags('a href="#"');
$str .=	$katwo->duasTags('span align="right" id="mostraHora"','glyphicon glyphicon-hourglass','/span');
$str .=	$katwo->duasTags('/a',NULL,'/li');
$str .= $katwo->tags('/ul');

$str .= $katwo->duasTags('ul','nav navbar-nav navbar-right','li');

/* --- [ IDIOMAS ] --- */

$str .= $katwo->duasTags('a href="default.php?idioma=pt_br"',NULL,'/a',NULL,$katwo->tags('img src="imagens/icones/BR.png"','img-responsive',1,' width="32" height="32"'));
$str .= $katwo->duasTags('/li',NULL,'li');
$str .= $katwo->duasTags('a href="default.php?idioma=en_us"',NULL,'/a',NULL,$katwo->tags('img src="imagens/icones/US.png"','img-responsive',1,' width="32" height="32"'));
$str .= $katwo->duasTags('/li',NULL,'li');


/* --- [ LINK LOGIN ] --- */

if(!isset($_SESSION["admin"])){
	$str .= $katwo->tags('a href="#" data-toggle="modal" data-target="#myModal"');
	$str .= $katwo->duasTags('span','glyphicon glyphicon-log-in','/span');
	$str .= $_ACESSO;
	$str .= $katwo->tags('/a');
	
}else{
	$str .= $katwo->tags('a href="default.php?logout=1"');
	$str .= $katwo->duasTags('span','glyphicon glyphicon-log-in','/span');
	$str .= $_SAIR;
	$str .= $katwo->tags('/a');

}
$str .= $katwo->duasTags('/li',NULL,'/ul');
$str .= $katwo->tags('/div',NULL,2);
$str .= $katwo->tags('/nav');

/* --- [ INICIA CONTAINER ] --- */

$str .= $katwo->tags('div','container-fluid text-center');

/**************************************************************************************************/
/********************************* [ MENU SOCIAL ] ************************************************/
/**************************************************************************************************/

function botoesSociais($linkUsado,$tipoGlyf,$NomeLink,$glyphicon,$target="_blank"){
	$str = ('<a href="'.$linkUsado.'" target="'.$target.'" class="btn btn-lg btn-'.$tipoGlyf.'" role="button">'.$NomeLink.'<span class="glyphicon '.$glyphicon.'"></span></a>');
	return $str;
}

$str .= $katwo->duasTags('div','row content','div','col-sm-2 sidenav');
if($linkCanalYoutube != ''){$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais($linkCanalYoutube,"danger","&nbsp;YOUTUBE&nbsp;&nbsp;","glyphicon-expand"));}
if($linkFacebook != ''){$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais($linkFacebook,"primary","FACEBOOK&nbsp;","glyphicon-thumbs-up"));}
if($linkInstagran != ''){$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais($linkInstagran,"default","INSTAGRAM&nbsp;","glyphicon-camera"));}
if($linkTweeter != ''){$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais($linkTweeter,"info","&nbsp;TWITTER&nbsp;&nbsp;","glyphicon-bullhorn"));}
if($linkGrupoFacebook != ''){$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais($linkGrupoFacebook,"primary","KATWORMA&nbsp;","glyphicon-link"));}


/**************************************************************************************************/
/* --- [ ADMIN ] --- */
/**************************************************************************************************/

	if((isset($_SESSION["admin"]))){
			$str .= $katwo->tags('br',1);
			$str .= $katwo->duasTags('h2',NULL,'/h2',NULL,'Admin:');
			
		if(isset($sec_live)){
	
	 		$katwo->mudaStatusLive("config.php",8);

				unset($sec_live);
		}
			
		if(isset($sec_trocaJogo)){
			$katwo->mudaJogandoAgora("config.php",10);
			unset($sec_trocaJogo);
		}
			
		if($statusLive == 0){
			$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais("$ROTA/default.php?live=1&idioma=$_SESSION[idioma]","warning","&nbsp;&nbsp;&nbsp;&nbsp;LIVE OFF&nbsp;&nbsp;&nbsp;&nbsp;","glyphicon-eye-close","_self"));
			
		}else{
			$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais("$ROTA/default.php?live=0&idioma=$_SESSION[idioma]","success","&nbsp;&nbsp;&nbsp;&nbspLIVE ON&nbsp;&nbsp;&nbsp;&nbsp","glyphicon-eye-open","_self"));
		}
	

/* --------------------------------------------------------------------------------------------- */
/* --- [ SELEÇÃO DE JOGO DA HORA ] --- */
/* --------------------------------------------------------------------------------------------- */
	
		$str .= $katwo->tags('label',NULL,1,'for="usrname"');
		$str .= $katwo->duasTags('span','glyphicon glyphicon-user','/span');
		$str .= ('&nbsp;Jogando agora!');
		$str .= $katwo->tags('/label');
		
		$str .= $katwo->tags('form',NULL,1,' actiom="'.$ROTA.'"');
		$str .= $katwo->tags('select',NULL,1,' name="trocaJogo" onchange="this.form.submit()"');
		$str .= $katwo->tags('option');
		$str .= ('Selecione Jogo');
		$str .= $katwo->tags('option',NULL,1, 'value="0"');
		$str .= ('League O Legends');
		$str .= $katwo->tags('option',NULL,1, 'value="1"');
		$str .= ('Black Squad');
		$str .= $katwo->tags('option',NULL,1, 'value="2"');
		$str .= ('Battle Field');
		$str .= $katwo->tags('option',NULL,1, 'value="3"');
		$str .= ('Combat Arms');
		$str .= $katwo->tags('option',NULL,1, 'value="4"');
		$str .= ('Counter Strike');
		$str .= $katwo->tags('/select');
		$str .= $katwo->tags('input',NULL,1,'type="hidden" name="idioma" value="'.$_SESSION["idioma"].'"');
		$str .= $katwo->tags('/form');	
	
		
		$str .= $katwo->tags('br',2);
		
		if(isset($imagemDaHora)){		
			$str .= $katwo->tags('img','img-responsive',1,' title="Live Off" src="imagens/'.$imagemDaHora.'"');
		}else{			
			$str .= $katwo->tags('a',NULL,1,' href="'.$linkCanalYoutube.'"');
			$str .= $katwo->tags('img','img-responsive',1,' title="Live Off" src="imagens/live_off_001.png"');
			$str .= $katwo->tags('/a');
		}
	
	
/* --- [ ENCERRA EXIBIÇÃO ADMIN ] --- */
	}else{
/* --- [ INICIA EXIBIÇÃO USUÁRIOS ] --- */
	
		if($statusLive == 0){
			$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais($linkCanalYoutube,"warning","&nbsp;&nbsp;&nbsp;LIVE OFF&nbsp;&nbsp;&nbsp;","glyphicon-eye-close"));		
		}else{
			$str .= $katwo->duasTags('p',NULL,'/p',NULL,botoesSociais($linkCanalYoutube,"success","&nbsp;&nbsp;&nbspLIVE ON&nbsp;&nbsp;&nbsp;&nbsp","glyphicon-eye-open"));		
		}	
		$str .= $katwo->tags('div','well');
		$str .= $ADS->rotateBanners();
		$str .= $katwo->tags('/div');
	}


/**************************************************************************************************/
/* --- [ //ADMIN ] --- */
/**************************************************************************************************/

$str .= $katwo->tags('/div');

print $str;

/*************************************************************************************************/
/******************************** [ Modal LOGIN ] ************************************************/
/*************************************************************************************************/

	print $katwo->loginForm();

/*************************************************************************************************/
/******************************** [ //Modal PATROCINADORES ] *************************************/
/*************************************************************************************************/

print $katwo->janelaModal('ModalPatrocinadores',$_PATROCINADORES,$_TXT_PATROCINADORES,'glyphicon-piggy-bank');

/*************************************************************************************************/
/******************************** [ //Modal COLABORADORES ] *************************************/
/*************************************************************************************************/

print $katwo->janelaModal('ModalColaboradores',$_SEJA_COLABORADOR,$_TXT_COLABORADORES,'glyphicon-flag');

/*************************************************************************************************/
/******************************** [ //Modal PROJETOS ] *************************************/
/*************************************************************************************************/

print $katwo->janelaModal('ModalProjetos',$_PROJETOS,$_TXT_PROJETOS,'glyphicon-file');

/*************************************************************************************************/
/******************************** [ //Modal CONTATOS ] *************************************/
/*************************************************************************************************/

print $katwo->janelaModal('ModalContato',$_CONTATO,$_TXT_CONTATOS,'glyphicon-envelope');

/*************************************************************************************************/
/******************************** [ //Modal INSCRIÇÕES ABERTAS ] *********************************/
/*************************************************************************************************/

print $katwo->janelaModal('inscricoesAbertas',$_INSCRICOES_ABERTAS,$_TXT_MANTER_INSCRICOES_ABERTAS_YOUTUBE,'glyphicon-wrench');

/* ----------------------------------------------------------------------------------------- */
/* ---------------------- [ ADMINISTRANDO RECURSOS ] --------------------------------------- */
/* ----------------------------------------------------------------------------------------- */
/* ---------------------- [ ATUALIZANDO UMA LINHA ] ---------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

if((isset($sec_atualizar))|| (isset($_SESSION["admin"]))){

		$katwo->atualizaLinhaTxt();
		
/* ----------------------------------------------------------------------------------------- */
/* ---------------------- [ EXIBE OS REGISTROS PARA ADMIN ] -------------------------------- */
/* ----------------------------------------------------------------------------------------- */		

		print $katwo->exibeRegistroAdmin();
		exit();
}

/* ----------------------------------------------------------------------------------------- */
/* ---------------------- [ //ADMINISTRANDO RECURSOS ] ------------------------------------- */
/* ----------------------------------------------------------------------------------------- */


/* -------------------------------------------- [ CONTEÚDO CENTRAL EXIBE ] -------------------------------------------------------------------------------- */

	$str = $katwo->tags('div','col-sm-8 text-left');
	$str .= $katwo->tags('div','container');
	$str .= $katwo->duasTags('h1',NULL,'/h1',NULL,$titulo);
	$str .= $ADS->rotateFrases();
	print $str;
	unset($str);
	
/* -------------------------------------------- [ ACCORDION EXIBE ] -------------------------------------------------------------------------------- */

	$accordion = $katwo->tags('br',NULL,2);
	$accordion .= $katwo->tags('div','panel-group',1,' id="accordion"');
	print $accordion;
	
/* -------------------------------------------- [ SOBRE ] ------------------------------------------------------------------------------------------ */
	/*1*/
	print $katwo->AccordionExibe($_SOBRE,$_TXT_ACCORDION_SOBRE,"glyphicon-info-sign","collapse1","in");
/* -------------------------------------------- [ COMO FUNCIONA ] ---------------------------------------------------------------------------------- */
	/*2*/
	print $katwo->AccordionExibe($_COMO_FUNCIONA,$_TXT_ACCORDION_COMO_FUNCIONA,"glyphicon-wrench","collapse2","");
/* -------------------------------------------- [ DICAS IMPORTANTES ] ------------------------------------------------------------------------------ */
	/*3*/
	print $katwo->AccordionExibe($_DICAS_IMPORTANTES,$_TXT_ACCORDION_DICAS_IMPORTANTES,"glyphicon-flash","collapse3",""); // glyphicon-sunglasses
/* -------------------------------------------- [ QUER AJUDAR ] ------------------------------------------------------------------------------------ */
    /*4*/
	print $katwo->AccordionExibe($_QUER_AJUDAR,$_TXT_ACCORDION_QUER_AJUDAR,"glyphicon-thumbs-up","collapse4","");

/* -------------------------------------------- [  ] ----------------------------------------------------------------------------------------------- */
	$accordion = $katwo->tags('/div',NULL,2);
	print $accordion;
	unset($accordion);

	
/* ----------------- [ VAMOS EXIBIR O FORM DE CADASTRO APENAS QUANDO A LIVE ESTIVER ON ] ---------------------------------------------------------------- */
	
if($statusLive == 0){

/* ----------------------- [ LIVE OFF! ] ------------------------------------------------- */

	$str = $katwo->tags('center');
	$str .= $katwo->tags('a',NULL,1, 'href="'.$linkCanalYoutube.'" target="_blank"');
	$str .= $katwo->tags('img','img-responsive',1,'title="Live Off" src="imagens/live_off_001.png"');
	$str .= $katwo->tags('/a');
	$str .= $katwo->tags('br',NULL,2);
	$str .= $katwo->tags('div class="panel"')."\n";
	//$str .= $GLOBALS["ADS"]->ADsResponsivo2017();
	$str .= $katwo->tags('/div');
	$str .= $katwo->tags('div class="panel"')."\n";
	$str .= $GLOBALS["ADS"]->ADsResponsivoTextual();
	$str .= $katwo->tags('/div');
	$str .= $katwo->tags('div','col-sm-2 sidenav');	   
	$str .= $ADS->rotateBanners();
	$str .= $katwo->tags('/div');
	$str .= $katwo->tags('div','col-sm-2 sidenav');	   
	$str .= $ADS->rotateBanners();
	$str .= $katwo->tags('/div');
	$str .= $katwo->tags('div','col-sm-2 sidenav');	   
	$str .= $ADS->rotateBanners();
	$str .= $katwo->tags('/div');
	$str .= $katwo->tags('div','col-sm-2 sidenav');	   
	$str .= $ADS->rotateBanners();
	$str .= $katwo->tags('/div');
	$str .= $katwo->tags('div','col-sm-2 sidenav');	   
	$str .= $ADS->rotateBanners();
	$str .= $katwo->tags('/div');
	$str .= $katwo->tags('div','col-sm-2 sidenav');	   
	$str .= $ADS->rotateBanners();
	$str .= $katwo->tags('/div',NULL,2);

	$katwo->controleDatasRegistros($nomeArquivoArmazem,1,$hoje);

	print $str;
	unset($str);

}else{
/* ----------------------- [ LIVE ON! ] ------------------------------------------------- */
  
if(!isset($sec_NomeGoogle)|| empty( $sec_NomeGoogle ) && !isset($sec_JogoEscolhido)|| empty( $sec_JogoEscolhido ) && !isset($sec_NickName)|| empty( $sec_NickName ) && !isset($sec_linkYoutube)|| empty( $sec_linkYoutube )){
	
	$str = $katwo->tags('center');
	$str .= $katwo->tags('img','img-responsive',1,'title="'.$jogoDaHora.'" src="imagens/'.$imagemDaHora.'"');
	$str .= $katwo->tags('/center');
	print $str;
	unset($str);
	
	if((isset($sec_NomeGoogle)&&($sec_NomeGoogle == "")) || (isset($sec_JogoEscolhido)&&($sec_JogoEscolhido == "")) || (isset($sec_NickName)&&($sec_NickName == "")) || (isset($sec_linkYoutube)&&($sec_linkYoutube == ""))){		
		$str = $katwo->tags('div','alert alert-danger');
		$str .= $katwo->tags('br');
		$str .= $katwo->duasTags('b','text-danger','/b',NULL,$_TODOS_CAMPOS_PREENCHIDOS);
		$str .= $katwo->tags('br',NULL,2);
		$str .= $katwo->tags('/div');
		print $str;
		unset($str);
	} 
		
/* ----------------------------------------------------------------------------------------- */
/* ------------------------------- [ FORM CADASTRO AMIGOS ] -------------------------------- */
/* ----------------------------------------------------------------------------------------- */
  	
	print $katwo->exibeFormCadastroAmigos($jogoDaHora);

/* ----------------------------------------------------------------------------------------- */
/* ------------------------------- [ ALERTAS ] --------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

	$str = $katwo->duasTags('hr',NULL,'/hr');
	$str .= $katwo->duasTags('h3','text-danger','/h3',NULL,$_ATENCAO.':');
   	
	$str .= $katwo->tags('div','alert alert-info');	
	print $str;
	unset($str);
	
	$katwo->controleDatasRegistros($nomeArquivoArmazem,1,$hoje);
	
	$str = $katwo->tags('/div',NULL,2);	
   
/* ----------------------------------------------------------------------------------------- */
/* ----------------- [                                 ] ----------------------------------- */
/* ----------------------------------------------------------------------------------------- */
   	
	print $str;
	unset($str);
	$_SESSION['cadastroEfetuado'] = 1;
	
}else{
	
/* ----------------------------------------------------------------------------------------- */
/* ----------------- [ EVITA DUPLICIDADE DE REGISTROS ] ------------------------------------ */
/* ----------------------------------------------------------------------------------------- */
	
	//print $katwo->testaCadastro();
	
/* ----------------------------------------------------------------------------------------- */
/* ----------------- [ REALIZA O CADASTRO DE JOGADORES ] ----------------------------------- */
/* ----------------------------------------------------------------------------------------- */

	$katwo->cadastraPlayer('');
	
/* ----------------------------------------------------------------------------------------- */
/* ----------------- [ EXIBE O CADASTRO PARA USUÁRIOS ] ------------------------------------ */
/* ----------------------------------------------------------------------------------------- */
   
  print $katwo->exibeRegistroParaUsuário();
   
/************************************************************************************************************************/

}//condição para exibir form
} // LIVE ON OFF
	
/* ----------------- [] ----------------------------------- */
	
	unset($sec_NomeGoogle,$sec_JogoEscolhido,$sec_NickName);
	unset($_POST);
	

	
/* ----------------- [] ----------------------------------- */

?>	