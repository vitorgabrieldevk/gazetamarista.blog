<main id="site-corpo" class="frota-detalhada">
	{assign var="banner_existe" value="common/uploads/aviao/"|cat:$aviao->banner_desktop}
	{if file_exists($banner_existe) && !empty($aviao->banner_desktop)}
		{assign var="src" value=$this->url(['tipo'=>'aviao', 'crop'=>'1', 'largura'=>1920, 'altura'=>615, 'imagem'=>$aviao->banner_desktop], 'imagem', TRUE)}

		{assign var="banner_existe" value="common/uploads/aviao/"|cat:$aviao->banner_mobile}
		{if file_exists($banner_existe) && !empty($aviao->banner_mobile)}
			{assign var="src_mobile" value=$this->url(['tipo'=>'aviao', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$aviao->banner_mobile], 'imagem', TRUE)}
		{else}
			{assign var="src_mobile" value=$this->url(['tipo'=>'aviao', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$aviao->banner_desktop], 'imagem', TRUE)}
		{/if}
		<figure class="uk-cover-container figure-header">
			<img class="uk-visible@s" data-src="{$src}" data-width="1920" data-height="615" uk-img alt="{$translate['frota']['nossa_frota']}" uk-cover>
			<img class="uk-hidden@s" data-src="{$src_mobile}" data-width="520" data-height="615" uk-img alt="{$translate['frota']['nossa_frota']}" uk-cover>
		</figure>
	{/if}

	<section class="bloco-informacoes">
		<div class="uk-container">
			<div class="uk-width-expand@m">
				<header class="titulo-pagina">
					<h1>{$aviao->titulo{$linguagem_tipo}}</h1>
				</header>
			</div>

			{if $itens|count > 0}
				<div class="slide-informacoes">
					<div class="slides tema-claro tipo-grid"
						{literal}data-slide='{"autoplay":{"delay":4000}, "watchOverflow":true, "spaceBetween":20, "slidesPerView": 1, "breakpoints":{"640":{"slidesPerView":2, "slidesPerGroup":2}, "960":{"slidesPerView":3, "slidesPerGroup":3}, "1200":{"slidesPerView":4, "slidesPerGroup":4}}}'
						{/literal} uk-scrollspy="cls: uk-animation-slide-bottom-medium;" style="visibility: hidden;">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								{foreach from=$itens item="row"}
									{if $row->tipo != "vantagens"}{continue}{/if}
									<div class="swiper-slide">
										<div class="uk-card uk-card-default uk-card-body">
											<h2 class="uk-card-title">{$row->item{$linguagem_tipo}}</h2>
											<p>-<br />{$row->conteudo{$linguagem_tipo}|nl2br}</p>
										</div>
									</div>
								{/foreach}
							</div>
							<div class="swiper-pagination"></div>
						</div>
					</div>
				</div>
			{/if}

			<div class="uk-grid uk-child-width-1-2@m melhor-jato" uk-grid>
				{if !empty($aviao->frase_centro{$linguagem_tipo})}
					<div>
						<div class="uk-panel uk-text-large">
							<h3>{$aviao->frase_centro{$linguagem_tipo}}</h3>
						</div>
					</div>
				{/if}

				{if !empty($aviao->texto{$linguagem_tipo})}
					<div>
						<div class="uk-panel uk-text-break">
							<p>{$aviao->texto{$linguagem_tipo}}</p>
						</div>
					</div>
				{/if}
			</div>
		</div>

		{if !empty($_configuracao->whatsapp)}
			<div class="bloco-contato-whatsapp">
				<figure>
					<a class="segmento" href="https://wa.me/55{$_configuracao->whatsapp|replace:['(',')','+','-',' ']:''}" target="_blank">
						<img data-src="common/default/images/icons/whatsapp.png" alt="Whatsapp" uk-img />
					</a>
				</figure>
			</div>
		{/if}
	</section>

	{if $detalhes|count > 0}
		<section class="bloco-conteudo">
			<div class="uk-container uk-flex uk-flex-center uk-flex-middle uk-flex-column">
				{foreach from=$detalhes key="chave" item="row"}
					<div class="uk-flex {if $chave % 2 == 1}uk-flex-row-reverse{/if} uk-margin-large-bottom conteudo">
						{assign var="img_existe" value="common/uploads/aviao/"|cat:$row->img}
						{if file_exists($img_existe) && !empty($row->img)}
							<figure>
								<img data-src="{$this->url(['tipo'=>'aviao', 'crop'=>'1', 'largura'=>590, 'altura'=>360, 'imagem'=>$row->img], 'imagem', TRUE)}"
									alt="{$row->detalhe{$linguagem_tipo}}" uk-img />
							</figure>
						{/if}

						<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
							<h3>{$row->detalhe{$linguagem_tipo}}</h3>
							<p>{$row->texto{$linguagem_tipo}}</p>
						</div>
					</div>
				{/foreach}
			</div>
		</section>
	{/if}

	{if $itens|count > 0}
		{assign var="countPerformance" value=0}
		{foreach from=$itens item="row"}
			{if $row->tipo != "performance"}{continue}{/if}
			{assign var="countPerformance" value=$countPerformance+1}
		{/foreach}
		{if $countPerformance > 0}
			<section class="bloco-performance">
				<div class="uk-container">
					<div class="uk-padding">
						<h4>{$translate['frota']['performance']}</h4>

						<div class="uk-child-width-1-2@m uk-grid-match" uk-grid>
							{foreach from=$itens item="row"}
								{if $row->tipo != "performance"}{continue}{/if}
								<p>
									{$row->item{$linguagem_tipo}} </br> - </br><span>{$row->conteudo{$linguagem_tipo}|nl2br}</span>
								</p>
							{/foreach}
						</div>
					</div>
			</section>
		{/if}
	{/if}

	<section class="bloco-contato uk-text-center">
		<div class="uk-container">
			{if !empty($aviao->texto2{$linguagem_tipo})}<p>{$aviao->texto2{$linguagem_tipo}}</p>{/if}

			<a href="{url('contato')}?aeronave={$this->createslug($aviao->titulo{$linguagem_tipo})}">
				<button class="uk-button uk-button-third">{$translate['conteudo']['entrar_contato']}</button>
			</a>
		</div>
	</section>
</main>