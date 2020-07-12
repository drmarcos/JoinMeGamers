<?php
 class minhaClasse{
 	function alerta($textoUsado = "ENTREI"){
		$str = ('<script language="javascript">alert(\''.$textoUsado.'\');</script>');
		return $str;
	}
	
/* ----------------------------------------------------------------------------------------- */
/* --------------------------------- [ FUNÇÃO CABEÇALHO DA TABELA ] ------------------------ */

		function cabecalhoTabela(){
			global $_NOME_YOUTUBE,$_JOGO,$_NICKNAME,$_STATUS;
		$str = $this->tags('br',NULL,1);	
		$str .=('<table class="table table-striped" width="100%">');
		$str .=('<thead>');
		$str .=('<tr>');
		$str .=('<th style="background-color:#363636; color:white;" width="15%"><span class="glyphicon glyphicon-expand" style="color:#ff0000;"></span>&nbsp;'.$_NOME_YOUTUBE.'</th>');
		$str .=('<th style="background-color:#363636; color:white; text-align:center;" width="30%"><span class="glyphicon glyphicon-screenshot" style="color:#00ff00;"></span>&nbsp;'.$_JOGO.'</th>');
		$str .=('<th style="background-color:#363636; color:red; text-align:center;" width="40%"><span class="glyphicon glyphicon-user" style="color:#ff8040;"></span>&nbsp;'.$_NICKNAME.'</th>');
		$str .=('<th style="background-color:#363636; color:white;" width="15%"><span class="glyphicon glyphicon-cog" style="color:#a6caf0;"></span>&nbsp;'.$_STATUS.'</th>');
		$str .=('</tr>');
		$str .=('</thead>');
		return $str;
		}

/* ----------------------------------------------------------------------------------------- */
/* ----------------------------------- [ FUNÇÃO ACCORDION ] -------------------------------- */

		function AccordionExibe($TITULO,$TXT_EXIBICAO,$glyphiconType,$ID_Collapse,$in=""){
				$accordion =('<div class="panel panel-default">')."\n";
				$accordion .=('<div class="panel-heading">')."\n";
				$accordion .=('<h2 class="panel-title">')."\n";
				$accordion .=('<span class="glyphicon '.$glyphiconType.'"></span>&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#'.$ID_Collapse.'">'.$TITULO.'</a>')."\n";
				$accordion .=('</h2>')."\n";
				$accordion .=('</div>')."\n";
				$accordion .=('<div id="'.$ID_Collapse.'" class="panel-collapse collapse '.$in.'">')."\n";
				$accordion .=('<div class="panel-body">')."\n";
				$accordion .= $TXT_EXIBICAO;
				$accordion .=('</div>')."\n";
				$accordion .=('</div>')."\n";
				$accordion .=('</div>')."\n";
				return $accordion;
		}
		
/* ----------------------------------------------------------------------------------------- */
/* ---------------------------- [ ACESSO ADMINISTRATIVO ] ---------------------------------- */
/* --------------------------------- [ LOGIN ] --------------------------------------------- */ 
/* ----------------------------------------------------------------------------------------- */

		function Login(){	
			global $usuarioMD5,$senhaMD5,$conf1,$conf2,$DEBUG;

				if(((isset($_SESSION["loginUsuario"]))&&($_SESSION["loginUsuario"] != NULL))|| ((isset($_SESSION["loginSenha"]))&&($_SESSION["loginSenha"] != NULL))){
					if (($_SESSION['confirmacao'] != $_SESSION['autenticagd'])&& (!isset($_SESSION["admin"]))){	
								print('<div class="container-fluid alert alert-danger">Verificador não confere</div>');			
					}else{					
								if(($_SESSION["loginUsuario"] == "$usuarioMD5")&&($_SESSION["loginSenha"] == "$senhaMD5")){
									$_SESSION["admin"] = "administrador";
									if($DEBUG != 0){										
										print('Admin:'.$sec_usrname. ' logado');
										print('<div class="container-fluid alert alert-success"><a href="chamaeu.php?logout=1"><b>'.strtoupper($_SESSION["admin"]). '</b> Sair</a></div>');
									}
									
								}else{
									print('<div class="container-fluid alert alert-danger">Dados incorretos </div>');			
								}
								
								unset($sec_usrname,$sec_psw);
				}
				}elseif(((isset($_SESSION["loginUsuario"]))&&($_SESSION["loginUsuario"] == ""))||((isset($_SESSION["loginSenha"]))&&($_SESSION["loginSenha"] == ""))){
					print('<span class="alert alert-danger">'.$_PREENCHA_CAMPOS_OBRIGATORIOS.'<span>');
			}
		}
		

/* ----------------------------------------------------------------------------------------- */
/* ------ [ CONTAMOS O NÚMERO DE REGISTROS DO DIA ] ---------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

		function ContaRegistros($nomeArquivo){	
			$linecount = 0;
			$handle = fopen($nomeArquivo, "r");
			while(!feof($handle)){
			  $line = fgets($handle);
			  $linecount++;
			}
			fclose($handle);
			return $linecount-1;
		}
/* ----------------------------------------------------------------------------------------- */
/* ----------------- [ REALIZA O CADASTRO ] ----------------------------------- */
/* ----------------------------------------------------------------------------------------- */

	function cadastraPlayer(){
	global $sec_atualizar,$nomeArquivoArmazem,$sec_NomeGoogle,$sec_linkYoutube,$sec_JogoEscolhido,$sec_NickName,$_JA_CADASTRADO,$DEBUG;
	if((isset($sec_atualizar))&&($sec_atualizar == "admin")){
		print('Administrando');

	}else{
			$this->testaCadastro();
			if($DEBUG != 0){
				print $this->alerta('admin passando');
			}
		if($_SESSION['cadastroEfetuado'] == 1){
			
			$myfile = fopen($nomeArquivoArmazem, "a") or die("Ika, deu alguma Zika!");
			$txt = "\n".htmlspecialchars($sec_NomeGoogle)."%%@@";
			
			$testandoLink = explode('//',$sec_linkYoutube);
			$testandoLink2 = explode('/',$testandoLink[1]);
			$somaLink = $testandoLink[0].'//'.$testandoLink2[0];
			$testaString = strpos($sec_linkYoutube, '&');
			if ($testaString == true){$temTreta = 1;}
			if($somaLink != "https://www.youtube.com"){$temTreta = 1;}
			if((isset($temTreta))&&($temTreta == 1)){
				print '<div  class="alert alert-danger"><h1>Aviso</h1>';
				if($DEBUG != 0){
					print $testandoLink[0].'<br/>';
					print $testandoLink[1].'<br/>';
					print trim($testandoLink2[0]).'<br/>';
				}
				print '<span style="color:black;">'.$sec_linkYoutube.'</span>';
				print '<br>';
				print '<b>Este link não é permitido</b><br/>';
				print '<b>Por favor, verifique se você não está fornecendo um endereço web incorreto e tente novamente!</b>';
				print '</div>';
				print '</div>';
				unset($temTreta);
				print $this->finalPagina();
				exit;
			}
			
			$txt .= htmlspecialchars($sec_linkYoutube)."%%@@";
			$txt .= htmlspecialchars($sec_JogoEscolhido)."%%@@";
			$txt .= htmlspecialchars($sec_NickName)."%%@@ativo%%@@".time();
			fwrite($myfile, $txt);
			fclose($myfile);
		
			$_SESSION['cadastroEfetuado'] = $txt;
			print '<div class="alert alert-success">';
			print 'Obrigado por participar!';
			print '</div>';
		}else{
			print '<div class="alert alert-danger">';
			print '<h3 class="text-danger">'.$_JA_CADASTRADO.': '.$_SESSION['cadastroEfetuado'].'</h3>';
			print ('</div>');
		}	
	}
	}// function cadastraPlayer()
			
/* ----------------------------------------------------------------------------------------- */
/* ---------------------- [ ATUALIZANDO UMA LINHA ] ---------------------------------------- */
/* ---------------------- [ ATIVA/DESATIVA CADASTRO ] -------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

	function atualizaLinhaTxt(){
		global $sec_atualizar,$sec_excluir,$nomeArquivoArmazem,$producao,$DEBUG;
		if(!isset($sec_atualizar))	{
		}else{
				if($DEBUG != 0){
				$sec_atualizar = htmlspecialchars($sec_atualizar);
				print $sec_atualizar;
				exit;
				}
			$convert = explode("\n", trim(file_get_contents($nomeArquivoArmazem))); //create array separate by new line
			
				for ($i=0;$i<count($convert);$i++){
					
					if($sec_atualizar == $convert[$i]){					
						$busca = explode("%%@@",$convert[$i]);
						$separando = explode("%%@@",$sec_atualizar);
						
						if((isset($busca[5]))&&($busca[5] == $separando[5])){
						if($DEBUG != 0){							
							print $this->alerta('entrei 3\\n'.$busca[5]);
							print $this->alerta('entrei 4\\n'.$separando[5]);
						}							
						}
						
						$reescreve = $separando[0]."%%@@";
						$reescreve .= $separando[1]."%%@@";
						$reescreve .= $separando[2]."%%@@";
						$reescreve .= $separando[3]."%%@@";
		
		/* --- [ ATIVAR/DESATIVAR ] --- */
						if((!isset($sec_excluir))||($sec_excluir == 0)){
							switch($separando[4]){
							case 'ativo':
								$reescreve .= "inativo%%@@".time();
							break;
							case 'inativo':
								$reescreve .= "ativo%%@@".time();
							break;
							case 'excluido':
								$reescreve .= "inativo%%@@".time();
							break;								
							}
							
							if($DEBUG != 0){	
							if($separando[4] == "ativo"){					
								$reescreve .= "inativo%%@@0";
							}else{
								$reescreve .= "ativo";					
							}
						}	
						}elseif($sec_excluir == 1){
								$reescreve .= "excluido%%@@".time();
								unset($sec_excluir);
						}
						
						file_put_contents($nomeArquivoArmazem, str_replace($sec_atualizar, $reescreve, file_get_contents($nomeArquivoArmazem)));
						if($DEBUG != 0){	
							print ' » [ Registro atualizado ]';
						}
					}
				}//admin na área

			if($producao == 0){
			 	@header("Location: $ROTA/default.php");				
			 }else{			 	
			 	@header("Location: $ROTA/default.php?idioma=$_SESSION[idioma]");
				if($DEBUG != 0){print $this->alerta('entrei 2');}
			}
				if($DEBUG != 0){print $this->alerta('entrei 2');}
	
						unset($sec_atualizar,$sec_excluir,$nomeArquivoArmazem);
		}// testa sec_atualizar
}

