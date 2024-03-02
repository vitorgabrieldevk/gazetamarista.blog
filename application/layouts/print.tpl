
<div style="width: 500px; margin: auto;">
	<div style="float: left;">
		{foreach $_model->getCampo() as $column=>$value}
			<div style="width: 50px; padding: 5px;">{$value}:</div>
		{/foreach}
	</div>
	<div style="float: left;">
		{if $dados|count > 0}
			{foreach from=$dados item=dado}
				<div style=" padding: 5px;">{$dado}</div>
			{/foreach}
		{/if}
	</div>
</div>