<main id="site-corpo" class="main-noticias-detalhe">
	<div class="bloco-noticia">
		<div class="uk-container">
			<div class="uk-grid uk-flex-middle" uk-grid>
				<div class="uk-width-expand@m">
					<header class="titulo-pagina">
						<h1>{$noticia["titulo$linguagem_tipo"]}</h1>
						<p>{$noticia['data']|date_format:"%d/%m/%Y"}</p>
					</header>
				</div>
			</div>
		</div>

		{if !empty($_configuracao->whatsapp)}
			<figure class="bloco-contato">
				<a class="segmento" href="https://wa.me/55{$_configuracao->whatsapp|replace:['(',')','+','-',' ']:''}"
					target="_blank">
					<img data-src="common/default/images/icons/whatsapp.png" alt="Whatsapp" uk-img />
				</a>
			</figure>
		{/if}
	</div>

	<div class="uk-container">
		<div class="uk-grid uk-flex-center" uk-grid>
			<article class="uk-width-1-1@m uk-width-5-6@l coluna-conteudo">
				<input type="hidden" id="idpost" value="{$noticia['idblog']}">

				{assign var="img_existe" value="common/uploads/blog/"|cat:$noticia['imagem']}
				{if file_exists($img_existe) && !empty($noticia['imagem'])}
					<figure class="item-imagem">
						<img data-src="{$this->url(['tipo'=>'blog', 'crop'=>1, 'largura'=>980, 'altura'=>595, 'imagem'=>$noticia['imagem']], 'imagem', TRUE)}"
							alt="{$noticia["titulo$linguagem_tipo"]}" uk-img />
					</figure>
				{/if}

				<div class="bloco-conteudo-texto">
					{$noticia["texto$linguagem_tipo"]}
				</div>

				{if !empty($noticia["autor$linguagem_tipo"])}
					<div class="item-autor">{$translate['noticias']['por']} {$noticia["autor$linguagem_tipo"]}</div>
				{/if}

				<div class="uk-grid" uk-grid>
					{if !empty($noticia["tags$linguagem_tipo"])}
						<div class="uk-width-expand@m">
							<div class="item-tags">
								{assign var="tags" value=","|explode:$noticia["tags$linguagem_tipo"]}
								{foreach from=$tags item="tag"}
									<a href="{$this->url(['page'=>1,'termo'=>$tag|trim], 'noticias', TRUE)}" class="uk-button uk-border-pill">{$tag|trim}</a>
								{/foreach}
							</div>
						</div>
					{/if}

					<div class="uk-width-auto@m">
						<div class="item-compartilhar">
							<h3>{$translate['conteudo']['compartilhar']}</h3>

							<div class="icones-social">
								<div data-network="whatsapp" class="st-custom-button"><i class="icon-whatsapp"></i></div>
								<div data-network="facebook" class="st-custom-button"><i class="icon-facebook"></i></div>
								<div data-network="twitter" class="st-custom-button"><i class="icon-twitter"></i></div>
								<div data-network="linkedin" class="st-custom-button"><i class="icon-linkedin"></i></div>
							</div>
						</div>
					</div>
				</div>

				<div class="uk-grid uk-flex-center uk-flex-between@m uk-flex-middle item-voltar" uk-grid>
					<div class="uk-width-1-1 uk-width-auto@m uk-text-center uk-text-left@m">
						<div class="item-like">
							<h3>{$translate['noticias']['que_achou']}</h3>

							<div class="uk-flex uk-flex-center like-container">
								<div class="like like-toggle">
									<i class="icon-like"></i>
								</div>

								<div class="unlike like-toggle">
									<i class="icon-dislike"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="uk-width-1-1 uk-width-auto@m uk-text-center uk-text-right@m uk-flex-first@m btn-voltar">
						<a href="{url('noticias')}" class="uk-button uk-border-pill"> << {$translate['conteudo']['voltar']}</a>
					</div>
				</div>
			</article>
		</div>
	</div>

	{if $outrosblogs|count > 0}
		<div class="bloco-noticias">
			<div class="uk-container">
				<div class="uk-flex uk-flex-center uk-flex-between@m uk-flex-middle uk-margin-large-bottom mais-noticias">
					<h3>{$translate['noticias']['mais_lidas']}</h3>

					<a class="uk-button uk-border-pill" href="{url('noticias')}">{$translate['noticias']['ver_todas']}</a>
				</div>

				<div class="slides tema-claro tipo-grid"
					{literal}data-slide='{"watchOverflow":true, "spaceBetween":20, "slidesPerView": 1, "breakpoints":{"768":{"slidesPerView":2, "slidesPerGroup":2}, "960":{"slidesPerView":3, "slidesPerGroup":3}}}'
					{/literal} uk-scrollspy="cls: uk-animation-slide-bottom-medium;" style="visibility: hidden;">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							{foreach from=$outrosblogs item="outro"}
								<div class="swiper-slide">
									<a class="lista-noticia" href="{url('noticia', ['idnoticia'=>$outro->idblog, 'slug'=>$this->createslug($outro->titulo{$linguagem_tipo})])}">
										<figure>
											<img data-src="{$this->url(['tipo'=>'blog', 'crop'=>'1', 'largura'=>380, 'altura'=>280, 'imagem'=>$outro->imagem|default:'null'], 'imagem', TRUE)}"
												alt="{$outro->titulo{$linguagem_tipo}}" uk-img />
										</figure>

										{if !empty($outro->tags{$linguagem_tipo})}
											{assign var="tags" value=","|explode:$outro->tags{$linguagem_tipo}}
											{assign var="txt_tag" value=$tags[0]}
										{else}
											{assign var="txt_tag" value="Sync"}
										{/if}

										<div class="categoria">{$txt_tag}</div>
										<h3>{$outro->titulo{$linguagem_tipo}}</h3>
										<div class="data">{$outro->data|date_format:"%d/%m/%Y"}</div>

										<button class="uk-button uk-button-secondary uk-hidden@m">
											{$translate['noticias']['ler']} <i class="icon-arrow-b-right"></i>
										</button>
									</a>
								</div>
							{/foreach}
						</div>

						<div class="swiper-pagination"></div>
					</div>
				</div>

				<div class="uk-flex uk-flex-between uk-flex-middle botao-mobile">
					<a class="uk-button uk-border-pill" href="{url('noticias')}">{$translate['noticias']['ver_todas']}</a>
				</div>
			</div>
		</div>
	{/if}
</main>

<script type="text/javascript"
	src="//platform-api.sharethis.com/js/sharethis.js#property=60645b36406a11001102db6a&product=custom-share-buttons">
</script>