/* ----------------------------------------------------------------------------------------- */
/* ---------------------- [ EXIBE OS REGISTROS PARA ADMIN ] -------------------------------- */
/* ----------------------------------------------------------------------------------------- */

	function exibeRegistroAdmin(){
		global $nomeArquivoArmazem,$hoje,$sec_verPaginaInicial,$sec_JogoEscolhido,$_COPIAR,$_EXCLUIR,$estatistica,$producao,$ROTA,$DEBUG;
		if(isset($sec_JogoEscolhido)){
			unset($sec_JogoEscolhido);
			if($producao == 0){
			    print('<meta http-equiv="refresh" content="0;URL=\'default.php?verPaginaInicial='.$sec_verPaginaInicial.'\'" />  ');
			}else{
				print('<meta http-equiv="refresh" content="0;URL=\'default.php?verPaginaInicial='.$sec_verPaginaInicial.'\'" />  ');
			}
		}

		$str = '';
	
		$str .= ('<div class="col-sm-8 text-left">');
		$str .= ('<div class="table-responsive">');
	
		$str .= $this->cabecalhoTabela();
	

		$file = new SplFileObject($nomeArquivoArmazem);
		$i = 0;
		while (!$file->eof()) {	
			if($i > 0){
				$registro = $file->fgets();
				$retornandoRegistrosTxtAdm = explode("%%@@",$registro); 
				
				if ($retornandoRegistrosTxtAdm[0] == $hoje){
				}else{				
				$this->controleDatasRegistros($nomeArquivoArmazem,1,$hoje);
				$str .=('<td>');
				if(trim($retornandoRegistrosTxtAdm[4]) != 'excluido'){	
					$testaLink = explode("//",$retornandoRegistrosTxtAdm[1]);
					$testaLink2 = explode("/",$testaLink[1]);
					if($DEBUG != 0){	
						$str .= $testaLink[0];
						$str .= $testaLink2[0];
					}
					if(($testaLink[0] == "https:") && ($testaLink2[0] == "www.youtube.com")){				
					$str .=('<a class="btn btn-danger btn-lg btn-block" href="'.$retornandoRegistrosTxtAdm[1].'" target="_blank">');
						$str .= $retornandoRegistrosTxtAdm[0];			
					$str .= '&nbsp;';
					$str .= $this->duasTags('span','glyphicon glyphicon-expand','/span');
					$str .= $this->tags('/a');
					}else{
						$str .= $this->duasTags('span style="color:#b3b3b3;"','glyphicon glyphicon-remove-circle','/span');
						$str .= '&nbsp;';
						$str .= $this->duasTags('span style="color:#b3b3b3;"','glyphicon glyphicon-arrow-right','/span');
						$str .= $this->duasTags('span style="color:#b3b3b3;"',NULL,'/span',NULL,$retornandoRegistrosTxtAdm[0]);
					}
				}
				$str .=('</td>');
				
				$str .=('<td style="text-align:center;">');
				if(trim($retornandoRegistrosTxtAdm[4]) != 'excluido'){
					$str .= $retornandoRegistrosTxtAdm[2];
				}
				$str .=('</td>');				
				$str .=('<td style="text-align:center;">');

/* --- [ EXCLUIR REGISTRO ] --- */				

				$str .= ('<div class="col-sm-4">');				
				if(trim($retornandoRegistrosTxtAdm[4]) != 'excluido'){
					$str .= '<a class="btn btn-default btn-lg btn-block" href="?idioma='.$_SESSION["idioma"].'&verPaginaInicial='.$sec_verPaginaInicial.'&atualizar='.$registro.'&verAtualizacao=1&excluir=1"><b style="color:red">'.$_EXCLUIR.'</b> <span class="glyphicon glyphicon-heart-empty"></span> </a>';
				}
				$str .= ('</div>');

/* --- [ EXIBE NICK NAME ] --- */	
				$montaIdCopiar = trim($retornandoRegistrosTxtAdm[3].$retornandoRegistrosTxtAdm[5]);
				$str .= ('<div class="col-sm-4" id="'.$montaIdCopiar.'">');
				if(trim($retornandoRegistrosTxtAdm[4]) != 'excluido'){					
					$str .= $retornandoRegistrosTxtAdm[3];
				}else{
					$str .= '<b style="color:#ccc;">'.$GLOBALS["_USUARIO_BANIDO"].'</b>';
				}
				$str .= ('</div>');
				
/* --- [ COPIAR NICK NAME ] --- */			
	
				$str .= ('<div class="col-sm-4" id="'.$montaIdCopiar.'">');	
				if(trim($retornandoRegistrosTxtAdm[4]) != 'excluido'){			
					$str .= ('<button class="btn btn-lg btn-warning" data-clipboard-action="copy" data-clipboard-target="#'.$montaIdCopiar.'"><span class="glyphicon glyphicon-hand-left"></span>&nbsp;');
					$str .= $_COPIAR;
					$str .= ('&nbsp;&nbsp;<span class="glyphicon glyphicon-copy"></span>');
					$str .= ('</button>');
				}
				$str .= ('</div>');
				
				$str .=('</td>');

				$str .=('<td>');
				
/* --- [ ATIVAR / DESATIVAR ] --- */			
	
				
				if((trim($retornandoRegistrosTxtAdm[4]) == "inativo\n")||(trim($retornandoRegistrosTxtAdm[4]) == "inativo")){
					if((isset($_SESSION["admin"]))&&($_SESSION["admin"] == "administrador")){
						$str .= '<a class="btn btn-default btn-lg btn-block" href="?idioma='.$_SESSION["idioma"].'&verPaginaInicial='.$sec_verPaginaInicial.'&atualizar='.$registro.'&verAtualizacao=1&excluir=0"><b style="color:red">'.trim($retornandoRegistrosTxtAdm[4]).'</b> <span class="glyphicon glyphicon-heart-empty"></span> </a>';
					}else{
						$str .= '<b style="color:red;">'.trim($retornandoRegistrosTxtAdm[4]).'</b>';						
					}
				}elseif((trim($retornandoRegistrosTxtAdm[4]) == "ativo\n")||(trim($retornandoRegistrosTxtAdm[4]) == "ativo")){
					if((isset($_SESSION["admin"]))&&($_SESSION["admin"] == "administrador")){
						$str .= '<a class="btn btn-success  btn-lg btn-block" href="?idioma='.$_SESSION["idioma"].'&verPaginaInicial='.$sec_verPaginaInicial.'&atualizar='.$registro.'&verAtualizacao=1&excluir=0"><span class="glyphicon glyphicon-hand-right"></span> '.trim($retornandoRegistrosTxtAdm[4]).'</a>';
					}else{
						$str .= trim($retornandoRegistrosTxtAdm[4]);				
					}
				}else{//if inativo
						$str .= '<a class="btn btn-danger  btn-lg btn-block" href="?idioma='.$_SESSION["idioma"].'&verPaginaInicial='.$sec_verPaginaInicial.'&atualizar='.$registro.'&verAtualizacao=1&excluir=0"><span class="glyphicon glyphicon-hand-right"></span> '.trim($retornandoRegistrosTxtAdm[4]).'</a>';
				}
			}//if2
			}//if	
			$i++;
			$str .=('</td></tr>');
		}//while 
					$admTex = '';
					
					$admTex .= $this->tags('div','col-sm-4 text-center',1,'style="background-color:#a9a9a9; color:#fff;"');
					$admTex .= strtoupper($_SESSION["admin"]);
					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center',1,'style="background-color:#363636; color:#fff;"');
					$admTex .= 'Total de visitas restringidas:';
					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center',1,'style="background-color:#a9a9a9; color:#fff;"');
					$admTex .= 'Total cliques site: ';
					$admTex .= $this->tags('/div');
					
					$admTex .= $this->tags('div','col-sm-4 text-center');
					$admTex .= $this->tags('br');
					$admTex .= ('<a class="btn btn-md btn-danger" href="default.php?logout=1">Sair</a>');
					$admTex .= $this->tags('br');
					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center');
					$admTex .= $this->duasTags('b',NULL,'h3');
					$admTex .= $estatistica->exibeDados('contador.katworma.php','.default.php');
					$admTex .= $this->duasTags('/b',NULL,'/h3');
					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center');
					$admTex .= $this->duasTags('b',NULL,'h3');
					$admTex .= $estatistica->acessototais('velocimetro.katworma.php');
					$admTex .= $this->duasTags('/b',NULL,'/h3');
					$admTex .= $this->tags('/div');
/* SEGUNDO BLOCO */																			

					$admTex .= $this->tags('div','col-sm-4 text-center',1,'style="background-color:#363636; color:#fff;"');
					$admTex .= 'Total de dias jogados';
					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center',1,'style="background-color:#a9a9a9; color:#fff;"');
					$admTex .= 'Amigos que jogaram';
					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center',1,'style="background-color:#363636; color:#fff;"');
					$admTex .= 'Cadastrados hoje: ';
					$admTex .= $this->tags('/div');

					$caminhoLogs = 'logs'.$GLOBALS["tokenSite"].'/';
					$admTex .= $this->tags('div','col-sm-4 text-center');
					$admTex .= $this->duasTags('b',NULL,'h3');
					$admTex .= $this->tags('span','btn btn-circle-lg btn-default');
					$admTex .= $GLOBALS["CONTA"]->contaNumLogs($caminhoLogs);
					$admTex .= $this->tags('/span');
					$admTex .= $this->duasTags('/b',NULL,'/h3');
					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center');
					
					$admTex .= $this->duasTags('b',NULL,'h3');
					$admTex .= $this->tags('span','btn btn-circle-lg btn-default');
					$admTex .= $GLOBALS["CONTA"]->contarRegistros($caminhoLogs);
					$admTex .= $this->tags('/span');
					$admTex .= $this->duasTags('/b',NULL,'/h3');

					$admTex .= $this->tags('/div');
					$admTex .= $this->tags('div','col-sm-4 text-center');
					$admTex .= $this->duasTags('b',NULL,'h1');
					//$admTex .= $this->tags('span',NULL,1,'style="color:#ff0000;"');
					$admTex .= $this->tags('span','btn btn-circle-lg btn-danger');
					$admTex .= $this->ContaRegistros($nomeArquivoArmazem);
					$admTex .= $this->tags('/span');
					$admTex .= $this->duasTags('/b',NULL,'/h1');
					$admTex .= $this->tags('/div');
										
					$texAjuda = 'É muito fácil e simples!.';
					$texAjuda .= $this->tags('br');
					$texAjuda .= 'Basta apenas seguir sua intuição!';
				
				$str .= $this->tags('div','panel-group',1,' id="accordion"');	
				$str .= $this->AccordionExibe('Admin',$admTex,'glyphicon-king','admin','');
				$str .= $this->AccordionExibe('Cadastrar um Amigo!',$this->exibeFormCadastroAmigos($GLOBALS['jogoDaHora']),'glyphicon-eye-open','cadastros');
				$str .= $this->AccordionExibe('Ajuda',$texAjuda,'glyphicon-barcode','ajuda');
				$str .= $this->tags('/div');
		
			$str .= ('</table>');




	   
/* ----------------------------------------------------------------------------------------- */
					$str .= $this->tags('/span');

/* ---------------------- [ // EXIBE OS REGISTROS ] ---------------------------------------- */

		if((!isset($sec_verPaginaInicial))||($sec_verPaginaInicial == 0)){
					$str .= $this->tags('/div',NULL,2);			
		}else{
			if(isset($GLOBALS['sec_NomeGoogle'])){				
				if($DEBUG != 0){print('<script language="javascript">alert(\'entrei\');</script>');}
				$_SESSION['cadastroEfetuado'] = 1;
				$this->cadastraPlayer('');
			}			
			if($DEBUG != 0){$str .= $this->exibeFormCadastroAmigos($GLOBALS['jogoDaHora']);}
			$str .= $this->tags('/div',NULL,2);	
	   		
		}
		$str .= $this->finalPagina();
	   	return $str;
		unset($sec_atualizar,$str);
		exit();
	}//
	

