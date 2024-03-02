//$(function() {
$(document).ready(function() {
	/*
	* Função de análise de SEO
	*/

	var analisarseo = function() {
		// Campos do form
        var inputs = $('#form_admin').serialize();

        // Imagem já existente no bd
        var imagem = $('.item-preview').attr('href');

        // Imagem inserida mas ainda não salva
        var imagem_temp = $('#imagem').val();

        // Id primary
        var action = $('#form_admin').attr('action');
        var action_array1 = action.split('idblog/');
        if(action_array1[1]) {
        	var idprimary = parseInt(action_array1[1]);
        	inputs += "&idprimary="+idprimary;
	    }

	    // Imagem
       	if(imagem != "") {
       		inputs += "&imagem="+imagem;
       	}
       	
       	// Imagem temp
    	if(imagem_temp != "") {
    		inputs += "&imagem_temp="+imagem_temp;
    	}

        // Envia o ajax
        $.ajax({
			url		: document.basePath + "/admin/blogs/seo",
			method	: 'POST',
			data	: inputs,
			dataType: "json"
		})
		.done(function(response) {
			if( response.status == 'sucesso' && response.itens.length > 0 ) {
				// Atualiza o seo-preview
				$('.preview_title').html(response.span_titulo);
				$('.preview_link').html(response.span_link);
				$('.preview_description').html(response.span_descricao);

				// Limpa o html
				$('#seo').html('');

				if($('input#meta_slug').val() == "" && response.meta_slug != "") {
					$('input#meta_slug').val(response.meta_slug);
				}

				// Percorre os itens retornados
				$.each(response.itens, function(key, item) {
					// Adiciona os itens
					$('#seo').append(
						'<li><span title="'+item.item_nivel+'" style="background-color:'+item.item_cor+';"></span>'+item.item_frase+'</li>'
					);
				});
			}
		})
		.fail(function (xhr, status, thrownError) {
	    	console.log(status + " :: " + thrownError);
	    });
	}

	// Executa a análise assim que abrir o formulário
	analisarseo();

	var timeout;

	// Qualquer alteração de conteúdo executa
	$('input, textarea').on('blur', function(e) {
		analisarseo();
	});

	CKEDITOR.instances.texto.on('blur', function() {
		analisarseo();
	});

	CKEDITOR.instances.texto.on('keyup', function() {
		// Bloqueia repetições durante o tempo
		clearTimeout(timeout);
	    timeout = setTimeout(function() {
			analisarseo();
		}, 4000);
	});

	$('input, textarea').on('keyup', function(e) {
		// Bloqueia repetições durante o tempo
		clearTimeout(timeout);
	    timeout = setTimeout(function() {
			analisarseo();
		}, 2000);
	});

	$('.button.input-file-upload input[type="file"]').off().on('change', function() {
		// Bloqueia repetições durante o tempo
		clearTimeout(timeout);
	    timeout = setTimeout(function() {
			analisarseo();
		}, 2000);
	});

	/*
	 * ********** Arquivos downloads **********
	 */

	// Adiciona o evento de adicionar à lista
	$('#downloads').on('click', 'a.btn-add-arquivo', function(e) {
		// Cancela o click do anchor
		e.preventDefault();

		// Busca as informações
		var doc_arquivo	= $('#doc_arquivo').val();
		var doc_titulo 	= $('#doc_titulo').val();

		if(!!doc_arquivo) {
			var ext = doc_arquivo.split('.').pop().toLowerCase();
			if($.inArray(ext, ['pdf','zip', 'rar', 'doc','docx', 'jpg', 'jpeg', 'png']) == -1) {
			    swal('Ops!', 'Extensão do arquivo inválida!', 'error');
            	return false;
			}else{
				if($('.no-arquivos').length > 0) {
					$('.no-arquivos').remove();
				}

				// Cria os wrapper padrões
				var div_row = $('<div class="row arquivo-container"></div>');

				// Move o input file para o outro formulario e envia
				var obj 	= $('#doc_arquivo');
				var clonar  = obj.clone();
				$(obj).closest('.button.input-file-upload').append(clonar);
				$('#form-uploadarquivo').html(obj.addClass('hide'));
				$('#form-uploadarquivo').trigger('submit');

				$('iframe[name="uploadarquivo-frame"]').off('load').on('load', function() {
					var filename = $(this).contents().text();
					if(filename != 'erro') {
						$('#form-uploadarquivo').html('');

						// Extensao
						var doc_extensao = filename.split(/[. ]+/).pop();

						// Cria os dados na listagem
						var hidden1	= $('<input type="hidden" name="arquivos_titulos[]" value="' + doc_titulo + '" form="form_admin">');
						var hidden2	= $('<input type="hidden" name="file_arquivos[]" value="' + filename + '" form="form_admin">');
						var remove 	= $('<a href="' + document.basePath + '/admin/blogs/deletardownload/arquivo/' + filename + '" title="Excluir arquivo" class="btn-remove-arquivo btn_excluir"></a>');
						var view 	= $('<a href="#" style="float:left;margin-left:22px;">..</a>');
						var titulo 	= $('<div class="nome" style="margin:7px;">' + doc_titulo + ' (.' + doc_extensao + ')</div>');

						// Adiciona as divs
						div_row.append(hidden1);
						div_row.append(hidden2);
						div_row.append(remove);
						div_row.append(view);
						div_row.append(titulo);

						$('.arquivos').append(div_row);

						// Limpa o input
						$('span.nome-arquivo').html('');
						$('#doc_arquivo').val('');
						$('#doc_titulo').val('');
					}else{
						swal('Ops!', 'Ocorreu um erro, tente novamente!', 'error');
            			return false;
					}
				});
			}
		}else{
			swal('Ops!', 'Informe o arquivo e título para adicionar!', 'warning');
            return false;
		}
	});

	// Evento que remove o downloads
	$('#downloads').on('click', 'a.btn-remove-arquivo', function(e) {
		if(!confirm('Deseja remover este arquivo?')) {
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
					anchor.closest('.arquivo-container').fadeOut(function() {
						$(this).remove();
						if($('.arquivo-container').length == 0) {
							$('.arquivos').append('<div class="small-12 columns no-arquivos"><p>(nenhum arquivo cadastrado)</p></div>');
						}
					});
				},
				error: function() {
					swal('Erro!', 'Ocorreu um erro, tente novamente!', 'error');
					return false;
				}
			});
		}
	});

	/*
	 * Itens relacionados
	 */
	
	// Adiciona o evento de adicionar à lista
	$('a.btn-add-blog').on('click', function(e) {
		// Cancela o click do anchor
		e.preventDefault();
		
		// Busca as informações		
		var blog_relacionado 		= $('#blog_relacionado').val();
		var blog_relacionado_label 	= $('#blog_relacionado_label').val();
		
		if(blog_relacionado != "" && blog_relacionado_label != "") {
			if($('.no-blogs_relacionados').length > 0)
				$('.no-blogs_relacionados').remove();

			// Cria os wrapper padrões, os input hiddens, botão de remover, div da legenda e a div da url
			var div_row = $('<div class="row blog-container"></div>');

			// Input hidden com os valores da imagem
			var hidden 	= $('<input type="hidden" name="relacionados[]" value="' + blog_relacionado + '" form="form_admin">');

			// Botão de remover
			var remove 	= $('<div class="small-2 medium-1 columns"><a href="' + document.basePath + '/admin/blogs/deletarblogrelacionado/" class="btn-remove-blog btn_excluir"></a></div>');

			// Div com a nome_relacionado
			var nome_relacionado = $('<div class="small-10 medium-11 columns end" style="margin-top:7px;"><span>' + blog_relacionado_label + '</span></div>');

			// Adiciona as divs
			div_row.append(remove);
			div_row.append(nome_relacionado);
			div_row.append(hidden);
			
			$('.blogs_relacionados').append(div_row);

			// Limpa o input
			$('#blog_relacionado').val('');
			$('#blog_relacionado_label').val('').focus();

		}else{
			swal('Ops!', 'Informe o blog relacionado para adicionar.', 'warning');
		}
	});
	
	// Evento que remove o blogs_relacionados
	$('.blogs_relacionados').on('click', 'a.btn-remove-blog', function(e) {
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
					if(data == "ok") {
						anchor.closest('.blog-container').fadeOut(function() {
							$(this).remove();
							if($('.blog-container').length == 0)
								$('.blogs_relacionados').append('<div class="small-12 columns no-blogs_relacionados"><p>(nenhum blog relacionado cadastrado)</p></div>');
						});
					}
				}
			});
		}
	});

	// Abre o previewsite
	$('#abrepreviewsite').on('click', function(){
		// Altera o conteúdo para exibir
		var titulo 	= $('#titulo').val();

		var imagem 	= $('.input-file-upload').data('preview');
		if(imagem != undefined) {
			if(imagem.length > 0) {
				imagem = imagem.split('/').pop();

				imagem = '<img class="imagem-post" src="' + document.basePath + '/thumb/blog/2/280/280/' + imagem +'" alt="'+titulo+'">';
			}
		}

		var autor 	= $('#autor').val();

		var data 	= $('#data').val();

		if(data != undefined) {
			if(data.length > 0) {
				var currentTime = new Date(data.split("/").reverse().join("-"));
				var dia = currentTime.getUTCDate().toString(); 
				var mes = currentTime.getMonth().toString();
				var ano = currentTime.getFullYear().toString();
				var Mes = currentTime.getUTCMonth().toString();

				if (dia < 10)
					dia = "0" + dia
				if (mes < 10)
					mes = "0" + mes

				var arrayMes = new Array();
				   arrayMes[0] = "Janeiro";
				   arrayMes[1] = "Fevereiro";
				   arrayMes[2] = "Março";      
				   arrayMes[3] = "Abril";
				   arrayMes[4] = "Maio";
				   arrayMes[5] = "Junho";
				   arrayMes[6] = "Julho";
				   arrayMes[7] = "Agosto";
				   arrayMes[8] = "Setembro";
				   arrayMes[9] = "Outubro";
				   arrayMes[10] = "Novembro";
				   arrayMes[11] = "Dezembro";

				data = dia + " de " + arrayMes[Mes] + ", " + ano
			}
		}

		if(autor != undefined) {
			if(autor.length > 0) {
				data = data + " - por " + autor
			}
		}

		var texto 	= $('#element-texto .input-form #texto').val();

		if(window.location.hostname == "localhost") {
			var urlonline = document.basePath;
		}else{
			var urlonline = location.protocol + '//' + document.basePath.replace('//','').replace('/','');
		}

		$.fancybox({
			type: 'iframe',
			href: urlonline + '/admin/blogs/preview',
			width	  : '100%',
			autoSize : false,
			scrolling : false,
			padding	  : 0,
			autoScale : false,
		    openEffect : 'elastic',
		    closeEffect : 'elastic',
		    fitToView: false,
		    
		    afterShow: function(){
		  		// tituto
				$('iframe').contents().find('h1').html(titulo);

				// imagem
				$('iframe').contents().find('figure').html(imagem);

				// Data-autor
				$('iframe').contents().find('.data').html(data);

				// texto
				$('iframe').contents().find('.item-texto').html(texto);
		    }
		 });

		return false;
	});
});