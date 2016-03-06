var final_transcript = '';
var recognizing = false;
var ignore_onend;
var start_timestamp;

var recognition = new webkitSpeechRecognition();
recognition.continuous = true;
recognition.interimResults = true;

recognition.onstart = function() {
	recognizing = true;
	//showInfo('info_speak_now');
	//speech_img.src = 'imgs/speech.gif';
};

recognition.onerror = function(event) {
	
	if (event.error == 'no-speech') {
		ler('Erro no comando de voz!');
		//speech_img.src = 'imgs/speech.jpg';
		//showInfo('info_no_speech');
		ignore_onend = true;
	}
	
	if (event.error == 'audio-capture') {
		ler('Erro no comando de voz!');
		//speech_img.src = 'imgs/speech.jpg';
		//showInfo('info_no_microphone');
		ignore_onend = true;
	}
	
	if (event.error == 'not-allowed') {
		if (event.timeStamp - start_timestamp < 100) {
			//showInfo('info_blocked');
		} else {
			//showInfo('info_denied');
		}
		ignore_onend = true;
	}
};

recognition.onend = function() {
	recognizing = false;
	if (ignore_onend) {
		return;
	}
	//speech_img.src = 'imgs/speech.jpg';
	if (!final_transcript) {
		//showInfo('info_start');
		return;
	}
	//showInfo('');
	if (window.getSelection) {
		window.getSelection().removeAllRanges();
		var range = document.createRange();
		//range.selectNode(document.getElementById('final_span'));
		window.getSelection().addRange(range);
	}
};

recognition.onresult = function(event) {
	var interim_transcript = '';
	//var aux;
	for (var i = event.resultIndex; i < event.results.length; ++i) {
		final_transcript = '';
		if (event.results[i].isFinal) {
			final_transcript = event.results[i][0].transcript;
			if(qCheck) {
				if(final_transcript[0] ==  ' ')
					final_transcript = final_transcript.substr(1);
					switch(final_transcript) {
						case 'voltar':
							setPergunta(oldQuest);
							break;
							
						case 'inicial':
							setPergunta('q1');
							break;
						
						default:
							
							eval('var aux2 = qCheck.resposta.' + final_transcript.replace(" ", "_"));
							if(aux2){
								if(aux2.search("link") >= 0) {
									var url = aux2.replace("link:", "");
									location = '/' + url;
									break;
								} else if(aux2.search("focus") >= 0) {
									var selec = aux2.replace("focus:", "");
									switch(selec){
										case 'lista':
											jQuery('#protocolo').select().focus();
											ler('Utilize tab para navegar.');
											break;
										case 'id':
											jQuery('#busca').select().focus();
											ler('Digite o codigo do protocolo.');
											break;
									}
									
									break;
								}
							} else
								break;
							
							if(aux2)
								setPergunta(aux2);
							else {
								qCheck = false;
								ler('Resposta não válida.');
								setPergunta(auxold);
							}
							break;
					}
			}
		} else {
			interim_transcript += event.results[i][0].transcript;
		}
		
		final_transcript = capitalize(final_transcript);
		final_span.innerHTML = linebreak(final_transcript);
		interim_span.innerHTML = linebreak(interim_transcript);
	}
	//final_transcript = capitalize(final_transcript);
	//final_span.innerHTML = linebreak(final_transcript);
	//interim_span.innerHTML = linebreak(interim_transcript);
	
};

function startButton(event) {
	if (recognizing) {
		recognition.stop();
		return;
	}
	final_transcript = '';
	recognition.lang = 'pt-BR';
	recognition.start();
	ignore_onend = false;
	final_span.innerHTML = '';
	interim_span.innerHTML = '';
	//speech_img.src = 'imgs/speech-slash;jpg.jpg';
	start_timestamp = event.timeStamp;
}

var two_line = /\n\n/g;
var one_line = /\n/g;

function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}

var first_char = /\S/;

function capitalize(s) {
  return s.replace(first_char, function(m) { return m.toUpperCase(); });
}