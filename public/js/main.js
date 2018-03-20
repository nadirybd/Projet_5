var subMail = document.getElementById('mail');
var subMail_confirm = document.getElementById('confirm_mail');
var editMail = document.getElementById('edit_mail');
var sendMailTo = document.getElementById('to_mail');

ValidateForm.mail(subMail, subMail_confirm);
ValidateForm.mail(editMail);
ValidateForm.mail(sendMailTo);