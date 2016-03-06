<?php
$qst = $_POST["qst"];

$pergustas = array(
	'q1' => '"pergunta": "Vamos começar?", "resposta": {"sim": "q2"}',
	'q2' => '"pergunta": "Escolha entre atendimento ou protocolo?", "resposta": {"atendimento": "link:atendimento.php", "protocolo": "link:protocolo.php"}',
	'q3' => '"pergunta": "Consultar por lista ou idê?", "resposta": {"lista": "focus:lista", "ID": "focus:id"}'
);

?>
{<?php echo $pergustas[$qst]; ?>}