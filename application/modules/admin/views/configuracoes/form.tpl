<div class="row">
	<div class="small-12 columns buttons-bar">
		<ul class="stack-for-small button-group">
			<li>					
				<button form="form_admin" type="submit" name="submitcontinuar" value="true" onclick="$('#'+this.getAttribute('form')).submit();">
					Atualizar informações
				</button>
			</li>
		</ul>
		<p class="cleafix show-for-small-only"></p>
	</div>
	<form enctype="multipart/form-data" id="form_admin" action="{$form->getAction()}" method="post" data-abide>
		<div class="small-12 columns">
			<div class="show-for-medium-up">
				<ul class="tabs" data-tab data-options="deep_linking:true">
					<li class="tab-title active"><a href="#geral">Geral</a></li>
					<li class="tab-title"><a href="#institucional">Institucional</a></li>
					{if $idperfil === '99'}<li class="tab-title"><a href="#codigos">Códigos/Share</a></li>{/if}
					<li class="tab-title"><a href="#cookies">Política Cookies</a></li>
				</ul>
			</div>
			<div class="show-for-small-only">
				<nav class="top-bar" data-topbar role="navigation">
					<ul class="title-area">
						<li class="name">
						</li>
						<li class="toggle-topbar menu-icon">
							<a href="#"><span></span></a>
						</li>
					</ul>
					<section class="top-bar-section">
						<ul class="left" data-tab data-options="deep_linking:true">
							<li class="active"><a href="#geral">Geral</a></li>
							<li><a href="#institucional">Institucional</a></li>
							{if $idperfil === '99'}<li><a href="#codigos">Códigos/Share</a></li>{/if}
							<li><a href="#cookies">Política Cookies</a></li>
						</ul>
					</section>
				</nav>
			</div>
			<div class="tabs-content">
				<div class="content active" id="geral">
					<input id="idconfiguracao" type="hidden" value="{$idconfiguracao}">
					{$form->getElement('ativar_traducao')}
					{$form->getElement('nome_site')}
					{$form->getElement('email_padrao')}
					{$form->getElement('email_contato')}
					{$form->getElement('email_trabalhe')}
					{$form->getElement('google_play')}
					{$form->getElement('apple_store')}
					{$form->getElement('texto_bloco_app_home')}
					{$form->getElement('texto_bloco_app_home_en')}
					{$form->getElement('texto_bloco_app_home_es')}
					{$form->getElement('link_area_cliente')}
					{$form->getElement('facebook')}
					{$form->getElement('instagram')}
					{$form->getElement('linkedin')}
					{$form->getElement('whatsapp')}
				</div>

				<div class="content" id="institucional">
					{$form->getElement('frota_banner_desktop')}
					{$form->getElement('frota_banner_mobile')}
					{$form->getElement('frota_texto_tela')}
					{$form->getElement('frota_texto_tela_en')}
					{$form->getElement('frota_texto_tela_es')}
					{$form->getElement('venda_banner_desktop')}
					{$form->getElement('venda_banner_mobile')}
					{$form->getElement('endereco')}
					{$form->getElement('link_maps')}
					{$form->getElement('email_tela_contato')}
					{$form->getElement('telefone_escritorio_geral')}
					{$form->getElement('telefone_vendas')}
					{$form->getElement('telefone_setor_operacoes')}
					{$form->getElement('telefone_internacional')}
					{$form->getElement('email_internacional')}
					{$form->getElement('telefone_rampa')}
				</div>

				<div class="content" id="codigos">
					{$form->getElement('recaptcha_key')}
					{$form->getElement('recaptcha_secret')}
					{$form->getElement('share_tag')}
					{$form->getElement('codigo_final_head')}
					{$form->getElement('codigo_inicio_body')}
					{$form->getElement('codigo_final_body')}
				</div>

				<div class="content" id="cookies">
					{$form->getElement('politica_cookie_texto')}
					{$form->getElement('politica_cookie_texto_en')}
					{$form->getElement('politica_cookie_texto_es')}
				</div>
			</div>
		</div>
	</form>
</div>