/* ----------------------------------------------------------------------------------------- */
/* ----------------- [ EXIBE O CADASTRO PARA USUÁRIOS ] ------------------------------------ */
/* ----------------------------------------------------------------------------------------- */

		function exibeRegistroParaUsuário(){
			global $nomeArquivoArmazem,$hoje,$_USUARIO_BANIDO,$DEBUG;
			$str = '';
			$str .= $this->tags('div','table-responsive');
			$str .= $this->cabecalhoTabela();
				$file = new SplFileObject($nomeArquivoArmazem);
				$i = 0;
				while (!$file->eof()) {	
					if($i > 0){
						$registro = $file->fgets();
						$retornandoRegistrosTxt = explode("%%@@",$registro); 
						
						if ($retornandoRegistrosTxt[0] == $hoje){
						}else{				
						$pacote = trim($retornandoRegistrosTxt[4]);							
						
						$str .= $this->tags('td');
						if($pacote != 'excluido'){
							$str .= $retornandoRegistrosTxt[0];//nome Youtube
						}
						
						$str .= $this->duasTags('/td',NULL,'td style="text-align:center;"');
						if($pacote != 'excluido'){
							$str .= $retornandoRegistrosTxt[2];
						}
						$str .= $this->duasTags('/td',NULL,'td style="text-align:center;"');
						
						if($pacote != 'excluido'){
							$str .= $retornandoRegistrosTxt[3];
						}
						$str .= $this->duasTags('/td',NULL,'td');
						if($DEBUG != 0){$str .= $retornandoRegistrosTxt[4];}
						switch($pacote){
							case 'inativo':
							$str .= $this->tags('span',NULL,1,'style="color:#ff0000;"');
							$str .= 'Já foi chamado!';
							$str .= $this->tags('span');
							break;
							case "ativo":
							$str .= 'Ativo';
							break;
							case "excluido":
							$str .= $this->tags('span',NULL,1,'style="color:#cccccc;"');
							$str .= $_USUARIO_BANIDO;
							$str .= $this->tags('/span');
							break;
						}
						
						if($DEBUG != 0){$str .= $_SESSION["admin"];}
					}//if2 confere data
					}//if $i > 0
					$i++;
					$str .= $this->duasTags('/td',NULL,'/tr');
				}//while 
			
				
					$str .= $this->tags('/table');
					$str .= $this->tags('/div',NULL,2);				
			   return $str;
		}	
