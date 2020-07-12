<?php
extract($_REQUEST, EXTR_PREFIX_ALL|EXTR_REFS, 'sec');
print('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />');
print('<title>Conferencia de dados avaliação</title>');
print('<b>Confira os dados antes de salvar na base de dados:</b><br/><br/>');

if(isset($sec_enviaPontuacao)){
	//	print "recebendo dados corretamente<br/>";
}
if(isset($sec_valorControle)){
		$str = '';
		$str .= $RM->duasTags('div','clearfix','/div');
		$str .= $RM->tagsHtml('div','row');
		$str .= $RM->tagsHtml('div','col-md-4 col-sm-4 col-xs-4');
		$str .= 'CPF: <b>'.$sec_can_cpf.'</b><br/>';
		$str .= $RM->tagsHtml('/div',NULL,1);
		$str .= $RM->tagsHtml('div','col-md-4 col-sm-4 col-xs-4');
		$str .= 'Atividade: <b>'.$sec_atividade.'</b><br/>';
		$str .= $RM->tagsHtml('/div',NULL,1);
		$str .= $RM->tagsHtml('div','col-md-4 col-sm-4 col-xs-4');
		$str .= $RM->tagsHtml('/div',NULL,1);
		$str .= 'Avaliador: <b>'.$sec_avaliador.'</b><br/>';
		$str .= $RM->tagsHtml('div','col-md-4');
		$str .= '<b>Resultado da avaliação</b>:<br/>';
		$str .= $RM->tagsHtml('/div',NULL,1);
		print $str;
		print $RM->tagsHtml('div','col-md-8');
$i = 1;
$strAnterior = '';
foreach($sec_valorControle as $numero)
    {
        $tratamento = 'sec_resposta'.$numero;
        $meuteste =  $tratamento;
		$questao = 'Questão '.$i;

		//print $questao.'&nbsp;{ '.$meuteste.' : } ';
		if($$meuteste == ""){
			print ('alternativa não preenchida corretamente' . $numero);
			exit('Não é possível cadastrar sem os valores corretos.');
		}
		if($$meuteste == 'nao'){
			$obs = ' Avaliador reprovou documentação para este ítem.';
		}else{
			$obs = NULL;
		}
		$stringSalvar = $$meuteste.'#'.$numero.'@';
		print '<b>'.$$meuteste.' - '.$numero.'</b> '.$obs.'<br/>';
		if($stringSalvar !=  $strAnterior){
			$strCompleta = $strCompleta.$stringSalvar;
		}
			$strAnterior = $stringSalvar;
		$i++;
    }
		print $RM->tagsHtml('/div',NULL,1);
		print $RM->tagsHtml('div','col-md-12');
 	   	print '<b>Resultado da avaliação</b>: <br/>{'.$strCompleta .'}';
		print $RM->tagsHtml('/div',NULL,1);
}else{
    echo "Erro de carreamento de valores!<br>";
}


 	$str = '';
 	$str .= '<br/><br/>';
 	$str .= 'Devemos, antes de inserir na base de dados, realizar uma consulta para verificar se não existe o registro<br/>';
 	$str .= 'para o mesmo usuário (<b>'.$sec_can_cpf.'</b>) e mesma atividade (<b>'.$sec_atividade.'</b>.)<br/>';
 	$str .= '<ul><li>';
 	$str .= 'Caso exista, vamos exibir?';
 	$str .= '</li><li>';
 	$str .= 'Será permitodo editar?';
 	$str .= '</li><li>';
 	$str .= 'Um mesmo candidato pode possuir mais de um registros em diferentes atividades?';
 	$str .= '</li><li>';
 	$str .= 'A tabela é acumulativa?'; 
 	$str .= '</li><li>';
 	$str .= 'Isto é, será usada todos os anos guardando os valores registrados?';
 	$str .= '</li></ul>';
 	$str .= $RM->tagsHtml('br',NULL,1);
 	//$str .= 'https://www.resmedceara.ufc.br/dashboard/index.php?modulo=Processamento2017&pag=avaliacao_correcao_uploads_ma';
 	//print $str;
 	unset($str);
 	
