<?php
class trocaJogoAgora{

	function trocandoImagemJogoAgora($sec_trocaJogo){
		switch($sec_trocaJogo){		
			case 0:
			$imagemDaHora = 'lol_002.png';
			break;
			case 1:
			$imagemDaHora = 'black_squad.png';
			break;
			case 2:
			$imagemDaHora = 'battle_field.png';
			break;
			case 3:
			$imagemDaHora = 'combat_arms.png';
			break;
			case 4:
			$imagemDaHora = 'counter_strike.png';
			break;
			default:
			$imagemDaHora = 'lol_001.png';
			break;
			
		}
		return $imagemDaHora;
	}
	function trocandoNomeJogoAgora($sec_trocaJogo){
		switch($sec_trocaJogo){		
			case 0:
			$jogoDaHora = 'League of Legends';
			break;
			case 1:
			$jogoDaHora = 'Black Squad';
			break;
			case 2:
			$jogoDaHora = 'BattleField';
			break;
			case 3:
			$jogoDaHora = 'Combat Arms';
			break;
			case 4:
			$jogoDaHora = 'Counter Strike';
			break;
			default:
			$jogoDaHora = 'Não definido';
			break;
			
		}
	
		return $jogoDaHora;
	}
}
?>