/* ----------------------------------------------------------------------------------------- */
/* ------------------------------- [ FORM CADASTRO AMIGOS ] -------------------------------- */
/* ----------------------------------------------------------------------------------------- */

		function exibeFormCadastroAmigos($nomeJogoEscolhido){
			global $nomeArquivoArmazem,$_CADASTROS_EFETUADOS,$_NOME_YOUTUBE,$_SEU_LINK_YOUTUBE,$_NICKNAME,$_CHAMAEUKATWO;
			
			$str = $this->tags('br');
			$str .= $this->tags('div','text-right',1,' style"max-width: 600px;');
			$str .= $this->tags('span','alert alert-info');
			$str .= $this->tags('span','glyphicon glyphicon-list-alt');
			$str .= $this->tags('/span');
			if($this->ContaRegistros($nomeArquivoArmazem) == 0){
				$str .= '&nbsp;Seja o primeiro a ser chamado!';
			}else{
				$str .= $this->tags('b',NULL,1,'style="font-size:1.5em;"');
				$str .= '&nbsp;'.$this->ContaRegistros($nomeArquivoArmazem);
				$str .= $this->tags('/b');
				$str .= '&nbsp;'.$_CADASTROS_EFETUADOS;
				
			}
			$str .= $this->tags('/span');
		  	$str .= $this->tags('/div');
			$str .= $this->tags('div','container',1, 'style=" max-width:450px;"');
			$str .= $this->tags('form',NULL,1,' action="default.php" name="chamaeu" data-toggle="validator" role="form"');
			$str .= $this->tags('div','form-group');
			
			/* --- [ O JOGO É DETERMINADO PELO CONFIG ] --- */
		  	$str .= $this->tags('input','form-control',1,'type="hidden" name="JogoEscolhido" id="inputlg" value="'.$nomeJogoEscolhido.'"');

			if(isset($_SESSION['admin'])){			
			  	$str .= $this->tags('input','form-control',1,'type="hidden" name="verPaginaInicial" id="inputlg" value="1"');
			}

		  	$str .= $this->tags('/div');
			
			/* --- [ NOME YOUTUBE ] --- */
	
			$str .= $this->tags('div','form-group');	    
			$str .= $this->tags('label',NULL,1,' for="email"');
			$str .= $this->tags('span','glyphicon glyphicon-expand');
			$str .= $this->tags('/span');
			$str .= '&nbsp;'.$_NOME_YOUTUBE.'::';
			$str .= $this->tags('/label');
			$str .= $this->tags('input','form-control',1,'type="text" name="NomeGoogle" placeholder="ex: KatwoGamer" required');
		  	$str .= $this->tags('/div');
			
			/* --- [ LINK CANAL YOUTUBE ] --- */
			$str .= $this->tags('div','form-group');  
			$str .= $this->tags('label',NULL,1,' for="email"');
			$str .= $this->tags('span','glyphicon glyphicon-bell');
			$str .= $this->tags('/span');
			$str .= '&nbsp;'.$_SEU_LINK_YOUTUBE.'::';
			$str .= $this->tags('/label');
			$str .= $this->tags('input','form-control',1,'type="url" name="linkYoutube" placeholder=https://www.youtube.com/user/seu_Canal_Youtube/channels" required');
		  	$str .= $this->tags('/div');
			
			/* --- [ NICK NAME JOGO ] --- */
			$str .= $this->tags('div','form-group',1, 'style"max-width: 600px;"');
		    $str .= $this->tags('label',NULL,1, 'for="inputsm"');
			$str .= $this->tags('span','glyphicon glyphicon-user');
			$str .= $this->tags('/span');
			$str .= '&nbsp;'.$_NICKNAME.'::';
			$str .= $this->tags('/label');
		    $str .= $this->tags('input','form-control input-sm',1, 'type="text" placeholder="ex: Wind Ama Você" id="inputsm" name="NickName" required');
			$str .= $this->tags('/div');
			
			$str .= $this->tags('button','btn btn-success btn-block',1,' type="submit"');
			$str .= $this->tags('span','glyphicon glyphicon-off');
			$str .= $this->tags('/span');
			$str .= '&nbsp;'.$_CHAMAEUKATWO;
			$str .= $this->tags('/button');
			$str .= $this->tags('/div');//container
			
			$str .= $this->tags('br',NULL,1);
			if(!isset($_SESSION["admin"])){
				$str .= $this->tags('br',NULL,2);			
				$str .= $this->tags('div class="panel"')."\n";
				$str .= $GLOBALS["ADS"]->ADsBannerBlog();
				$str .= $this->Tags('/div');
				$str .= $this->tags('div class="panel"')."\n";
				$str .= $this->Tags('/div');
			}
			return $str;
			
	}		
	