/* --------------------------------------------------------------------------------- */
/*  TRAZER OS NOMES DAS IMAGENS  */
/* --------------------------------------------------------------------------------- */
 	$sql_arquivos = "SELECT *  
 	FROM `atividade_arquivos` 
 	WHERE `id_atividade` = ".$sec_atividade." AND 
 	`can_cpf` 
 	LIKE '".$sec_can_cpf."' LIMIT 2";
 	$sql_at_arquivos = mysql_query($sql_arquivos);
 	$row_cnt = mysql_num_rows($sql_at_arquivos);
	$imgs = "";
 	while($row = mysql_fetch_array($sql_at_arquivos)){
		//while($rows = mysql_fetch_assoc($sql_at_arquivos)) {									
			$html_arquivo .= 	trim($rows['arquivo']); 
			$imgs .= "'".trim($row[arquivo])."',"; 								
			$img2 .= trim($row[arquivo])."#"; 								
		}
		print $RM->tagsHtml('div','col-md-10');
		print '<br/><br/>'.$img2.'<br/><br/>';
		$imagem1 = explode('#',$img2);
		//print $imagem1[0].'<br/>';	
		//print $imagem1[1];	
		$imgs = substr($imgs,0,-1);
		print '<br/><b>Nomes dos arquivos avaliados</b>: <br/>'.$imgs.'<br/>';
		print $RM->tagsHtml('img src="'.$linkPathDirUpload.$imagem1[0].'"','responsive',1,' width="100px;" height="100px;"');	
		if($imagem1[1] != ""){			
			print $RM->tagsHtml('img src="'.$linkPathDirUpload.$imagem1[1].'"','responsive',1,' width="100px;" height="100px;"');	
		}

/* --------------------------------------------------------------------------------- */
 
 	$dataFormacaoRecebida = $sec_can_dataGraduacao;
 	$dataCertificadoRecebida = $sec_can_dataCertificado;
 	$descricaoRecebida = $sec_can_descricao;
 	$nomeCandidatoRecebido = $sec_can_nome;
 	$str .= $RM->tagsHtml('br',null,2);
 	
 	$str .= '(\''.$nomeCandidatoRecebido.'\', 
 	\''. $dataFormacaoRecebida.'\', 
 	\''. $dataCertificadoRecebida.'\', 
 	\''.$descricaoRecebida.'\',  
 	\''.$sec_can_cpf.'\', 
 	\''.$arquivos['id_video'].'\', 
 	'.$imgs.')"';
 	
/* --------------------------------------------------------------------------------- */
/* --- [ BOTÕES] --- */
/* --------------------------------------------------------------------------------- */
 	
/* --- [ VOLTAR / CANCELAR] --- */

 	//$str .= $RM->tagsHtml('a','btn btn-default',1, 'onclick="modalVideo(\''.$arquivos['can_nome'].'\', \''. $RM->trataDatasExibir($arquivos['can_data_formacao']).'\', \''. $RM->trataDatasExibir($arquivos['data_doc']).'\', \''.$arquivos['descricao'].'\',  \''.$arquivos['can_cpf'].'\', \''.$arquivos['id_video'].'\', '.$imgs.')" data-toggle="tooltip" data-placement="bottom" data-original-title="Visualizar Certificado"');
 	$str .= $RM->tagsHtml('a','btn btn-default',1, 'onclick="modalVideo(\''.$nomeCandidatoRecebido.'\', \''. $dataFormacaoRecebida.'\', \''. $dataCertificadoRecebida.'\', \''.$descricaoRecebida.'\',  \''.$sec_can_cpf.'\', \''.$arquivos['id_video'].'\', '.$imgs.')" data-toggle="tooltip" data-placement="bottom" data-original-title="Visualizar Certificado"');
 	$str .= $RM->duasTags('span','glyphicon glyphicon-picture','/span');
	$str .= $RM->tagsHtml('/a');
	$str .= $RM->tagsHtml('br/',NULL,4);
 	$str .= $RM->tagsHtml('a','btn btn-default',1, 'href="https://www.resmedceara.ufc.br/dashboard/index.php?modulo=Processamento2017&pag=avaliacao_correcao_uploads_ma"');
 	$str .= $RM->duasTags('span','glyphicon glyphicon-step-backward','/span');
	$str .= ' Cancelar / Voltar ';
	$str .= $RM->tagsHtml('/a');
 	
/* --- [ SALVAR / CONCLUIR] --- */

 	$str .= $RM->tagsHtml('a','btn btn-success',1, 'href="https://www.resmedceara.ufc.br/dashboard/index.php?modulo=Processamento2017&pag=avaliacao_correcao_uploads_ma"');
 	$str .= $RM->duasTags('span','glyphicon glyphicon-save','/span');
	$str .= ' Finalizar / Salvar ';
	$str .= $RM->tagsHtml('/a');
 	
 	print $str;
	
	unset($str,$stringSalvar,$meuteste,$obs,$questao,$sec_atividade,$sec_avaliador,$sec_can_cpf,$sec_valorControle,$tratamento);
?>