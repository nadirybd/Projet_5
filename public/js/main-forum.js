var tbBody;
var tbArraw;

function tableToogle(tableBody, tableArraw){
	tbBody = $(tableBody);
	tbArraw = $(tableArraw)

	if(tbBody.css('display') === "block"){
		tbBody.fadeOut();
		tbArraw.css('transform', 'rotate(-180deg)');	
	} else {
		tbBody.fadeIn();
		tbArraw.css('transform', 'rotate(360deg)');	
	}	
};

$('#tb-last-topics thead').on('click', function(){
	tableToogle('#tb-last-topics tbody', '#tb-last-topics .fa-caret-up');
});

$('#tb-last-posts thead').on('click', function(){
	tableToogle('#tb-last-posts tbody', '#tb-last-posts .fa-caret-up');
});