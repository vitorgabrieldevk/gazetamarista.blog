$(function() {
	// Remove o botão
	$(".button-group button[name='submitcontinuar']").parent('li').remove();
	$(".button-group li").first().remove();
});