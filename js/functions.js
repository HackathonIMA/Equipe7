var qCheck = false;
var checkQuest = false;
var oldQuest = false;
var auxold = null;
var perguntas = null;
	
var msg = new SpeechSynthesisUtterance();
speechSynthesis.getVoices()[15];
//setTimeout(function(){
msg.voice = speechSynthesis.getVoices()[15];
msg.voiceURI = 'Google português do Brasil';
msg.volume = 1; // 0 to 1
msg.lang = 'pt-BR';
//}, 10000);

function ler(txt, callback){
	msg.text = txt;
	speechSynthesis.speak(msg);
}
jQuery(document).ready(function() {
	jQuery(window).keyup(function(e){
		if(e.keyCode == 9) {
			ler(document.activeElement.title);
		}
	});
});
function setPergunta(ind){
	
	if(!oldQuest)
		oldQuest = 'q1'
	else
		oldQuest = auxold;
	
	auxold = ind;
	
	if(!auxold)
		auxold = oldQuest
		
	qCheck = getQst(ind);
	ler(qCheck.pergunta);
	aux = ind
}

function getQst(qts){
	
	jQuery.ajax({
		dataType: "json",
		async: false,
		url: 'perguntas.php',
		type: "POST",
		data: 'qst=' + qts,
		success: function(data){
			perguntas = data;
		}
	});
return perguntas;
}