/*************************************************************************************************/
/******************************** [ Modal LOGIN ] ************************************************/
/*************************************************************************************************/

		function loginForm(){
			global $_ACESSO,$tokenSite,$_FECHAR,$nomeFormLogin,$DEBUG;
			@session_start();
				
			$str =  $this->tags('div','modal fade',1,' id="myModal" role="dialog"');
			$str .= $this->tags('div','modal-dialog');
			$str .= $this->tags('div','modal-content');
			$str .= $this->tags('div','modal-header');
			$str .= $this->tags('button','close',1, 'data-dismiss="modal"  type="button"');
			$str .= '&times;';
			$str .= $this->tags('/button');
			$str .= $this->tags('h4','modal-title');
			$str .= $nomeFormLogin;
			$str .= $this->tags('/h4');
			$str .= $this->tags('/div');
			$str .= $this->tags('div','modal-body text-left');
			if($DEBUG != 0){
				$str .= $this->tags('p');
				$str .= $_ACESSO.' IP: ';
				$str .= $this->get_client_ip();
				$str .= $this->tags('/p');
			}
			$str .= $this->tags('div','modal-body',1,'padding:40px 50px;');
			$str .= $this->tags('form',NULL,1, 'role="form" action="paginas'.$tokenSite.'/index2.php" data-toggle="validator"');
			$str .= $this->tags('div','form-group');
			$str .= $this->tags('label',NULL,1,' for="usrname"');
			$str .= $this->tags('span', 'glyphicon glyphicon-user');
			$str .= $this->tags('/span');
			$str .= '&nbsp;Username';
			$str .= $this->tags('/label');
			$str .= $this->tags('input','form-control',1, 'type="text" class="" name="usrname" id="usrname" placeholder="Enter email" required');
			$str .= $this->tags('/div');
			$str .= $this->tags('div','form-group');
			$str .= $this->tags('label',NULL,1,' for="psw"');
			$str .= $this->tags('span','glyphicon glyphicon-eye-open');
			$str .= $this->tags('/span');
			$str .= '&nbsp;Password';
			$str .= $this->tags('/label');
			$str .= $this->tags('input','form-control',1, 'type="password" name="psw" id="psw" placeholder="Enter password" required');
			$str .= $this->tags('input',NULL,1,'type="hidden" name="logando"');
			$str .= $this->tags('/div');
			/* --- [ CAPTCHA ] --- */
			$_SESSION["autenticagd"]=$this->generateRandomString();
			$str .= $this->tags('div','form-group text-center');
			$str .= $this->tags('div','container-fluid',1,'style="background:#ab69d5;"');
			$str .= '<img src="imagens/captcha.php">';
			$str .= $this->tags('/div',NULL,2);
			$str .= $this->tags('div','form-group');
			$str .= $this->tags('label',NULL,1,' for="usrname"');
			$str .= $this->tags('span', 'glyphicon glyphicon-certificate');
			$str .= $this->tags('/span');
			$str .= '&nbsp;I\'m  not Robot!';
			$str .= $this->tags('/label');
			$str .= $this->tags('input','form-control',1,'type="text" name="confirmacao" id"captcha" placeholder="Texto de segurança" required');
			$str .= $this->tags('/div');
			
			$str .= $this->tags('button','btn btn-success btn-block',1,'type="submit"');
			$str .= $this->tags('span','glyphicon glyphicon-off');
			$str .= $this->tags('/span');
			$str .= $_ACESSO;
			$str .= $this->tags('/button');
			$str .= $this->tags('/form');
			$str .= $this->tags('/div',NULL,2);
			$str .= $this->tags('div','modal-footer');
			$str .= $this->tags('button','btn btn-default',1, 'type="button" class="" data-dismiss="modal"');
			$str .= $_FECHAR.'&nbsp;&nbsp';
			$str .= $this->tags('span','glyphicon glyphicon-remove-circle');
			$str .= $this->tags('/span');
			$str .= $this->tags('/button');
			$str .= $this->tags('/div',NULL,4);

			return $str;
			
		}	
