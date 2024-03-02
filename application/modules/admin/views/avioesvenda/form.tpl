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
				<li class="tab-title"><a href="#vantagem">Vantagem</a></li>
				<li class="tab-title"><a href="#performance">Performance</a></li>
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
						<li><a href="#vantagem">Vantagem</a></li>
						<li><a href="#performance">Performance</a></li>
					</ul>
				</section>
			</nav>
		</div>
		<div class="tabs-content">
			<div class="content active" id="geral">
				<input id="idaviaovenda" type="hidden" value="{$id}">
				{$form}
			</div>

			<div class="content" id="vantagem">
				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_vantagem" class="optional">Vantagem (PT) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_vantagem" id="input_vantagem" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_vantagem_texto" class="optional">Descrição (PT) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<textarea name="input_vantagem_texto" id="input_vantagem_texto" rows="5" field-type="textarea" class="string textarea radius" cols="50" aria-invalid="false"></textarea>
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_vantagem_en" class="optional">Vantagem (EN) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_vantagem_en" id="input_vantagem_en" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_vantagem_texto_en" class="optional">Descrição (EN) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<textarea name="input_vantagem_texto_en" id="input_vantagem_texto_en" rows="5" field-type="textarea" class="string textarea radius" cols="50" aria-invalid="false"></textarea>
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_vantagem_es" class="optional">Vantagem (ES) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_vantagem_es" id="input_vantagem_es" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_vantagem_texto_es" class="optional">Descrição (ES) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<textarea name="input_vantagem_texto_es" id="input_vantagem_texto_es" rows="5" field-type="textarea" class="string textarea radius" cols="50" aria-invalid="false"></textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="small-12 medium-6 columns end">
						<a href="#" class="button secondary normal btn-add-vantagem-venda"><span class="mdi mdi-content-save-move-outline"></span> Adicionar</a>
						<p>*Após adicionar, clique em cadastrar/atualizar</p>
						{if $vantagens|count > 1}
							<p>*Clique e arraste o item para ajustar a ordenação</p>
						{/if}
					</div>
				</div>

				<div class="row">
					{if $vantagens|count == 0}
						<div class="small-12 columns no-vantagens">
							<p>(nenhum item cadastrado)</p>
						</div>
					{/if}
					<div class="small-12 columns list-vantagens lista-simples" data-type="vantagem">
						{foreach from=$vantagens item="row"}
							<div class="row item-container lista-simples-item" id="{$row->idaviaoitemvenda}">
								<div class="small-2 medium-1 columns">
									<a href="{$basePath}/admin/avioesvenda/deletaritem/idaviaovenda/{$id}/iditem/{$row->idaviaoitemvenda}" title="Excluir item" title="Excluir item" class="btn-remove-vantagem-venda btn_excluir"></a>
								</div>
								<div class="small-10 medium-11 columns grab">
									<span class="titulo">(PT) {$row->item}</span>
									<span class="descricao" style="padding-left:43px;">{$row->conteudo|nl2br}</span>
									<span class="titulo">(EN) {$row->item_en}</span>
									<span class="descricao" style="padding-left:43px;">{$row->conteudo_en|nl2br}</span>
									<span class="titulo">(ES) {$row->item_es}</span>
									<span class="descricao" style="padding-left:43px;">{$row->conteudo_es|nl2br}</span>
								</div>
							</div>
						{/foreach}
					</div>
				</div>
			</div>

			<div class="content" id="performance">
				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_performance" class="optional">Performance (PT) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_performance" id="input_performance" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_performance_texto" class="optional">Descrição (PT) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_performance_texto" id="input_performance_texto" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_performance_en" class="optional">Performance (EN) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_performance_en" id="input_performance_en" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_performance_texto_en" class="optional">Descrição (EN) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_performance_texto_en" id="input_performance_texto_en" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_performance_es" class="optional">Performance (ES) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_performance_es" id="input_performance_es" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="element-form">
					<div class="row">
						<div class="small-6 medium-2 large-2 columns labeldiv">
							<label for="input_performance_texto_es" class="optional">Descrição (ES) <div class="clearfix"></div><small></small></label>
						</div>
						<div class="input-form small-12 medium-5 large-5 columns end">
							<input type="text" name="input_performance_texto_es" id="input_performance_texto_es" field-type="text" class="varchar string">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="small-12 medium-6 columns end">
						<a href="#" class="button secondary normal btn-add-performance-venda"><span class="mdi mdi-content-save-move-outline"></span> Adicionar</a>
						<p>*Após adicionar, clique em cadastrar/atualizar</p>
						{if $performances|count > 1}
							<p>*Clique e arraste o item para ajustar a ordenação</p>
						{/if}
					</div>
				</div>

				<div class="row">
					{if $performances|count == 0}
						<div class="small-12 columns no-performances">
							<p>(nenhum item cadastrado)</p>
						</div>
					{/if}
					<div class="small-12 columns list-performances lista-simples" data-type="performance">
						{foreach from=$performances item="row"}
							<div class="row item-container lista-simples-item" id="{$row->idaviaoitemvenda}">
								<div class="small-2 medium-1 columns">
									<a href="{$basePath}/admin/avioesvenda/deletaritem/idaviaovenda/{$id}/iditemvenda/{$row->idaviaoitemvenda}" title="Excluir item" title="Excluir item" class="btn-remove-performance-venda btn_excluir"></a>
								</div>
								<div class="small-10 medium-11 columns grab">
									<span class="titulo">(PT) {$row->item}</span>
									<span class="descricao" style="padding-left:43px;">{$row->conteudo}</span>
									<span class="titulo">(EN) {$row->item_en}</span>
									<span class="descricao" style="padding-left:43px;">{$row->conteudo_en}</span>
									<span class="titulo">(ES) {$row->item_es}</span>
									<span class="descricao" style="padding-left:43px;">{$row->conteudo_es}</span>
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