{if $logged_usuario['idperfil'] > 2}
	<div class="row" id="container">
		<div class="columns dasboard-list" id="sortable">

			<div class="blocoNumeros ui-state-default">
				<h5><i class="mdi mdi-cursor-move"></i> Total Geral</h5>

				<div class="BlocoNumero BlocoLaranja">
					<i class="mdi mdi-email"></i>
					<div class="Dados">
						<h4>{$resumo['qtd_noticia']}</h4>
						<span>Notícia{if $resumo['qtd_noticia'] > 1}s{/if}</span>
					</div>
				</div>
				<div class="BlocoNumero BlocoVerde">
					<i class="mdi mdi-email"></i>
					<div class="Dados">
						<h4>{$resumo['qtd_servico']}</h4>
						<span>Serviço{if $resumo['qtd_servico'] > 1}s{/if}</span>
					</div>
				</div>
				<div class="BlocoNumero BlocoAzul">
					<i class="mdi mdi-email"></i>
					<div class="Dados">
						<h4>{$resumo['qtd_contato']}</h4>
						<span>Contato{if $resumo['qtd_contato'] > 1}s{/if}</span>
					</div>
				</div>
				<div class="BlocoNumero BlocoAmarelo">
					<i class="mdi mdi-email"></i>
					<div class="Dados">
						<h4>{$resumo['qtd_email']}</h4>
						<span>Email{if $resumo['qtd_email'] > 1}s{/if}</span>
					</div>
				</div>
			</div>

			<div class="bloco ui-state-default">
				<h5><i class="mdi mdi-cursor-move"></i> Últimas notícias</h5>
				<table class="list">
					<tbody>
					{foreach from=$blogs item="row"}
						<tr data-link="{$basePath}/admin/blogs/form/idblog/{$row['idblog']}">
							<td>{$row['idblog']}</td>
							<td>{$row['titulo']}</td>
							<td>{$this->dateformat("%d/%m/%Y", $row['data'])}</td>
							<td>{if $row['ativo'] == 1}ativo{else}inativo{/if}</td>
						</tr>
					{/foreach}
					<tr data-link="{$basePath}/admin/blogs/list"><td class="verlista" colspan="4"><i class="mdi mdi-format-list-bulleted"></i> Ver Listagem</td></tr>
					</tbody>
				</table>
			</div>

			<div class="bloco ui-state-default">
				<h5><i class="mdi mdi-cursor-move"></i> Últimos Contatos</h5>
				<table class="list">
					<tbody>
					{foreach from=$contatos item="row"}
						<tr data-link="{$basePath}/admin/contatos/view/idcontato/{$row['idcontato']}">
							<td>{$row['idcontato']}</td>
							<td>{$row['nome']}</td>
							<td>{if $row['visualizado'] == 1}lido{else}não lido{/if}</td>
							<td>{$this->dateformat("%d/%m/%Y %Hh%i", $row['data'])}</td>
						</tr>
					{/foreach}
					<tr data-link="{$basePath}/admin/contatos/list"><td class="verlista" colspan="4"><i class="mdi mdi-format-list-bulleted"></i> Ver Listagem</td></tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
{/if}