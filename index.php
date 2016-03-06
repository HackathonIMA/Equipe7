<?php
include("header.php");
include("footer.php");
?>
<script>
jQuery(document).ready(function() {
	setTimeout(function(){
		ler('Olá. Bem vindo ao ' + document.title + '.');
		setPergunta('q1');
		startButton(event);
	}, 3000);
});
</script>