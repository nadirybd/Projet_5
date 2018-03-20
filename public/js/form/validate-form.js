var ValidateForm = {
	mail: function(mail, mailConfirm){
		if(mail !== null && mail !== undefined){
			mail.addEventListener('blur', function(e){
				var mailValue = mail.value;
				var regexMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			
				if(regexMail.test(mailValue.toLowerCase()) === false){
					mail.style.borderColor = "rgba(255, 0, 0, 0.5)";
				} else {
					mail.style.borderColor = "rgba(0, 255, 0, 0.5)";
				}
			});
		}
		if(mailConfirm !== null && mailConfirm !== undefined && mail !== null && mail !== undefined){
			mailConfirm.addEventListener('blur', function(e){
				var confirmMailValue = mailConfirm.value;
				var regexMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				
				if(regexMail.test(confirmMailValue.toLowerCase()) === false || confirmMailValue !== subMail.value){
					mailConfirm.style.borderColor = "rgba(255, 0, 0, 0.5)";
				} else {
					mailConfirm.style.borderColor = "rgba(0, 255, 0, 0.5)";
				}
			});
		}
	},
}