$(function() {
	/*
	 * ********* Facilidades **********
	 */

	// Função para reordenar itens
	$(".list-facilidades").sortable({
		opacity: 0.6,
		cursor: 'move',
		update: function() {
			// Ids
			var id = $("#idbase").val();

			// Converter os IDs em array
			var order = $(this).sortable("toArray");

			// Type
			var type = $(this).data('type');

			// Mandando um POST para o webservice com a nova ordem
			$.ajax({
				url		: document.basePath + "/admin/bases/salvaordem",
				type	: 'POST',
				data	: {'type': type, 'id': id, 'objOrdem': order},
				success: function() {
					// ok

					// Percorre os itens e ajusta ordem dos novos
					var contador = 1;
					$.each(order, function (key, value) {
						// Se for new
						if(value.substr(0, 3) == 'new') {
							// Atualiza input hidden order
							$('div#'+value).find('input[name="new_facilidades_order[]"]').val(contador);
						}
						contador++;
					});
				},
				error: function() {
					swal('Erro!', 'Ocorreu um erro, tente novamente!', 'error');
					return false;
				}
			});
		}
	});

	// Adiciona o evento de adicionar à lista
	$('a.btn-add-facilidade').on('click', function(e) {
		// Cancela o click do anchor
		e.preventDefault();

		// Busca as informações
		var input_facilidade 	= $('#input_facilidade').val();
		var input_facilidade_en = $('#input_facilidade_en').val();
		var input_facilidade_es = $('#input_facilidade_es').val();

		if(!!input_facilidade) {
			var existe_termo = 0;
			if(!!input_facilidade) {
				existe_termo = $('.list-facilidades span').filter(function(){ return $(this).text().replace('(PT) ', '') === input_facilidade });
			}
			var existe_termo_en = 0;
			if(!!input_facilidade_en) {
				existe_termo_en = $('.list-facilidades span').filter(function(){ return $(this).text().replace('(EN) ', '') === input_facilidade_en });
			}
			var existe_termo_es = 0;
			if(!!input_facilidade_es) {
				existe_termo_es = $('.list-facilidades span').filter(function(){ return $(this).text().replace('(ES) ', '') === input_facilidade_es });
			}

			if(existe_termo.length > 0 || existe_termo_en.length > 0 || existe_termo_es.length > 0) {
				// Existe o item
				//$('#input_facilidade').val('');
				//$('#input_facilidade_en').val('');
				//$('#input_facilidade_es').val('');
				$('#input_facilidade').focus();
				swal('Ops!', 'Item já existente!', 'warning');
				return false;
			}else{
				if($('.no-facilidades').length > 0)
					$('.no-facilidades').remove();

				// Conta se possui novos itens
				var count_new = $('.list-facilidades.lista-simples div[id^="new00"]').length;
				var count_new_next = (count_new+1);

				// Cria os wrapper padrões
				var div_row 	= $('<div class="row item-container lista-simples-item" id="new00'+count_new_next+'"></div>');
				var hidden 		= $('<input type="hidden" name="new_facilidades[]" value="' + input_facilidade + '" form="form_admin">');
				var hidden_en 	= $('<input type="hidden" name="new_facilidades_en[]" value="' + input_facilidade_en + '" form="form_admin">');
				var hidden_es 	= $('<input type="hidden" name="new_facilidades_es[]" value="' + input_facilidade_es + '" form="form_admin">');
				var hidden2 	= $('<input type="hidden" name="new_facilidades_order[]" value="" form="form_admin">');
				var remove 		= $('<div class="small-2 medium-1 columns"><a href="' + document.basePath + '/admin/bases/deletaritem/" title="Excluir item" class="btn-remove-facilidade btn_excluir"></a></div>');
				var item 		= $('<div class="small-10 medium-11 columns">' +
					'<span class="titulo">(PT) ' + input_facilidade + '</span>' +
					'<span class="titulo">(EN) ' + input_facilidade_en + '</span>' +
					'<span class="titulo">(ES) ' + input_facilidade_es + '</span>' +
				'</div>');

				// Adiciona as divs
				div_row.append(remove);
				div_row.append(item);
				div_row.append(hidden);
				div_row.append(hidden_en);
				div_row.append(hidden_es);
				div_row.append(hidden2);

				$('.list-facilidades').append(div_row);

				// Limpa o input
				$('#input_facilidade').val('');
				$('#input_facilidade_en').val('');
				$('#input_facilidade_es').val('');
				$('#input_facilidade').focus();
			}
		}else{
			swal('Ops!', 'Informe o item para adicionar.', 'error');
            return false;
		}
	});

	// Evento que remove os itens
	$('.list-facilidades').on('click', 'a.btn-remove-facilidade', function(e) {
		if(!confirm('Deseja remover este item?')) {
			return false;
		}else{
			e.preventDefault();

			// Armazena as informações
			var anchor = $(this);

			// Faz a requisição à exclusão
			$.ajax({
				url: anchor.attr('href'),
				type: 'POST',
				success: function(data) {
					anchor.closest('.item-container').fadeOut(function() {
						$(this).remove();
						if($('.item-container').length == 0)
							$('.itens').append('<div class="small-12 columns no-facilidades"><p>(nenhum item cadastrado)</p></div>');
					});
				}
			});
		}
	});

	/*
	 * ********* Serviços **********
	 */

	// Função para reordenar itens
	$(".list-servicos").sortable({
		opacity: 0.6,
		cursor: 'move',
		update: function() {
			// Ids
			var id = $("#idbase").val();

			// Converter os IDs em array
			var order = $(this).sortable("toArray");

			// Type
			var type = $(this).data('type');

			// Mandando um POST para o webservice com a nova ordem
			$.ajax({
				url		: document.basePath + "/admin/bases/salvaordem",
				type	: 'POST',
				data	: {'type': type, 'id': id, 'objOrdem': order},
				success: function() {
					// ok

					// Percorre os itens e ajusta ordem dos novos
					var contador = 1;
					$.each(order, function (key, value) {
						// Se for new
						if(value.substr(0, 3) == 'new') {
							// Atualiza input hidden order
							$('div#'+value).find('input[name="new_servicos_order[]"]').val(contador);
						}
						contador++;
					});
				},
				error: function() {
					swal('Erro!', 'Ocorreu um erro, tente novamente!', 'error');
					return false;
				}
			});
		}
	});

	// Adiciona o evento de adicionar à lista
	$('a.btn-add-servico').on('click', function(e) {
		// Cancela o click do anchor
		e.preventDefault();

		// Busca as informações
		var input_servico 	 = $('#input_servico').val();
		var input_servico_en = $('#input_servico_en').val();
		var input_servico_es = $('#input_servico_es').val();

		if(!!input_servico) {
			var existe_termo = 0;
			if(!!input_servico) {
				existe_termo = $('.list-servicos span').filter(function(){ return $(this).text().replace('(PT) ', '') === input_servico });
			}
			var existe_termo_en = 0;
			if(!!input_servico_en) {
				existe_termo_en = $('.list-servicos span').filter(function(){ return $(this).text().replace('(EN) ', '') === input_servico_en });
			}
			var existe_termo_es = 0;
			if(!!input_servico_es) {
				existe_termo_es = $('.list-servicos span').filter(function(){ return $(this).text().replace('(ES) ', '') === input_servico_es });
			}

			if(existe_termo.length > 0 || existe_termo_en.length > 0 || existe_termo_es.length > 0) {
				// Existe o item
				//$('#input_servico').val('');
				//$('#input_servico_en').val('');
				//$('#input_servico_es').val('');
				$('#input_servico').focus();
				swal('Ops!', 'Item já existente!', 'warning');
				return false;
			}else{
				if($('.no-servicos').length > 0)
					$('.no-servicos').remove();

				// Conta se possui novos itens
				var count_new = $('.list-servicos.lista-simples div[id^="new00"]').length;
				var count_new_next = (count_new+1);

				// Cria os wrapper padrões
				var div_row 	= $('<div class="row item-container lista-simples-item" id="new00'+count_new_next+'"></div>');
				var hidden 		= $('<input type="hidden" name="new_servicos[]" value="' + input_servico + '" form="form_admin">');
				var hidden_en 	= $('<input type="hidden" name="new_servicos_en[]" value="' + input_servico_en + '" form="form_admin">');
				var hidden_es 	= $('<input type="hidden" name="new_servicos_es[]" value="' + input_servico_es + '" form="form_admin">');
				var hidden2 	= $('<input type="hidden" name="new_servicos_order[]" value="" form="form_admin">');
				var remove 		= $('<div class="small-2 medium-1 columns"><a href="' + document.basePath + '/admin/bases/deletaritem/" title="Excluir item" class="btn-remove-servico btn_excluir"></a></div>');
				var item 		= $('<div class="small-10 medium-11 columns">' +
					'<span class="titulo">(PT) ' + input_servico + '</span>' +
					'<span class="titulo">(EN) ' + input_servico_en + '</span>' +
					'<span class="titulo">(ES) ' + input_servico_es + '</span>' +
				'</div>');

				// Adiciona as divs
				div_row.append(remove);
				div_row.append(item);
				div_row.append(hidden);
				div_row.append(hidden_en);
				div_row.append(hidden_es);
				div_row.append(hidden2);

				$('.list-servicos').append(div_row);

				// Limpa o input
				$('#input_servico').val('');
				$('#input_servico_en').val('');
				$('#input_servico_es').val('');
				$('#input_servico').focus();
			}
		}else{
			swal('Ops!', 'Informe o item para adicionar.', 'error');
            return false;
		}
	});

	// Evento que remove os itens
	$('.list-servicos').on('click', 'a.btn-remove-servico', function(e) {
		if(!confirm('Deseja remover este item?')) {
			return false;
		}else{
			e.preventDefault();

			// Armazena as informações
			var anchor = $(this);

			// Faz a requisição à exclusão
			$.ajax({
				url: anchor.attr('href'),
				type: 'POST',
				success: function(data) {
					anchor.closest('.item-container').fadeOut(function() {
						$(this).remove();
						if($('.item-container').length == 0)
							$('.itens').append('<div class="small-12 columns no-servicos"><p>(nenhum item cadastrado)</p></div>');
					});
				}
			});
		}
	});
});