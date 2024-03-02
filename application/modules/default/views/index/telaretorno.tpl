<main id="site-corpo" class="main-tela-retorno" data-class-body="static-header">
	<div class="uk-text-center ">
		<div class="bloco-tela-retorno">
			<div class="uk-container">
				{if $status == "sucesso"}
					<h1>{if !empty($title)}{$title}{else}{$translate['retorno']['sucesso']}!{/if}</h1>
				{else}
					<h1>{if !empty($title)}{$title}{else}{$translate['retorno']['erro']}!{/if}</h1>
				{/if}
			</div>
		</div>

		<div class="bloco-retorno">
			<div class="uk-container ">
				<p>{$translate['retorno']['texto']}</p>

				{if $status == "sucesso"}
					<a href="{url('home')}" class="back-btn">
						<button class="uk-button uk-button-secondary">{$translate['retorno']['inicio']}</button>
					</a>
				{else}
					<a href="javascript:history.go(-1);" class="back-btn">
						<button class="uk-button uk-button-secondary">{$translate['retorno']['tentar']}</button>
					</a>
				{/if}
			</div>
		</div>
	</div>
</main>