$(function() {
	/*
	 * ********* Vantagens **********
	 */

	// Função para reordenar itens
	$(".list-vantagens").sortable({
		opacity: 0.6,
		cursor: 'move',
		update: function() {
			// Ids
			var id = $("#idaviao").val();

			// Converter os IDs em array
			var order = $(this).sortable("toArray");

			// Type
			var type = $(this).data('type');

			// Mandando um POST para o webservice com a nova ordem
			$.ajax({
				url		: document.basePath + "/admin/avioes/salvaordem",
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
							$('div#'+value).find('input[name="new_vantagens_order[]"]').val(contador);
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
	$('a.btn-add-vantagem').on('click', function(e) {
		// Cancela o click do anchor
		e.preventDefault();

		// Busca as informações
		var input_vantagem 			= $('#input_vantagem').val();
		var input_vantagem_texto 	= $('#input_vantagem_texto').val();
		var input_vantagem_en 		= $('#input_vantagem_en').val();
		var input_vantagem_texto_en = $('#input_vantagem_texto_en').val();
		var input_vantagem_es 		= $('#input_vantagem_es').val();
		var input_vantagem_texto_es = $('#input_vantagem_texto_es').val();

		if(!!input_vantagem) {
			var existe_termo = 0;
			if(!!input_vantagem) {
				existe_termo = $('.list-vantagens span').filter(function(){ return $(this).text().replace('(PT) ', '') === input_vantagem });
			}
			var existe_termo_en = 0;
			if(!!input_vantagem_en) {
				existe_termo_en = $('.list-vantagens span').filter(function(){ return $(this).text().replace('(EN) ', '') === input_vantagem_en });
			}
			var existe_termo_es = 0;
			if(!!input_vantagem_es) {
				existe_termo_es = $('.list-vantagens span').filter(function(){ return $(this).text().replace('(ES) ', '') === input_vantagem_es });
			}

			if(existe_termo.length > 0 || existe_termo_en.length > 0 || existe_termo_es.length > 0) {
				// Existe o item
				//$('#input_vantagem').val('');
				//$('#input_vantagem_texto').val('');
				//$('#input_vantagem_en').val('');
				//$('#input_vantagem_texto_en').val('');
				//$('#input_vantagem_es').val('');
				//$('#input_vantagem_texto_es').val('');
				$('#input_vantagem').focus();
				swal('Ops!', 'Item já existente!', 'warning');
				return false;
			}else{
				if($('.no-vantagens').length > 0)
					$('.no-vantagens').remove();

				// Conta se possui novos itens
				var count_new = $('.list-vantagens.lista-simples div[id^="new00"]').length;
				var count_new_next = (count_new+1);

				// Cria os wrapper padrões
				var div_row 	= $('<div class="row item-container lista-simples-item" id="new00'+count_new_next+'"></div>');
				var hidden 		= $('<input type="hidden" name="new_vantagens[]" value="' + input_vantagem + '" form="form_admin">');
				var hidden1		= $('<input type="hidden" name="new_vantagens_texto[]" value="' + input_vantagem_texto + '" form="form_admin">');
				var hidden_en 	= $('<input type="hidden" name="new_vantagens_en[]" value="' + input_vantagem_en + '" form="form_admin">');
				var hidden1_en	= $('<input type="hidden" name="new_vantagens_texto_en[]" value="' + input_vantagem_texto_en + '" form="form_admin">');
				var hidden_es 	= $('<input type="hidden" name="new_vantagens_es[]" value="' + input_vantagem_es + '" form="form_admin">');
				var hidden1_es	= $('<input type="hidden" name="new_vantagens_texto_es[]" value="' + input_vantagem_texto_es + '" form="form_admin">');
				var hidden2 	= $('<input type="hidden" name="new_vantagens_order[]" value="" form="form_admin">');
				var remove 		= $('<div class="small-2 medium-1 columns"><a href="' + document.basePath + '/admin/avioes/deletaritem/" title="Excluir item" class="btn-remove-vantagem btn_excluir"></a></div>');
				var item 		= $('<div class="small-10 medium-11 columns">' +
						'<span class="titulo">(PT) ' + input_vantagem + '</span><span class="descricao" style="padding-left:43px;">' + input_vantagem_texto + '</span>' +
						'<span class="titulo">(EN) ' + input_vantagem_en + '</span><span class="descricao" style="padding-left:43px;">' + input_vantagem_texto_en + '</span>' +
						'<span class="titulo">(ES) ' + input_vantagem_es + '</span><span class="descricao" style="padding-left:43px;">' + input_vantagem_texto_es + '</span>' +
					'</div>');

				// Adiciona as divs
				div_row.append(remove);
				div_row.append(item);
				div_row.append(hidden);
				div_row.append(hidden1);
				div_row.append(hidden_en);
				div_row.append(hidden1_en);
				div_row.append(hidden_es);
				div_row.append(hidden1_es);
				div_row.append(hidden2);

				$('.list-vantagens').append(div_row);

				// Limpa o input
				$('#input_vantagem').val('');
				$('#input_vantagem_texto').val('');
				$('#input_vantagem_en').val('');
				$('#input_vantagem_texto_en').val('');
				$('#input_vantagem_es').val('');
				$('#input_vantagem_texto_es').val('');
				$('#input_vantagem').focus();
			}
		}else{
			$('#input_vantagem').focus();
			swal('Ops!', 'Informe o item para adicionar.', 'error');
            return false;
		}
	});

	// Evento que remove os itens
	$('.list-vantagens').on('click', 'a.btn-remove-vantagem', function(e) {
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
							$('.itens').append('<div class="small-12 columns no-vantagens"><p>(nenhum item cadastrado)</p></div>');
					});
				}
			});
		}
	});

	/*
	 * ********* Performances **********
	 */

	// Função para reordenar itens
	$(".list-performances").sortable({
		opacity: 0.6,
		cursor: 'move',
		update: function() {
			// Ids
			var id = $("#idaviao").val();

			// Converter os IDs em array
			var order = $(this).sortable("toArray");

			// Type
			var type = $(this).data('type');

			// Mandando um POST para o webservice com a nova ordem
			$.ajax({
				url		: document.basePath + "/admin/avioes/salvaordem",
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
							$('div#'+value).find('input[name="new_performances_order[]"]').val(contador);
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
	$('a.btn-add-performance').on('click', function(e) {
		// Cancela o click do anchor
		e.preventDefault();

		// Busca as informações
		var input_performance 			= $('#input_performance').val();
		var input_performance_texto 	= $('#input_performance_texto').val();
		var input_performance_en 		= $('#input_performance_en').val();
		var input_performance_texto_en 	= $('#input_performance_texto_en').val();
		var input_performance_es 		= $('#input_performance_es').val();
		var input_performance_texto_es 	= $('#input_performance_texto_es').val();

		if(!!input_performance) {
			var existe_termo = 0;
			if(!!input_performance) {
				existe_termo = $('.list-performances span').filter(function(){ return $(this).text().replace('(PT) ', '') === input_performance });
			}
			var existe_termo_en = 0;
			if(!!input_performance_en) {
				existe_termo_en = $('.list-performances span').filter(function(){ return $(this).text().replace('(EN) ', '') === input_performance_en });
			}
			var existe_termo_es = 0;
			if(!!input_performance_es) {
				existe_termo_es = $('.list-performances span').filter(function(){ return $(this).text().replace('(ES) ', '') === input_performance_es });
			}

			if(existe_termo.length > 0 || existe_termo_en.length > 0 || existe_termo_es.length > 0) {
				// Existe o item
				//$('#input_performance').val('');
				//$('#input_performance_texto').val('');
				//$('#input_performance_en').val('');
				//$('#input_performance_texto_en').val('');
				//$('#input_performance_es').val('');
				//$('#input_performance_texto_es').val('');
				$('#input_performance').focus();
				swal('Ops!', 'Item já existente!', 'warning');
				return false;
			}else{
				if($('.no-performances').length > 0)
					$('.no-performances').remove();

				// Conta se possui novos itens
				var count_new = $('.list-performances.lista-simples div[id^="new00"]').length;
				var count_new_next = (count_new+1);

				// Cria os wrapper padrões
				var div_row 	= $('<div class="row item-container lista-simples-item" id="new00'+count_new_next+'"></div>');
				var hidden 		= $('<input type="hidden" name="new_performances[]" value="' + input_performance + '" form="form_admin">');
				var hidden1		= $('<input type="hidden" name="new_performances_texto[]" value="' + input_performance_texto + '" form="form_admin">');
				var hidden_en 	= $('<input type="hidden" name="new_performances_en[]" value="' + input_performance_en + '" form="form_admin">');
				var hidden1_en	= $('<input type="hidden" name="new_performances_texto_en[]" value="' + input_performance_texto_en + '" form="form_admin">');
				var hidden_es 	= $('<input type="hidden" name="new_performances_es[]" value="' + input_performance_es + '" form="form_admin">');
				var hidden1_es	= $('<input type="hidden" name="new_performances_texto_es[]" value="' + input_performance_texto_es + '" form="form_admin">');
				var hidden2 	= $('<input type="hidden" name="new_performances_order[]" value="" form="form_admin">');
				var remove 		= $('<div class="small-2 medium-1 columns"><a href="' + document.basePath + '/admin/avioes/deletaritem/" title="Excluir item" class="btn-remove-performance btn_excluir"></a></div>');
				var item 		= $('<div class="small-10 medium-11 columns">' +
						'<span class="titulo">(PT) ' + input_performance + '</span><span class="descricao" style="padding-left:43px;">' + input_performance_texto + '</span>' +
						'<span class="titulo">(EN) ' + input_performance_en + '</span><span class="descricao" style="padding-left:43px;">' + input_performance_texto_en + '</span>' +
						'<span class="titulo">(ES) ' + input_performance_es + '</span><span class="descricao" style="padding-left:43px;">' + input_performance_texto_es + '</span>' +
					'</div>');

				// Adiciona as divs
				div_row.append(remove);
				div_row.append(item);
				div_row.append(hidden);
				div_row.append(hidden1);
				div_row.append(hidden_en);
				div_row.append(hidden1_en);
				div_row.append(hidden_es);
				div_row.append(hidden1_es);
				div_row.append(hidden2);

				$('.list-performances').append(div_row);

				// Limpa o input
				$('#input_performance').val('');
				$('#input_performance_texto').val('');
				$('#input_performance_en').val('');
				$('#input_performance_texto_en').val('');
				$('#input_performance_es').val('');
				$('#input_performance_texto_es').val('');
				$('#input_performance').focus();
			}
		}else{
			swal('Ops!', 'Informe o item para adicionar.', 'error');
            return false;
		}
	});

	// Evento que remove os itens
	$('.list-performances').on('click', 'a.btn-remove-performance', function(e) {
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
							$('.itens').append('<div class="small-12 columns no-performances"><p>(nenhum item cadastrado)</p></div>');
					});
				}
			});
		}
	});
});