<?php
 class geraEstatisticas{
 /* ------------------------------------------------------------------------- */
 /* ---- [ APENAS CONTA O NÚMERO DE LOGS ] ---------------------------------- */
 /* ------------------------------------------------------------------------- */
 
 	function contaNumLogs($pasta){
		$arquivos = glob("$pasta{*.txt}", GLOB_BRACE);
		$i = 0;
		foreach($arquivos as $txt){
	    	$i++;
		}
		return $i;
	}
 
 /* ------------------------------------------------------------------------- */ 
 /* ---- [ APENAS CONTA O NÚMERO DE REGISTROS DOS LOGS ] ---------------------------------- */
 /* ------------------------------------------------------------------------- */
		function contarRegistros($pasta){
		global $tokenSite;
		$arquivos = glob("$pasta{*.txt}", GLOB_BRACE);
			$i = 0;
			$contando = 0;
			$count = 0;
			$contaAnterior = 1;
		foreach($arquivos as $txt){		
			$nomeArq = explode('/',$txt);
			$usando = 'logs'.$tokenSite;
			$file = fopen($usando.'/'.$nomeArq[1],'r');
			
			while (!feof($file)) {
			    $line = fgets($file, 4096); //provavelmente eu colocaria um valor maior, jamais menor
				if($count != $contaAnterior){
					$contando = $contando+1;
				}
				$contaAnterior = $count;
				$count++;
			}
				fclose($file);
			$i++;
		}
			$contando = $contando - $i;
			return $contando;
		}
		
 /* ------------------------------------------------------------------------- */
 }// fecha class
?>