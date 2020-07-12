<?php
/* ---------------------------------------------------------------------------------------- */
/* --- [ ELIMINA A NECESSIDADE DE FAZER INCLUDES PARA QUALQUER ARQUIVO DE UMA CLASSE ] --- */
/* ---------------------------------------------------------------------------------------- */

function __autoload($classe){
	global $INCLUDE,$tokenSite;
		include_once ("$INCLUDE/biblioteca$tokenSite/{$classe}.class.php");
}
	$katwo = new minhaClasse;
	$trocador = new trocaJogoAgora;
	$ADS = new ClasseAds;
	$estatistica = new contador;
	$CONTA = new geraEstatisticas;

?>