/* ----------------------------------------------------------------------------------------- */
/* ------ [ IDENTIFICADOR DE ENDEREÇO IP ] ------------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

		function get_client_ip() {
		    $ipaddress = '';
		    if (isset($_SERVER['HTTP_CLIENT_IP']))
		        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED'];
		    else if(isset($_SERVER['REMOTE_ADDR']))
		        $ipaddress = $_SERVER['REMOTE_ADDR'];
		    else
		        $ipaddress = 'UNKNOWN';
		    return $ipaddress;
		}	
		
			function getClientIP() {
	
	        if (isset($_SERVER)) {				
	           if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
	               return $_SERVER["HTTP_X_FORWARDED_FOR"];				
	           if (isset($_SERVER["HTTP_CLIENT_IP"]))
	               return $_SERVER["HTTP_CLIENT_IP"];				
	           return $_SERVER["REMOTE_ADDR"];
	        	}				
		        if (getenv('HTTP_X_FORWARDED_FOR'))
		           return getenv('HTTP_X_FORWARDED_FOR');					
		        if (getenv('HTTP_CLIENT_IP'))
		           return getenv('HTTP_CLIENT_IP');					
		    return getenv('REMOTE_ADDR');
	}

/* ----------------------------------------------------------------------------------------- */
/* ------ [ VERIFICA DATAS E FAZ BACKUP ] -------------------------------------------------- */
/*------------------------------------------------------------------------------------------ */

	function controleDatasRegistros($arq,$linha,$dataRegistrada){
		global $tokenSite,$_FIQUE_ATENTO_A_LIVE,$_NOVO_DIA_NOVOS_INSCRITOS,$statusLive,$DEBUG;
		 $arquivo = file($arq);
		 $y = $linha - 1;
		 $x =  $arquivo[$y];
	 
	 		$converte = explode("%%@@",$x);
			 
			$dia = substr($converte[0],0,2);	
			$mes = substr($converte[0],2,2);	
			$ano = substr($converte[0],4,4);	
			 
			$diaHoje = substr($dataRegistrada,0,2);	
			$mesHoje = substr($dataRegistrada,2,2);	
			$anoHoje = substr($dataRegistrada,4,4);	
			if($DEBUG != 0){
				if(($dia<$diaHoje)){print('dia menor<br/>');}else{print('dia maior ou igual<br/>');}
				if(($mes<$mesHoje)){print('mes menor<br/>');}else{print('mes maior ou igual<br/>');}
				if(($ano<$anoHoje)){print('ano menor<br/>');}else{print('ano maior ou igual<br/>');}
				if(($dia<$diaHoje)||($mes<$mesHoje)||($ano<$anoHoje)){
				print('<br/>trocamos<br/>');
			}
			}
			

		if(($dia<$diaHoje)||($mes<$mesHoje)||($ano<$anoHoje)){
		 
		/* ---------------------[ BACKUP ]------------------------- */
	
			$retornandoData = explode("%%@@",$x); 
			$arquivo_destino = 'logs'.$tokenSite.'/log_'.$retornandoData[0].'.txt';
			
			if (copy($arq, $arquivo_destino)){
				if($DEBUG != 0){echo "BackUp realizado!<br/>";}
			}else{
				echo "Erro ao copiar arquivo.";
			}
			
		/* ---------------------------------------------- */	 
			if($statusLive != 0){			
		 		print ('<p style="color:red;">'.$_NOVO_DIA_NOVOS_INSCRITOS.'</p>');
				print $_FIQUE_ATENTO_A_LIVE;
			}
			
			$myfile = fopen("newfile.txt", "w") or die("Ika, deu alguma Zika!");
			$cadastraData = $dataRegistrada."%%@@1%%@@2%%@@3";
			fwrite($myfile, $cadastraData);
			fclose($myfile);
		
		 }else{
		 if($DEBUG != 0){
		 	print $_FIQUE_ATENTO_A_LIVE .'-- '.$converte[0].' -- '.$dataRegistrada.' -- '.$dia.' -- '.$mes.' -- '.$ano.' -- '.$diaHoje.' -- '.$mesHoje.' -- '.$anoHoje;			
		 	}
			if($statusLive != 0){
				if(isset($_SESSION['admin'])){
					if($DEBUG != 0){print 'instruções admin';}
				}else{				
					print $_FIQUE_ATENTO_A_LIVE;
				}			
			}
		 }
		 return $x;
	}				

