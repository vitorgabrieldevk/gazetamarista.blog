<main id="site-corpo" class="main-contato">
	<section class="bloco-header">
		<div class="uk-container">
			<div class="uk-grid " uk-grid>
				<div class="uk-width-1-2@m">
					<h1>{$translate['topo']['contato']}</h1>
				</div>

				<div class="uk-width-1-2 uk-width-1-4@m">
					<div class="uk-flex uk-flex-center uk-flex-between@m">
						<div class="bloco-endereco email">
							<a href="{$_configuracao->link_maps}" target="_blank">{$_configuracao->endereco|nl2br}</a>

                            {if !empty($_configuracao->email_tela_contato)}
								<a class="email-topo" href="mailto:{$_configuracao->email_tela_contato}">
                                    {$_configuracao->email_tela_contato}
								</a>
                            {/if}
						</div>
					</div>
				</div>

				<div class="uk-width-1-2 uk-width-1-4@m">
					<div class="uk-flex uk-flex-center uk-flex-between@m">
						<div class="bloco-endereco telefone">
                            {if !empty($_configuracao->telefone_escritorio_geral)}
								<p>{$translate['contato']['escritorio']}</p>
								<a href="tel:+{$_configuracao->telefone_escritorio_geral|regex_replace:'/[^0-9]+/':''}">{$_configuracao->telefone_escritorio_geral}</a>
                            {/if}

                            {if !empty($_configuracao->telefone_setor_operacoes)}
								<p>{$translate['contato']['setor']}</p>
								<a href="tel:+{$_configuracao->telefone_setor_operacoes|regex_replace:'/[^0-9]+/':''}">{$_configuracao->telefone_setor_operacoes}</a>
                            {/if}

                            {if !empty($_configuracao->telefone_vendas)}
								<p>{$translate['contato']['venda']}</p>
								<a href="tel:+{$_configuracao->telefone_vendas|regex_replace:'/[^0-9]+/':''}">{$_configuracao->telefone_vendas}</a>
                            {/if}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bloco-formulario">
		<div class="uk-container">
			<div class="uk-grid uk-child-width-1-2@m" uk-grid>
				<div>
					<form method="post" action="{url('ajax-fale-conosco')}" enctype="multipart/form-data" data-validate="ajax">
						<div class="uk-margin">
							<div class="uk-form-controls">
								<input type="text" name="nome" class="uk-input" placeholder="{$translate['contato']['nome']}" maxlength="150" required data-fv-regexp="true" data-fv-regexp___flags="g" data-fv-regexp___regexp="\s+" data-fv-regexp___message="Informe seu nome completo">
							</div>
						</div>

						<div class="uk-margin">
							<div class="uk-form-controls">
								<input type="email" name="email" class="uk-input" placeholder="{$translate['contato']['email']}" maxlength="150" required>
							</div>
						</div>

						<div class="uk-margin">
							<div class="uk-form-controls">
								<input type="tel" name="telefone" class="uk-input mascara-telefone" placeholder="{$translate['contato']['telefone']}" maxlength="50" required>
							</div>
						</div>

						<div class="uk-margin">
							<div class="uk-form-controls">
								<select name="assunto" class="uk-select campo-assunto" data-select-default required>
									<option value="" selected>{$translate['contato']['assunto']}</option>
									<option value="agendar_atendimento" {if $assunto == "agendar-atendimento"}selected{/if}>{$translate['assuntos']['agendar_atendimento']}</option>
									<option value="taxi_aereo" {if $assunto == "taxi-aereo"}selected{/if}>{$translate['assuntos']['taxi_aereo']}</option>
									<option value="gestao_aeronaves" {if $assunto == "gestao-de-aeronaves"}selected{/if}>{$translate['assuntos']['gestao_aeronaves']}</option>
									<option value="propriedade_compartilhada" {if $assunto == "propriedade-compartilhada"}selected{/if}>{$translate['assuntos']['propriedade_compartilhada']}</option>
									<option value="trabalhe_conosco" data-mostrar-upload {if $assunto == "trabalhe-conosco"}selected{/if}>{$translate['assuntos']['trabalhe_conosco']}</option>
									<option value="parcerias">{$translate['assuntos']['parcerias']}</option>
									<option value="duvidas">{$translate['assuntos']['duvidas']}</option>
									<option value="outro_assunto">{$translate['assuntos']['outro_assunto']}</option>
								</select>
							</div>
						</div>

						<div class="uk-margin textarea">
							<textarea name="mensagem" class="uk-textarea" placeholder="{$translate['contato']['mensagem']}" required></textarea>
						</div>

						<div class="arquivo-upload uk-hidden">
							<div class="arquivo_tmp">
								<div class="botao"></div>
								<div class="nome-arquivo"></div>
								<div class="botao-remover"></div>
							</div>

							<input accept=".pdf,.doc,.docx" type="file" name="arquivo" tabindex="-1" autocomplete="off">
						</div>

						<div class="uk-grid uk-grid-small" uk-grid>
							<div class="uk-width-1-2@s">
								<div class="recaptcha-container"></div>
							</div>

							<div class="uk-width-1-2@s">
								<button type="submit" class="uk-button uk-width-expand uk-border-pill btn-enviar">{$translate['contato']['enviar']}</button>
							</div>
						</div>
					</form>
				</div>

				<div>
					<div class="bloco-informacoes">
						<div class="uk-margin-bottom">
							<h2>{$translate['contato']['internacional']}</h2>

                            {if !empty({$_configuracao->telefone_internacional})}
								<p>{$translate['contato']['solicitacao']}</p>
								<p>
									<a href="tel:+{$_configuracao->telefone_internacional|regex_replace:'/[^0-9]+/':''}">{$_configuracao->telefone_internacional}</a>
								</p>
                            {/if}

                            {if !empty({$_configuracao->email_internacional})}
								<a href="mailto:{$_configuracao->email_internacional}">{$_configuracao->email_internacional}</a>
                            {/if}
						</div>

						<div>
							<h2>{$translate['contato']['rampa']}</h2>

                            {if !empty({$_configuracao->telefone_rampa})}
								<p>{$translate['contato']['solicitacoes']}</p>
								<p>
									<a href="tel:+{$_configuracao->telefone_rampa|regex_replace:'/[^0-9]+/':''}">{$_configuracao->telefone_rampa}</a>
								</p>
                            {/if}

							<p>—</p>

							<p>{$translate['contato']['para_outras']}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>