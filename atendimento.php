<?php include("header.php"); ?>
<?php
if (!isset($_GET['id']))
	$_GET['id'] = false;
$atendimentos = getJason('http://api.ima.sp.gov.br/v1/atendimento/', $_GET['id']);

//var_dump($atendimentos);
?>
<div>
	<div>
        <div>
            <form class="form-inline" method="get">
                <div class="form-group">
                    <label for="busca">Qual o número do atendimento: </label>
                    <input type="text" id="busca" class="form-control" name="id"/>
                </div>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>
        <?php $cont = 29; foreach($atendimentos as $key => $atendimento) { ?>
        <ul id="lista<?php echo $cont++?>">
            <li class="list-group-item active">
            <a href="/atendimento.php?id=<?php echo $atendimento->id; ?>" title="Numero do Atendimento: <?php echo $atendimento->id; ?>" tabindex="<?php echo $cont++?>">
                <label>Numero do Atendimento:</label>
                <span class="badge"> <?php echo $atendimento->id; ?> </span>
            </a>
            </li>
            <?php if($_GET["id"]) {?>
            <li class="list-group-item"><label>Nome Regional:</label> <span title="Nome Regional: <?php echo $atendimento->nomeRegional; ?>"><?php echo $atendimento->nomeRegional; ?></span></li>
            <li class="list-group-item" ><label>Secretaria:</label> <span title="Secretaria <?php echo $atendimento->secretaria; ?>"><?php echo $atendimento->secretaria; ?></span></li>
            <li class="list-group-item"><label>Bairro:</label> <span title="Bairro <?php echo $atendimento->nomeBairro; ?>"><?php echo $atendimento->nomeBairro; ?></span></li>
            <li class="list-group-item"><label>Assunto:</label> <span title="Assunto <?php echo $atendimento->descricaoAssunto; ?>"><?php echo $atendimento->descricaoAssunto; ?></span></li>
            <li class="list-group-item"><label>Ano Solicitação:</label> <span title="Ano Solicitação <?php echo $atendimento->anoSolicitacao; ?>"><?php echo $atendimento->anoSolicitacao; ?></span></li>
            <li class="list-group-item"><label>Tipo Solicitação:</label> <span title="Tipo Solicitação <?php echo $atendimento->descricaoTipoSolicitacao; ?>"><?php echo $atendimento->descricaoTipoSolicitacao; ?></span></li>
            <li class="list-group-item"><label>Status:</label> <span title="Status <?php echo $atendimento->descricaoStatus; ?>"><?php echo $atendimento->descricaoStatus; ?></span></li>
            <li class="list-group-item"><label>Data Cadastro:</label> <span title="Data Cadastro <?php echo $atendimento->dataCadastro; ?>"><?php echo $atendimento->dataCadastro; ?></span></li>
            <li class="list-group-item"><label>Data Previsão:</label> <span title="Data Previsão <?php echo $atendimento->dataPrevisaoResposta; ?>"><?php echo $atendimento->dataPrevisaoResposta; ?></span></li>
            <li class="list-group-item"><label>Data Atendimento:</label> <span title="Data Atendimento <?php echo $atendimento->dataAtendimento; ?>"><?php echo $atendimento->dataAtendimento; ?></span></li>
            <li class="list-group-item"><label>Data Conclusão:</label> <span title="Data Conclusão <?php echo $atendimento->dataConclusao; ?>"><?php echo $atendimento->dataConclusao; ?></span></li>
            <?php } ?>

        </ul>	
        <?php } ?>
        
        <button id="btnBuscarMais" class="btn btn-primary hide" ng-click="buscarMais()">BUSCAR MAIS</button>
    </div>
</div>
<script>
$(document).ready(function() {
	setTimeout(function(){
		<?php
			if($_GET["id"] && $atendimento) { 
				echo "jQuery('#protocolo').select().focus();ler('Utilize tab para navegar.');";
			} else if(!$atendimento) {
				echo "jQuery('#busca').select().focus(); ler('ID não encontrado. Tente novamente');";
			} else { 
				echo "ler('Você está em atendimento.'); setPergunta('q3');";
			}
		?>
		startButton(event);
	}, 3000);
});
</script>
<?php include("footer.php"); ?>