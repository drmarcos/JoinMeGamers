<?php

	@session_start();
	include('config.php');
	include('biblioteca'.$tokenSite.'/params.inc.php');
	extract($_REQUEST, EXTR_PREFIX_ALL|EXTR_REFS, 'sec');

/* -------------------------------------------------------------------------------------- */
/* --- [ SELEÇÃO DE JOGO ] --- */
/* -------------------------------------------------------------------------------------- */

	if(isset($sec_trocaJogo)){		
		$imagemDaHora = $trocador->trocandoImagemJogoAgora($sec_trocaJogo);
		$jogoDaHora = $trocador->trocandoNomeJogoAgora($sec_trocaJogo);
	}else{
		$imagemDaHora = $trocador->trocandoImagemJogoAgora($jogoAtivoAgora);
		$jogoDaHora = $trocador->trocandoNomeJogoAgora($jogoAtivoAgora);
	}

/* -------------------------------------------------------------------------------------- */
/* --- [ SELEÇÃO DE IDIOMAS ] --- */
/* -------------------------------------------------------------------------------------- */

	if(isset($sec_idioma)){$_SESSION["idioma"] = $sec_idioma;}
	if(!isset($_SESSION["idioma"])){$_SESSION["idioma"] = $idioma;}
	
/* -------------------------------------------------------------------------------------- */

	include($INCLUDE.'/idiomas'.$tokenSite.'/'.$_SESSION["idioma"].'/mainlang.php');

/* -------------------------------------------------------------------------------------- */
/* --- [ EXIBE CONTEÚDOS ] --- */
/* -------------------------------------------------------------------------------------- */

	include('temas/default/topo.inc.php');
	include('chamaeu.php');
	include('temas/default/final.inc.php');
	include('estatisticas'.$tokenSite.'/contador.katworma.php');

?>