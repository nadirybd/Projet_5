tinymce.init({
selector: '#mytextarea',
plugins: "wordcount",
addI18n: "fr_FR",
menubar: false,

}); 

tinymce.init({
selector: '#mytinymce',
plugins: "wordcount",
addI18n: "fr_FR",
menubar: false,

});

tinymce.addI18n('fr_FR',{
	"Redo": "Rétablir",
	"Undo": "Annuler",
	"Cut": "Couper",
	"Copy": "Copier",
	"Paste": "Coller",
	"Select all": "Tout sélectionner",
	"Headers": "Titres",
	"Header 1": "Titre 1",
	"Header 2": "Titre 2",
	"Header 3": "Titre 3",
	"Header 4": "Titre 4",
	"Header 5": "Titre 5",
	"Header 6": "Titre 6",
	"Headings": "En-têtes",
	"Heading 1": "En-tête 1",
	"Heading 2": "En-tête 2",
	"Heading 3": "En-tête 3",
	"Heading 4": "En-tête 4",
	"Heading 5": "En-tête 5",
	"Heading 6": "En-tête 6",
	"Inline": "En ligne",
	"Blocks": "Blocs",
	"Div": "Div",
	"Pre": "Pre",
	"Paragraph": "Paragraphe",
	"Blockquote": "Citation",
	"Bold" : "Gras",
	"Alignment": "Alignement",
	"Left" : "Gauche",
	"Center" : "Centrer",
	"Right" : "Droite",
	"Align left": "Aligner à gauche",
	"Align center": "Centrer",
	"Align right": "Aligner à droite",
	"Justify": "Justifier",
	"Decrease indent": "Diminuer le retrait",
	"Increase indent": "Augmenter le retrait",
	"Underline": "Souligné",
	"Strikethrough": "Barré",
	"Superscript": "Exposant",
	"Subscript": "Indice"
});