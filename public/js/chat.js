$(document).ready(function(){
	var url = 'indexAjax.php?req=chat';
	var refresh = setInterval(getMessages, 2000);

	$('#chat-form').on('submit', function(e){
		e.preventDefault();
		clearInterval(refresh);

		text_chat = $('#chat-form input[name="text_chat"]').val();
		if(text_chat.length > 0 && text_chat.length <= 255){		
			$.post(url,{req:"chat", action:"addMessage", text_chat: text_chat}, function(response){	
				refresh = setInterval(getMessages, 2000);
				getMessages();
			});
		} else {
			refresh = setInterval(getMessages, 2000);
		}
	});
	
	function getMessages(){
		$.post(url,{req:"chat", action:"getMessages"}, function(response){
			$('#chat-container').html(response);
		});
	};

});
