<?php include("header.php"); ?>
<?php
if (!isset($_GET['id']))
	$_GET['id'] = false;
	
$atendimentos = getJason('http://api.ima.sp.gov.br/v1/protocolo/', $_GET['id']);

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
            <li class="list-group-item active"><label>Assunto: </label><a href="/protocolo.php?id=<?php echo $atendimento->id; ?>" title="Assunto: <?php echo $atendimento->descricaoAssunto; ?>" tabindex="<?php echo $cont++?>"><?php echo $atendimento->descricaoAssunto; ?></a><span class="badge"><span title="<?php echo $atendimento->id; ?>" tabindex="<?php //echo $cont++?>"><?php echo $atendimento->id; ?> </span></span></li>
            <?php if($_GET["id"]) {?>
            <li class="list-group-item"><label>Nome do Bairro</label> <span title="Nome do Bairro: <?php echo $atendimento->nomeBairro; ?>" tabindex="<?php echo $cont++?>"><?php echo $atendimento->nomeBairro; ?></span></li>
            <li class="list-group-item"><label>Secretaria Expediente</label> <span title="Secretaria Expediente: <?php echo $atendimento->secretariaExpediente; ?>" tabindex="<?php echo $cont++?>"><?php echo $atendimento->secretariaExpediente; ?></span></li>
            <li class="list-group-item"><label>Sigla Expediente</label> <span title="Sigla Expediente: <?php echo $atendimento->siglaExpediente; ?>" tabindex="<?php echo $cont++?>"><?php echo $atendimento->siglaExpediente; ?></span></li>
            <li class="list-group-item"><label>Nome da Região</label> <span title="Nome da Região: <?php echo $atendimento->nomeRegiao; ?>" tabindex="<?php echo $cont++?>"><?php echo $atendimento->nomeRegiao; ?></span></li>
            <li class="list-group-item"><label>Ano Processo</label> <span title="Ano Processo: <?php echo $atendimento->anoProcesso; ?>" tabindex="<?php echo $cont++?>"><?php echo $atendimento->anoProcesso; ?></span></li>
            <li class="list-group-item"><label>Ponto Cadastrado</label> <span title="Ponto Cadastrado: <?php echo $atendimento->nomePontoCadastramento; ?>" tabindex="<?php echo $cont++?>"><?php echo $atendimento->nomePontoCadastramento; ?></span></li>
            <li class="list-group-item"><label>Data Cadastro</label> <span title="Data Cadastro: <?php if($atendimento->dataCadastro) echo date("d/m/Y", strtotime($atendimento->dataCadastro)); ?>" tabindex="<?php echo $cont++?>"><?php if($atendimento->dataCadastro) echo date("d/m/Y", strtotime($atendimento->dataCadastro)); ?></span></li>
            <li class="list-group-item"><label>Data Atendimento</label> <span title="Data Atendimento: <?php if($atendimento->dataAtendimento) echo date("d/m/Y", strtotime($atendimento->dataAtendimento)); ?>" tabindex="<?php echo $cont++?>"><?php if($atendimento->dataAtendimento) echo date("d/m/Y", strtotime($atendimento->dataAtendimento)); ?></span></li>
            <li class="list-group-item"><label>Data Cancelamento</label> <span title="Data Cancelamento: <?php if($atendimento->dataCancelamento) echo date("d/m/Y", strtotime($atendimento->dataCancelamento)); ?>" tabindex="<?php echo $cont++?>"><?php if($atendimento->dataCancelamento) echo date("d/m/Y", strtotime($atendimento->dataCancelamento)); ?></span></li>
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
				echo "ler('Você está em protocolo.'); setPergunta('q3');";
			}
		?>
		startButton(event);
	}, 3000);
});
</script>
<?php include("footer.php"); ?>