/*------------------------------------------------------------------------------------------ */
/* ----------------- [ TESTA CADASTROS // EVITA DUPLICIDADE ] ------------------------------ */
/* ----------------- [ CADASTROS REALIZADO PELO USUÁRIO APENAS ] --------------------------- */
/*------------------------------------------------------------------------------------------ */
	
		function testaCadastro(){
			global $sec_NomeGoogle,$sec_JogoEscolhido,$sec_NickName,$_EITA_CALMA_AI_VEI,$nomeArquivoArmazem;
			$file = new SplFileObject($nomeArquivoArmazem);
			$str = '';
			$i = 0;
			while (!$file->eof()) {	
				if($i > 0){
					$registro = $file->fgets();
					$retornandoRegistros = explode("%%@@",$registro); 
					
					if (($retornandoRegistros[0] == $sec_NomeGoogle) && ($retornandoRegistros[4] == "ativo")){
					$_SESSION['cadastroEfetuado'] = "0¿ö";
					$str .= $this->tags('div','alert alert-warning');
						$str .=($_EITA_CALMA_AI_VEI.' :)');
					$str .= $this->tags('/div');	
					}else{
					$_SESSION['cadastroEfetuado'] = 1;				
					}
		
				}//if	
				$i++;
				$str .= $this->duasTags('/td',null,'/tr');
			}//while
			return $str;
		}
		
/*------------------------------------------------------------------------------------------ */
/* ----------------- [ MUDA STATUS LIVE ] ----------------------------------- */
/*------------------------------------------------------------------------------------------ */

		function mudaStatusLive($arq,$linha){
			global $sec_live,$producao,$ROTA;
			 $arquivo = file($arq);
			 $y = $linha - 1;
			 $x =  "<b>".$arquivo[$y]."</b>";
		 	file_put_contents($arq, str_replace($arquivo[$y], '$statusLive = '.$sec_live.';'."\n", file_get_contents($arq)));
			if($producao == 0){
			 	@header("Location:$ROTA/default.php?idioma=$_SESSION[idioma]");
			 }else{			 	
			 	@header("Location:$ROTA/default.php?idioma=$_SESSION[idioma]");
			 }		 	
		 return $x;
		}	
			
/*------------------------------------------------------------------------------------------ */
/* ----------------- [ MUDA JOGO ATUAL ] ----------------------------------- */
/*------------------------------------------------------------------------------------------ */

		function mudaJogandoAgora($arq,$linha){
			global $sec_trocaJogo,$producao,$ROTA;
			 $arquivo = file($arq);
			 $y = $linha - 1;
			 $x =  "<b>".$arquivo[$y]."</b>";
		 	file_put_contents($arq, str_replace($arquivo[$y], '$jogoAtivoAgora = '.$sec_trocaJogo.';'."\n", file_get_contents($arq)));
			if($producao == 0){
			
				@header("Location: $ROTA/default.php");
			}else{
				@header("Location: $ROTA/default.php?idioma=$_SESSION[idioma]");
			}
		 	
		 return $x;
		}
		
