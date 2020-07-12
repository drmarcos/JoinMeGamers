<?php
class contador{
	function exibeDados($arquivoContador,$nomeArquivoIp){		
		//print $GLOBALS['katwo']->getClientIP();
		if($GLOBALS['katwo']->getClientIP() != '::1'){
			
		$arIP=($GLOBALS['INCLUDE'].'/estatisticas'.$GLOBALS['tokenSite'].'/'.$GLOBALS['katwo']->getClientIP().$nomeArquivoIp);
		$arZ=($GLOBALS['INCLUDE'].'/estatisticas'.$GLOBALS['tokenSite'].'/'.$arquivoContador);	
	
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */	
/* --- [ SISTEMA DE CONTROLE DE ACESSOS ] --- */
/* --- [ IP E HORA DE ACESSO ] --- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	
						if(!file_exists($arIP)){
									$arIP=fopen($arIP,"w");									
									$dataHora = '$dataHora';
									$dataHoraRegistrada = time();
									$ipReg  = '$ipReg';
									$ipDetectado  = $GLOBALS['katwo']->getClientIP();
									$agora = '$agora';
									$sub = '$sub';
									$min = '$min';
									$subdv = '$subdv';
									$tempoMaisUmahora = '$tempoMaisUmahora';
									$timestamp = '$timestamp';
									$_TEMPO_RESTANTE = '$_TEMPO_RESTANTE';
									$_MINUTOS = '$_MINUTOS';
									$contagem = '$contagem';
									$destaque = '$destaque';
									$_AGUARDE = '$_AGUARDE';

$conteudo1 =<<<EOF
<?php
$dataHora = "$dataHoraRegistrada";
$ipReg = "$ipDetectado";
$agora = time();
$sub = $agora - $dataHora;
$min = 15;
$subdv = $sub / $min - $min;
$tempoMaisUmahora = $dataHora + 900;
$timestamp = ($tempoMaisUmahora - $agora);
$contagem = round($timestamp/900*60);
?>
EOF;
									fputs($arIP,$conteudo1);			
									fclose ($arIP);	
									$liberaPrimeiraGravacao = TRUE;									
						}else{
							//print ('arquivo existe 1'.$GLOBALS['pagina'].' -> '.$arIP);
						}
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */	
/* --- [ VERIFICA TEMPO DESDE ڌTIMO ACESSO ] --- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */

$qualArqUsar = $GLOBALS['INCLUDE'].'/estatisticas'.$GLOBALS['tokenSite'].'/'.$GLOBALS['katwo']->getClientIP().$nomeArquivoIp;
if(file_exists($qualArqUsar)){
	include($qualArqUsar);
		if($agora > $tempoMaisUmahora){
			//print $agora;
			unlink($qualArqUsar);
				$liberaGravacao = 1;				

		}else{
			if(isset($liberaPrimeiraGravacao)){				
				$liberaGravacao = 1;
				unset($liberaPrimeiraGravacao);
			}else{				
				$liberaGravacao = 0;
			}
		}						
}else{
	//print ('Arquivo inexistente');
}

/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */	
/* --- [ ATUALIZA REGISTRO DE ACESSO ] --- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	
	$varTotalRegistros = '$TotalRegistrosAcesso';
	if(file_exists($arZ)){
	include($arZ);
	if(isset($liberaGravacao) && $liberaGravacao == 1){	
			$contador = $TotalRegistrosAcesso+1;
			$new_lines = array(2 =>'$TotalRegistrosAcesso = "'.$contador.'";');
			$UT = new minhaClasse;
			$UT->replace_lines($arZ,$new_lines);
			unset($liberaGravacao);
			}

	}else{
						if(!file_exists($arZ)){
									$arZ=fopen($arZ,"w");	
$TotalRegistrosAcesso = '$TotalRegistrosAcesso';
$conteudo2 =<<<EOF
<?php
	$TotalRegistrosAcesso = "1";
?>
EOF;
									fputs($arZ,$conteudo2);			
									fclose ($arZ);	
									$liberaPrimeiraGravacao = TRUE;			
					}
	}
			if(isset($_SESSION["admin"])){			
				$resultado = '<SPAN id="spanLabel">'.$TotalRegistrosAcesso.'</span>&nbsp;';
			}else{
				$resultado = NULL;
			}
			return $resultado;
		}	
}
/* ----------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------- */

		function eliminaLixo($path){
		global $agora,$tempoMaisUmahora;
		$str = NULL;	
	  	$path = ('estatisticas'.$GLOBALS['tokenSite'].'/');
	  	 $diretorio = dir($path);
		   while($arquivo = $diretorio -> read()){
		   if(($arquivo != '.')
		   &&($arquivo != '..')
		   &&($arquivo != 'index.html')
		   &&($arquivo != 'metricas.inc.php')
		   &&($arquivo != 'lixeira')
		   &&($arquivo != 'contador.katworma.php'))
		   { 
		      // CHAMA CADA ARQUIVO E VERIFICA O TEMPO DE CRIAÇÃO
			 // SE A DIFERENÇA FOR MAIOR QUE 1 HORA, APAGAMOS O ARQUIVO DE RESTRIÇÃO.
		  	 include($path.'/'.$arquivo);
		 		if($agora > $tempoMaisUmahora){
					unlink($path.'/'.$arquivo);
				}else{
				}	    	
		   }
		  }
			//$str .= (':)');
		   $diretorio -> close();
		   return $str;
	}

/* ----------------------------------------------------------------------------------------------- */
function acessototais($arquivoContador){
$arZ=($GLOBALS['INCLUDE'].'/estatisticas'.$GLOBALS['tokenSite'].'/'.$arquivoContador);	
		$varTotalRegistros = '$TotalRegistrosAcesso';
	if(file_exists($arZ)){
	include($arZ);
	
			$contador = $TotalRegistrosAcesso+1;
			$new_lines = array(2 =>'$TotalRegistrosAcesso = "'.$contador.'";');
			$UT = new minhaClasse;
			$UT->replace_lines($arZ,$new_lines);
			unset($liberaGravacao);
			}


if(!file_exists($arZ)){
$arZ=fopen($arZ,"w");	
$TotalRegistrosAcesso = '$TotalRegistrosAcesso';
$conteudo2 =<<<EOF
<?php
$TotalRegistrosAcesso = "1";
?>
EOF;
									fputs($arZ,$conteudo2);			
									fclose ($arZ);	
									$liberaPrimeiraGravacao = TRUE;			
					}

			if(isset($_SESSION["admin"])){				
				$resultado = '<SPAN id="spanLabel">'.$TotalRegistrosAcesso.'</span>&nbsp;';
			}else{
				$resultado = NULL;
			}		
			return $resultado;
}
}
?>