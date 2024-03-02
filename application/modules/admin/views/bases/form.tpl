<div class="row">
	<div class="small-12 columns buttons-bar">
		<ul class="stack-for-small button-group">
			<li>
				<a href="{$this->url(['module'=>'admin', 'controller'=>$controller, 'action'=>'list'], 'default', TRUE)}{$filtrosParam}" class="button secondary normal">
					<span class="mdi mdi-keyboard-backspace"></span> Voltar para listagem
				</a>
			</li>

			<li>
				<button form="form_admin" type="submit" name="submit" value="true" onclick="$('#'+this.getAttribute('form')).submit();">
					<span class="mdi mdi-content-save-move-outline"></span> {$form->getElement('submit')->getLabel()}
				</button>
			</li>

			<li class="btn_save-continue">
				<button form="form_admin" type="submit" name="submitcontinuar" value="true" value="true" onclick="$('#'+this.getAttribute('form')).submit();">
					<span class="mdi mdi-content-save-edit-outline"></span> {$form->getElement('submit')->getLabel()} e continuar {if $id > 0}editando{else}cadastrando{/if}
				</button>
			</li>
		</ul>
		<p class="cleafix show-for-small-only"></p>
	</div>

	<div class="small-12 columns">
		<div class="show-for-medium-up">
			<ul class="tabs" data-tab data-options="deep_linking:true">
				<li class="tab-title active"><a href="#geral">Geral</a></li>
				<li class="tab-title"><a href="#facilidades">Facilidades</a></li>
				<li class="tab-title"><a href="#servicos">Serviços</a></li>
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
					<ul class="left" data-tab>
						<li class="active"><a href="#geral">Geral</a></li>
						<li><a href="#facilidades">Facilidades</a></li>
						<li><a href="#servicos">Serviços</a></li>
					</ul>
				</section>
			</nav>
		</div>
		<div class="tabs-content">
			<div class="content active" id="geral">
				<input id="idbase" type="hidden" value="{$id}">
				{$form}
			</div>

			<div class="content" id="facilidades">
				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-3 large-3 columns labeldiv">
							<label for="input_facilidade" class="optional">Facilidade (PT) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-4 large-4 columns end">
							<input type="text" name="input_facilidade" id="input_facilidade" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-3 large-3 columns labeldiv">
							<label for="input_facilidade_en" class="optional">Facilidade (EN) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-4 large-4 columns end">
							<input type="text" name="input_facilidade_en" id="input_facilidade_en" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-3 large-3 columns labeldiv">
							<label for="input_facilidade_es" class="optional">Facilidade (PT) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-4 large-4 columns end">
							<input type="text" name="input_facilidade_es" id="input_facilidade_es" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="small-12 medium-6 columns end">
						<a href="#" class="button secondary normal btn-add-facilidade"><span class="mdi mdi-content-save-move-outline"></span> Adicionar</a>
						<p>*Após adicionar, clique em cadastrar/atualizar</p>
						{if $facilidades|count > 1}
							<p>*Clique e arraste o item para ajustar a ordenação</p>
						{/if}
					</div>
				</div>

				<div class="row">
					{if $facilidades|count == 0}
						<div class="small-12 columns no-facilidades">
							<p>(nenhum item cadastrado)</p>
						</div>
					{/if}
					<div class="small-12 columns list-facilidades lista-simples" data-type="facilidade">
						{foreach from=$facilidades item="row"}
							<div class="row item-container lista-simples-item" id="{$row->idbaseitem}">
								<div class="small-2 medium-1 columns">
									<a href="{$basePath}/admin/bases/deletaritem/idbase/{$id}/iditem/{$row->idbaseitem}" title="Excluir item" title="Excluir item" class="btn-remove-facilidade btn_excluir"></a>
								</div>
								<div class="small-10 medium-11 columns grab">
									<span class="titulo">(PT) {$row->item}</span>
									<span class="titulo">(EN) {$row->item_en}</span>
									<span class="titulo">(ES) {$row->item_es}</span>
								</div>
							</div>
						{/foreach}
					</div>
				</div>
			</div>

			<div class="content" id="servicos">
				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-3 large-3 columns labeldiv">
							<label for="input_servico" class="optional">Serviço (PT) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-4 large-4 columns end">
							<input type="text" name="input_servico" id="input_servico" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-3 large-3 columns labeldiv">
							<label for="input_servico_en" class="optional">Serviço (EN) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-4 large-4 columns end">
							<input type="text" name="input_servico_en" id="input_servico_en" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-3 large-3 columns labeldiv">
							<label for="input_servico_es" class="optional">Serviço (ES) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-4 large-4 columns end">
							<input type="text" name="input_servico_es" id="input_servico_es" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="small-12 medium-6 columns end">
						<a href="#" class="button secondary normal btn-add-servico"><span class="mdi mdi-content-save-move-outline"></span> Adicionar</a>
						<p>*Após adicionar, clique em cadastrar/atualizar</p>
						{if $servicos|count > 1}
							<p>*Clique e arraste o item para ajustar a ordenação</p>
						{/if}
					</div>
				</div>

				<div class="row">
					{if $servicos|count == 0}
						<div class="small-12 columns no-servicos">
							<p>(nenhum item cadastrado)</p>
						</div>
					{/if}
					<div class="small-12 columns list-servicos lista-simples" data-type="serviço">
						{foreach from=$servicos item="row"}
							<div class="row item-container lista-simples-item" id="{$row->idbaseitem}">
								<div class="small-2 medium-1 columns">
									<a href="{$basePath}/admin/bases/deletaritem/idbase/{$id}/iditem/{$row->idbaseitem}" title="Excluir item" title="Excluir item" class="btn-remove-servico btn_excluir"></a>
								</div>
								<div class="small-10 medium-11 columns grab">
									<span class="titulo">(PT) {$row->item}</span>
									<span class="titulo">(EN) {$row->item_en}</span>
									<span class="titulo">(ES) {$row->item_es}</span>
								</div>
							</div>
						{/foreach}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{if $id|default:0 > 0}
	<input type=hidden name="referer_url" value="{$this->url(['module'=>'admin', 'controller'=>$controller, 'action'=>'list'], 'default', FALSE)}">
{/if}