/*------------------------------------------------------------------------------------------ */
/* ----------------- [ MONTA FINAL DA PÁGINA ] ----------------------------------- */
/*------------------------------------------------------------------------------------------ */
	
	function finalPagina(){	
		global $ADS,$_PEGUE_SEU_AGORA,$creditosFooter,$tokenSite,$estatistica,$TotalRegistrosAcesso;
			$fim = '';
			$fim .= $this->duasTags('div','col-sm-2 sidenav','div','well');
		    //$fim .=('<a href="'.$linkBanner1.'" title="'.$_PEGUE_SEU_AGORA.'" target="_blank"><img class="img-responsive" src="imagens/banners/'.$imgBanner1.'"></a>');
		    $fim .= $ADS->rotateBanners();
			$fim .= $this->duasTags('/div',NULL,'div','well');
		    $fim .= $ADS->MostraAds250x250();
			//$fim .= $ADS->ADsResponsivoTextual();
		    $fim .= $this->tags('/div',NULL,4);		    
			$fim .= $this->duasTags('footer','container-fluid text-center','p');
		  	$fim .= $creditosFooter;
		  	$fim .= $this->tags('b','alert alert-default');
		  	$fim .= 'Owpoga';
		  	$fim .= $this->tags('/b');
		  	$fim .= 'Trade Mark ® WebDevelopment, Games and More!';
		  	$fim .= $this->tags('/p');
		  	$fim .= $this->tags('p');
			
			$fim .= $estatistica->exibeDados('contador.katworma.php','.default.php');
			$fim .= $estatistica->acessototais('velocimetro.katworma.php');
			
			$fim .= $estatistica->eliminaLixo('estatisticas'.$GLOBALS['tokenSite'].'/');
			
			//$fim .= ('estatisticas'.$GLOBALS['tokenSite'].'/');
		  	$fim .= $TotalRegistrosAcesso;
		  	$fim .= $this->tags('/p');
			$fim .= $this->tags('/footer');
			$fim .=' <script src="js/clipboard.min.js"></script>
			    <!-- 3. Instantiate clipboard -->
			    <script>
			    var clipboard = new Clipboard(\'.btn\');
			
			    clipboard.on(\'success\', function(e) {
			        console.log(e);
			    });
			
			    clipboard.on(\'error\', function(e) {
			        console.log(e);
			    });
			    </script>';
		return $fim;
	}	
			
/*------------------------------------------------------------------------------------------ */
/* ------------------------- [ RECURSOS HTML ] --------------------------------------------- */
/*------------------------------------------------------------------------------------------ */
	
	function meta($recurso){
		$str = '';
			$str .= "\t".'<'.$recurso.'>'."\n";
		return $str;
	}	
	
/*------------------------------------------------------------------------------------------ */
/*------------------------------------------------------------------------------------------ */
	
	function tags($recurso,$class='',$quantidade='1',$atributos=NULL){
		$str = '';
	if(($recurso{0} == "/")||(($recurso == "BR")||($recurso == "br"))){
		//$str .= 'tem algo aqui';
		$classe = NULL;		
	}else{
		$classe = ' class="'.$class.'"';
	}
		for($i=0;$i<$quantidade;$i++){
			$str .= "\n\t".'<'.$recurso.''.$classe.''.$atributos.'>';
		}
		return $str;
	}
	
/*------------------------------------------------------------------------------------------ */
/*------------------------------------------------------------------------------------------ */
	
	function duasTags($recurso1,$class1=NULL,$recurso2,$class2=NULL,$exibeConteudo=NULL){
		$str = '';		
	if($recurso1{0} == "/"){	
		$classe1 = NULL;		
	}else{
		$classe1 = ' class="'.$class1.'"';
	}		
	if($recurso2{0} == "/"){	
		$classe2 = NULL;		
	}else{
		$classe2 = ' class="'.$class2.'"';
	}
	
		$str .= "\n\t".'<'.$recurso1.''.$classe1.'>';
		$str .= $exibeConteudo;
		$str .= "\n\t".'<'.$recurso2.''.$classe2.'>'."\n\t\t";		
		return $str;
	}
	
/*------------------------------------------------------------------------------------------ */
/*------------------------------------------------------------------------------------------ */

	function janelaModal($Id_inscricoesAbertas,$TituloModal,$conteudo,$glyIconUsado=NULL){
	global $_FECHAR;
			$str = '';
			$str .=$this->tags('div','modal fade','1', 'id="'.$Id_inscricoesAbertas.'"');
			$str .=$this->tags('div','modal-dialog');
			$str .=$this->tags('div','modal-content');
			$str .=$this->tags('div','modal-header');
			$str .=('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>');
			$str .=$this->tags('h4','modal-title');
			$str .=$this->tags('span','glyphicon '.$glyIconUsado.'');
			$str .=$this->tags('/span');
			$str .=	'&nbsp;'.$TituloModal;
			$str .=$this->tags('/h4');
			$str .=$this->tags('/div');
			$str .=$this->tags('div','modal-body text-left');
			$str .= $conteudo;
			$str .=$this->tags('/div');
			$str .=$this->tags('div','modal-footer');
			$str .=$this->tags('button','btn btn-default',1,'type="button" data-dismiss="modal"');
			$str .= $_FECHAR.'&nbsp;&nbsp;';
			$str .=$this->tags('span','glyphicon glyphicon-remove-circle');
			$str .= $this->tags('/button');
			$str .=$this->tags('/div',NULL,4);

			return $str;
			unset($str);
	}
/*------------------------------------------------------------------------------------------ */
/*------------------------------------------------------------------------------------------ */
	function generateRandomString($length = 3, $letters = '1234567890qwertyuioApBaCsKdYfNghGjPklzxcvbnm') 
	  { 
	      $s = ''; 
	      $lettersLength = strlen($letters)-1; 
	      
	      for($i = 0 ; $i < $length ; $i++) 
	      { 
	      $s .= $letters[rand(0,$lettersLength)]; 
	      } 
	      
	      return $s; 
	  }
/*------------------------------------------------------------------------------------------ */
/*------------------------------------------------------------------------------------------ */

	public function replace_lines($file, $new_lines, $source_file = NULL) {
	        $response = 0;
	        //characters
	        $tab = chr(9);
	        $lbreak = chr(13) . chr(10);
	        //get lines into an array
	        if ($source_file) {
	            $lines = file($source_file);
	        }
	        else {
	            $lines = file($file);
	        }
	        //change the lines (array starts from 0 - so minus 1 to get correct line)
	        foreach ($new_lines as $key => $value) {
	            $lines[--$key] = $tab . $value . $lbreak;
	        }
	        //implode the array into one string and write into that file
	        $new_content = implode('', $lines);
	 
	        if ($h = fopen($file, 'w')) {
	            if (fwrite($h, $new_content)) {
	                $response = 1;
	            }
	            fclose($h);
	        }
	        return $response;
	    }
/*------------------------------------------------------------------------------------------ */
/*------------------------------------------------------------------------------------------ */
 }//classe
?>