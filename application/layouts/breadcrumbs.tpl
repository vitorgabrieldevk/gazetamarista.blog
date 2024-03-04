<ul class="breadcrumbs">

	{if $this->pages|count > 0}
		{assign var="page_name" value=''}
		{foreach $this->pages as $key => $page}
			{assign var="page_name" value=$page->getLabel()}
		{/foreach}
	{else}
		<li class="unavailable">
			{$this->breadcrumb('menuitem-categoria')}
		</li>

		<li>
			<a href="{$this->url(['module'=>'admin', 'controller'=>$controller, 'action'=>'list'], 'default', TRUE)}">{$this->breadcrumb('menuitem-descricao')}</a>
		</li>
	{/if}
</ul>

{if !empty($page_name)}
	<h2 style="text-transform: capitalize;">
		{$page_name} {if $paginator}<span style="font-size:13px;">(Total itens: {$paginator->getTotalItemCount()})</span>{/if}
	</h2>
{/if}
